<?php
App::uses('AppModel', 'Model');

class News extends AppModel {

	public $validate = array();

	public $belongsTo = array();

	public $displayField = 'title';


}
