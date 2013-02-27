<?php

/**
  Filename: CronJobsShell.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 26, 2013  4:58:37 PM
 */
class CronJobsShell extends AppShell {

        public $uses = array('OutgoingMessage');
        
        
        function main(){
              
        }
        
        function processMailQueue(){
              $config = cRead('Application.MailConfig');
              
              if(!$config['enabled']) {
                    $this->out("Mail is disabled in Application.MailConfig in bootstrap.php");
                    return;
              }
              
              $limit = $config['limit_per_run'];
              
              $conditions =array(
                  'OutgoingMessage.sent'=>0,
                  );
              
              $outgoingMessages = $this->OutgoingMessage->find('all',compact('limit','conditions'));
              
              if(!$outgoingMessages){
                    $this->out("No pending messages");
                    return;
              }
              
              
              foreach($outgoingMessages as $message){
                    $message = $message['OutgoingMessage'];
                    $recipients =json_decode($message['recipients'],true);
                    if(!$recipients){
                          $this->OutgoingMessage->setAsInvalid($message['id']);
                          continue;
                    }
                    
                    $templateVariables = json_decode($message['variables'],true);
                    if(!$templateVariables){
                          $this->OutgoingMessage->setAsInvalid($message['id']);
                          continue;
                    }
                    $validRecipients=  array();
                    
                    foreach($recipients as $recipient){
                          $recipient = trim($recipient);
                          
                          if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $recipient)){
                                continue;
                          }
                          $validRecipients[]=$recipient;
                          
                    }
                      if(!$validRecipients){
                              $this->OutgoingMessage->setAsInvalid($message['id']);
                              continue;
                      }      
                      
                      $email = new CakeEmail();
                      
                      $email->template($message['email_template'], 'default')
                                ->config('notifications')
                                ->emailFormat('html')
                                ->subject(Configure::read('Application.safe_name'). ' - '.$message['subject'])
                                ->bcc($validRecipients)
                                ->viewVars($templateVariables)
                                ->send();
                    $this->OutgoingMessage->setAsSent($message['id']);
                    
              }
              
              
              
        }
        
}