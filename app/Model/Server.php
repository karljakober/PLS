<?php
App::uses('AppModel', 'Model');

class Server extends AppModel {

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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);

	public function isOwnedBy($server, $user) {
    	return $this->field('id', array('id' => $server, 'user_id' => $user)) === $server;
	}
}
