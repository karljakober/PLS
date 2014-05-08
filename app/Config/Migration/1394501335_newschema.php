<?php
class Newschema extends CakeMigration {

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
			'drop_field' => array(
				'lans' => array('max_attendants',),
				'news' => array('modified', 'title',),
			),
			'drop_table' => array(
				'brackets'
			),
		),
		'down' => array(
			'create_field' => array(
				'lans' => array(
					'max_attendants' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
				'news' => array(
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
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
