<?php
/**
 * AuthenticationFixture
 *
 */
class AuthenticationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'provider' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'uid' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'username' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'oauth_token' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
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
			'user_id' => 1,
			'provider' => 'Lorem ipsum dolor sit amet',
			'uid' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'created_at' => '2014-02-05 01:56:18',
			'updated_at' => '2014-02-05 01:56:18'
		),
	);

}
