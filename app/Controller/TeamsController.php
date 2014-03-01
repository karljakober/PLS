<?php
App::uses('AppController', 'Controller');

class TeamsController extends AppController {

	public $uses = array('Team');

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

		$this->set('autoCompleteData', $this->Bracket->getAutocomplete($id));

	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			$this->request->data = $this->Team->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('Team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
