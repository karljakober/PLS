<?php
App::uses('AppController', 'Controller');

class TournamentsController extends AppController {

	public $uses = array('Tournament', 'Bracket');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('model', $this->modelClass);
	}

	public function index() {
		$this->Tournament->recursive = 1;
		$this->set('tournaments', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
		$this->set('tournament', $this->Tournament->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Tournament->create();
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
			}
		}
		$lans = $this->Tournament->Lan->find('list');
		$this->set(compact('lans'));
	}

	public function admin_edit($id = null) {
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
			$this->request->data = $this->Tournament->find('first', $options);
		}
		$lans = $this->Tournament->Lan->find('list');
		$this->set(compact('lans'));
	}

	public function admin_delete($id = null) {
		$this->Tournament->id = $id;
		if (!$this->Tournament->exists()) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tournament->delete()) {
			$this->Session->setFlash(__('Tournament deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tournament was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_index() {
		$this->{$this->modelClass}->recursive = 0;
		$this->set('tournaments', $this->paginate());
	}

}
