<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ResourcesController extends AppController {
    
    public $uses = array('Article','Category');
    
    function index() {
        
    }
    
    function articles(){
        
          $myCategories = $this->Article->Category->find(
            'all',
            array(
                'fields' => array(
                    'Category.id',
                    'Category.name'
                ),
                'order' => 'Category.id DESC',
                'recursive' => 1
            )
        );

    $this->set('myCategories',$myCategories);
        
    }
    
    function getRelatedArticles($id = null){   

        $RelatedArticles = $this->Category->Article->find(
            'all',
            array(
                'fields' => array(
                    'Article.name',
                    'Article.id'
                ),
                'conditions' => array(
                    'Article.category_id =' => $id,
                ),
                'limit' => 5,
                'order' => 'Article.id DESC'            
            )
        );
        if (!empty($this->params['requested'])) {
            return $RelatedArticles;
        }else{
            $this->set('RelatedArticles');
        }
        
    
    }
    
 
}
