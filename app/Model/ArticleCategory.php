<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ArticleCategory extends AppModel {
    
    public $hasMany = array(
        'Article' => array(
            'className' => 'Article',
                'foreignKey' => 'article_category_id',
                'fields' => '',
                'order' => ''
            
        )
    );
  
  public $displayField = 'name';
  public $name = 'ArticleCategory';
  
 function getArticleCategory(){
                $conditions = array('ArticleCategory.deleted' =>0);
                return $this->find('all', compact('conditions', 'null', 'null'));
        }
        
  
}

?>
