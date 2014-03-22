<?php
App::uses('AppController', 'Controller');

class SeatingChartController extends AppController {
    
    public $uses = array('SeatingChart', 'SeatingChartTile', 'UserSeating');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('model', $this->modelClass);
        $this->Auth->allow('index');
    }

    public function index() {
        $activeLan = $this->Lan->active(true);
        $seatingChartTiles = $this->SeatingChartTile->findAllBySeatingChartId($activeLan['Lan']['seating_chart_id']);
        $userSeating = $this->UserSeating->findAllByLanId($activeLan['Lan']['id']);

        foreach ($seatingChartTiles as $index1 => $tile) {
            foreach ($userSeating as $index2 => $seat) {
                if ($seat['UserSeating']['seat_number'] == $tile['SeatingChartTile']['seat_number']) {
                    $seatingChartTiles[$index1]['UserSeating'] = $seat['UserSeating'];
                    $seatingChartTiles[$index1]['User'] = $seat['User'];
                    unset($userSeating[$index2]);
                }
            }
        }

        $this->set('seatingChartTiles', $seatingChartTiles);
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
        $this->set('js_include', 'admin_add_seating_chart.js');
        
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $jsonData = file_get_contents("php://input");
            if(isset($jsonData) && !empty($jsonData)) {
                $data = json_decode($jsonData,true);
                $this->SeatingChart->create();
                $this->SeatingChart->set('name', $data['name']);
                $this->SeatingChart->set('width', $data['width']);
                $this->SeatingChart->set('height', $data['height']);
                $this->SeatingChart->save();
                $chartId = $this->SeatingChart->id;
                
                foreach ($data['tiles'] as $tile) {
                    $this->SeatingChartTile->create();
                    $this->SeatingChartTile->set('seating_chart_id', $chartId);
                    $this->SeatingChartTile->set('x', $tile['x']);
                    $this->SeatingChartTile->set('y', $tile['y']);
                    $this->SeatingChartTile->set('tile_id', $tile['tileName']);
                    if (isset($tile['seatId'])) {
                        $this->SeatingChartTile->set('seat_number', $tile['seatId']);
                    }
                    $this->SeatingChartTile->save();
                }
            }
            echo 'success';
        }
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
        $this->set('seatingcharts', $this->paginate());
    }
}
