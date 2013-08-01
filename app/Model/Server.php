<?php
App::uses('AppModel', 'Model');
/**
 * Server Model
 *
 * @property Lan $Lan
 * @property User $User
 */
class Server extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'lan_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'Lan' => array(
			'className' => 'Lan',
			'foreignKey' => 'lan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function isOwnedBy($server, $user) {
    	return $this->field('id', array('id' => $server, 'user_id' => $user)) === $server;
	}
}
