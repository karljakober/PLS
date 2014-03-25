<?php
App::uses('AppController', 'Controller');

class TeamsController extends AppController {

	public $uses = array('Team', 'UserTeam');

	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function index() {
		$this->Team->recursive = 1;
		$this->set('teams', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			$this->Team->set('manager_id', $this->Auth->User('id'));
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
		$managers = $this->Team->Manager->find('list');
		$this->set(compact('managers'));
	}

	public function edit($id = null) {
	    //Checking if the team exists
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		//Checks if a form is being submitted
		if ($this->request->is('put')) {
		    //Check for changes and to save them
			if ($this->Team->save($this->request->data)) 
			{
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
		//If no form is submitted
		else {
		    //gets the team id for request
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			//applies team id to the form
			$this->request->data = $this->Team->find('first', $options);
            //check if user is manager
			if ($this->request->data['Team']['manager_id'] != $this->Auth->User('id')) 
			{
			    $this->Session->setFlash('You can not edit this team because you are not the manager! Contact the manager to change this team.', 'flash_failure');
			    $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			    $this->redirect('/Teams/view/'.$this->request->data['Team']['id']);
			}
		}
	}
	
	public function join($id = null){
	    //Checks if team exists
	    if(!$this->Team->exists($id)){
	        throw new NotFoundException(__('Invalid team'));
	    }
	    $options = array('conditions' => array('user_id'=>$this->Auth->User('id'), 'team_id'=>$id));
	    $u = $this->UserTeam->find('first', $options);
	    if($u)
	    {
	        $this->Session->setFlash(__('HEY! You are already part of this team'), 'flash_failure');
	        $this->redirect('/Teams/view/'.$id);
	    }
	    
	    $this->UserTeam->create(); 
	    $this->UserTeam->set('user_id', $this->Auth->User('id'));
	    $this->UserTeam->set('team_id', $id);
	    $this->UserTeam->save();
	    $this->Session->setFlash(__('Congrats! You have joined a team!'),'flash_success');
	    $this->redirect('/Teams/view/'.$id);
	    
	}

	public function delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) 
		{
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Team->delete()) 
		{
			$this->Session->setFlash(__('Team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
