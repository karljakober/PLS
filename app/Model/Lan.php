<?php
App::uses('AppModel', 'Model');

class Lan extends AppModel {

	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		),
	);

	public $hasMany = array(
		'Server' => array(
			'className' => 'Server',
			'foreignKey' => 'lan_id',
			'dependent' => false
		),
		'Tournament' => array(
			'className' => 'Tournament',
			'foreignKey' => 'lan_id',
			'dependent' => false
		)
	);
	
    public $hasOne = array(
        'SeatingChart' => array(
            'foreignKey' => 'id'
        )
    );
    
	public function active($upcoming = false) {
    //if upcoming is true, it will return current lan or future lan
    //if upcoming is false, it will return current lan or previous lan
		if ($upcoming) {
      $curLan = $this->find('first', array(
        'conditions' => array(
          'and' => array(
            'Lan.end_time > ' => date('Y-m-d H:i:s'),
            'Lan.start_time < ' => date('Y-m-d H:i:s')
          )
        )
      ));
      if (!isset($curLan) || !$curLan) {
        $curLan = $this->find('first', array(
          'conditions' => array(
            'Lan.start_time > ' => date('Y-m-d H:i:s')
          )
        ));
      }
      if (!isset($curLan) || !$curLan) {
        return false;
      }
    } else {
      $curLan = $this->find('first', array(
        'conditions' => array(
          'and' => array(
            'Lan.end_time > ' => date('Y-m-d H:i:s'),
            'Lan.start_time < ' => date('Y-m-d H:i:s')
          )
        )
      ));
      if(!isset($curlan) || !$curLan) {
        $curLan = $this->find('first', array(
          'conditions' => array(
            'Lan.end_time < ' => date('Y-m-d H:i:s')
          )
        ));
      }
    }
    return $curLan;

	}

  public function lanActive($id) {
      $lan = $this->findById($id);
      if ($lan['Lan']['end_time'] < date(time())) {
          return false;
      }
      return true;
  }

}
