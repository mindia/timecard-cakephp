<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
class ProjectsController extends AppController {
  	//var $scaffold;
  	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment', 'Authentication', 'Provider'];
  	public $helpers = ['Workload'];
  	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('index');
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
		$issues = $this->Project->Issue->find('all', ['conditions'=>['Project.id'=>$this->request->params['id'], 'Issue.status'=>1]]);
		$comments = $this->Issue->Comment->find('all' ,['conditions'=>['Issue.id'=>array_map(function($val){return $val['Issue']['id'];}, $issues)], 'order'=>'Comment.created_at desc'] );
		$workloads = $this->Issue->Workload->find('all' ,
			[
				'conditions'=>['Issue.id'=>array_map(function($val){return $val['Issue']['id'];}, $issues)], 
				'order'=>'Workload.created_at desc',
				'limit' => 5
			]);
		$this->set("project", $project);
		$this->set("issues", $issues);
		$this->set("comments", $comments);
		$this->set("workloads", $workloads);
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
	public function edit()
	{
		$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->params['id']]]);
		$github = $this->Provider->find('first', ['conditions'=>['provided_type'=>'Project', 'name'=>'github', 'foreign_id'=>$this->request->params['id']]]);
		$ruffnote = $this->Provider->find('first', ['conditions'=>['provided_type'=>'Project', 'name'=>'ruffnote', 'foreign_id'=>$this->request->params['id']]]);
		$this->set("project", $project);
		$this->set("github_full_name", $github ? $github['Provider']['info']: "");
		$this->set("ruffnote_full_name", $ruffnote ? $ruffnote['Provider']['info']: "");
	}

	public function update()
	{
		if ($this->request->is('post'))
		{
			#github / ruffnote full_name save
			if ($this->addGithub($this->request->data['Project']['github_full_name'], $this->request->data['Project']['id']) != true)
			{
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'default', ['class' => 'alert alert-danger']);
				return $this->redirect('/projects/' . $this->request->data['Project']['id'] . '/edit');
			}
			unset($this->request->data['Project']['github_full_name']);
			if ($this->addRuffnote($this->request->data['Project']['ruffnote_full_name'], $this->request->data['Project']['id']) != true )
			{
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'default', ['class' => 'alert alert-danger']);
				return $this->redirect('/projects/' . $this->request->data['Project']['id'] . '/edit');
			}
			unset($this->request->data['Project']['ruffnote_full_name']);
			if ($this->Project->save($this->request->data['Project']))
			{
			    $this->Session->setFlash(__('The project has been saved'), 'default', ['class' => 'alert alert-success']);
			} else {
			    $this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'default', ['class' => 'alert alert-danger']);
			}
		}
		return $this->redirect('/projects/' . $this->request->data['Project']['id'] . '/edit');
	}

	private function addGithub($fullName, $foreign_id)
	{
		$provider = $this->Provider->find('first', ['conditions' => ['name' => 'github', 'foreign_id' => $foreign_id, 'provided_type' => 'Project']] );
		if ( $provider == false )
		{
			// create
			$this->Provider->create();
			$data = ['name' => 'github',
				 'foreign_id' => $foreign_id,
				 'provided_type' => 'Project'
				];
			$this->Provider->save( $data );
			$provider = $this->Provider->find('first', ['conditions' => ['id' => $this->Provider->id] ]);
		}

		if (!empty($fullName))
		{
			$sock = new HttpSocket();
			$uri = "https://api.github.com/repos/" . $fullName;
			$res = $sock->get($uri);
			if (!$res->isOk())
			{
				$this->Session->setFlash(__('GitHub Full Name is not found on GitHub.'), 'default', ['class' => 'alert alert-danger'], 'provider');
				return false;
			}
		}
		$data = ['info' => $fullName,
			'id' => $provider['Provider']['id']];
		return $this->Provider->save( $data );
	}


	private function addRuffnote( $fullName, $foreign_id )
	{

		$provider = $this->Provider->find('first', ['conditions' => ['name' => 'ruffnote', 'foreign_id' => $foreign_id, 'provided_type' => 'Project']] );
		if ( $provider == false )
		{
			// create
			$this->Provider->create();
			$data = ['name' => 'ruffnote',
				 'foreign_id' => $foreign_id,
				 'provided_type' => 'Project'
				];
			$this->Provider->save( $data );
			$provider = $this->Provider->find('first', ['conditions' => ['id' => $this->Provider->id] ]);
		}

		$data = ['info' => $fullName,
			'id' => $provider['Provider']['id']];
		$this->Provider->save( $data );
		return true;
	}
}
