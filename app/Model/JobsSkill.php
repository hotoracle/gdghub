<?php

App::uses('AppModel', 'Model');

/**
 * UsersSkill Model
 *
 * @property User $User
 * @property Skillset $Skillset
 */
class JobsSkill extends AppModel {

      public $useTable='jobs_skillsets';
        /**
         * Primary key field
         *
         * @var string
         */
        public $primaryKey = 'skillset_id';
        public $displayField = 'skillset_id';


        //The Associations below have been created with all possible keys, those that are not needed can be removed

        /**
         * belongsTo associations
         *
         * @var array
         */
        public $belongsTo = array(
//            'User' => array(
//                'className' => 'User',
//                'foreignKey' => 'user_id',
//                'conditions' => '',
//                'fields' => '',
//                'order' => ''
//            ),
            'Skillset' => array(
                'className' => 'Skillset',
                'foreignKey' => 'skillset_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            )
        );

        function getJobSkills($jobId){
                
                return $this->find('all',array('conditions'=>array('JobsSkill.job_id'=>$userId)));
                
        }
        function listJobSkillIds($userId){
                
                return $this->find('list',array('conditions'=>array('JobsSkill.job_id'=>$userId)));
                
        }
        function removeSkill($jobId,$skillId){
              $conditions=  array(
                  'JobsSkill.skillset_id'=>$skillId,
                  'JobsSkill.job_id'=>$jobId
              );
              
              $this->deleteAll($conditions);
              
        }
}
