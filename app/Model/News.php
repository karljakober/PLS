<?php
App::uses('AppModel', 'Model');

class News extends AppModel {

	public $validate = array();

	public $belongsTo = array(		
	  'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));

	public $displayField = 'title';


}
