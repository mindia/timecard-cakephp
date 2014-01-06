<?php
App::uses('AppController', 'Controller');

class IssuesController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue'];
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function show()
	{
		$issue = $this->Issue->find('first', ['conditions'=>['Issue.id'=>$this->request->params['id']]]);
		$project_member = $this->Project->find('first', ['conditions'=>['Project.id'=>$issue['Project']['id']]]);
		$this->set('issue', $issue);
		$this->set('project_member', $project_member);
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

		$this->set('project', $project['Project']);
		$this->set('project_member', $assign_select($project['Member']));
		$this->render('new');
	}

	public function create()
	{
		if ($this->request->is('post'))
		{
			$this->Issue->create();

			if ($this->Issue->save($this->request->data['Issue']))
			{
			    $this->Session->setFlash(__('The Issue has been saved'));
			    $this->redirect('/projects/'. $this->request->data['Issue']['project_id']);
			} else {
			    $this->Session->setFlash(__('The Issue could not be saved. Please, try again.'));
			}
		}

		$this->redirect('/projects/');
	}
}