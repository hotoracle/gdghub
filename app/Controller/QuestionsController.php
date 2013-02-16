<?php

/**
  Filename: QuestionsController.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:31:19 PM
 */
class QuestionsController extends AppController {

        public $uses = array('Question', 'QcVote', 'QuestionComment', 'QTag', 'Tag');
        public $helpers = array('Qv');

        /**
         * To allow action to all methods without login
         * @TODO restrict asking to authenticated users
         */
        function beforeFilter() {
                parent::beforeFilter();
                $this->Auth->allow('*');
        }

        /**
         * Landing Page for Questions Section
         * It should display tags, newest/hottest/popular questions
         * If user is authenticated, it should display relevant questions
         * 
         */
        function index($sortBy='hottest') {
                
                
                
                switch($sortBy){
                        case 'new':
                                $orderBy = array('Question.created'=>'DESC');//Is this the best ?
                                break;
                        default:
                                $orderBy = array('Question.views'=>'DESC');//Is this the best ?
                                
                }
                
                $conditions = array(
                    'Question.published'=>1
                );
                
                $this->paginate = array('Question'=>array(
                    'order'=>$orderBy
                        )
                );
                
                $questions = $this->paginate('Question',$conditions);
                
                $questionIds = $this->Question->extractKeys($questions);
                
                $questionsTags = $this->QTag->getIndexedTags($questionIds);
                
                $this->set(compact('questions','questionsTags'));
                
//                $storedTags = $this->Session->read('storedTags');
//                if(!$storedTags){
//                        
//                }
                $storedTags = $this->QTag->listTagsWithStats();//We should cache this....
                
                $this->set('storedTags',$storedTags);
                
        }

        /**
         * Method/Form for creating questions
         * @return null
         */
        function ask() {
                $this->_requireAuth();

                $rules = array(
                    'Ask' => array(
                        'title' => array(
                            FV_REQUIRED => 'Please provide a title for this question',
                            FV_MIN_LENGTH => array('param' => 20, 'error' => 'The title provided is too short'),
                            FV_MAX_LENGTH => array('param' => 200, 'error' => 'The title provided is too long')
                        ),
                        'description' => array(
                            FV_REQUIRED => 'Please provide details for this question, share your research or errors encountered',
                            FV_MIN_LENGTH => array('param' => 50, 'error' => 'The description provided is too short'),
                            FV_MAX_LENGTH => array('param' => 5000, 'error' => 'The title provided is too long')
                        ),
                    )
                );

                $this->FormValidator->setRules($rules);

                if (!empty($this->data) && $this->FormValidator->validate()) {

                        App::uses('Sanitize', 'Utility');

                        $subData = $this->data['Ask'];

                        
                        $tagsProvided = str_replace(' ',',', $subData['tags']);
                        $tagsProvided = explode(',', $tagsProvided);
                        $tagIds = array();
                        foreach ($tagsProvided as $tag) {

                                $tag = Sanitize::paranoid($tag);
                                //@TODO we should remove whitespaces too...
                                $tagIds[] = $this->Tag->getOrCreateTagId($tag);
                        }

                        $questionData = array(
                            'user_id' => $this->_thisUserId,
                            'name' => Sanitize::stripAll($subData['title']),
                            'description' => Sanitize::stripAll($subData['description'])
                        );

                        $questionId = $this->Question->addQuestion($questionData);
                        if (!$questionId) {
                                $this->sFlash("An unexpected error occurred while saving this question. Please try again later");
                                return;
                        }
                        foreach ($tagIds as $tagId) {
                                $this->QTag->addTag($questionId, $tagId);
                        }

                        $questionSlug = $this->Question->getSlug($questionId);

                        $this->miniFlash("Question Posted", "viewQuestion/$questionId/$questionSlug");
                }
        }

        /**
         * A security action for validating questions - that it does exist.
         * @param string $questionId
         * @return array
         */
        private function _getQuestion($questionId) {

                $questionInfo = $this->Question->getQuestion($questionId);
                if (!$questionInfo) {

                        $this->miniFlash('Unable to find selected question. Try searching instead', 'index');
                }
                if(!$questionInfo['Question']['published']){
                        $this->miniFlash('The selected question has been unpublished for some important reason I\'m not privy to :)', 'index');
                }
                return $questionInfo;
        }

        /**
         * Show details of a question and comments and comments form
         * @param string $questionSlug
         */
        public function viewQuestion($questionId = '', $questionSlug = '') {

                $question = $this->_getQuestion($questionId);
                $questionTags = $this->QTag->questionTags($questionId);
               
                $directComments = $this->QuestionComment->getDirectComments($questionId);

                $postedAnswers = $this->QuestionComment->getPostedAnswers($questionId);

                $postedComments = $this->QuestionComment->getPostedComments($questionId);
                
                //Let's try to increase the view count
                $questionsViewed = $this->Session->read('questionsViewed');
                if(!$questionsViewed){
                        $questionsViewed = array();
                }
                if(!in_array($questionId,$questionsViewed)){
                        
                        $questionsViewed[] = $questionId;
                        $this->Session->write('questionsViewed',$questionsViewed);
                        $this->Question->increaseViewCount($questionId);
                }
                
                $this->set(compact('questionId', 'questionSlug', 'question', 'questionTags', 'directComments', 'postedAnswers', 'postedComments'));
                
                
                if($question['Question']['flag']==0){
                        $this->postResponse($questionId,$questionSlug);//To set values into form
                }
                
                
        }

        public function postResponse($questionId,$questionSlug) {
                $question = $this->_getQuestion($questionId);
                if($question['Question']['flag']!=0){
                        $this->miniFlash('This question is no longer open for comments or answers',"viewQuestion/$questionId/$questionSlug");
                }
                 $rules = array(
                    'Answer' => array(
                        'answer' => array(
                            FV_REQUIRED => 'You must provide a response to submit this',
                        )
                    )
                );
                 
                $this->FormValidator->setRules($rules);
                
                if (!empty($this->data) && $this->FormValidator->validate()) {

                        $subData = $this->data['Answer'];

                        $dbData = array(
                            'is_comment' => 0,
                            'question_id' => $questionId,
                            'user_id' => $this->_thisUserId,
                            'description' => $subData['answer']
                        );

                         
                        if ($this->QuestionComment->addComment($dbData)) {
                                $hash = md5($this->QuestionComment->id);
                                $this->miniFlash("Posted successfully", "viewQuestion/$questionId/$questionSlug/#{$hash}");
                        } else {
                                $this->sFlash("An unexpected errror occurred. Please try again later");
                        }
                }
                $this->set(compact('questionId', 'questionSlug', 'question'));

        }

        /**
         * I chose to duplicate this function on purpose for the sake of simplicity
         * It could have been handled by postResonse instead
         * @param type $questionId
         * @param type $questionSlug
         * @param type $responseId
         */
         public function postComment($questionId,$questionSlug,$relCommentId=0) {
                $question = $this->_getQuestion($questionId);
                if($question['Question']['flag']!=0){
                        $this->miniFlash('This question is no longer open for comments or answers',"viewQuestion/$questionId/$questionSlug");
                }
                 $rules = array(
                    'Answer' => array(
                        'answer' => array(
                            FV_REQUIRED => 'You must provide a response to submit this',
                        )
                    )
                );
                 
                $this->FormValidator->setRules($rules);
                
                if (!empty($this->data) && $this->FormValidator->validate()) {

                        $subData = $this->data['Answer'];

                        $dbData = array(
                            'is_comment' => 1,
                            'question_id' => $questionId,
                            'user_id' => $this->_thisUserId,
                            'description' => $subData['answer']
                        );

                        if ($relCommentId) {
                                
                                if (!$this->QuestionComment->exists($relCommentId)) {
                                        $this->miniFlash("Invalid Question Comment Link", "viewQuestion/$questionId/$questionSlug");
                                }
                                
                                $dbData['question_comment_id'] = $relCommentId;
                                
                        }
                        $hash = md5($relCommentId);
                        if ($this->QuestionComment->addComment($dbData)) {
                                $this->miniFlash("Posted successfully", "viewQuestion/$questionId/$questionSlug/#{$hash}");
                        } else {
                                $this->sFlash("An unexpected errror occurred. Please try again later");
                        }
                }
                $this->set(compact('questionId', 'questionSlug', 'question'));

        }
}