<?php
/**
 * LanFixture
 *
 */
class LanFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'seating_chart_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'start_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
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
                'name' => 'Lorem ipsum dolor sit amet',
                'seating_chart_id' => '1',
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s'),
            ),
        );
        parent::init();
    }
    
}
