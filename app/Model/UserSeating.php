<?php
App::uses('AppModel', 'Model');

class UserSeating extends AppModel {

    public $validate = array();

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Lan' => array(
            'className' => 'Lan',
            'foreignKey' => 'lan_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function isOwnedBy($server, $user) {
        return $this->field('id', array('id' => $server, 'user_id' => $user)) === $server;
    }
}
