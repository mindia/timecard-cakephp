<?php
/**
 * ProviderFixture
 *
 */
class ProviderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'foreign_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'provided_type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'info' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'provided_id' => array('type' => 'integer', 'null' => true, 'default' => null),
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
	public $records =[ 
		[
			'id' => 1,
			'name' => 'github',
			'foreign_id' => 1,
			'provided_type' => 'Project',
			'info' => 'mindia/timecard-cakephp',
			'provided_id' => 1
		],
		[
			'id' => 2,
			'name' => 'ruffnote',
			'foreign_id' => 1,
			'provided_type' => 'Project',
			'info' => 'timecard-cakephp',
			'provided_id' => 1
		],
		[
			'id' => 3,
			'name' => 'github',
			'foreign_id' => 5,
			'provided_type' => 'Project',
			'info' => 'github_provider_id_2',
			'provided_id' => 1
		],
		[
			'id' => 4,
			'name' => 'ruffnote',
			'foreign_id' => 5,
			'provided_type' => 'Project',
			'info' => 'ruffnote_provider_id_2',
			'provided_id' => 1
		],
	];

}
