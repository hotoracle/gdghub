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

        public $components = array('Auth', 'Session', 'Error', 'FormValidator', 'RequestHandler');
        public $_thisUserId = false; //In Dev mode, once auth is sorted, this should be set in the code

        public function beforeFilter() {
                $this->Auth->authenticate = array('Form' => array(
                        'username', 'id', 'name', 'email'
                ));
                $this->Auth->loginRedirect = array('action' => 'index', 'controller' => 'MyAccount');
                $this->Auth->logoutRedirect = array('action' => 'index', 'controller' => 'Dashboard');
                $this->Auth->authError = 'You are required to login to proceed to the requested page';

                $userInfo = $this->Auth->user();

                if ($userInfo) {

                        $this->_thisUserId = $userInfo['User']['id'];
                }

                # To enable portuguese language as main
                #Configure::write('Config.language', 'por');
        }

        function beforeRender() {
                parent::beforeRender();
                $url = '/' . $this->params->url;
                $this->set('_thisUrl', $url);
                $this->set('_userInfo', $this->_getAuthedUser());
                $this->set('_thisUserId',$this->_thisUserId);
        }

        function _getAuthedUser() {
                return $this->Auth->user();
        }

        //This should ensure that the user is logged in
        function _requireAuth() {
                
        }

        /**
         *  Session Flash a message and redirect
         * @param string $msg message to display
         * @param string $url to redirect to
         */
        function miniFlash($msg, $url) {

                $this->Session->setFlash($msg);

                $this->redirect($url);
        }

        /**
         *  Session Flash a message 
         * @param string $msg message to display
         */
        function sFlash($msg,$isError = false) {
                $flashDoc = 'flash_success';
                if($isError){
                        $flashDoc = 'flash_fail';
                }

                $this->Session->setFlash($msg,$flashDoc);
        }

}

