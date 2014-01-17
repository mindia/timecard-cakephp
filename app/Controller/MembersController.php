<?php
App::uses('AppController', 'Controller');

class MembersController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment'];
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		if($this->request->is('get') && isset($this->request->query['user_id'])) return $this->__create();
		$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->params['id']]]);
		$this->set('project', $project);
		$members = $this->Member->find('all', ['conditions'=>['project_id'=>$this->request->params['id']]]);
		$this->set('members', $members);

		$exclude_user = array_map(
			function($val)
			{
				return $val['Member']['user_id'];
			},
			$members
		);

		$users = $this->User->find('all', ['conditions'=>['NOT'=>['id'=>$exclude_user]]]);
		$this->set('users', $users);
	}

	//todo members add
	// member is admin
	private function __create()
	{
		$current_user_id = $this->Session->read('current_user')['User']['id']; 
		$is_admin = $this->Member->isAdmin($current_user_id, $this->request->params['id']);
		if(!$is_admin) throw new BadRequestException('you can not add member', 400);

		$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->params['id']]]);
		if(count($project) == 0) throw new BadRequestException('not exists project', 400);

		$user = $this->User->find('first', ['conditions'=>['id'=>$this->request->query['user_id']]]);
		if(count($user) == 0) throw new BadRequestException('not exists user', 400);

		if((int)$current_user_id === (int)$this->request->query['user_id']) throw new BadRequestException('not exists user', 400);

		$this->Member->create();
		$data = [
		    		'project_id'=>$this->request->params['id'], 
		    		'user_id'=>$this->request->query['user_id'], 
		    		'is_admin'=>0, 
		];

		if ($this->Member->save($data))
		{
		    $this->Session->setFlash(__('The Member has been saved'));
		} else {
		    $this->Session->setFlash(__('The Member could not be saved. Please, try again.'));
		}

		$this->redirect('/projects/'. $this->request->params['id'].'/members');
	}

	// todo members delete
	// member is admin
	public function del()
	{
		if ($this->request->is('post'))
		{
			header('Content-type: application/json');
			$is_admin = $this->Member->isAdmin($this->Session->read('current_user')['User']['id'], $this->request->data['project_id']);
			if(!$is_admin)
			{
				print json_encode(['status'=>'error', 'error' => 'you can not delete member']); exit;
			} //throw new BadRequestException('you can not delete member', 400);

			$project = $this->Project->find('first', ['conditions'=>['id'=>$this->request->data['project_id']]]);
			if(count($project) == 0){
				print json_encode(['status'=>'error', 'error' => 'not exists project']); exit; 
			}//throw new BadRequestException('not exists project', 400);

			$member = $this->Member->find('first', ['conditions'=>['Member.id'=>$this->params->id]]);
			if(count($member) == 0){
				print json_encode(['status'=>'error', 'error' => 'not exists member']); exit; 
			}//throw new BadRequestException('not exists member', 400);

			$this->Member->create();
			if ($this->Member->delete($this->params->id))
			{
				$this->Session->setFlash(__('The Member has been deleted'));
			} else {
				print json_encode(['status'=>'error', 'error' => 'The Member could not be deleted. Please, try again.']); exit;
			}

			print json_encode(['status' => 'success']);
			exit;
		}
	}
}
