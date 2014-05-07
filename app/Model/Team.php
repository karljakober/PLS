<?php
App::uses('AppModel', 'Model');
/**
 * Tournament Model
 *
 * @property Lan $Lan
 */
class Team extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	public $validate = array(

		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Manager' => array(
			'className' => 'User',
			'foreignKey' => 'manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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