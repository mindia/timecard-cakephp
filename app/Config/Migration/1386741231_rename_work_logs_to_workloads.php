<?php
class RenameWorkLogsToWorkloads extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'workloads' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'start_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'end_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'issue_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
			),
			'drop_table' => array(
				'work_logs'
			),
		),
		'down' => array(
			'drop_table' => array(
				'workloads'
			),
			'create_table' => array(
				'work_logs' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'start_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'end_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'issue_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
