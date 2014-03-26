<?php
class AddedUserTeams extends CakeMigration {

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
				'teams' => array(
					'manager_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'invite_only' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
				),
			),
			'create_table' => array(
				'user_teams' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'id'),
					'team_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'user_id'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
			),
			'drop_table' => array(
				'brackets'
			),
		),
		'down' => array(
			'alter_field' => array(
				'teams' => array(
					'manager_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'invite_only' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
				),
			),
			'drop_table' => array(
				'user_teams'
			),
			'create_table' => array(
				'brackets' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'tournament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
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
