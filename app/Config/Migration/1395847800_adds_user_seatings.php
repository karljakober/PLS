<?php
class AddsUserSeatings extends CakeMigration {

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
			'create_field' => array(
				'servers' => array(
					'official' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'after' => 'additional_info'),
				),
				'users' => array(
					'forum_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'steam_id'),
				),
			),
			'alter_field' => array(
				'servers' => array(
					'user_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
			),
			'create_table' => array(
				'user_seatings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'lan_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'seat_number' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'seat_number' => array('column' => array('seat_number', 'lan_id'), 'unique' => 1),
						'user_id' => array('column' => array('user_id', 'lan_id'), 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'servers' => array('official',),
				'users' => array('forum_id',),
			),
			'alter_field' => array(
				'servers' => array(
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
			),
			'drop_table' => array(
				'user_seatings'
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
