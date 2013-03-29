<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ResourcesController extends AppController {
    
    public $uses = array('Article','ArticleCategory');
    
    function index() {
        
    }
    
    function articles(){
        
          $myCategories = $this->Article->ArticleCategory->find(
            'all',
            array(
                'fields' => array(
                    'ArticleCategory.id',
                    'ArticleCategory.name'
                ),
                'order' => 'ArticleCategory.id DESC',
                'recursive' => 1
            )
        );

    $this->set('myCategories',$myCategories);
        
    }
    
    function getRelatedArticles($id = null, $categoryID = null){   

        $RelatedArticles = $this->ArticleCategory->Article->find(
            'all',
            array(
                'fields' => array(
                    'Article.name',
                    'Article.id',
                    'Article.article_category_id',
                    'Article.description',
                    'Article.date_published',
                    'Article.slug'
                ),
                'conditions' => array(
                    'Article.article_category_id =' => $id,
                    //'ArticleCategory.id =' => $categoryID
                ),
                'limit' => 5,
                'order' => 'Article.id DESC'            
            )
        );
        if (!empty($this->params['requested'])) {
            return $RelatedArticles;
        }else{
            $this->set('RelatedArticles', $RelatedArticles);
        }
        
        $myCategories = $this->Article->ArticleCategory->find(
            'all',
            array(
                'fields' => array(
                    'ArticleCategory.id',
                    'ArticleCategory.name'
                ),
                'order' => 'ArticleCategory.id DESC',
                'recursive' => 1
            )
        );

    $this->set('myCategories',$myCategories);
    
   // $categoryID = $this->ArticleCategory->findAll();
   // $this->paginate = array('Question' => array(
   //                 'order' => $orderBy,
   //                'limit' => 25,
    //            )
      //      );

        //    $questions = $this->paginate('Question', $conditions);

            $categoryID = $this->ArticleCategory->extractKeys($myCategories);
        
    
    }
    
 
}
?>
