<?php
class ProjectFixture extends CakeTestFixture {
	public $useDbConfig = 'test';
	public $fields = [
	    'id' => ['type' => 'integer', 'key' => 'primary'],
	    'name' => ['type' => 'string', 'length' => 255, 'null' => false],
	    'description' => ['type' => 'text'],
	    'is_public' => ['type' => 'integer', ],
	    'parent_id' => ['type' => 'integer', ],
	    'status' => ['type' => 'integer', 'null' => false],
	    'created_at' => 'datetime',
	    'updated_at' => 'datetime',
	];
	public $records = [
		['id' => 1, 'name' => 'project_parent_1', 'description' => '', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'is_public'=>1, 'parent_id'=>null, 'status'=>1],
		['id' => 2, 'name' => 'project_child_1', 'description' => 'hogehoge', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'is_public'=>0, 'parent_id'=>1, 'status'=>1],
		['id' => 3, 'name' => 'project_child_2', 'description' => 'hogehoge', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'is_public'=>1, 'parent_id'=>1, 'status'=>5],
		['id' => 4, 'name' => 'project_child_3', 'description' => 'hogehoge', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'is_public'=>1, 'parent_id'=>1, 'status'=>9],
		['id' => 5, 'name' => 'project_parent_5', 'description' => '', 'created_at' => '2007-03-18 10:39:23', 'updated_at' => '2007-03-18 10:41:31', 'is_public'=>1, 'parent_id'=>null, 'status'=>1],
	];
 }
