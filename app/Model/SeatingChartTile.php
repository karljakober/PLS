<?php
App::uses('AppModel', 'Model');

class SeatingChartTile extends AppModel {

	public $validate = array('seat_number' => array('numeric'));

	public $belongsTo = array(
		'SeatingChart' => array(
			'className' => 'SeatingChart',
			'foreignKey' => 'seating_chart_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
