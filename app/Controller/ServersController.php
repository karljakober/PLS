<?php
App::uses('AppController', 'Controller');
/**
 * Servers Controller
 *
 * @property Server $Server
 */
class ServersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'add', 'edit', 'delete');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Server->recursive = 0;
		$this->set('servers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Server->exists($id)) {
			throw new NotFoundException(__('Invalid server'));
		}
		$options = array('conditions' => array('Server.' . $this->Server->primaryKey => $id));
		$this->set('server', $this->Server->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Server->create();
			if ($this->Server->save($this->request->data)) {
				$this->Session->setFlash(__('The server has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The server could not be saved. Please, try again.'));
			}
		}
		$lans = $this->Server->Lan->find('list');
		$this->set(compact('lans'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Server->exists($id)) {
			throw new NotFoundException(__('Invalid server'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Server->save($this->request->data)) {
				$this->Session->setFlash(__('The server has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The server could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Server.' . $this->Server->primaryKey => $id));
			$this->request->data = $this->Server->find('first', $options);
		}
		$lans = $this->Server->Lan->find('list');
		$this->set(compact('lans'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Server->id = $id;
		if (!$this->Server->exists()) {
			throw new NotFoundException(__('Invalid server'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Server->delete()) {
			$this->Session->setFlash(__('Server deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Server was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
