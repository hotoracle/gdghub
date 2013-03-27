<?php

class UsersController extends AppController {

        public function beforeFilter() {
                parent::beforeFilter();
                $this->Auth->allow('register', 'logout', 'change_password', 'remember_password', 'remember_password_step_2', 'opauth_complete');
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

        public function opauth_complete() {
                  if(empty($this->data)){
                        $this->miniFlash('An Unexpected Error Occured', '/');
                  }
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
