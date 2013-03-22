<div class="row">
<div class="span8">
    <div class="bordered shadowed">
<?php
    foreach ($myCategories as $myCategory){
?>
<div>
    <div>
        <?php echo $myCategory['Category']['name'];?>
    </div>
    <div>
        <?php
            echo $this->element(
                '/categories/category_relatedarticles',
            array(
            'categoryID' => $myCategory['Category']['id']
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
        
                <?php echo $this->element('categories/category_sidebar'); ?>
                
</div>
</div>