<?php
App::uses('AppModel', 'Model');
/**
 * Authentication Model
 *
 */
class Authentication extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public function beforeSave($options = [])
	{
		if(is_null($this->data[$this->alias]['id'])){
			$this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at']
				= date('Y-m-d H:i:s');
		}else{
			$this->data[$this->alias]['updated_at'] = date('Y-m-d H:i:s');
		}
	}
}
