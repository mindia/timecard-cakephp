<?php
/**
 * WorkloadFixture
 *
 */
class WorkloadFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'start_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'issue_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'start_at' => '2014-02-05 01:55:54',
			'end_at' => '2014-02-05 01:55:54',
			'issue_id' => 1,
			'user_id' => 1,
			'created_at' => '2014-02-05 01:55:54',
			'updated_at' => '2014-02-05 01:55:54'
		),
	);

}
