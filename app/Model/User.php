<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Authentication', 'Model');

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

    public $hasMany = [
        'Member' => [
            'className'  => 'Member',
        ],
        'Issue' => [
            'className'  => 'Issue',
            'foreignKey' => 'assignee_id'
        ],
        'Comment' => [
            'className'  => 'Comment',
        ],
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
    public function findProjectUserName($projects)
    {
       if(count($projects) === 0) return [];
       $user_ids = [];
       foreach($projects as $project)
       {
            foreach ($project['Member'] as $member) {
              $user_ids[$member['user_id']] = $member['user_id'];
            }
       }
       $this->unbindModel(['hasMany'=>['Member']], false);
       $users = $this->find('list', ['conditions'=> ['id'=> $user_ids], 'fields'=>['name'] ]);
       return $users;
    }
    public function findProjectUserEmail($projects)
    {
       if(count($projects) === 0) return [];
       $user_ids = [];
       foreach($projects as $project)
       {
            foreach ($project['Member'] as $member) {
              $user_ids[$member['user_id']] = $member['user_id'];
            }
       }
       $this->unbindModel(['hasMany'=>['Member']], false);
       $users = $this->find('list', ['conditions'=> ['id'=> $user_ids], 'fields'=>['email'] ]);
       return $users;
    }
/*
    def work_in_progress?(issue)
    working_issue == issue
  end

  def working_issue
    if workloads.running?
      workloads.find_by("start_at IS NOT NULL AND end_at IS NULL").issue
    else
      nil
    end
  end

  def running_workload
    workloads.find_by("start_at IS NOT NULL AND end_at IS NULL")
  end
 */

	public function connected($provider, $id){
		$conditions = ['Authentication.provider'=>$provider, 'Authentication.user_id'=>$id];
		$this->Authentication = new Authentication();
		return $this->Authentication->find('first', ['conditions' => $conditions]);
	}

	public function githubUserName($id){
		$row = $this->connected('github', $id);
		if ($row) {
			return $row['Authentication']['username'];
		}
		return '';
	}

	public function ruffnoteUserName($id){
		$row = $this->connected('ruffnote', $id);
		if ($row) {
			return  $row['Authentication']['username'];
		}
		return '';
	}
}


