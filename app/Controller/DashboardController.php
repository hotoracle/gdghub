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
                
                $this->set(compact('articleInfo'));
        }
        
}