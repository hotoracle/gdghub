<?php

App::uses('AppModel', 'Model');

/**
 * Question Model
 *
 * @property User $User
 * @property QuestionComment $QuestionComment
 * @property Tag $Tag
 */
class Question extends AppModel {

        /**
         * Display field
         *
         * @var string
         */
        public $displayField = 'name';

        public $actsAs = array('Sluggable' => array('label' => 'name', 'overwrite' =>true));
        //Overwrite set to false because if the question is edited, the links indexed by search engines will be broken
        //The alternative is to always pass the id which I find uninteresting
        //The second alternative is to create a permalinks tag for search engines...is that possible?

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
                'fields' => array('User.id','User.name','User.photo_url'),
                'order' => ''
            )
        );

        /**
         * hasMany associations
         *
         * @var array
         */
        public $hasMany = array(
            'QuestionComment' => array(
                'className' => 'QuestionComment',
                'foreignKey' => 'question_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            )
        );

        /**
         * hasAndBelongsToMany associations
         *
         * @var array
         */
        public $hasAndBelongsToMany = array(
            'Tag' => array(
                'className' => 'Tag',
                'joinTable' => 'questions_tags',
                'foreignKey' => 'question_id',
                'associationForeignKey' => 'tag_id',
                'unique' => 'keepExisting',
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'deleteQuery' => '',
                'insertQuery' => ''
            )
        );

        function addQuestion($questionData){
                
                $this->create($questionData);
                
                if(!$this->save($questionData)){
                        return false;
                }
                
                return $this->id;
        }

        function getSlug($questionId=0){
                
                $conditions = array('Question.id'=>$questionId);
                return $this->field('slug',$conditions);
                
        }
        
        function getQuestion($questionId=0){
                
                return $this->read(null,$questionId);
                
        }
        
        function increaseViewCount($questionId){
                
                $query="UPDATE questions set views=views+1 where id='$questionId'";
                $this->query($query);
                
        }
}
