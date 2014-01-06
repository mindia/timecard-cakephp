<?php
App::uses('AppController', 'Controller');
App::import('Vendor','/Spyc/Spyc');


class UsersController extends AppController {
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('show', 'sign_up', 'sign_in', 'sign_out', 'password');
	}

	public function beforeRender(){
		$this->set('refer',$this->referer());
	}

	/**
	 * #todo show user data
	 */
	public function show(){
	}

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
		$var = Spyc::YAMLLoad(APP . 'Config' . DS . 'omniauth.yml');
		$auth = $var['auth'];

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
		$datas  = ['controller_name'=> $this->name,
			   'action' => $this->action,
			   'auth'=> $auth];
		$this->set(compact('datas'));
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
				$this->log("validationErrors=" . var_export($this->User->validationErrors, LOG_ERROR));
			}
		} else {
			$current_user = $this->Session->read('current_user');
			$datas = [
				'connect_gitHub' => empty($this->User->connected('github', $current_user['User']['id'])) ? false: true,
				'connect_ruffnote'=> empty($this->User->connected('ruffnote', $current_user['User']['id'])) ? false: true,
				'github_username' => $this->User->github_username($current_user['User']['id']),
				'ruffnote_username' => $this->User->ruffnote_username($current_user['User']['id'])
				];
			$this->set(compact('datas'));
		}
	}

	public function password(){
		$var = Spyc::YAMLLoad(APP . 'Config' . DS . 'omniauth.yml');
		$auth = $var['auth'];
		$datas  = ['controller_name'=> $this->name,
			   'action' => $this->action,
			   'auth'=> $auth];
		$this->set(compact('datas'));
	}

	public function github() {

	}

	public function ruffnote() {

	}
}
