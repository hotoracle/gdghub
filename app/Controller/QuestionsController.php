<?php

/**
  Filename: QuestionsController.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:31:19 PM
 */

class QuestionsController extends AppController{
        
        public $uses = array('Question','QcVote','QuestionComment','QuestionsTag','Tag');
        
        function beforeFilter(){
                parent::beforeFilter();
                $this->Auth->allow('*');
        }
        
        function index(){
                
                
        }
        
        function ask(){
                $this->_requireAuth();
                
                $rules  = array(
                   'Ask'=>array(
                       'title'=>array(
                           FV_REQUIRED=>'Please provide a title for this question',
                           FV_MIN_LENGTH=>array('param'=>20,'error'=> 'The title provided is too short'),
                           FV_MAX_LENGTH=>array('param'=>200,'error'=> 'The title provided is too long')
                       ),
                       'description'=>array(
                           FV_REQUIRED=>'Please provide details for this question, share your research or errors encountered',
                           FV_MIN_LENGTH=>array('param'=>50,'error'=> 'The description provided is too short'),
                           FV_MAX_LENGTH=>array('param'=>5000,'error'=> 'The title provided is too long')
                       ),
                       
                   ) 
                );
                
                $this->FormValidator->setRules($rules);
                
                if(!empty($this->data) && $this->FormValidator->validate()){
                        
                        App::uses('Sanitize', 'Utility');

                        $subData = $this->data['Ask'];
                        
                        
                        $tagsProvided = explode(',',$subData['tags']);
                        $tagIds  = array();
                        foreach($tagsProvided as $tag){
                        
                               $tag =  Sanitize::paranoid($tag);
                               //@TODO we should remove whitespaces too...
                                $tagIds[] = $this->Tag->getOrCreateTagId($tag);
                               
                        }
                        
                        $questionData = array(
                            'user_id'=>$this->_thisUserId,
                            'name'=>Sanitize::paranoid($subData['title'],array('-','.','/','_')),
                            'description'=>  Sanitize::stripAll($subData['description'])
                        );
                        
                        $questionId = $this->Question->addQuestion($questionData);
                        foreach($tagIds as $tagId){
                                $this->QuestionsTag->addTag($questionId,$tagId);
                        }
                        $this->miniFlash("Question Posted","viewQuestion/$questionId");
                        
                        
                }
                
                
                
        }
        
        
}