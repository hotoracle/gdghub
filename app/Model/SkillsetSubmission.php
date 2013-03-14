<?php

App::uses('AppModel', 'Model');

/**
 * SkillsetSubmission Model
 *
 * @property User $User
 */
class SkillsetSubmission extends AppModel {

      /**
       * Display field
       *
       * @var string
       */
      public $displayField = 'name';


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

      function addSubmission($data){
            $this->create($data);
            $this->save($data);
      }
      
      function getPendingUserSubmissions($userId){
            
            $conditions = array(
                'SkillsetSubmission.user_id'=>$userId,
                'SkillsetSubmission.approval_status'=>0
            );
            
            return $this->find('all',compact('conditions'));
      }
}
