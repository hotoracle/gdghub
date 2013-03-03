<?php

App::uses('AppModel', 'Model');

/**
 * Tag Model
 *
 * @property Question $Question
 */
class Tag extends AppModel {

        /**
         * Display field
         *
         * @var string
         */
        public $displayField = 'name';


        //The Associations below have been created with all possible keys, those that are not needed can be removed

        /**
         * hasAndBelongsToMany associations
         *
         * @var array
         */
        public $hasAndBelongsToMany = array(
            'Question' => array(
                'className' => 'Question',
                'joinTable' => 'questions_tags',
                'foreignKey' => 'tag_id',
                'associationForeignKey' => 'question_id',
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

         function getOrCreateTagId($tag){
                $tag = trim($tag);
                $conditions = array('Tag.name'=>$tag);
                $this->recursive = -1;
                $tagId = $this->field('Tag.id',$conditions);
                if(!$tagId){
                        $data  = array('Tag'=>array(
                            'name'=>$tag,
                        ));
                        $this->create($data);
                        $this->save($data);
                        $tagId  =$this->id;
                }
                return $tagId;
        }
        
        function listTagsByName(){
              return array_values($this->find('list',array('order'=>'Tag.name')));
        }
}
