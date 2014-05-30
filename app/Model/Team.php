<?php
App::uses('AppModel', 'Model');

class Team extends AppModel {

	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		),
	);

	public $belongsTo = array(
		'Manager' => array(
			'className' => 'User',
			'foreignKey' => 'manager_id'
		)
	);


	public $hasAndBelongsToMany = array(
        'Member' => array(
            'className' => 'Users',
            'joinTable' => 'user_teams',
            'foreignKey' => 'team_id',
            'associationForeignKey' => 'user_id',
        ),
        
        'Squad' => array(
            'className' => 'Squads',
            'joinTable' => 'Squads',
	        'associationForeignKey' => 'team_id'
        )
    );
    
    public $hasMany = array(
        'Requests' => array(
            'className' => 'TeamRequests',
            'foreignKey' => 'team_id'
        )
    );
    

}
