<?php
App::uses('AppModel', 'Model');

class Option extends AppModel {

	public $validate = array();

	public $belongsTo = array();
	
	public $defaults = array(
	    'steam_api_key' => '',
	);
	
	public function getValue($key) {
	    $option = $this->findByKey($key);
	    $value = false;
	    if (!$option) {
	        //option not created, fallback to default value from this model
	        if ($defaults[$key] != '') {
	            $value = $defaults[$key];
	        }
	    } else {
	        $value = $option['Option']['value'];
	    }
	    return $value;
	}


}
