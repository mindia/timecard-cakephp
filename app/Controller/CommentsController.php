<?php
class CommentsController extends AppController {
	public $uses = ['Project', 'Member', 'User', 'Issue', 'Comment'];
	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function create()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;
			$data['Comment']['issue_id'] = $this->request->params['id'];
			$data['Comment']['user_id'] = $this->Session->read('current_user')['User']['id'];

			$this->Comment->create();

			if ($this->Comment->save($data))
			{
				$this->Session->setFlash(__('The Comment has been saved'));
				$this->redirect('/issues/'. $this->request->params['id']);
			} else {
			    	$this->Session->setFlash(__('The Comment could not be saved. Please, try again.'));
			    	$this->redirect('/issues/'. $this->request->params['id']);
			}
		}
	}

	public function update()
	{

	}

	public function destroy()
	{
		
	}
}