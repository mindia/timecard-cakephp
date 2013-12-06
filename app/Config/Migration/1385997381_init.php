<?php
class Init extends CakeMigration {

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
				'comments' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'body' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'issue_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
				'issues' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'subject' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'will_start_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'status' => array('type' => 'integer', 'null' => false, 'default' => '1'),
					'closed_on' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'author_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'assignee_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'info' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
				'members' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'project_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'is_admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
				'projects' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'is_public' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
					'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'status' => array('type' => 'integer', 'null' => false, 'default' => '1'),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
				'providers' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'provided_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'provided_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'info' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'encrypted_password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'reset_password_token' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'reset_password_sent_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'remember_created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'sign_in_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'current_sign_in_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'last_sign_in_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'current_sign_in_ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'last_sign_in_ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'index_users_on_email' => array('column' => 'email', 'unique' => 1),
						'index_users_on_reset_password_token' => array('column' => 'reset_password_token', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
				),
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
		'down' => array(
			'drop_table' => array(
				'comments', 'issues', 'members', 'projects', 'providers', 'users', 'work_logs'
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
