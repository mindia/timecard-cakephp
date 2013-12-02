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


	public function show($id)
	{
		$project = $this->Project->find('first', ['conditions'=>['id'=>$id]]);
		//todo ; find (issue, comment, workload)
		//$issues = $this->Issue->find('all', ['conditions'=>['project_id'=>$id], 'order'=>'updated_at DESC', 'limit'=>10]);
		//$comments = $this->Comment->find('all', ['conditions'=>['project_id'=>$id]]);
		$this->set("project", $project);
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
