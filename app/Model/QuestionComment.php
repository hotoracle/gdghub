<?php

App::uses('AppModel', 'Model');

/**
 * QuestionComment Model
 *
 * @property QuestionComment $QuestionComment
 * @property User $User
 * @property Question $Question
 * @property QcVote $QcVote
 * @property QuestionComment $QuestionComment
 */
class QuestionComment extends AppModel {
        //The Associations below have been created with all possible keys, those that are not needed can be removed

        /**
         * belongsTo associations
         *
         * @var array
         */
        public $belongsTo = array(
//            'QuestionComment' => array(
//                'className' => 'QuestionComment',
//                'foreignKey' => 'question_comment_id',
//                'conditions' => '',
//                'fields' => '',
//                'order' => ''
//            ),
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id',
                'conditions' => '',
                'fields' => array('User.id','User.name','User.image'),
                'order' => ''
            ),
//            'Question' => array(
//                'className' => 'Question',
//                'foreignKey' => 'question_id',
//                'conditions' => '',
//                'fields' => '',
//                'order' => ''
//            )
        );

        /**
         * hasMany associations
         *
         * @var array
         */
        public $hasMany = array(
            'QcVote' => array(
                'className' => 'QcVote',
                'foreignKey' => 'question_comment_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            ),
//            'QuestionComment' => array(
//                'className' => 'QuestionComment',
//                'foreignKey' => 'question_comment_id',
//                'dependent' => false,
//                'conditions' => '',
//                'fields' => '',
//                'order' => '',
//                'limit' => '',
//                'offset' => '',
//                'exclusive' => '',
//                'finderQuery' => '',
//                'counterQuery' => ''
//            )
        );

        function getHierComments($questionId=0){
                
                $conditions  = array('QuestionComment.question_id'=>$questionId);
                $order = array(
                    'QuestionComment.is_comment'=>'ASC',
                    'QuestionComment.accepted_answer'=>'DESC',
                    'QuestionComment.question_comment_id'=>'ASC',
                    'QuestionComment.created'=>'ASC',
                    'QuestionComment.vote_ups'=>'DESC',
                    'QuestionComment.vote_downs'=>'DESC',
                    
                 );
                
                $result = $this->find('all',compact('conditions','order'));
                $finalResults = array();
                foreach($result as $row){
                        $commentId = $row['QuestionComment']['id'];
                        $parentId = $row['QuestionComment']['question_comment_id'];
                        $finalResults[$parentId][$commentId] = $row;
                }
                
                return $finalResults;
                
        }
        
        function getDirectComments($questionId){
                $conditions  = array(
                    'QuestionComment.question_id'=>$questionId,
                    'QuestionComment.question_comment_id'=>0,
                    'QuestionComment.is_comment'=>1,
                    'QuestionComment.published'=>1,
                );
                
                $order = array(
                    'QuestionComment.created'=>'ASC',
                 );
                
              return $this->find('all',compact('conditions','order'));
        }
        
        function getPostedAnswers($questionId){
                
                $conditions  = array(
                    'QuestionComment.question_id'=>$questionId,
                    'QuestionComment.question_comment_id'=>0,
                    'QuestionComment.is_comment'=>0,
                    'QuestionComment.published'=>1,
                );
                
                $order = array(
                    'QuestionComment.created'=>'ASC',
                );
                
               return $this->find('all',compact('conditions','order'));
        }
        
        function getPostedComments($questionId){
                
                $conditions  = array(
                    'QuestionComment.question_id'=>$questionId,
                    'QuestionComment.question_comment_id != 0', //is this the best?
                    'QuestionComment.is_comment'=>1,
                    'QuestionComment.published'=>1,
                );
                
                $order = array(
                    'QuestionComment.created'=>'ASC',
                );
                
                $result = $this->find('all',compact('conditions','order'));
                
                $finalResults = array();
                
                if(!$result) return $finalResults;
                
                foreach($result as $row){
                        $finalResults[$row['QuestionComment']['question_comment_id']][]  = $row;
                }
                return $finalResults;
        }
        
        function addComment($commentData){
                
                $this->create($commentData);
                return $this->save($commentData);
                
        }
        function setAsAnswer($commentId){
              
              $data = array('accepted_answer'=>1);
              $this->id = $commentId;
              $this->save($data);
              
              
              
        }
}
