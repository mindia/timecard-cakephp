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
		$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    	= date('Y-m-d H:i:s');
	}
}
