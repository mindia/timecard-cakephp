<?php
class Workload extends AppModel {
	public $belongsTo = [
		'Issue' => [
			'className' => 'Issue'
		],
		'User' => [
			'className' => 'User'
		]
	];

	public $validate = [
		'start_at' => [
			'required' => [
		              'rule' => ['notEmpty'],
		              'message' => 'start_at is required'
		       ],
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
	
	public function isRunning($user_id)
	{
		return $this->find('count', ['conditions'=>['NOT'=>['start_at'=>null], 'end_at'=>null, 'user_id'=>$user_id] ]);
	}
}
