<?php
App::uses('AppController', 'Controller');

class TournamentsController extends AppController {

    public $uses = array('Tournament', 'Bracket', 'Squad', 'User', 'SquadUsers', 'Team');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('model', $this->modelClass);

    }

    public function index() {
        $this->Tournament->recursive = 1;
        $this->set('tournaments', $this->paginate());
    } 

    public function view($id = null) {
        $this->Tournament->recursive = 1;
        if (!$this->Tournament->exists($id)) {
            throw new NotFoundException(__('Invalid tournament'));
        }
        $options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
        $this->set('tournament', $this->Tournament->find('first', $options));
        $this->set('squads', $this->Squad->find('all',array('conditions' => array('tournament_id' => $id))));
        $this->set('user', $this->User->findById($this->Auth->User('id')));
        //pr($this->Tournament->find('first', $options));
        //pr($this->Squad->find('all'));
        //pr($this->User->find('all',''));
        //pr($this->SquadUsers->find('all'));
        //pr($this->User->findById($this->Auth->User('id')));
    }

    public function leave($tid = null) {
        $this->SquadUsers->deleteAll(array(
            'squad_id' => $this->request->data['Tournament']['squad'],
            'user_id' => $this->request->data['Tournament']['user']
        ), false);

        $this->redirect(array('action' => 'view', $tid));
    }

    public function join($tid = null) {
        $data = array(
            'SquadUsers' => array(
                'squad_id' => $this->request->data['Tournament']['squad'],
                'user_id' => $this->request->data['Tournament']['user']
            )
        );
        $this->SquadUsers->create();
        $this->SquadUsers->save($data);

        $this->redirect(array('action' => 'view', $tid));
    }

    public function disband($tid = null) {
        $this->SquadUsers->deleteAll(array(
            'squad_id' => $this->request->data['Tournament']['squad']
        ), false);
        $this->Squad->delete($this->request->data['Tournament']['squad']);

        $this->redirect(array('action' => 'view', $tid));
    }

    public function create() {
        $data = array(
            'Squad' => array(
                'team_id' => $this->request->data['Tournament']['team'],
                'tournament_id' => $this->request->data['Tournament']['tournament']
            )
        );
        $this->Squad->create();
        $this->Squad->save($data);
        $this->redirect(array('action' => 'view', $this->request->data['Tournament']['tournament']));
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
