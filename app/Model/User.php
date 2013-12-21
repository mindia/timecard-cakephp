<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
	public $validate = [
		'email' => [
			'required' => [
              'rule' => ['notEmpty'],
              'message' => 'email is required'
           ],
          'email' => [
            'rule' => 'email',
            'message' => 'メールアドレスが正しくありません。'
          ],
           'isUnique' => [
           	'rule' => ['isUnique'],
              'message' => '既に登録されているメールアドレスです。'
           ]
       ],
       'name' => [
			'required' => [
              'rule' => ['notEmpty'],
              'message' => 'name is required'
           ]
       ],
       'encrypted_password' => [
			'required' => [
              'rule' => ['notEmpty'],
              'message' => 'password is required'
           ],
           'length' => [
           	'rule' => ['minLength', 8],
              'message' => 'passwordは8文字以上で入力してください.'
           ],
       ],
       'password_confirmation' => [
			'required' => [
              'rule' => ['notEmpty'],
              'message' => 'password_confirmation is required'
           ],
           'isSamePasswd' => [
           	'rule' => array('isSamePasswd'),
				'message' => 'パスワードの確認ができませんでした。',
				'allowEmpty' => false,
				'required' => true,
				'last' => false,
           ],
       ]
	];

	public function beforeSave($options = [])
	{
	    if (isset($this->data[$this->alias]['encrypted_password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['encrypted_password'] = $passwordHasher->hash($this->data[$this->alias]['encrypted_password']);
	    }

	    $this->data[$this->alias]['current_sign_in_at'] = $this->data[$this->alias]['last_sign_in_at'] 
	    	= $this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    	= date('Y-m-d H:i:s');
	    $this->data[$this->alias]['current_sign_in_ip'] = $this->data[$this->alias]['last_sign_in_ip'] = $_SERVER['REMOTE_ADDR'];
	    return true;
	}

	public function isSamePasswd($data)
	{
		if($this->data[$this->alias]['encrypted_password'] === $data['password_confirmation']) return true;
		return false;
	}
}


