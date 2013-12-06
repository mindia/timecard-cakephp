<?php
class UsersController extends AppController {

    public $name = 'Users';

    /**
    * ログイン
    **/ 
    public function login(){
                $user_signed_in = false;
                $notice = "";
                $alert = "";
	$this->set(compact('user_signed_in','notice','alert'));
    }

    /**
    * ログアウト
    **/
    public function logout(){
        $this->Session->delete('login');
        $this->redirect($this->Auth->logout());
    }
}
