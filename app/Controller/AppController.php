<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $theme = false;

    public $components = array(
        'Auth' => array(
            'authorize' => array(
                //'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'ControllerList'
    );

    public $uses = array('Lan', 'User', 'Message', 'News');

    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        //Configure AuthComponent
        $this->allowAccess();

        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->authError = "You shouldnt be here!";
        $this->Auth->loginRedirect = "/";

        $this->Auth->authorize = 'Controller';
        
        if ($this->Lan->active()) {
            $timeline_json = '/events/timeline_json';
        } else {
            $this->set('upcominglan', $this->Lan->find('first', array(
              'conditions' => array('Lan.start_time > NOW()')
            )));
            $timeline_json = '/lans/timeline_json';
        }
        $this->set('timeline_path', $timeline_json);
        $this->set('activeLan', $this->Lan->active(true));

        if ($this->Auth->User('id')) {
            //setting for controllers
            $user = $this->User->findById($this->Auth->User('id'));
            Configure::write('user', $user);
            //setting for models
            $this->set('user', $user);
            if ($this->Auth->User('role') == 'admin') {
                $this->set('isAdmin', true);
                $adminNavigation = array();
                $controllers = $this->ControllerList->getList();
                foreach ($controllers as $controller) {
                  $controllerActions = array();
                  //we dont want to include anything that doesnt have admin methods
                  if ($controller['actions']) {
                    foreach ($controller['actions'] as $index => $action) {
                      if ($action == 'admin_index') {
                        $controllerActions['View All'] = '/admin/' . $controller['name'] . '/index';
                      }
                      if ($action == 'admin_add') {
                        $controllerActions['Add New'] = '/admin/' . $controller['name'] . '/add';
                      }
                    }
                    if (count($controllerActions)) {
                      $adminNavigation[$controller['displayName']] = $controllerActions;
                    }
                  }
                }
                $this->set('adminNavigation', $adminNavigation);
            } else {
                $this->set('isAdmin', false);
            }
            
            // allowed pages when user does not have a username
            $allowedPages = array(
                '/settings',
                '/logout'
            );
            
            /*if (!in_array($this->params->here(), $allowedPages)) {
                if ($user['User']['username'] == "") {
                    $this->Session->setFlash('Looks like you signed up through steam! We need to know what to call you, and you will need to verify your email address before you can reserve your seat. Want to enter those now?', 'flash_notification');
                    $this->redirect('/settings');
                }
            }*/
            
            $messages = $this->Message->find('all', array(
                'conditions' => array(
                    'or' => array(
                        'Message.username' => $user['User']['username'],
                        'Message.to' => $user['User']['username'],
                        'Message.to is null'
                    )
                ),
                'order' => array('created' => 'asc')
            ));
            
            $this->set('messages', $messages);

            $navigationleft = array(
                'Seating Chart' => '/SeatingChart/', 
                'Tournaments' => '/tournaments/',
                'Servers' => '/servers/',
                'Sponsors' => '/pages/sponsors/', 
                'Local Streamers' => '/streamers/', 
                'Schedule' => '/schedule/'
            );
            
            if ($user['User']['username'] == "") {
                $user['User']['username'] = 'Steam User';
            }
            
            $navigationright = array(
                $user['User']['username'] => array(
                    'View Profile' => '/profile',
                    'Settings' => '/settings',
                    'Log Out' => '/logout',
                )
            );
        } else {
            $navigationleft = array(
                'Tournaments' => '/tournaments/',
                'Servers' => '/servers/',
                'Sponsors' => '/pages/sponsors/', 
                'Seating Chart' => '/SeatingChart/'
            );
            $navigationright = array(
                'Register' => '/register/',
                'Log in' => '/login/'
            );
        }
        $this->set('navigationleft', $navigationleft);
        $this->set('navigationright', $navigationright);
        $this->set('news', $this->News->find('all', array('order' => array('News.created'), 'limit' => 4)));
        $this->set('streamList', $this->User->getStreamerList());
    }

    public function isAuthorized() {
        if (isset($this->params['admin']) && $this->Auth->user('role') == 'admin') {
            return true;
        } elseif (!isset($this->params['admin'])) {
            return true;
        }
        return false;
    }

    private function allowAccess() {
        // this actually searches the URL to see what controller you're accessing, and allows actions for that controller.
        if(in_array($this->name, array('Pages'))) {
            $this->Auth->allow('display');
        }
        if(in_array($this->name, array('Lans', 'Servers', 'Tournaments'))) {
            $this->Auth->allow('index', 'view');
        }
        if(in_array($this->name, array('Users'))) {
            $this->Auth->allow('steam_login', 'login', 'register');
        }

    }

}
