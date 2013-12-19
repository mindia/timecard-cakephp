<?php
class Project extends AppModel
{
	public $validate = [
		'name' => [
			'required' => [
              'rule' => ['notEmpty'],
              'message' => 'name is required'
           ],
           'length' => [
           	'rule' => ['maxLength', 255],
           	'message' => 'name is too long.'
           ]
       ]
	];

	public $hasMany = [
        'Member' => [
            'className'  => 'Member',
        ]
    ];

	public function beforeSave($options = [])
	{
		$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    	= date('Y-m-d H:i:s');
	}
}


