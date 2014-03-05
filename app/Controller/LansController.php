<?php
App::uses('AppController', 'Controller');

class LansController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('model', $this->modelClass);
    }

    public function index() {
        $this->Lan->recursive = 0;
        $this->set('lans', $this->paginate());
    }

    public function view($id = null) {
        if (!$this->Lan->exists($id)) {
            throw new NotFoundException(__('Invalid lan'));
        }
        $options = array('conditions' => array('Lan.' . $this->Lan->primaryKey => $id));
        $this->set('lan', $this->Lan->find('first', $options));
        $this->set('lanActive', $this->Lan->lanActive($id));
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Lan->create();
            if ($this->Lan->save($this->request->data)) {
                $this->Session->setFlash(__('The lan has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lan could not be saved. Please, try again.'), 'flash_failure');
            }
        }
    }

    public function admin_edit($id = null) {
        if (!$this->Lan->exists($id)) {
            throw new NotFoundException(__('Invalid lan'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Lan->save($this->request->data)) {
                $this->Session->setFlash(__('The lan has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lan could not be saved. Please, try again.'), 'flash_failure');
            }
        } else {
            $options = array('conditions' => array('Lan.' . $this->Lan->primaryKey => $id));
            $this->request->data = $this->Lan->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        if ($this->{$this->modelClass}->delete($id)) {
            $this->Session->setFlash(__('Lan deleted'), 'flash_success');
        } else {
            $this->Session->setFlash(__('Invalid Lan'), 'flash_failure');
        }

        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_index() {
        $this->{$this->modelClass}->recursive = 0;
        $this->set('lans', $this->paginate());
    }
}
