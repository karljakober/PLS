<?php
App::import('Vendor', 'openid', array('file' => 'openid.php'));
App::uses('Option', 'Model');

class UsersController extends AppController {

    public $name = 'Users';
    public $plugin = null;
    public $uses = array('User', 'Option');
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Time',
        'Text');

    public $components = array(
        'Auth',
        'Session',
        'Cookie',
        'Paginator',
        'Security',
        'RememberMe');

    public $presetVars = array(
        array('field' => 'search', 'type' => 'value'),
        array('field' => 'username', 'type' => 'value'),
        array('field' => 'email', 'type' => 'value'));

    public function __construct($request, $response) {
        $this->_setupComponents();
        $this->_setupHelpers();
        parent::__construct($request, $response);
        $this->_reInitControllerName();
    }

    protected function _reInitControllerName() {
        $name = substr(get_class($this), 0, -10);
        if ($this->name === null) {
            $this->name = $name;
        } elseif ($name !== $this->name) {
            $this->name = $name;
        }
    }

    protected function _pluginDot() {
        if (is_string($this->plugin)) {
            return $this->plugin . '.';
        }
        return $this->plugin;
    }

    protected function _setupComponents() {
        if (App::import('Component', 'Search.Prg')) {
            $this->components[] = 'Search.Prg';
        }
    }

    protected function _setupHelpers() {
        if (App::import('Helper', 'Goodies.Gravatar')) {
            $this->helpers[] = 'Goodies.Gravatar';
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->_setupAuth();

        $this->set('model', $this->modelClass);

        if (!Configure::read('App.defaultEmail')) {
            Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
        }
    }

/**
 * Setup Authentication Component
 *
 * @return void
 */
    protected function _setupAuth() {
        $this->Auth->allow('register', 'reset', 'verify', 'logout', 'view', 'reset_password', 'login', 'steam_login');
        if (!is_null(Configure::read('allowRegistration')) && !Configure::read('allowRegistration')) {
            $this->Auth->deny('register');
        }
        if ($this->request->action == 'register') {
            $this->Components->disable('Auth');
        }

        $this->Auth->authenticate = array(
            'Form' => array(
                'fields' => array(
                    'username' => 'email',
                    'password' => 'password'),
                'userModel' => $this->_pluginDot() . $this->modelClass,
                /*'scope' => array(
                    $this->modelClass . '.active' => 1,
                    $this->modelClass . '.email_verified' => 1
                )*/
                ));

        $this->Auth->loginRedirect = '/';
        $this->Auth->logoutRedirect = array('plugin' => $this->plugin, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginAction = array('admin' => false, 'plugin' => $this->plugin, 'controller' => 'users', 'action' => 'login');
    }

/**
 * Simple listing of all users
 *
 * @return void
 */
    public function index() {
        $this->paginate = array(
            'limit' => 12,
            'conditions' => array(
                $this->modelClass . '.active' => 1,
                $this->modelClass . '.email_verified' => 1));
        $this->set('users', $this->paginate($this->modelClass));
    }

/**
 * The homepage of a users giving him an overview about everything
 *
 * @return void
 */
    public function dashboard() {
        $user = $this->{$this->modelClass}->read(null, $this->Auth->user('id'));
        $this->set('user', $user);
    }

/**
 * Shows a users profile
 *
 * @param string $slug User Slug
 * @return void
 */
    public function view($slug = null) {
        try {
            $this->set('user', $this->{$this->modelClass}->view($slug));
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage());
            $this->redirect('/');
        }
    }

/**
 * Edit
 *
 * @param string $id User ID
 * @return void
 */
    public function edit() {
    
    }

/**
 * Admin Index
 *
 * @return void
 */
    public function admin_index() {
        $this->Prg->commonProcess();
        unset($this->{$this->modelClass}->validate['username']);
        unset($this->{$this->modelClass}->validate['email']);
        $this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
        if ($this->{$this->modelClass}->Behaviors->attached('Searchable')) {
            $parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
        } else {
            $parsedConditions = array();
        }
        $this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
        $this->Paginator->settings[$this->modelClass]['order'] = array($this->modelClass . '.created' => 'desc');

        $this->{$this->modelClass}->recursive = 0;
        $this->set('users', $this->paginate());
    }

/**
 * Admin view
 *
 * @param string $id User ID
 * @return void
 */
    public function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('users', 'Invalid User.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->{$this->modelClass}->read(null, $id));
    }

/**
 * Admin add
 *
 * @return void
 */
    public function admin_add() {
        if (!empty($this->request->data)) {
            $this->request->data[$this->modelClass]['tos'] = true;
            $this->request->data[$this->modelClass]['email_verified'] = true;

            if ($this->{$this->modelClass}->add($this->request->data)) {
                $this->Session->setFlash(__d('users', 'The User has been saved'));
                $this->redirect(array('action' => 'index'));
            }
        }
        $this->set('roles', Configure::read('roles'));
    }

/**
 * Admin edit
 *
 * @param string $id User ID
 * @return void
 */
    public function admin_edit($userId = null) {
        try {
            $result = $this->{$this->modelClass}->edit($userId, $this->request->data);
            if ($result === true) {
                $this->Session->setFlash(__d('users', 'User saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->request->data = $result;
            }
        } catch (OutOfBoundsException $e) {
            $this->Session->setFlash($e->getMessage());
            $this->redirect(array('action' => 'index'));
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->{$this->modelClass}->read(null, $userId);
        }
        $this->set('roles', Configure::read('roles'));
    }

/**
 * Delete a user account
 *
 * @param string $userId User ID
 * @return void
 */
    public function admin_delete($userId = null) {
        if ($this->{$this->modelClass}->delete($userId)) {
            $this->Session->setFlash(__d('users', 'User deleted'));
        } else {
            $this->Session->setFlash(__d('users', 'Invalid User'));
        }

        $this->redirect(array('action' => 'index'));
    }


/**
 * User register action
 *
 * @return void
 */
    public function register() {
        if ($this->Auth->user()) {
            $this->Session->setFlash(__d('users', 'You are already registered and logged in!'), 'flash_notification');
            $this->redirect('/');
        }

        if (!empty($this->request->data)) {
            $user = $this->{$this->modelClass}->add($this->request->data, array('emailVerification' => false));
            if ($user !== false) {
                //$this->_sendVerificationEmail($this->{$this->modelClass}->data);
                $this->Session->setFlash(__d('users', 'Your account has been created.'), 'flash_success');
                $this->redirect(array('action' => 'login'));
            } else {
                unset($this->request->data[$this->modelClass]['password']);
                unset($this->request->data[$this->modelClass]['temppassword']);
                $this->Session->setFlash(__d('users', 'Your account could not be created. Please, try again.'), 'flash_failure');
            }
        }
    }

/**
 * Common login action
 *
 * @return void
 */
    public function login() {
      $user = $this->User->findById($this->Auth->User('id'));
      if ($user) {
        $this->redirect('/dashboard');
      }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->getEventManager()->dispatch(new CakeEvent('afterLogin', $this, array(
                    'isFirstLogin' => !$this->Auth->user('last_login'))));

                $this->{$this->modelClass}->id = $this->Auth->user('id');
                $this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

                if ($this->here == $this->Auth->loginRedirect) {
                    $this->Auth->loginRedirect = '/';
                }
                $this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')), 'flash_success');
                if (!empty($this->request->data)) {
                    $data = $this->request->data[$this->modelClass];
                    if (empty($this->request->data[$this->modelClass]['remember_me'])) {
                        $this->RememberMe->destroyCookie();
                    } else {
                        $this->_setCookie();
                    }
                }

                if (empty($data['return_to'])) {
                    $data['return_to'] = null;
                }

                $this->redirect($this->Auth->redirect($data['return_to']));
            } else {
                $this->Session->setFlash(__d('users', 'Invalid e-mail / password combination.  Please try again'), 'flash_failure');
            }
        }
        if (isset($this->request->params['named']['return_to'])) {
            $this->set('return_to', urldecode($this->request->params['named']['return_to']));
        } else {
            $this->set('return_to', false);
        }
        $allowRegistration = Configure::read('allowRegistration');
        $this->set('allowRegistration', (is_null($allowRegistration) ? true : $allowRegistration));
    }
    
    public function admin_login() {
      $this->redirect('/login');
    }
    
    public function steam_login() {
        $api_key = $this->Option->getValue('steam_api_key');
        //if theres no api key, this functionality wont work.
        if (!$api_key) {
            $this->redirect('/login');
        }
        try {
            // Change 'localhost' to your domain name.
            $openid = new LightOpenID($_SERVER['SERVER_NAME']);
            if(!$openid->mode) {
                $openid->identity = 'http://steamcommunity.com/openid';
                $this->redirect($openid->authUrl());
            } elseif($openid->mode == 'cancel') {
                    $this->Session->setFlash('FOR SOME REASON you clicked cancel on the steam connect page! maybe you want to register through our website instead?', 'flash_failure');
                    $this->redirect('/login');
            } else {
                if($openid->validate()) { 
                    $id = $openid->identity;
                    $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                    preg_match($ptn, $id, $matches);
                    
                    $user = $this->User->findBySteamId($matches[1]);
                    if ($user) {
                        //user is made, force login, go to this page again to ensure they have a username
                        $this->Auth->login($user['User']);
                        $this->redirect('/dashboard');
                    } elseif ($this->Auth->User('id')) {
                        $this->User->read(null, $this->Auth->User('id'));
                        $this->User->set('steam_id', $matches[1]);
                        $this->User->save();
                        $this->Session->setFlash('Steam account linked successfully!', 'flash_success');
                        $this->redirect('/dashboard');
                    } else {
                        //no user, lets sign them up
                        $this->{$this->modelClass}->create();
                        $this->{$this->modelClass}->set('steam_id', $matches[1]);
                        $this->{$this->modelClass}->save(null, false);
                        $user = $this->{$this->modelClass}->findBySteamId($matches[1]);
                        $this->Auth->login($user['User']);
                    }
                } else {
                    $this->Session->setFlash('Something went wrong with the steam server, or you entered your credentials incorrectly. Try again?', 'flash_failure');
                    $this->redirect('/login');
                }
        
            }
        } catch(ErrorException $e) {
            echo $e->getMessage();
        }
    }

/**
 * Common logout action
 *
 * @return void
 */
    public function logout() {
        $user = $this->Auth->user();
        $this->Session->destroy();
        $this->Cookie->destroy();
        $this->RememberMe->destroyCookie();
        $this->Session->setFlash(sprintf(__d('users', 'You have successfully logged out')), 'flash_success');
        $this->redirect($this->Auth->logout());
    }

/**
 * Confirm email action
 *
 * @param string $type Type, deprecated, will be removed. Its just still there for a smooth transistion.
 * @param string $token Token
 * @return void
 */
    public function verify($type = 'email', $token = null) {
        if ($type == 'reset') {
            // Backward compatiblity
            $this->request_new_password($token);
        }

        try {
            $this->{$this->modelClass}->verifyEmail($token);
            $this->Session->setFlash(__d('users', 'Your e-mail has been validated!'));
            return $this->redirect(array('action' => 'login'));
        } catch (RuntimeException $e) {
            $this->Session->setFlash($e->getMessage());
            return $this->redirect('/');
        }
    }

/**
 * This method will send a new password to the user
 *
 * @param string $token Token
 * @throws NotFoundException
 * @return void
 */
    public function request_new_password($token = null) {
        if (Configure::read('sendPassword') !== true) {
            throw new NotFoundException();
        }

        $data = $this->{$this->modelClass}->validateToken($token, true);

        if (!$data) {
            $this->Session->setFlash(__d('users', 'The url you accessed is not longer valid'));
            return $this->redirect('/');
        }

        $email = $data[$this->modelClass]['email'];
        unset($data[$this->modelClass]['email']);

        if ($this->{$this->modelClass}->save($data, array('validate' => false))) {
            $this->_sendNewPassword($data);
            $this->Session->setFlash(__d('users', 'Your password was sent to your registered email account'));
            return $this->redirect(array('action' => 'login'));
        }

        $this->Session->setFlash(__d('users', 'There was an error verifying your account. Please check the email you were sent, and retry the verification link.'));
        $this->redirect('/');
    }

/**
 * Sends the password reset email
 *
 * @param array
 * @return void
 */
    protected function _sendNewPassword($userData) {
        $Email = $this->_getMailInstance();
        $Email->from(Configure::read('App.defaultEmail'))
            ->to($userData[$this->modelClass]['email'])
            ->replyTo(Configure::read('App.defaultEmail'))
            ->return(Configure::read('App.defaultEmail'))
            ->subject(env('HTTP_HOST') . ' ' . __d('users', 'Password Reset'))
            ->template($this->_pluginDot() . 'new_password')
            ->viewVars(array(
                'model' => $this->modelClass,
                'userData' => $userData))
            ->send();
    }

/**
 * Allows the user to enter a new password, it needs to be confirmed by entering the old password
 *
 * @return void
 */
    public function change_password() {
        if ($this->request->is('post')) {
            $this->request->data[$this->modelClass]['id'] = $this->Auth->user('id');
            if ($this->{$this->modelClass}->changePassword($this->request->data)) {
                $this->Session->setFlash(__d('users', 'Password changed.'));
                $this->redirect('/');
            }
        }
    }

/**
 * Reset Password Action
 *
 * Handles the trigger of the reset, also takes the token, validates it and let the user enter
 * a new password.
 *
 * @param string $token Token
 * @param string $user User Data
 * @return void
 */
    public function reset_password($token = null, $user = null) {
        if (empty($token)) {
            $admin = false;
            if ($user) {
                $this->request->data = $user;
                $admin = true;
            }
            $this->_sendPasswordReset($admin);
        } else {
            $this->_resetPassword($token);
        }
    }


/**
 * Sends the verification email
 *
 * This method is protected and not private so that classes that inherit this
 * controller can override this method to change the varification mail sending
 * in any possible way.
 *
 * @param string $to Receiver email address
 * @param array $options EmailComponent options
 * @return boolean Success
 */
    protected function _sendVerificationEmail($userData, $options = array()) {
        $defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => __d('users', 'Account verification'),
            'template' => $this->_pluginDot() . 'account_verification',
            'layout' => 'default');

        $options = array_merge($defaults, $options);

        $Email = $this->_getMailInstance();
        $Email->to($userData[$this->modelClass]['email'])
            ->from($options['from'])
            ->subject($options['subject'])
            ->template($options['template'], $options['layout'])
            ->viewVars(array(
            'model' => $this->modelClass,
                'user' => $userData))
            ->send();
    }

/**
 * Checks if the email is in the system and authenticated, if yes create the token
 * save it and send the user an email
 *
 * @param boolean $admin Admin boolean
 * @param array $options Options
 * @return void
 */
    protected function _sendPasswordReset($admin = null, $options = array()) {
        $defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => __d('users', 'Password Reset'),
            'template' => $this->_pluginDot() . 'password_reset_request',
            'layout' => 'default');

        $options = array_merge($defaults, $options);

        if (!empty($this->request->data)) {
            $user = $this->{$this->modelClass}->passwordReset($this->request->data);

            if (!empty($user)) {

                $Email = $this->_getMailInstance();
                $Email->to($user[$this->modelClass]['email'])
                    ->from($options['from'])
                    ->subject($options['subject'])
                    ->template($options['template'], $options['layout'])
                    ->viewVars(array(
                    'model' => $this->modelClass,
                    'user' => $this->{$this->modelClass}->data,
                        'token' => $this->{$this->modelClass}->data[$this->modelClass]['password_token']))
                    ->send();

                if ($admin) {
                    $this->Session->setFlash(sprintf(
                        __d('users', '%s has been sent an email with instruction to reset their password.'),
                        $user[$this->modelClass]['email']));
                    $this->redirect(array('action' => 'index', 'admin' => true));
                } else {
                    $this->Session->setFlash(__d('users', 'You should receive an email with further instructions shortly'));
                    $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->Session->setFlash(__d('users', 'No user was found with that email.'));
                $this->redirect($this->referer('/'));
            }
        }
        $this->render('request_password_change');
    }

/**
 * Sets the cookie to remember the user
 *
 * @param array RememberMe (Cookie) component properties as array, like array('domain' => 'yourdomain.com')
 * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
 * @return void
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
 * @deprecated Use the RememberMe Component
 */
    protected function _setCookie($options = array(), $cookieKey = 'rememberMe') {
        $this->RememberMe->settings['cookieKey'] = $cookieKey;
        $this->RememberMe->configureCookie($options);
        $this->RememberMe->setCookie();
    }

/**
 * This method allows the user to change his password if the reset token is correct
 *
 * @param string $token Token
 * @return void
 */
    protected function _resetPassword($token) {
        $user = $this->{$this->modelClass}->checkPasswordToken($token);
        if (empty($user)) {
            $this->Session->setFlash(__d('users', 'Invalid password reset token, try again.'));
            $this->redirect(array('action' => 'reset_password'));
        }

        if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
            $this->Session->setFlash(__d('users', 'Password changed, you can now login with your new password.'));
            $this->redirect($this->Auth->loginAction);
        }

        $this->set('token', $token);
    }

/**
 * Returns a CakeEmail object
 *
 * @return object CakeEmail instance
 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/email.html
 */
    protected function _getMailInstance() {
        App::uses('CakeEmail', 'Network/Email');
        $emailConfig = Configure::read('emailConfig');
        if ($emailConfig) {
            return new CakeEmail($emailConfig);
        } else {
            return new CakeEmail('default');
        }
    }
    
    public function settings() {
        $this->set('title_for_layout', 'Settings');
        $user = $this->User->findById($this->Auth->User('id'));

        $error = false;
        if ($this->request->isPost()) {
            $this->User->id = $this->Auth->User('id');
            //if a username is posted, make sure we dont already have one
            if (isset($this->request->data['User']['username'])) {
                if ($user['User']['username'] == "") {
                    $findUsername = $this->User->findByUsername($this->request->data['User']['username']);
                    if ($findUsername) {
                        $this->Session->setFlash('This username is already taken!', 'flash_failure');
                        $error = true;
                    }
               }
            }
            //if a username is posted, make sure we dont already have one
            if (isset($this->request->data['User']['settingsemail'])) {
                if ($user['User']['email'] == "") {
                    $findEmail = $this->User->findByEmail($this->request->data['User']['settingsemail']);
                    if ($findEmail) {
                        $this->Session->setFlash('This email address is already taken!', 'flash_failure');
                        $error = true;
                    }
                }
            }
            
            if (isset($this->request->data['User']['password1']) && isset($this->request->data['User']['password2'])) {
                if ($this->request->data['User']['password1'] != $this->request->data['User']['password2']) {
                    $this->Session->setFlash('The passwords you have entered do not match.', 'flash_failure');
                    $error = true;
                }
            }
            
            if (!$error) {
                $this->User->read(null, $this->Auth->User('id'));
                $this->User->set('twitch_id', $this->request->data['User']['twitch_id']);
                if (isset($this->request->data['User']['username'])) {
                    $this->User->set('username', $this->request->data['User']['username']);
                }
                if (isset($this->request->data['User']['settingsemail'])) {
                    $this->User->set('email', $this->request->data['User']['settingsemail']);
                }
                if (isset($this->request->data['User']['password1'])) {
                    $this->User->set('password', $this->User->hash($this->request->data['User']['password1'], 'sha1', true));
                }
                $this->Session->setFlash('Settings updated successfully!', 'flash_success');
                $this->User->save();
                $this->Auth->login($user);
            }
        }
    }

}