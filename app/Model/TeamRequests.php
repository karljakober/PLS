<?php
App::uses('AppModel', 'Model');

class TeamRequests extends AppModel {

    /*public $hasMany = array(
        'Requests' => array(
            'className' => 'User',
            'foreignKey' => 'id'
        )
    );*/
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )  
    );
}


    

