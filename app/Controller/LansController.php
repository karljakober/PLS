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
                $this->Session->setFlash(__('The lan has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lan could not be saved. Please, try again.'));
            }
        }
    }

    public function admin_edit($id = null) {
        if (!$this->Lan->exists($id)) {
            throw new NotFoundException(__('Invalid lan'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Lan->save($this->request->data)) {
                $this->Session->setFlash(__('The lan has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lan could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Lan.' . $this->Lan->primaryKey => $id));
            $this->request->data = $this->Lan->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->Lan->id = $id;
        if (!$this->Lan->exists()) {
            throw new NotFoundException(__('Invalid lan'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Lan->delete()) {
            $this->Session->setFlash(__('Lan deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Lan was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function timeline_json() {
        $data = $this->Lan->getTimelineJson();
        return new CakeResponse(array('body' => json_encode($data)));
    }
    
    public function admin_index() {
        $this->{$this->modelClass}->recursive = 0;
        $this->set('lans', $this->paginate());
    }
}
