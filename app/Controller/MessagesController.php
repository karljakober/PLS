<?php

App::uses('AppController', 'Controller');

class MessagesController extends AppController {

	public $name = 'Messages';

	public $uses = array('Message', 'User');

	function beforeFilter() {
		parent::beforeFilter();
	}

	public function add() {
	    $user = $this->User->findById($this->Auth->User('id'));
	    $this->layout = false;
	    $this->autoRender = false;
        
	    $this->Message->create();
	    $this->Message->set('username', $user['User']['username']);
	    $this->Message->set('message', $this->request->data['message']);
	    if (isset($this->request->data['to']) && $this->request->data['to'] != '') {
    	    $this->Message->set('to', $this->request->data['to']);
            $data = array('username' => $user['User']['username'], 'message' => $this->request->data['message'], 'to' => $this->request->data['to']);
	    } else {
            $data = array('username' => $user['User']['username'], 'message' => $this->request->data['message']);
	    }
	    $this->Message->save();
        $string = json_encode($data);
        
        $ciphertext = mcrypt_encrypt('rijndael-128', 'M02cnQ51Ji97vwT4', $string, 'ecb');
        echo base64_encode($ciphertext);
	}
	
	public function register() {
	    $user = $this->User->findById($this->Auth->User('id'));
	    $this->layout = false;
	    $this->autoRender = false;
        
        $string = json_encode($user);
        
        $ciphertext = mcrypt_encrypt('rijndael-128', 'M02cnQ51Ji97vwT4', $string, 'ecb');
        echo base64_encode($ciphertext);
	}
}
