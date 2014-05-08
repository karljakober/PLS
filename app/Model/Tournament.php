<?php
App::uses('AppModel', 'Model');

class Tournament extends AppModel {

	public $types = array('single_elimination', 'double_elimination', 'boiloff', 'round_robin', 'ffa');

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

	public $hasAndBelongsToMany = array(
	    'registered_teams' => array(
	        'className' => 'team',
	        'joinTable' => 'team_tournaments',
	        'foreignKey' => 'tournament_id',
	        'associationForeignKey' => 'team_id',
	    ),
	);
	
	public $hasMany = array(
	    'squads' => array(
	        'className' => 'squads',
	        'joinTable' => 'squads',
	        'associationForeignKey' => 'tournament_id'
	    )
	);
}
