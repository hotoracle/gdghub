<div>
    <?php
    $RelatedArticles = $this->requestAction('/resources/getRelatedArticles/'.$categoryID);
    
    ?>
    <ul class="threadList">
        <?php
        foreach($RelatedArticles as $RelatedArticle){
        ?>
        <li>
                                        <div class="threadBody">
                                                <span class="threadName"><?php echo $this->Html->link($RelatedArticle['Article']['name'], "/Dashboard/viewArticle/{$RelatedArticle['Article']['slug']}"); ?> <em><?php echo date('h:ia D F j, Y', strtotime($RelatedArticle['Article']['date_published'])); ?></em></span>
                                                <div class="hidden-phone">
                                                <?php
                                               
                                                        echo substr(strip_tags($RelatedArticle['Article']['description']), 0, 400) . '...';
                                               
                                                ?>
                                        </div>
                                        </div>
                                        <span class="threadLink hidden-phone">
                                                <?php echo $this->Html->link('More', "/Dashboard/viewArticle/{$RelatedArticle['Article']['slug']}"); ?>
                                        </span>
                                </li>
       
        <?php
        }
        ?>
    </ul>

</div>