<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ResourcesController extends AppController {
    
    public $uses = array('Article','ArticleCategory');
     public $paginate = array(
          'Article' => array(
              'order' => array('Article.sort_order' => 'DESC', 'Article.id' => 'DESC'),
              'limit' => 4
          )
      );
    
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
                'order' => 'ArticleCategory.id ASC',
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
                'limit' => 10,
                'order' => 'Article.date_published DESC'            
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
                'order' => 'ArticleCategory.id ASC',
                'recursive' => 1
            )
        );

    $this->set('myCategories',$myCategories);

            $categoryID = $this->ArticleCategory->extractKeys($myCategories);
        
    
    }
    
 
}
?>
