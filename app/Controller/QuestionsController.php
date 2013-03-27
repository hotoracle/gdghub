<?php

/**
  Filename: QuestionsController.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:31:19 PM
 */
class QuestionsController extends AppController {

      public $uses = array('Question', 'QcVote', 'QuestionComment', 'QTag', 'Tag', 'OutgoingMessage');
      public $helpers = array('Qv');

      /**
       * To allow action to all methods without login
       * @TODO restrict asking to authenticated users
       */
      function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('index', 'viewQuestion'));
            $this->Auth->deny(array('ask','mine','editQuestion'));
      }

      /**
       * Landing Page for Questions Section
       * It should display tags, newest/hottest/popular questions
       * If user is authenticated, it should display relevant questions
       * 
       */
      function index($sortBy = 'hottest') {
            
            $this->pageTitle='Questions';

            switch ($sortBy) {
                  case 'newest':
                        $orderBy = array('Question.created' => 'DESC'); //Is this the best ?
                        break;
                  default:
                        $orderBy = array('Question.views' => 'DESC'); //Is this the best ?
            }

            $conditions = array(
                'Question.published' => 1
            );

            if (isset($this->params['named'])) {

                  $namedParams = $this->params['named'];

                  $tagId = isset($namedParams['tag']) ? $namedParams['tag'] + 0 : false; //+0 to force to numeric

                  if ($tagId) {

                        $conditions[] = "Question.id IN (SELECT question_id FROM questions_tags WHERE tag_id='$tagId')";
                  }
            }

            if (!empty($this->data) && isset($this->data['Search']['keywords'])) {

                  $keywords = $this->data['Search']['keywords'];

                  App::uses('Sanitize', 'Utility');
                  $keywords = Sanitize::paranoid($keywords, array(' '));
                  $keywords = explode(' ', $keywords);
                  $usableKeywords = false;
                  //This is the temporary search process.
                  //@TODO Change to a cool search feature
                  foreach ($keywords as $keyword) {

                        $keyword = trim($keyword);
                        if (strlen($keyword) < 3) {
                              $this->sFlash('');
                              continue;
                        }
                        $usableKeywords = true;
                        $conditions[] = "( Question.name LIKE '%$keyword%' OR Question.description LIKE '%$keyword%') ";
                        $this->pageTitle='Search Questions';

                  }

                  if (!$usableKeywords) {
                        $this->sFlash('Please use longer words for your search criteria');
                  }
            }


            $this->paginate = array('Question' => array(
                    'order' => $orderBy,
                    'limit' => 25,
                )
            );

            $questions = $this->paginate('Question', $conditions);

            $questionIds = $this->Question->extractKeys($questions);

            $questionsTags = $this->QTag->getIndexedTags($questionIds);

            $this->set(compact('questions', 'questionsTags'));

//                $storedTags = $this->Session->read('storedTags');
//                if(!$storedTags){
//                        
//                }
            $storedTags = $this->QTag->listTagsWithStats(); //We should cache this....

            $this->set('storedTags', $storedTags);
      }

      /**
       * Method/Form for creating questions
       * @return null
       */
      function ask() {
            $this->pageTitle='Ask a Question';

            $this->set('usesAutocomplete',true);
            $this->_requireAuth();
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
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


                  $tagsProvided = str_replace(' ', ',', $subData['tags']);
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
                  $tagIds = array_unique($tagIds);
                  foreach ($tagIds as $tagId) {
                        $this->QTag->addTag($questionId, $tagId);
                  }

                  $questionSlug = $this->Question->getSlug($questionId);

                  $this->miniFlash("Question Posted", "viewQuestion/$questionId/$questionSlug");
            }
            $possibleTags = $this->Tag->listTagsByName();
            $this->set('possibleTags',$possibleTags);
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
            if (!$questionInfo['Question']['published']) {
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
            $this->pageTitle=$question['Question']['name'];

            $questionTags = $this->QTag->questionTags($questionId);

            $directComments = $this->QuestionComment->getDirectComments($questionId);

            $postedAnswers = $this->QuestionComment->getPostedAnswers($questionId);

            $postedComments = $this->QuestionComment->getPostedComments($questionId);

            //Let's try to increase the view count
            $questionsViewed = $this->Session->read('questionsViewed');
            if (!$questionsViewed) {
                  $questionsViewed = array();
            }
            if (!in_array($questionId, $questionsViewed)) {

                  $questionsViewed[] = $questionId;
                  $this->Session->write('questionsViewed', $questionsViewed);
                  $this->Question->increaseViewCount($questionId);
            }

            $this->set(compact('questionId', 'questionSlug', 'question', 'questionTags', 'directComments', 'postedAnswers', 'postedComments'));

            if (!$this->_thisUserId)
                  return;
            if ($question['Question']['flag'] == 0) {
                  $this->postResponse($questionId, $questionSlug); //To set values into form
            }
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
      }

      /**
       * Submit an Answer
       * @param type $questionId
       * @param type $questionSlug
       */
      public function postResponse($questionId, $questionSlug) {

            $question = $this->_getQuestion($questionId);
            $this->pageTitle='Post Response to - '.$question['Question']['name'];

            if ($question['Question']['flag'] != 0) {
                  $this->miniFlash('This question is no longer open for comments or answers', "viewQuestion/$questionId/$questionSlug");
            }
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
            
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

                        $comment = $this->QuestionComment->read(null, $this->QuestionComment->id);
                        $ownerEmail = $this->Question->User->getEmail($question['User']['id']);
                        $recipients = array($ownerEmail);
                        $emailQuestion = $question;
                        
                        unset($emailQuestion['Question']['description']);
                        
                        $notificationData = array(
                            'subject' => 'New Answer Posted to ' . $question['Question']['name'],
                            'variables' => json_encode(
                                    array(//Isn't it better to store ids?
                                        'question' => $emailQuestion,
                                        'comment' => $comment
                                    )
                            ),
                            'recipients' => json_encode($recipients),
                            'created_by' => $this->_thisUserId,
                            'email_template' => 'question_answer_posted'
                        );

                        $this->OutgoingMessage->addMessage($notificationData);

                        $this->miniFlash("Posted successfully", "viewQuestion/$questionId/$questionSlug/#{$hash}");
                  } else {
                        $this->sFlash("An unexpected errror occurred. Please try again later");
                  }
            }
            $this->set(compact('questionId', 'questionSlug', 'question'));
      }

      /**
       * Submit a response to an answer
       * I chose to duplicate this function on purpose for the sake of simplicity
       * It could have been handled by postResonse instead
       * @param type $questionId
       * @param type $questionSlug
       * @param type $responseId
       */
      public function postComment($questionId, $questionSlug, $relCommentId = 0) {

            $question = $this->_getQuestion($questionId);
            $this->pageTitle='Post Comment to - '.$question['Question']['name'];

            if ($question['Question']['flag'] != 0) {
                  $this->miniFlash('This question is no longer open for comments or answers', "viewQuestion/$questionId/$questionSlug");
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

                        $comment = $this->QuestionComment->read(null, $this->QuestionComment->id);

                        $ownerEmail = $this->Question->User->getEmail($question['User']['id']);
                        $recipients = array($ownerEmail);

                        $hostComment = array();

                        if ($relCommentId) {
                              $hostComment = $this->QuestionComment->getComment($relCommentId, -1);
                              if ($hostComment) {

                                    $recipients[] = $this->Question->User->getEmail($hostComment['QuestionComment']['user_id']);
                              }
                        }
                        $emailQuestion = $question;
                        unset($emailQuestion['Question']['description']);
                        $notificationData = array(
                            'subject' => 'New Comment on ' . $question['Question']['name'],
                            'variables' => json_encode(
                                    array(//Isn't it better to store ids?
                                        'question' => $emailQuestion,
                                        'host_comment' => $comment,
                                        'comment' => $hostComment
                                    )
                            ),
                            'recipients' => json_encode($recipients),
                            'created_by' => $this->_thisUserId,
                            'email_template' => 'question_comment_posted'
                        );

                        $this->OutgoingMessage->addMessage($notificationData);



                        $this->miniFlash("Posted successfully", "viewQuestion/$questionId/$questionSlug/#{$hash}");
                  } else {
                        $this->sFlash("An unexpected errror occurred. Please try again later");
                  }
            }
            $this->set(compact('questionId', 'questionSlug', 'question'));
      }

      public function chooseAnswer($questionId, $questionSlug, $relCommentId = 0) {
            
            $this->pageTitle='Choose Answer to - '.$question['Question']['name'];

            $question = $this->_getQuestion($questionId);

            if ($this->_thisUserId != $question['Question']['user_id']) {
                  $this->miniFlash("I'm not sure this question belongs to you :( - so you cannot choose the answer", "viewQuestion/$questionId/$questionSlug");
            }

            if ($question['Question']['flag'] != 0) {
                  $this->miniFlash('This question is no longer open for comments or answers or choices', "viewQuestion/$questionId/$questionSlug");
            }
            if (!$this->QuestionComment->exists($relCommentId)) {
                  $this->miniFlash('Invalid answer selected', "viewQuestion/$questionId/$questionSlug");
            }

            $this->QuestionComment->setAsAnswer($relCommentId);
            $this->Question->setAsAnswered($questionId);
            $comment =  $this->QuestionComment->read(null,$relCommentId);

            $commentOwnerEmail = $this->Question->User->getEmail($comment['QuestionComment']['user_id']);
            
            $recipients = array($commentOwnerEmail);
            $emailQuestion = $question;

            unset($emailQuestion['Question']['description']);
            
            $notificationData = array(
            'subject' => 'Your Answer was chosen for - ' . $question['Question']['name'],
            'variables' => json_encode(
                    array(//Isn't it better to store ids?
                        'question' => $emailQuestion,
                        'comment' => $comment
                    )
            ),
            'recipients' => json_encode($recipients),
            'created_by' => $this->_thisUserId,
            'email_template' => 'question_answer_chosen'
        );
            
            
            $this->miniFlash('You have selected an answer. Thank you', "viewQuestion/$questionId/$questionSlug");
      }

      public function voteForAnswer($questionId, $questionSlug, $relCommentId = 0, $voteUp = 0) {

            $question = $this->_getQuestion($questionId);
            
            $this->pageTitle='Vote Answer - '.$question['Question']['name'];

            if (!$this->QuestionComment->exists($relCommentId)) {
                  $this->miniFlash('Invalid answer selected', "viewQuestion/$questionId/$questionSlug");
            }

            $voteFlag = ($voteUp) ? 1 : 0;

            $result = $this->QcVote->castVote($this->_thisUserId, $relCommentId, $voteFlag);

            if ($result !== true) {

                  $previousVote = ($result['QcVote']['vote_type']) ? 'UP' : 'DOWN';

                  $this->miniFlash("You can only vote once. You already voted this answer $previousVote on {$result['QcVote']['created']}", "viewQuestion/$questionId/$questionSlug");
            }


            $this->QuestionComment->increaseVotes($relCommentId, $voteFlag);
            $this->miniFlash("Your vote has been cast successfully.", "viewQuestion/$questionId/$questionSlug", true);
      }

      public function notifyTest() {

            $config = cRead('Application.MailConfig');

            if (!$config['enabled']) {
                  $this->out("Mail is disabled in Application.MailConfig in bootstrap.php");
                  return;
            }

            $limit = $config['limit_per_run'];

            $conditions = array(
                'OutgoingMessage.sent' => 0,
                'OutgoingMessage.id' => 1,
            );

            $outgoingMessages = $this->OutgoingMessage->find('all', compact('limit', 'conditions'));

            if (!$outgoingMessages) {
                  $this->out("No pending messages");
                  return;
            }


            foreach ($outgoingMessages as $message) {
                  break;
            }
            $message = $message['OutgoingMessage'];
            $recipients = json_decode($message['recipients'], true);
            if (!$recipients) {
                  $this->OutgoingMessage->setAsInvalid($message['id']);
                  continue;
            }

            $templateVariables = json_decode($message['variables'], true);
            if (!$templateVariables) {
                  $this->OutgoingMessage->setAsInvalid($message['id']);
                  continue;
            }
            $validRecipients = array();

            foreach ($recipients as $recipient) {
                  $recipient = trim($recipient);

                  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $recipient)) {
                        continue;
                  }
                  $validRecipients[] = $recipient;
            }
            if (!$validRecipients) {
                  $this->OutgoingMessage->setAsInvalid($message['id']);
                  continue;
            }
            foreach ($templateVariables as $key => $values) {
                  $this->set($key, $values);
            }

            $this->layout = 'Emails/html/default';
      }

      
      public function mine() {
            $conditions = array(
                'Question.user_id' => $this->_thisUserId
            );
            
            $questions = $this->paginate('Question',$conditions);
            $this->set('questions',$questions);
            
      }
      
      public function editQuestion($questionId=0,$questionSlug='') {
             $question = $this->_getQuestion($questionId);

            if ($this->_thisUserId != $question['Question']['user_id']) {
                  $this->miniFlash("I'm not sure this question belongs to you :( - so you cannot edit it", "viewQuestion/$questionId/$questionSlug");
            }

            if ($question['Question']['flag'] != 0) {
                  $this->miniFlash('This question is no longer open for comments or answers or choices', "viewQuestion/$questionId/$questionSlug");
            }
            
            
             $this->pageTitle='Edit Question';

            $this->set('usesAutocomplete',true);
            $this->_requireAuth();
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
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


                  $tagsProvided = str_replace(' ', ',', $subData['tags']);
                  $tagsProvided = explode(',', $tagsProvided);
                  $tagIds = array();
                  
                  foreach ($tagsProvided as $tag) {

                        $tag = Sanitize::paranoid($tag);
                        //@TODO we should remove whitespaces too...
                        $tagIds[] = $this->Tag->getOrCreateTagId($tag);
                  }

                  $questionData = array(
                      'name' => Sanitize::stripAll($subData['title']),
                      'description' => Sanitize::stripAll($subData['description'])
                  );

                    
                  if (!$this->Question->updateQuestion($questionId,$questionData)) {
                        $this->miniFlash("An unexpected error occurred while saving this question. Please try again later","viewQuestion/$questionId/$questionSlug");
                        return;
                  }
                  $this->QTag->clearTags($questionId);
                  $tagIds = array_unique($tagIds);
                  
                  foreach ($tagIds as $tagId) {
                        $this->QTag->addTag($questionId, $tagId);
                  }

                  $this->miniFlash("Question Updated", "viewQuestion/$questionId/$questionSlug");
            }elseif(empty($this->data)){
                  $this->request->data['Ask'] = $question['Question'];
                  $this->request->data['Ask']['title'] = $question['Question']['name'];
                  
                  $fullQuestionTags = $this->QTag->questionTags($questionId);
                  $questionTags = array();
                  foreach($fullQuestionTags as $tag){
                        $questionTags[] = $tag['Tag']['name'];
                  }
                  $this->request->data['Ask']['tags'] = join(', ',$questionTags);
            }
            $possibleTags = $this->Tag->listTagsByName();
            $this->set(compact('possibleTags','questionId','questionSlug'));
      }

}