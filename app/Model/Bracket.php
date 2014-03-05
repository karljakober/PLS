<?php
App::uses('AppModel', 'Model');

class Bracket extends AppModel {

	public $validate = array(
		'tournament_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		),
		'json' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		),
	);

	public $belongsTo = array(
		'Tournament' => array(
			'className' => 'Tournament',
			'foreignKey' => 'tournament_id'
		)
	);

}
