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
		$this->Session->destroy('current_user');
		$this->redirect($this->Auth->logout());
	}

	public function edit()
	{
		if ($this->request->is('post')){
			$this->User->unbindValidation('remove', ['encrypted_password'], true);
			$this->User->unbindValidation('remove', ['password_confirmation'], true);
			
			$auth_user = $this->Auth->user();
			if ($auth_user['email'] == $this->request->data['User']['email'] ) {
				unset($this->User->validate['email']['isUnique']);
			}
			if ($this->User->save($this->request->data)){
				$this->Session->setFlash('You updated your account successfully.');
##todo
				return $this->redirect('/users/edit');
			} else {
				$this->Session->setFlash('do not updated!!');
				$this->log("validationErrors=" . var_export($this->User->validationErrors, true));
			}
		}
	}
}
