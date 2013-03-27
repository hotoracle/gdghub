<?php

class UsersController extends AppController {

        public function beforeFilter() {
                parent::beforeFilter();
                $this->Auth->allow('register', 'logout', 'change_password', 'remember_password', 'remember_password_step_2', 'opauth_complete');
        }

        public function home() {
                $this->User->recursive = 0;
                $this->set('users', $this->paginate());
        }

        public function user_profile() {
                $this->User->recursive = 0;
                $this->set('users', $this->paginate());
        }

        public function login() {
                if ($this->request->is('post')) {
                        if ($this->Auth->login()) {
                                $this->redirect($this->Auth->redirect());
                        } else {
                                $this->Session->setFlash(__('Invalid username or password, try again'), 'flash_fail');
                        }
                }
        }

        public function logout() {
                $this->sFlash('You have been logged out successfully');
                $this->redirect($this->Auth->logout());
        }

        public function view($id = null) {
                $this->User->id = $id;

                if (!$this->User->exists()) {
                        throw new NotFoundException(__('Invalid user'));
                }

                $this->set('user', $this->User->read(null, $id));
        }

        public function register() {
                if ($this->request->is('post')) {
                        $this->User->create();

                        if ($this->User->save($this->request->data)) {
                                $this->Session->setFlash(__('The user has been saved'), 'flash_success');
                                $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
                        } else {
                                # Create a loop with validation errors
                                $this->Error->set($this->User->invalidFields());
                        }
                }
        }

        public function edit($id = null) {
                $this->User->id = $id;

                if (!$this->User->exists()) {
                        throw new NotFoundException(__('Invalid user'));
                }

                $user = $this->User->findById($id);
                $this->set('user', $user);

                if ($this->request->is('post') || $this->request->is('put')) {
                        if (empty($this->request->data['User']['password'])) {
                                unset($this->request->data['User']['password']);
                        }

                        if ($this->User->save($this->request->data)) {
                                $this->Session->setFlash(__('The user has been saved'), 'flash_success');
                                $this->redirect(array('action' => 'home'));
                        } else {
                                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_fail');
                        }
                } else {
                        $this->request->data = $this->User->read(null, $id);
                        unset($this->request->data['User']['password']);
                }
        }

        public function delete($id = null) {
                $this->User->id = $id;

                if (!$this->User->exists()) {
                        throw new NotFoundException(__('Invalid user'));
                }

                if ($this->User->delete()) {
                        $this->Session->setFlash(__('User deleted'), 'flash_success');
                        $this->redirect(array('action' => 'home'));
                }

                $this->Session->setFlash(__('User was not deleted'), 'flash_fail');

                $this->redirect(array('action' => 'home'));
        }

        public function change_password() {
                $user = $this->User->read(null, AuthComponent::user('id'));
                $this->set('user', $user);

                if ($this->request->is('post')) {
                        # Verify if password matches
                        if ($this->request->data['User']['password'] === $this->request->data['User']['re_password']) {
                                # Verify if user is logged in
                                if (AuthComponent::user('id')) {
                                        $this->request->data['User']['id'] = AuthComponent::user('id');
                                } else { # Maybe hes comming from change password form
                                        # Check the hash in database
                                        $user = $this->User->findByHashChangePassword($this->request->data['User']['hash']);

                                        if (!empty($user)) {
                                                $this->request->data['User']['id'] = $user['User']['id'];

                                                # Clean users hash in database
                                                $this->request->data['User']['hash_change_password'] = '';
                                        } else {
                                                throw new MethodNotAllowedException(__('Invalid action'));
                                        }
                                }

                                if ($this->User->save($this->request->data)) {
                                        $this->Session->setFlash('Password updated successfully!', 'flash_success');
                                        $this->redirect(array('controller' => 'users', 'action' => 'home'));
                                }
                        } else {
                                $this->Session->setFlash('Passwords do not match.', 'flash_fail');
                        }
                }
        }

        /**
         * Email form to inform the process of remembering the password.
         * After entering the email is checked if this email is valid and if so, a message is sent containing a link to change your password
         */
        public function remember_password() {
                if ($this->request->is('post')) {
                        $user = $this->User->findByEmail($this->request->data['User']['email']);

                        if (empty($user)) {
                                $this->Session->setFlash('This email does not exist in our database.', 'flash_fail');
                                $this->redirect(array('action' => 'login'));
                        }

                        $hash = $this->User->generateHashChangePassword();

                        $data = array(
                            'User' => array(
                                'id' => $user['User']['id'],
                                'hash_change_password' => $hash
                            )
                        );

                        $this->User->save($data);

                        $email = new CakeEmail();
                        $email->template('remember_password', 'default')
                                ->config('gmail')
                                ->emailFormat('html')
                                ->subject(__('Remember password - ' . Configure::read('Application.name')))
                                ->to($user['User']['email'])
                                ->from(Configure::read('Application.from_email'))
                                ->viewVars(array('hash' => $hash))
                                ->send();

                        $this->Session->setFlash('Check your e-mail to continue the process of recovering password.', 'flash_success');
                }
        }

        /**
         * Step 2 to change the password.
         * This step verifies that the hash is valid, if it is, show the form to the user to inform your new password
         */
        public function remember_password_step_2($hash = null) {

                $user = $this->User->findByHashChangePassword($hash);

                if ($user['User']['hash_change_password'] != $hash || empty($user)) {
                        throw new NotFoundException(__('Link inválido'));
                }

                # Sends the hash to the form to check before changing the password
                $this->set('hash', $hash);

                $this->render('/Users/change_password');
        }

        public function opauth_complete() {

                $myData = $this->data;
                
                    //debug($this->data);
                if(!isset($myData['auth']) || !$myData['auth']){
                        $this->sFlash("An error occurred. Unable to find the right credentials to authenticate you.",true);
                        $this->redirect('/Users/login');
                        return;
                }
                $auth = $myData['auth'];
                
                switch($auth['provider']){
                        
                        case 'Twitter':
                                $data = array('User' => array(
                                        'name' => $auth['info']['name'],
                                        'image' => $auth['info']['image'],
                                        'username' => $auth['info']['nickname'].'_'.$auth['raw']['id'],
                                        'name' => $auth['info']['name'],
                                        'link' => $auth['info']['urls']['twitter'],
                                        'token' => $auth['credentials']['token'],
                                        'provider' => $auth['provider'],
                                        'password' =>  $auth['credentials']['secret'],
                                    'raw_data' =>json_encode($auth)
                                    )
                                );
                                break;
                        default:
                                $data = array('User' => array(
                                        'name' => $auth['info']['name'],
                                        'image' => $auth['info']['image'],
                                        'username' => $auth['raw']['email'],
                                        'email' =>$auth['raw']['email'],
                                        'link' => $auth['raw']['link'],
                                        'gender' => $auth['raw']['gender'],
                                        'token' => $auth['credentials']['token'],
                                        'provider' => $auth['provider'],
                                        'password' =>  $auth['credentials']['token'],
                                    'raw_data' =>json_encode($auth)
                                    )
                                );
                }
      
                //This was added because remote images are not always good
                if(isset($data['User']['image']) && $data['User']['image']){
                      
                      $imageBlob = @file_get_contents($data['User']['image']);
                      $f = md5($data['User']['username']);
                      $destinationImg = time().'_'. $f. ".jpg";
                      $tempFile = APP.'/tmp/'.$destinationImg;
                      file_put_contents($tempFile,$imageBlob);
                      $data['User']['image']='';
                      $validImage = getimagesize($tempFile);
                      @unlink($tempFile);
                      if($validImage){
                            $photoDir = cRead('Application.upload.abs_profile_photos');
                            $continuePhotoWrite = true;
                              if (!file_exists($photoDir)) {
                                    $continuePhotoWrite = false;

                                    if (mkdir($photoDir, 0777, true)) {
                                          $continuePhotoWrite = true;
                                    }
                              }
                              
                              if($continuePhotoWrite){
                                    file_put_contents($photoDir . DS . $destinationImg,$imageBlob);
                                    $urlPath = cRead('Application.upload.url_profile_photos') . $destinationImg;
                                    $data['User']['image'] = $urlPath;  
                              }

                      }
                }
                $this->User->save($data);
                $fields = null;
                $conditions = array('User.username' => $data['User']['username']); //How does this work ?
                $loginUser = $this->User->find('first', compact('fields', 'conditions'));

                if ($this->Auth->login($loginUser)) {
                        $this->redirect($this->Auth->redirect());
                } else {
                        $this->Session->setFlash(__('Unable to find the right credentials'), 'flash_fail');
                }
        }

}
