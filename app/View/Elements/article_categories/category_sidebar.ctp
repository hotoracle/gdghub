
    <div class="bordered shadowed">
    <div class="dropdown clearfix">
        <p id="listedQuestion">Categories</p>
        <?php foreach ($myCategories as $myCategory): ?>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 2px;">
                    <li><a tabindex="-1" href=<?php echo $this->Html->url('/resources/getRelatedArticles/'.$myCategory['ArticleCategory']['id']); ?>><?php echo $myCategory['ArticleCategory']['name']; ?></a></li> 
                    
                </ul>
                <?php endforeach; ?>   
    </div>
    </div>

           