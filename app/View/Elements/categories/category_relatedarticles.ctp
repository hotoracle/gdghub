<div>
    <?php
    $RelatedArticles = $this->requestAction('/resources/getRelatedArticles/'.$categoryID);
    
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