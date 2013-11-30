<?php
class UserFixture extends CakeTestFixture {
	public $useDbConfig = 'test';
	public $fields = [
	    'id' => ['type' => 'integer', 'key' => 'primary'],
	    'email' => ['type' => 'string', 'length' => 255, 'null' => false],
	    'encrypted_password' => ['type' => 'string', 'length' => 255, 'null' => false],
	    'created_at' => 'datetime',
	    'updated_at' => 'datetime',
	    'username' => ['type' => 'string', 'length' => 255, 'null' => false],
	];
	public $records = [
		['id' => 1, 'email' => 'test1@timecard-cakephp.com', 'encrypted_password' => '', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'username'=>'test1']
	];
 }
