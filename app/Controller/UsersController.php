<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('sign_up', 'sign_in', 'sign_out');
	}

	/**
	 * #todo show user data
	 */
	public function show(){}

	public function sign_up()
	{
		if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
	}

	public function sign_in()
	{
		if ($this->request->is('post'))
		{
			if ($this->Auth->login($this->request->data['User']))
			{
				$this->Session->setFlash(__('Signed in successfully.'));
			    $this->redirect($this->Auth->redirect());
			}else{
			    $this->Session->setFlash(__('Invalid emai or password, try again'));
			}
		}
	}

	public function sign_out()
	{
		$this->Session->setFlash(__('You need to sign in or sign up before continuing.'));
		$this->redirect($this->Auth->logout());
	}
}
