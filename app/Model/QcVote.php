<?php

App::uses('AppModel', 'Model');

/**
 * QcVote Model
 *
 * @property User $User
 * @property QuestionComment $QuestionComment
 */
class QcVote extends AppModel {
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
          ),
          'QuestionComment' => array(
              'className' => 'QuestionComment',
              'foreignKey' => 'question_comment_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          )
      );

      function castVote($userId,$commentId,$voteFlag){
            
            $data = array(
                'question_comment_id'=>$commentId,
                'user_id'=>$userId
            );
            $exists = $this->find('first',array('conditions'=>$data,'fields'=>array('id','vote_type','created'),'recursive'=>-1));
            if($exists){//voted by user already
                  return $exists;
            }
            
            $data['vote_type'] = $voteFlag;
            
            $this->create($data);
            $this->save($data);
            return true;
      }
}
