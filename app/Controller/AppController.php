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
        'Session'
    );

    public $uses = array('Lan', 'User');

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
            } else {
                $this->set('isAdmin', false);
            }
            
            // allowed pages when user does not have a username
            $allowedPages = array(
                '/settings',
                '/logout'
            );
            
            if (!in_array($this->params->here(), $allowedPages)) {
                if ($user['User']['username'] == "") {
                    $this->Session->setFlash('Looks like you signed up through steam! We need to know what to call you, and you will need to verify your email address before you can reserve your seat. Want to enter those now?', 'flash_notification');
                    $this->redirect('/settings');
                }
            }

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
                    'Settings' => '/settings/',
                    'Log Out' => '/logout/',
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
            $this->Auth->allow('steam_login');
        }

    }

}
