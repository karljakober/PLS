<?php
/**
 * TournamentFixture
 *
 */
class TournamentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'lan_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_time' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'end_time' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'allow_teams' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'assigned_admin' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
    public function init() {
        $this->records = array(
    	    array(
    			'id' => 1,
    			'lan_id' => 1,
    			'name' => 'Lorem ipsum dolor sit amet',
    			'start_time' => date('Y-m-d H:i:s'),
    			'end_time' => date('Y-m-d H:i:s'),
    			'type' => 'round robin',
    			'allow_teams' => '1',
    			'assigned_admin' => '5236d17c-4d30-44ca-8e53-01360a808f7f'
    		),
        );
        parent::init();
    }
}
