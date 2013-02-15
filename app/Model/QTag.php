<?php

App::uses('AppModel', 'Model');

/**
 * QuestionsTag Model
 *
 * @property Question $Question
 * @property Tag $Tag
 */
class QTag extends AppModel {

        public $useTable = 'questions_tags';
        /**
         * Validation rules
         *
         * @var array
         */
        public $validate = array(
            'question_id' => array(
                'uuid' => array(
                    'rule' => array('uuid'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
            'tag_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
            ),
        );

        //The Associations below have been created with all possible keys, those that are not needed can be removed

        /**
         * belongsTo associations
         *
         * @var array
         */
        public $belongsTo = array(
            'Question' => array(
                'className' => 'Question',
                'foreignKey' => 'question_id',
                'conditions' => '',
                'fields' => array('Question.id'),
                'order' => ''
            ),
            'Tag' => array(
                'className' => 'Tag',
                'foreignKey' => 'tag_id',
                'conditions' => '',
                'fields' => array('Tag.id','Tag.name','Tag.published'),
                'order' => ''
            )
        );

        function addTag($questionId=0,$tagId=0){
                if(!$questionId|| !$tagId) return;
                
                $data = array('question_id'=>$questionId,'tag_id'=>$tagId);
                $this->create($data);
                $this->save($data);
                
        }
        
        function questionTags($questionId){
                
                return $this->find('all',array('conditions'=>array('QTag.question_id'=>$questionId)));
                
        }
}
