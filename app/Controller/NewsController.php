<?php
App::uses('AppController', 'Controller');

class NewsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('model', $this->modelClass);
    }

    public function view($id = null) {
        if (!$this->News->exists($id)) {
            throw new NotFoundException(__('Invalid News Article'));
        }
        $options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
        $this->set('news', $this->News->find('first', $options));
    }

    public function admin_add() {
    $this->set('js_include', 'summernote.js');
        if ($this->request->is('post')) {
            $this->News->create();
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__('The News article has been saved'));
                $this->redirect(array('controller' => 'User', 'action' => 'dashboard'));
            } else {
                $this->Session->setFlash(__('The News article could not be saved. Please, try again.'));
            }
        }
    }

    public function admin_edit($id = null) {
        if (!$this->News->exists($id)) {
            throw new NotFoundException(__('Invalid News Article'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->News->save($this->request->data)) {
                $this->Session->setFlash(__('The News article has been saved'));
                $this->redirect(array('controller' => 'User', 'action' => 'dashboard'));
            } else {
                $this->Session->setFlash(__('The News article could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
            $this->request->data = $this->News->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Invalid News article'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->News->delete()) {
            $this->Session->setFlash(__('News article deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('News article was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_index() {
        $this->{$this->modelClass}->recursive = 0;
        $this->set('news', $this->paginate());
    }
}
