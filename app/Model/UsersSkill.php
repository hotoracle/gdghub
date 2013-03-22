<?php

App::uses('AppModel', 'Model');

/**
 * UsersSkill Model
 *
 * @property User $User
 * @property Skillset $Skillset
 */
class UsersSkill extends AppModel {

      public $useTable='users_skillsets';
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

        function getUserSkills($userId){
                
                return $this->find('all',array('conditions'=>array('UsersSkill.user_id'=>$userId)));
                
        }
        function listUserSkillIds($userId){
                
                return $this->find('list',array('conditions'=>array('UsersSkill.user_id'=>$userId)));
                
        }
        function removeSkill($userId,$skillId){
              $conditions=  array(
                  'UsersSkill.skillset_id'=>$skillId,
                  'UsersSkill.user_id'=>$userId
              );
              
              $this->deleteAll($conditions);
              
        }
        
         function listSkillsWithStats(){
                
                $this->virtualFields = array('qcount'=>'COUNT(*)');
                $results = $this->find('all',array(
                    'fields'=>array('Skillset.id','Skillset.name', 'qcount'),
                'group'=>array('UsersSkill.skillset_id'),
                    'order'=>array('qcount'=>'DESC','Skillset.name')
                        )
                );
                
              return $results;
                
                
        }
}
