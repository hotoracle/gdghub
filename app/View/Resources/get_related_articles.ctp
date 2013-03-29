<div class="row">
    <div class="span8">
<div class="bordered shadowed">

<div>
     <div>
    <?php
 //   $RelatedArticles = $this->requestAction('/resources/getRelatedArticles/'.$myCategory['ArticleCategory']['id']);
    ?>
    <ul>
        <?php
        foreach($RelatedArticles as $RelatedArticle){
        ?>
        <li>
            <?php echo $RelatedArticle['Article']['name']; ?>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
</div>
    

</div>
    </div>
    
    
<div class="span4">
        
                <?php echo $this->element('article_categories/category_sidebar'); ?>
                
</div>
</div>