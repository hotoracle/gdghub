<?php


/**
 * Filename: EventsController.php
 * @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
 * Created: Mar 22, 2013  11:25:29 AM 
 */

class EventsController extends AppController {

      public $uses = array('Event');
      public $helpers = array('Ev');
      
      
      function beforeFilter() {
            parent::beforeFilter();
           $this->Auth->allow('*');
           $this->Auth->allow(array('index', 'viewEvent'));
           $this->Auth->deny(array('post'));
      }
      

      /**
       * Landing Page for Events Section
       * newest/popular events
       * 
       */
      function index($sortBy = 'hottest') {

            switch ($sortBy) {
                  case 'newest':
                        $orderBy = array('Event.created' => 'DESC'); //Is this the best ?
                        break;
                  default:
                        $orderBy = array('Event.views' => 'DESC'); //Is this the best ?
            }

            $conditions = array(
                'Event.published' => 1
            );


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
                        $conditions[] = "(Event.name LIKE '%$keyword%' OR Event.description LIKE '%$keyword%' OR Event.venue LIKE '%$keyword%') ";
                  }

                  if (!$usableKeywords) {
                        $this->sFlash('Please use longer words for your search criteria');
                  }
            }


            $this->paginate = array('Event' => array(
                    'order' => $orderBy,
                    'limit' => 25,
                )
            );

            $events = $this->paginate('Event', $conditions);

            $eventIds = $this->Event->extractKeys($events);

	    $this->set(compact('events'));
      }

      function post() { //post an event
            $this->set('usesAutocomplete',true);
            $this->set(compact('breadcrumbLinks'));
            $this->_requireAuth();
            //$highlighterSettings = cRead('syntaxHighlighter');
            //$this->set('codeTypes', $highlighterSettings['supportedTypes']);
            $rules = array(
                'Post' => array(
                    'name' => array(
                        FV_REQUIRED => 'Please provide a name for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The title provided is too short'),
                        FV_MAX_LENGTH => array('param' => 200, 'error' => 'The title provided is too long')
                    ),
                    'description' => array(
                        FV_REQUIRED => 'Please provide details for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The description provided is too short'),
                        FV_MAX_LENGTH => array('param' => 5000, 'error' => 'The title provided is too long')
                    ),
		   'venue'=>array(
                        FV_REQUIRED=>'You must specify the venue of the event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The venue provided is too short'),
                        FV_MAX_LENGTH => array('param' => 300, 'error' => 'The venue provided is too long')
                     ),
		    /*
		   'start'=>array(
                         FV_REQUIRED=>'You must provide the start date and time of the event'
                     ),
		   'end'=>array(
                         FV_REQUIRED=>'You must provide the end date and time of the event'
                     ),*/
                )
            );

            $this->FormValidator->setRules($rules);

            if (!empty($this->data) && $this->FormValidator->validate()) {

                  App::uses('Sanitize', 'Utility');

                  $subData = $this->data['Post']; 

                    
		  $eventData = array(
                      'user_id' => $this->_thisUserId,
                      'name' => Sanitize::stripAll($subData['name']),
                      'description' => Sanitize::stripAll($subData['description']),
                      'venue' => Sanitize::stripAll($subData['venue']),
                      'start' => Sanitize::stripAll($subData['start']),
                      'end' => Sanitize::stripAll($subData['end']),
                  );


                  $eventId = $this->Event->addEvent($eventData);
                  if (!$eventId) {
                        $this->sFlash("An unexpected error occurred while saving this event. Please try again later");
                        return;
                  }


		  $message = 'Event Submitted';
                  
                  $eventSlug = $this->Event->getSlug($eventId);
                  $this->miniFlash($message, "viewEvent/$eventId/$eventSlug");
            }
           
      }
      /**
       * A security action for validating events - that it does exist.
       * @param string $eventId
       * @return array
       */
      private function _getEvent($eventId) {

            $eventInfo = $this->Event->getEvent($eventId);
            if (!$eventInfo) {

                  $this->miniFlash('Unable to find selected event. Try searching instead', 'index');
            }
            if (!$eventInfo['Event']['published']) {
                  $this->miniFlash('The entered event requires approval by an Administrator.', 'index');
            }
            return $eventInfo;
      }

      /**
       * A security action for validating events - that it does exist. This function allows the display of unapproved events.
       * @param string $eventId
       * @return array
       */
      private function _getAdminEvent($eventId) {

            $eventInfo = $this->Event->getEvent($eventId);
            if (!$eventInfo) {

                  $this->miniFlash('Unable to find selected event. Try searching instead', 'index');
            }
            return $eventInfo;
      }


      /**
       * Show details of an event
       * @param string $eventId, $eventSlug
       */
      public function viewEvent($eventId = '', $eventSlug = '') {

           $event = $this->_getEvent($eventId);

            //Let's try to increase the view count
            $eventsViewed = $this->Session->read('eventsViewed');
            if (!$eventsViewed) {
                  $eventsViewed = array();
            }
            if (!in_array($eventId, $eventsViewed)) {

                  $eventsViewed[] = $eventId;
                  $this->Session->write('eventsViewed', $eventsViewed);
                  $this->Event->increaseViewCount($eventId);
            }

            $this->set(compact('eventId', 'eventSlug', 'event'));
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
      }

	function admin_index($sortBy = 'hottest') {

            switch ($sortBy) {
                  case 'newest':
                        $orderBy = array('Event.created' => 'DESC'); //Is this the best ?
                        break;
                  default:
                        $orderBy = array('Event.views' => 'DESC'); //Is this the best ?
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
                        $conditions[] = "(Event.name LIKE '%$keyword%' OR Event.description LIKE '%$keyword%' OR Event.venue LIKE '%$keyword%') ";
                  }

                  if (!$usableKeywords) {
                        $this->sFlash('Please use longer words for your search criteria');
                  }
            }


            $this->paginate = array('Event' => array(
                    'order' => $orderBy,
                    'limit' => 25,
                )
            );

            $events = $this->paginate('Event');

            $eventIds = $this->Event->extractKeys($events);

	    $this->set(compact('events'));
	}

      function admin_post() { //post an event
            $this->set('usesAutocomplete',true);
            $this->set(compact('breadcrumbLinks'));
            $this->_requireAuth();
            //$highlighterSettings = cRead('syntaxHighlighter');
            //$this->set('codeTypes', $highlighterSettings['supportedTypes']);
            $rules = array(
                'Post' => array(
                    'name' => array(
                        FV_REQUIRED => 'Please provide a name for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The title provided is too short'),
                        FV_MAX_LENGTH => array('param' => 200, 'error' => 'The title provided is too long')
                    ),
                    'description' => array(
                        FV_REQUIRED => 'Please provide details for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The description provided is too short'),
                        FV_MAX_LENGTH => array('param' => 5000, 'error' => 'The title provided is too long')
                    ),
		   'venue'=>array(
                        FV_REQUIRED=>'You must specify the venue of the event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The venue provided is too short'),
                        FV_MAX_LENGTH => array('param' => 300, 'error' => 'The venue provided is too long')
                     ),
		    /*
		   'start'=>array(
                         FV_REQUIRED=>'You must provide the start date and time of the event'
                     ),
		   'end'=>array(
                         FV_REQUIRED=>'You must provide the end date and time of the event'
                     ),*/
                )
            );

            $this->FormValidator->setRules($rules);

            if (!empty($this->data) && $this->FormValidator->validate()) {

                  App::uses('Sanitize', 'Utility');

                  $subData = $this->data['Post']; 

                    
		  $eventData = array(
                      'user_id' => $this->_thisUserId,
                      'name' => Sanitize::stripAll($subData['name']),
                      'description' => Sanitize::stripAll($subData['description']),
                      'venue' => Sanitize::stripAll($subData['venue']),
                      'start' => Sanitize::stripAll($subData['start']),
                      'end' => Sanitize::stripAll($subData['end']),
                  );


                  $eventId = $this->Event->addEvent($eventData);
                  if (!$eventId) {
                        $this->sFlash("An unexpected error occurred while saving this event. Please try again later");
                        return;
                  }


		  $message = 'Event Submitted';
                  
                  $eventSlug = $this->Event->getSlug($eventId);
                  $this->miniFlash($message, "viewEvent/$eventId/$eventSlug");
            }
           
      }

      function admin_edit($eventId = '', $eventSlug = '') { //edit an event
            $this->set('usesAutocomplete',true);
            $this->set(compact('breadcrumbLinks'));
            $this->_requireAuth();

            $event = $this->_getAdminEvent($eventId);
            //$highlighterSettings = cRead('syntaxHighlighter');
            //$this->set('codeTypes', $highlighterSettings['supportedTypes']);
            $rules = array(
                'Edit' => array(
                    'name' => array(
                        FV_REQUIRED => 'Please provide a name for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The title provided is too short'),
                        FV_MAX_LENGTH => array('param' => 200, 'error' => 'The title provided is too long')
                    ),
                    'description' => array(
                        FV_REQUIRED => 'Please provide details for this event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The description provided is too short'),
                        FV_MAX_LENGTH => array('param' => 5000, 'error' => 'The title provided is too long')
                    ),
		   'venue'=>array(
                        FV_REQUIRED=>'You must specify the venue of the event',
                        FV_MIN_LENGTH => array('param' => 20, 'error' => 'The venue provided is too short'),
                        FV_MAX_LENGTH => array('param' => 300, 'error' => 'The venue provided is too long')
                     ),
		    /*
		   'start'=>array(
                         FV_REQUIRED=>'You must provide the start date and time of the event'
                     ),
		   'end'=>array(
                         FV_REQUIRED=>'You must provide the end date and time of the event'
                     ),*/
                )
            );

            $this->FormValidator->setRules($rules);

            if (!empty($this->data) && $this->FormValidator->validate()) {

                  App::uses('Sanitize', 'Utility');

                  $subData = $this->data['Edit']; 

                    
		  $eventData = array(
                      'user_id' => $this->_thisUserId,
                      'name' => Sanitize::stripAll($subData['name']),
                      'description' => Sanitize::stripAll($subData['description']),
                      'venue' => Sanitize::stripAll($subData['venue']),
                      'start' => Sanitize::stripAll($subData['start']),
                      'end' => Sanitize::stripAll($subData['end'])
                  );


                  $this->Event->editEvent($eventData,$eventId);
                /*  if (!$this->Event->editEvent($eventData,$eventId)) {
                        //$this->sFlash("An unexpected error occurred while saving this event. Please try again later");
			$message = 'An unexpected error occurred while saving this event. Please try again later';
			$eventSlug = $this->Event->getSlug($eventId);
			$this->set(compact('eventId', 'eventSlug', 'event'));
                  	$this->miniFlash($message, "edit/$eventId/$eventSlug");
                     return;
                 }*/


		  $message = 'Event Updated';
		  $eventSlug = $this->Event->getSlug($eventId);
                  $this->miniFlash($message, "viewEvent/$eventId/$eventSlug");
            }
	    $this->set(compact('eventId', 'eventSlug', 'event'));
           
      }
      public function admin_viewEvent($eventId = '', $eventSlug = '') {

           $this->_requireAuth();
           $event = $this->_getAdminEvent($eventId);

            //Let's try to increase the view count
            $eventsViewed = $this->Session->read('eventsViewed');
            if (!$eventsViewed) {
                  $eventsViewed = array();
            }
            if (!in_array($eventId, $eventsViewed)) {

                  $eventsViewed[] = $eventId;
                  $this->Session->write('eventsViewed', $eventsViewed);
                  $this->Event->increaseViewCount($eventId);
            }

            $this->set(compact('eventId', 'eventSlug', 'event'));
            $highlighterSettings = cRead('syntaxHighlighter');
            $this->set('codeTypes', $highlighterSettings['supportedTypes']);
      }
      public function admin_publish($eventId='', $eventSlug='') {
            $this->_requireAuth();
            $event = $this->_getAdminEvent($eventId);
	    /*
            $rules = array(
                'Publish' => array(
                    'answer' => array(
                        FV_REQUIRED => 'You must provide a response to submit this',
                    )
                )
            );

            $this->FormValidator->setRules($rules);*/

            if (!empty($this->data) && $this->FormValidator->validate()) {

                  $eventData = $this->data['Publish']['published'];

                  $this->Event->setEventStatus($eventData,$eventId);
		  $message = 'Event Status Updated';
                  
                  
                  $this->miniFlash($message, "index");
                  //$this->miniFlash($message);
            }
	    $eventSlug = $this->Event->getSlug($eventId);
            $this->set(compact('eventId', 'eventSlug', 'event'));
      }

 public function admin_delete($eventId, $eventSlug) {
            $this->_requireAuth();
            $event = $this->_getAdminEvent($eventId);
            $eventSlug = $this->Event->getSlug($eventId);      
            if (!empty($this->data) && $this->FormValidator->validate()) {
			
                 if(!$this->Event->delete($eventId))
		 {
			$this->sFlash("An unexpected error occurred while deleting the event. Please try again later");
                        return;
		 }

		  $message = 'Event Deleted';
                  
                  $eventSlug = $this->Event->getSlug($eventId);
                  $this->miniFlash($message, "index");
                  //$this->miniFlash($message);
            }
            $this->set(compact('eventId', 'eventSlug', 'event'));
      }



}
?>
