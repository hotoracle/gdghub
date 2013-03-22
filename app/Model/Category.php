<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Category extends AppModel {
    
    public $hasMany = array(
        'Article' => array(
            'className' => 'Article',
                'foreignKey' => 'category_id',
                'conditions' => array('Article.category_id'=>'Category.id'),
                'fields' => '',
                'order' => ''
            
        )
    );
  
  public $displayField = 'name';
  public $name = 'Category';
  
 function getCategory(){
                $conditions = array('Category.deleted' =>0);
                return $this->find('all', compact('conditions', 'null', 'null'));
        }
        
  
}

?>
