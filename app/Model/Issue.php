<?php
class Issue extends AppModel {
	public $validate = [
		'subject' => [
			'required' => [
		              'rule' => ['notEmpty'],
		              'message' => 'subject is required'
		       ],
		]
	];

	public $belongsTo = [
		'Project' => [
			'className' => 'Project'
		],
		'Author' => [
			'className' => 'User',
			'foreignKey' => 'author_id'
		],
		'Assignee' => [
			'className' => 'User',
			'foreignKey' => 'assignee_id'
		]
	];

	public $hasMany = [
	    'Comment' => [
	        'className'  => 'Comment',
	    ],
	    'Workload' => [
	        'className'  => 'Workload',
	    ]
	];


	public function beforeSave($options = [])
	{
		if(is_null($this->data[$this->alias]['id'])){
			$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    		= date('Y-m-d H:i:s');
	    	}else{
	    		$this->data[$this->alias]['updated_at'] = date('Y-m-d H:i:s');
	    	}
	}

	public function withStatus($status)
	{
		switch($status)
		{
			case "open":
				$param = 1;
				$where = 'Issue.status';
				break;
			case "closed":
				$param = 9;
				$where = 'Issue.status';
				break;
			case 'not_do_today':
				$param = date('Y-m-d H:i:s');
				$where = 'Issue.will_start_at >= ';
				break;

		}

		return $this->find('all', ['conditions'=>[$where => $param] ]);
	}

	public function close($id)
	{
		$data = ['Issue'=>['id'=>$id, 'status'=>9, 'updated_at'=>date('Y-m-d H:i:s')]];
		$this->create();
		if($this->save($data['Issue'])) return true;
		return false;
	}

	public function reopen($id)
	{
		$data = ['Issue'=>['id'=>$id, 'status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]];
		$this->create();
		if($this->save($data['Issue'])) return true;
		return false;
	}
}
