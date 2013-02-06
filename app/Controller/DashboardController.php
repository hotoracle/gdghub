<?php

/**
  Filename: DashboardController.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  6:49:32 PM
 * Should homepage manager and it should display approved feeds
 * and widgets
 */


class DashboardController extends AppController{
        
        public $uses = array('Article');
        function index(){
                
                $groupDiscussions = $this->Article->getArticles(2);
                $gdlArticles = $this->Article->getArticles(3);
                
                
                $this->set(compact("groupDiscussions",'gdlArticles'));
        }
        
        function getFeed($feedId=0){
                $feedArticles = $this->Article->getArticles($feedId);
                return $feedArticles;
        }
        
        
}