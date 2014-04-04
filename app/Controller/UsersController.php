<?php
App::uses('AppController', 'Controller');
App::import('Vendor','/Spyc/Spyc');


class UsersController extends AppController {

	public $components = ['Cookie'];
	public $uses = ['Authentication'];

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('isSideMenu', false);
		$this->Auth->allow('show', 'signUp', 'signIn', 'signOut', 'password', 'opauthComplete');
	}

	public function beforeRender(){
		$this->set('refer',$this->referer());
	}

	/**
	 * #todo show user data
	 */
	public function show(){
		$user = $this->User->find('first', ['conditions' => ['id' => $this->request->params['id']]]);
		$github = $this->Authentication->find('first', ['conditions' => ['user_id' => $this->request->params['id'], 'provider'=>'github']]);
		$this->set('user', $user);
		$this->set('github', $github);
	}

	public function signUp()
	{
		if ($this->request->is('post')) {
            		$this->User->create();
            		if ($this->User->save($this->request->data))
            		{
            			$this->SendEmail->userCreate($this->request->data['User']);
                		$this->Session->setFlash(__('The user has been saved'));
                		$this->redirect('/');
            		} else {
                		$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            		}
        	}
	}

	public function signIn()
	{
		$var = Spyc::YAMLLoad(APP . 'Config' . DS . 'omniauth.yml');
		$auth = $var['auth'];

		if ($this->request->is('post'))
		{
			if ($this->Auth->login($this->request->data['User']))
			{
				$this->Cookie->write('Auth', $cookie, true, '+2 weeks');
				$this->Session->setFlash(__('Signed in successfully.'), 'default', ['class' => 'alert alert-success']);
			    $this->redirect($this->Auth->redirect());
			}else{
			    $this->Session->setFlash(__('Invalid emai or password, try again'), 'default', ['class' => 'alert alert-danger']);
			}
		}
		$datas  = ['controller_name'=> $this->name,
			   'action' => $this->action,
			   'auth'=> $auth];
		$this->set(compact('datas'));
	}

	public function signOut()
	{
		$this->Cookie->delete('Auth');
		$this->Session->setFlash(__('You need to sign in or sign up before continuing.', 'default', ['class' => 'alert alert-success']));
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
				'github_username' => $this->User->githubUserName($current_user['User']['id']),
				'ruffnote_username' => $this->User->ruffnoteUserName($current_user['User']['id'])
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

	public function disconnect() {
		$provider = $this->request->query['provider'];
		$current_user = $this->Session->read('current_user');
		$userId = $current_user['User']['id'];
		$data = $this->Authentication->find('first', ['conditions'=>['user_id'=> $userId, 'provider'=>$provider]]);
		$this->Authentication->delete($data['Authentication']['id']);

		return $this->redirect('/users/edit');
	}

	public function opauthComplete() {
		// search authentication
		$auth = $this->data['auth'];
		$uid = $auth['uid'];
		$provider = $auth['provider'];
		$userId = '';
		$isLogin = false;

		$current_user = $this->Session->read('current_user');
		if (empty($current_user)) {
			// login
			$authentication = $this->Authentication->find('first', ['conditions' => ['uid'=>$uid, 'provider'=>$provider]]);
			if (!empty($authentication)) {
				$userId = $authentication['Authentication']['user_id'];
				$user = $this->User->find('first', ['conditions'=> ['id'=> $userId]]);
			} else {
				$password = bin2hex(openssl_random_pseudo_bytes(20));
				$userData = ['User' => [
						'email' => $auth['info']['email'],
						'name' => $auth['info']['nickname'],
						'encrypted_password' => $password,
						'password_confirmation' => $password,
						]
					];
				$data = $this->User->find('first', ['conditions' => ['email' => $auth['info']['email']]]);
				if (!empty($data)) {
					$userData = array_merge($userData['User'], ['id' => $data['User']['id']]);
				} else {
					$this->User->create();
				}
				if ($this->User->save($userData)) {
					$userId = $this->User->id;
					$user = $this->User->find('first', ['conditions'=> ['id'=> $userId]]);
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
					return;
				}
			}
			$isLogin = true;
		} else {
			$userId = $current_user['User']['id'];
			// user edit
		}

		$data = $this->Authentication->find('first', ['conditions'=>['user_id'=> $userId, 'provider'=>$provider]]);
		$saveData = ['user_id'=> $userId,
			'provider' => $provider,
			'uid' => $uid,
			'username' => $auth['info']['nickname'],
			'oauth_token'=>$auth['credentials']['token'],
			];
		if (!empty($data)){
			$saveData = array_merge($saveData, ['id'=>$data['Authentication']['id']]);
		}

		$this->Authentication->save($saveData);

		if ($isLogin){
			$authdata = ['email'=>$user['User']['email'], 'encrypted_password'=>$user['User']['encrypted_password']];
			$this->Auth->login($authdata);
			return $this->redirect(['controller' => 'projects', 'action' => 'index']);
		} else {
			// user edit
			return $this->redirect(['controller' => 'users', 'action' => 'edit']);
		}
	}
}
