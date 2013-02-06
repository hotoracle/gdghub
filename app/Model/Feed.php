<?php

/**
  Filename: Feed.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:59:11 PM
 */
class Feed extends AppModel
{
  public $name = 'Feed';
  
 function getActiveFeeds(){
         $conditions =array('Feed.published'=>1);
         
         return $this->find('all',compact('conditions'));
         
 } 
  
}