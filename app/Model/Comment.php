<?php
class Comment extends AppModel {
	public $validate = [
		'body' => [
			'required' => [
		              'rule' => ['notEmpty'],
		              'message' => 'body is required'
		       ],
		]
	];

	public $belongsTo = [
		'Issue' => [
			'className' => 'Issue'
		],
		'User' => [
			'className' => 'User',
		],
	];

	public function beforeSave($options = [])
	{
		$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    	= date('Y-m-d H:i:s');
	}
}
