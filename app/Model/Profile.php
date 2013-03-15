<?php

App::uses('AppModel', 'Model');

/**
 * Profile Model
 *
 * @property User $User
 */
class Profile extends AppModel {
      //The Associations below have been created with all possible keys, those that are not needed can be removed

      /**
       * belongsTo associations
       *
       * @var array
       */
      public $belongsTo = array(
          'User' => array(
              'className' => 'User',
              'foreignKey' => 'user_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          )
      );

      
      function updateUserProfile($userId,$data){
            
            $profileInfo = $this->findByUserId($userId);
            if($profileInfo){
                  $this->id = $profileInfo['Profile']['id'];
                  
            }else{
                  $data['user_id'] = $userId;
                  $this->create($data);
            }
            $this->save($data);
            
            
      }
}
