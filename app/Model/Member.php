<?php
class Member extends AppModel
{
	public $belongsTo = [
		'User' => [
			'className' => 'User','foreignKey'   => 'user_id'
		]
	];
	public function beforeSave($options = [])
	{
		$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
	    	= date('Y-m-d H:i:s');
	}
	
	public function isAdmin($user_id, $project_id)
	{
		$res = $this->find('first', ['conditions'=>['user_id'=>$user_id, 'project_id'=>$project_id], 'fields'=>"is_admin"]);
		if(!isset($res['Member']['is_admin'])) return false;
		if($res['Member']['is_admin']==0) return false;
		return true;
	}

}
