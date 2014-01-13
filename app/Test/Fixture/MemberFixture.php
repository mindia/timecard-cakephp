<?php
class MemberFixture extends CakeTestFixture {
	public $useDbConfig = 'test';
	public $fields = [
	    'id' => ['type' => 'integer', 'key' => 'primary'],
	    'project_id' => ['type' => 'integer', ],
	    'user_id' => ['type' => 'integer', ],
	    'is_admin' => ['type' => 'integer', ],
	    'created_at' => 'datetime',
	    'updated_at' => 'datetime',
	];
	public $records = [
		[
			'id' => 1,
			'project_id' => 1,
			'user_id' => 1,
			'is_admin' => 1,
			'created_at' => '2013-12-22 00:00:00',
			'updated_at' => '2013-12-22 00:00:00',
		],
		[
			'id' => 2,
			'project_id' => 1,
			'user_id' => 1,
			'is_admin' => 0,
			'created_at' => '2013-12-22 00:00:00',
			'updated_at' => '2013-12-22 00:00:00',
		],
	];
 }
