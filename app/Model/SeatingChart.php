<?php
App::uses('AppModel', 'Model');

class SeatingChart extends AppModel {

	public $validate = array();

	public $belongsTo = array();

	public $hasMany = array(
		'Lan' => array(
			'className' => 'Lan',
			'foreignKey' => 'seating_chart_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SeatingChartTile' => array(
			'className' => 'SeatingChartTile',
			'foreignKey' => 'seating_chart_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
}
