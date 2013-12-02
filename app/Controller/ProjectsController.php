<?php
class ProjectsController extends AppController {
  	//var $scaffold;
  	public $uses = ['Project', 'Member', 'User', 'Issue'];
  	public function beforeFilter()
	{
		parent::beforeFilter();
	}
	public function index()
	{
		$status = (isset($this->request->query['status']))? $this->request->query['status']:Configure::read('STATUS_ACTIVE');
		$public_projects = $this->Project->find("all", ['conditions'=>['is_public'=>1, 'status'=>$status] ]);
		$this->Project->hasMany['Member']['conditions'] = array('Member.user_id' => $this->Session->read('current_user')['User']['id']);
		$my_private_projects = $this->Project->find("all", ['conditions'=>['is_public'=>0, 'status'=>$status] ]);
		$projects = array_merge((array)$public_projects, (array)$my_private_projects);

		$this->set("projects", $projects);
		$this->set('project_users', $this->User->fundProjectUserName($projects));
	}

	public function show()
	{
		$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->params['id']]]);

		//todo ; find (issue, comment, workload)
		$issues = $this->Project->Issue->find('all', ['conditions'=>['Project.id'=>$this->request->params['id'], 'Issue.status'=>1]]);
		//$comments = $this->Comment->find('all', ['conditions'=>['project_id'=>$id]]);
		$this->set("project", $project);
		$this->set("issues", $issues);
	}

	public function registration()
	{
		$this->render('new');
	}

	public function create()
	{
		if ($this->request->is('post'))
		{
			$this->Project->create();
			$data = [
			    'Project' => $this->request->data['Project'],
			    'Member' => [
			    	['user_id'=>$this->Session->read('current_user')['User']['id'], 'is_admin'=>1, ]
			    ]
			];

			if ($this->Project->saveAssociated($data))
			{
			    $this->Session->setFlash(__('The project has been saved'));
			    $this->redirect('/projects');
			} else {
			    $this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}

		$this->render('new');
	}
}
