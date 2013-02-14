<?php

/**
  Filename: QuestionsController.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:31:19 PM
 */
class QuestionsController extends AppController {

        public $uses = array('Question', 'QcVote', 'QuestionComment', 'QuestionsTag', 'Tag');

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
        function index() {
                
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


                        $tagsProvided = explode(',', $subData['tags']);
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
                                $this->QuestionsTag->addTag($questionId, $tagId);
                        }

                        $questionSlug = $this->Question->getSlug($questionId);

                        $this->miniFlash("Question Posted", "viewQuestion/$questionId/$questionSlug");
                }
        }

        /**
         * Show details of a question and comments and comments form
         * @param string $questionSlug
         */
        public function viewQuestion($questionId = '',$questionSlug='') {

                $question = $this->_getQuestion($questionId);
                $this->set(compact('questionId', 'question'));
        }

        /**
         * A security action for validating questions - that it does exist.
         * @param string $questionId
         * @return array
         */
        private function _getQuestion($questionId) {

               $questionInfo = $this->Question->getQuestion($questionId);
               if(!$questionInfo){
                       
                       $this->miniFlash('Unable to find selected question. Try searching instead','index');
                       
               }
                return $questionInfo;
        }

}