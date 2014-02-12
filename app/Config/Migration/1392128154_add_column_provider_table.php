<?php
class AddColumnProviderTable extends CakeMigration {

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
			'alter_field' => array(
				'authentications' => array(
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
				),
			),
			'create_field' => array(
				'projects' => array(
					'crowdworks_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'updated_at'),
				),
				'providers' => array(
					'created_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'provided_id'),
					'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'after' => 'created_at'),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'authentications' => array(
					'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
				),
			),
			'drop_field' => array(
				'projects' => array('crowdworks_url',),
				'providers' => array('created_at', 'updated_at',),
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
