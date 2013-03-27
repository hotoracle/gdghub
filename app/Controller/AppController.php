<?php
 
App::uses('Controller', 'Controller');
 
class AppController extends Controller {

        public $components = array('Auth', 'Session', 'Error', 'FormValidator', 'RequestHandler');
        public $_thisUserId = false; //In Dev mode, once auth is sorted, this should be set in the code
        public $pageTitle = '';
        
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
                if($this->pageTitle) $this->set('title_for_layout',$this->pageTitle);
        }

        function _getAuthedUser() {
                return $this->Auth->user();
        }
        function _refreshAuthenticatedUser() {
                
              if(!isset($this->User)){
                    App::import('Model','User');
                    $u = new User();
                    $this->User= $u;
                    
              }
              $userInfo = $this->User->getUserInfo($this->_thisUserId);
               $this->Auth->login($userInfo);
              
        }

        //This should ensure that the user is logged in
        function _requireAuth() {
                
        }

        /**
         *  Session Flash a message and redirect
         * @param string $msg message to display
         * @param string $url to redirect to
         */
        function miniFlash($msg, $url,$isSuccess=false) {
                  $flashDoc = 'flash';
                if($isSuccess){
                        $flashDoc = 'flash_success';
                }
                $this->Session->setFlash($msg,$flashDoc);

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

