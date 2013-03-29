<div class="row">
<div class="span8">
    <div class="bordered shadowed">
<?php
    foreach ($myCategories as $myCategory){
?>
<div>
    <div class="bordered bordered-light alixgnCenter">
      <div class="" id="listedQuestion">
         <?php echo $myCategory['ArticleCategory']['name'];?>
      </div>
    </div>
    <div>
        <?php
            echo $this->element(
                '/article_categories/category_relatedarticles',
            array(
            'categoryID' => $myCategory['ArticleCategory']['id']
            )
        );
        ?>
    </div>
</div>
    
<?php
    }
?>
</div>
</div>
    
<div class="span4">
        
                <?php echo $this->element('article_categories/category_sidebar'); ?>
                
</div>
</div>