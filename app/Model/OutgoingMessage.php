<?php
App::uses('AppModel', 'Model');
/**
 * OutgoingMessage Model
 *
 */
class OutgoingMessage extends AppModel {

      
      
      function addMessage($data){
            
            $this->create($data);
            $this->save($data);
            
      }
      
      function setAsSent($messageId){
            
            $data = array('sent'=>1);
            $this->id  = $messageId;
            $this->save($data);
            
      }
      function setAsInvalid($messageId){
            
            $data = array('sent'=>2);
            $this->id  = $messageId;
            $this->save($data);
            
      }
}
