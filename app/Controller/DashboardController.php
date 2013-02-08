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
        public $paginate =array(
           'Article'=>array(
               'order'=>array('Article.sort_order'=>'ASC','Article.id'=>'DESC'),
               'limit'=>10
           ) 
        );
        
        function beforeFilter(){
                
                
                parent::beforeFilter();
                $this->_setGPlusActivities();
                
        }
        
        function index(){
                
                $publishedArticles = $this->paginate('Article',array('Article.published'=>1));
                $this->set(compact('publishedArticles'));
        }
        
        function getFeed($feedId=0){
                $feedArticles = $this->Article->getArticles($feedId);
                return $feedArticles;
        }
        
        
        function viewArticle($articleSlug=''){
                
        $articleInfo = $this->Article->getArticle($articleSlug);        
         if(!$articleInfo){
                 
                 $this->flash("Unable to find selected article", 'index');
         }       
                $latestArticles = $this->Article->getLatestArticles(10,$articleSlug);
                shuffle($latestArticles);
                $this->set(compact('articleInfo','latestArticles'));
        }
 
        function _setGPlusActivities(){
                
                
                $gplusActivity = $this->Session->read('page_gplus');
                $now = time();
                if($gplusActivity){
                        $storedAt  = $this->Session->read('page_gplus_stored');
                        if($storedAt+600<$now){
                                $gplusActivity=false;
                        }
                }
                
                if(!$gplusActivity){
                        
                        $gplusPageId = Configure::read('Application.gplus_page_id');
                        $plusUrl = "https://www.googleapis.com/plus/v1/people/$gplusPageId/activities/public?key=AIzaSyAK7vaAWhUADjUInYSer-Ov1ZFZt0duIEQ";
                        try {
                              
                                $contents  = file_get_contents($plusUrl);
                                
                                if(!$contents){
                                     return;   
                                }
                                $decodedData = json_decode($contents,true);
//                                pr($decodedData);
//                                exit;
                                $items = $decodedData['items'];
                                $gplusActivity = array();
                                foreach($items as $row){
                                      $gplusActivity[] = array(
                                          'link'=>$row['url'],
                                          'title'=>isset($row['object']['attachments'][0]['displayName'])? $row['object']['attachments'][0]['displayName']:$row['title'],
                                          'date'=>$row['published']
                                      );  
                                }
                                $this->Session->write('page_gplus',$gplusActivity);
                                $this->Session->write('page_gplus_stored',$now);
                                 
                        }catch(Exception $e){
                                return;
                        }
                }
                
                $this->set('gplusActivity',$gplusActivity);
                
        }
        
        public function help() {

        }
}