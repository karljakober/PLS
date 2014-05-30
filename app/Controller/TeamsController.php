<?php
App::uses('AppController', 'Controller');

class TeamsController extends AppController {

	public $uses = array('Team', 'UserTeam', 'TeamRequests');

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
				//adding the manager as a member
				$this->UserTeam->create(); 
        	    $this->UserTeam->set('user_id', $this->Auth->User('id'));
        	    $this->UserTeam->set('team_id', $this->Team->id);
        	    $this->UserTeam->save();
        	    
        	    $this->Session->setFlash(__('The team has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		$managers = $this->Team->Manager->find('list');
		$this->set(compact('managers'));
	}

	public function edit($id = null) {
	    //Checking if the team exists
		if (!$this->Team->exists($id)) 
		{
			throw new NotFoundException(__('Invalid team'));
		}
		//Checks if a form is being submitted
		if ($this->request->is('put')) 
		{
		    //Check for changes and to save them
			if ($this->Team->save($this->request->data)) 
			{
				$this->Session->setFlash(__('The team has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		//If no form is submitted
		else 
		{
		    //gets the team id for request
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			//applies team id to the form
			$this->request->data = $this->Team->find('first', $options);
            //check if user is manager
			if ($this->request->data['Team']['manager_id'] != $this->Auth->User('id')) 
			{
			    $this->Session->setFlash('You can not edit this team because you are not the manager! Contact the manager to change this team.', 'flash_failure');
			    $this->redirect('/Teams/view/'.$this->request->data['Team']['id']);
			}
		}
	}
	
	public function join($id = null){
	    //Checks if team exists
	    if(!$this->Team->exists($id))
	    {
	        throw new NotFoundException(__('Invalid team'));
	    }
	    
	    //Create an array with the information needed for a query
	    $options = array('conditions' => array('user_id'=>$this->Auth->User('id'), 'team_id'=>$id));
	    //Use the info to find an item on a table and save it in a variable
	    //In this case, I use it to find a player on a team and a players request to join a team
	    $u = $this->UserTeam->find('first', $options);
	    $request = $this->TeamRequests->find('first', $options);
	    
        //Create an array with the information needed for a query
	    $options = array('conditions' => array('Team.id'=>$id));
	    //Use the info to find an item on a table and save it in a variable
	    //In this case, I use it to find a team on the Teams table
        $team = $this->Team->find('first', $options);
        
	    //If User is already a member of the team
	    if($u)
	    {
	        $this->Session->setFlash(__('HEY! You are already part of this team'), 'flash_failure');
	        $this->redirect('/Teams/view/'.$id);
	    }
	    // If Team is invite only
	    else if($team['Team']['invite_only'])
	    {
	        //If the user already sent a request
	        if($request)
	        {
	            $this->Session->setFlash(__('You have already submitted a request for this team!'), 'flash_failure');
	            $this->redirect('/Teams/view/'.$id);
	        }
	        //If this is the first request a user sent
	        else
	        {
    	        $this->TeamRequests->create(); 
        	    $this->TeamRequests->set('user_id', $this->Auth->User('id'));
        	    $this->TeamRequests->set('team_id', $id);
        	    $this->TeamRequests->save();
        	    $this->Session->setFlash(__('Your request has been given to the Manager for approvel.'),'flash_success');
        	    $this->redirect('/Teams/view/'.$id);
	        }
	    }
	    // If Team is open
	    else
	    {
    	    $this->UserTeam->create(); 
    	    $this->UserTeam->set('user_id', $this->Auth->User('id'));
    	    $this->UserTeam->set('team_id', $id);
    	    $this->UserTeam->save();
    	    $this->Session->setFlash(__('Congrats! You have joined a team!'),'flash_success');
    	    $this->redirect('/Teams/view/'.$id);
	   }
	    
	}
	
	public function teamRequests($id = null){
	    /*
	        Things to do for teamRequests:
	        1)List all requests from the team_requests table (Done in view)
	        2)Have the team manager have the ability to accept or deny the requests (JavaScript???)
	        3)If the request has been approved, add the player to the user_teams table for that team
	        4)After the request has been taken care of, have the request be removed from the team_requests table
	    */
	    $options = $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
	    $this->set('requests', $this->TeamRequests->find('all', array('conditions' => array('team_id' => $id))));
	    
	}

    public function accept(){
    
    }
    
    public function reject(){
        
    }

	public function delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) 
		{
			throw new NotFoundException(__('Invalid team'));
		}
		
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$team = $this->Team->find('first', $options);
		
		//Checking if the user is the manager
		if ($team['Team']['manager_id'] != $this->Auth->User('id')) 
		{
		    $this->Session->setFlash('You cannot delete this team, because you are not the manager!!!!', 'flash_failure');
			$this->redirect('/Teams/view/'.$team['Team']['id']);
		}
		
		if ($this->Team->delete()) 
		{
			$this->Session->setFlash(__('Team deleted'), 'flash_success');
			$this->redirect('/Teams');
		}
		else
		{
    		$this->Session->setFlash(__('Team was not deleted'), 'flash_failure');
    		$this->redirect('/Teams/view/'.$id);
		}
		
		
	}

}
