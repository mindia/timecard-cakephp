<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class IssuesController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Provider', 'Authentication'];
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		$status = (isset($this->request->query['status']))? $this->request->query['status']:'open';
		$projectId = (isset($this->request->query['project_id']))? $this->request->query['project_id']:null;
		$current_user_id = $this->Session->read('current_user')['User']['id'];

		//$issue = $this->Issue->find('all', ['conditions'=>['Issue.assignee_id' => $current_user_id]]);
		$issues = $this->Issue->withStatus($status, $projectId);
		$this->set('issues', $issues);
		$this->layout = null;
		$response = $this->render('/Elements/Issues/list');
		$html = $response->__toString();
		header('Content-type: application/json');
		print json_encode(['html' => $html, 'error'=>'']);
		exit;
	}

	public function show()
	{
		$issue = $this->Issue->find('first', ['conditions'=>['Issue.id'=>$this->request->params['id']]]);
		$project_member = $this->Project->find('first', ['conditions'=>['Project.id'=>$issue['Project']['id']]]);
		$comment_user = $this->Comment->find('all', ['conditions'=>['Issue.id'=>$issue['Issue']['id']]]);
		$this->set('issue', $issue);
		$this->set('project_member', $project_member);
		$this->set('comment_user', $comment_user);
	}

	public function registration()
	{
		$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->params['id']]]);
		if(count($project) === 0) throw new NotFoundException('page not found',404);
		$users = $this->User->fundProjectUserName([$project]);

		// todo class method
		$assign_select = function($project_member) use($users)
		{
			$members[] = "";
			foreach($project_member as $key=>$member){
				$members[$member['user_id']] = $users[$member['user_id']];
			}
			return $members;
		};

		$cond = ['foreign_id' => $project['Project']['id'], 'name' => 'github', 'provided_type' => 'Project'];
		$provider = $this->Provider->find('first', ['conditions' => $cond]);

		$this->set('project', $project['Project']);
		$this->set('project_member', $assign_select($project['Member']));
		if (empty($provider['Provider']['info']))
		{
			$this->set('isGitHub', false);
		} else {
			$this->set('isGitHub', true);
		}
		$this->render('new');
	}

	public function create()
	{
		if ($this->request->is('post'))
		{
			$saveData = $this->request->data['Issue'];
			if (!empty($this->request->data['Issue']['github']) && $this->request->data['Issue']['github'])
			{
				$github = $this->createGitHubIssue($this->request->data['Issue']);
				$saveData = array_merge($saveData, ['info'=>$github['html_url']]);
			}
			$this->Issue->create();

			if ($this->Issue->save($saveData))
			{
				$this->Session->setFlash(__('The Issue has been saved'));
 			    $this->redirect(['controller'=>'projects', 'action'=>$this->request->data['Issue']['project_id']]);
			} else {
			    $this->Session->setFlash(__('The Issue could not be saved. Please, try again.'));
			}
		}

		$this->redirect('/projects/');
	}

	public function close()
	{
		/* todo  work_in_progress check
		if current_user.work_in_progress?(@issue)
			current_user.running_workload.update(end_at: Time.now.utc)
		end
		*/

		$error = '';
		if(!$this->Issue->close($this->request->params['id']))
		{
			$error = 'can not Issue status.';
		}else{
			/* todo github
			if @issue.github
        			@issue.github.close(current_user.github.oauth_token)
      			end
      			*/
		}

		$issues = $this->Issue->withStatus('open');
		$this->set('issues', $issues);
		$this->layout = null;
		$response = $this->render('/Elements/Issues/list');
		$html = $response->__toString();
		header('Content-type: application/json');
		print json_encode(['html' => $html, 'error'=>$error]);
		exit;
	}

	public function reopen()
	{
		$error = '';
		if(!$this->Issue->reopen($this->request->params['id']))
		{
			$error = 'can not Issue status.';
		}else{
			/* todo github
			if @issue.github
        			@issue.github.reopen(current_user.github.oauth_token)
      			end
      			*/
		}

		$issues = $this->Issue->withStatus('closed');
		$this->set('issues', $issues);
		$this->layout = null;
		$response = $this->render('/Elements/Issues/list');
		$html = $response->__toString();
		header('Content-type: application/json');
		print json_encode(['html' => $html, 'error'=>$error]);
		exit;

	}

	public function postpone()
	{

	}

	public function doToday()
	{

	}

	private function createGitHubIssue($issue)
	{
		$github = Configure::read('Opauth.Strategy.GitHub');
		$sock = new HttpSocket();

		// create request URI
		$cond = ['foreign_id' => $issue['project_id'], 'name' => 'github', 'provided_type' => 'Project'];
		$provider = $this->Provider->find('first', ['conditions' => $cond]);
		$uri = "https://api.github.com/repos/".$provider['Provider']['info']."/issues";

		// create request data
		$data = ['title' => $issue['subject'], 'body' => $issue['description']];
		$assignee = $this->User->find('first', ['conditions' => ['id' => $issue['assignee_id']]]);
		if (!empty($assignee))
		{
			$data = array_merge($data, ['assignee' => $assignee['User']['name']]);
		}

		// create a HTTP header
		$author = $this->User->find('first', ['conditions' => ['id' => $issue['author_id']]]);
		$authentication = $this->Authentication->find('first', ['conditions' => ['user_id'=>$author['User']['id'], 'provider'=>'github']]);
		$request = ['header' => ['Authorization' => 'token '.$authentication['Authentication']['oauth_token']]];

		// send request
		$response = $sock->post($uri, json_encode($data), $request);
		if (empty($response))
		{
			return false;
		}
		return json_decode($response, true);
	}
}