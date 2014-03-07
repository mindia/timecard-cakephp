<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class IssuesController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Provider', 'Authentication'];
	public $helpers = ['Workload'];
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

		$this->set('project', $project['Project']);
		$this->set('project_member', $this->getAssigneeList($project));
		$this->set('isGitHub', $this->isGitHub($project));

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
				if (!empty($github))
				{
					$saveData = array_merge($saveData, ['info'=>$github['html_url']]);
				} else {
					$this->Session->setFlash(__('The Issue could not save to GitHub.'), 'default', ['class' => 'alert alert-warning'], 'provider');
				}
			}

			$this->Issue->create();
			if ($this->Issue->save($saveData))
			{
				$this->Session->setFlash(__('The Issue has been saved'), 'default', ['class' => 'alert alert-success']);
 			    $this->redirect(['controller'=>'projects', 'action'=>$this->request->data['Issue']['project_id']]);
			} else {
			    $this->Session->setFlash(__('The Issue could not be saved. Please, try again.'), 'default', ['class' => 'alert alert-alert']);
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

	public function edit()
	{
		$issue = $this->Issue->find('first', ['conditions'=>['Issue.id'=>$this->request->params['id']]]);
		$project = $this->Project->find('first', ['conditions'=>['id'=>$issue['Issue']['project_id']]]);
		if(count($project) === 0) throw new NotFoundException('page not found',404);

		$this->set('issue', $issue);
		$this->set('project_member', $this->getAssigneeList($project));
		$this->set('isGitHub', $this->isGitHub($project));
	}

	public function update()
	{
		if ($this->request->is('post'))
		{
			$saveData = $this->request->data['Issue'];
			if (!empty($this->request->data['Issue']['github']) && $this->request->data['Issue']['github'])
			{
				$github = $this->createGitHubIssue($this->request->data['Issue']['github']);
				if (!empty($github))
				{
					$saveData = array_merge($saveData, ['info'=>$github['html_url']]);
				} else {
					$this->Session->setFlash(__('The Issue could not save to GitHub.'), 'default', ['class' => 'alert alert-warning'], 'provider');
				}
			}
			$this->Issue->create();
			if ($this->Issue->save($saveData))
			{
				$this->Session->setFlash(__('The Issue has been saved'), 'default', ['class' => 'alert alert-success']);
			} else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.'), 'default', ['class' => 'alert alert-alert']);
			}
		}

		$this->redirect($this->referer());
	}

	private function createGitHubIssue($issue)
	{
		$github = Configure::read('Opauth.Strategy.GitHub');
		$sock = new HttpSocket();

		// create request URI
		$cond = ['foreign_id' => $issue['project_id'], 'name' => 'github', 'provided_type' => 'Project'];
		$provider = $this->Provider->find('first', ['conditions' => $cond]);
		$uri = "https://api.github.com/repos/".$provider['Provider']['info']."/issues";
		if (!empty($issue['info']))
		{
			$uri .= substr(strrchr($issue['info'], '/'), 0);
			$method = 'PATCH';
		} else {
			$method = 'POST';
		}

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
		$request = ['Authorization' => 'token '.$authentication['Authentication']['oauth_token']];

		// send request
		$response = $sock->request(['method'=>$method, 'uri'=>$uri, 'body'=>json_encode($data), 'header'=>$request]);
		if (!empty($response))
		{
			if ($response->code == 200 || $response->code == 201)
			{
				return json_decode($response, true);
			}
		}
		return false;
	}

	private function getAssigneeList($project)
	{
		$users = $this->User->findProjectUserName([$project]);
		$members[] = "";
		foreach ($project['Member'] as $key => $member){
			$members[$member['user_id']] = $users[$member['user_id']];
		}
		return $members;
	}

	private function isGitHub($project)
	{
		$cond = ['foreign_id' => $project['Project']['id'], 'name' => 'github', 'provided_type' => 'Project'];
		$provider = $this->Provider->find('first', ['conditions' => $cond]);
		if (!empty($provider['Provider']['info']))
		{
			return true;
		} else {
			return false;
		}
	}
}