<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $theme = 'PONG';

	public $components = array(
		'DebugKit.Toolbar',
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

            $navigation = array(
                'Seating Chart' => '/seating/', 
                'Tournaments' => '/tournaments/',
                'Servers' => '/servers/',
                'Sponsors' => '/pages/sponsors/', 
                'Local Streamers' => '/streamers/', 
                'Schedule' => '/schedule/',
                'Log Out' => '/logout/'
            );
        } else {
            $navigation = array(
                'Log in' => '/login/',
                'Register' => '/register/',
                'Tournaments' => '/tournaments/',
                'Servers' => '/servers/',
                'Sponsors' => '/pages/sponsors/', 
                'Seating Chart' => '/seating/'
            );
        }
        $this->set('navigation', $navigation);

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

    }

}
