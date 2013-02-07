<?php

/**
  Filename: AdminApprovalsController.php 
 * This is a broken and unsecure controller, until i find a simple non-login required way...
 * maybe long running session persistence?
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 7, 2013  10:38:30 PM
 */

class AdminApprovalsController extends AppController{
 
        
        public $uses =array('Article');
        
        
        function bulkApproval(){
                
                $totalPublished = 0;
                
                if(!empty($this->data)){
                        
                        $data =$this->data['article'];
                        
                        foreach($data as $articleId=>$value){
                                
                                if($value==1){
                                        
                                        $this->Article->publishArticle($articleId);
                                        $totalPublished++;
                                }
                                
                        }
                        
                        
                        
                }
                $this->flash("$totalPublished articles have been published","/");
                
        }
        
}