<?php
class AddsTournamentIdToBracketsAndMaxAttendantsToLans extends CakeMigration {

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
				'brackets' => array(
					'tournament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'id'),
				),
				'lans' => array(
					'max_attendants' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'end_time'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'brackets' => array('tournament_id',),
				'lans' => array('max_attendants',),
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
