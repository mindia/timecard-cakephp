<?php
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class SendEmailComponent extends Component{

	public function userCreate($user)
	{
		$email = new CakeEmail('default');
		$email->config(['log' => 'email'])
			->from(Configure::read('SYSTEM_NOTIFY_EMAIL'))
			->to(Configure::read('SYSTEM_ADMIN_EMAIL'))
			->subject('ユーザー登録通知')
			->emailFormat('text')
			->template('createuser')
			->viewVars( ['user_email' => $user['email'], 'user_name' => $user['name'] ] );

		$email->send();                              
	}
}