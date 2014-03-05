<?php
App::uses('AppController', 'Controller');

class NewsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('model', $this->modelClass);
    }

    public function view($id = null) {
        if (!$this->{$this->modelClass}->exists($id)) {
            throw new NotFoundException(__('Invalid News Article'));
        }
        $options = array('conditions' => array($this->modelClass . '.' . $this->{$this->modelClass}->primaryKey => $id));
        $this->set('news', $this->{$this->modelClass}->find('first', $options));
    }

    public function admin_add() {
        $this->set('js_include', 'summernote.js');
        if ($this->request->is('post')) {
            $this->{$this->modelClass}->create();
            $this->{$this->modelClass}->set('author_id', $this->Auth->User('id'));
            if ($this->{$this->modelClass}->save($this->request->data)) {
                $this->Session->setFlash(__('The News article has been saved'), 'flash_success');
                $this->redirect(array('controller' => 'News', 'action' => 'index', 'admin' => true));
            } else {
                $this->Session->setFlash(__('The News article could not be saved. Please, try again.'), 'flash_failure');
            }
        }
    }

    public function admin_edit($id = null) {
        $this->set('js_include', 'summernote.js');
        if (!$this->{$this->modelClass}->exists($id)) {
            throw new NotFoundException(__('Invalid News Article'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->{$this->modelClass}->id = $id;
            if ($this->{$this->modelClass}->save($this->request->data)) {
                $this->Session->setFlash(__('The News article has been saved'), 'flash_success');
                $this->redirect(array('controller' => 'News', 'action' => 'index', 'admin' => true));
            } else {
                $this->Session->setFlash(__('The News article could not be saved. Please, try again.'), 'flash_failure');
            }
        } else {
            $options = array('conditions' => array($this->modelClass . '.' . $this->{$this->modelClass}->primaryKey => $id));
            $this->request->data = $this->{$this->modelClass}->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        if ($this->{$this->modelClass}->delete($id)) {
            $this->Session->setFlash(__('News article deleted'), 'flash_success');
        } else {
            $this->Session->setFlash(__('News article was not deleted'), 'flash_failure');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function admin_index() {
        $this->{$this->modelClass}->recursive = 0;
        $this->set('news', $this->paginate());
    }
}
