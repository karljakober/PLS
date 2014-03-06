<?php
App::uses('AppModel', 'Model');

class Tournament extends AppModel {

	public $types = array(
		'single_elimination', 'double_elimination', 'boiloff');
	
	public $validate = array(
		'lan_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		),
	);

	public $belongsTo = array(
		'Lan' => array(
			'className' => 'Lan',
			'foreignKey' => 'lan_id'
		)
	);

}
