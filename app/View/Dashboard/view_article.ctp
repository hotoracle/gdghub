<?php
/**
  Filename: view_article.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 6, 2013  8:24:33 AM
 */
?>
<div class="row">
        <div class="span8">
                <h1><?php echo $articleInfo['Article']['name']; ?></h1>
                <?php echo $articleInfo['Article']['description']; ?>
                <p>&nbsp;</p>

                <p>        
                        <a href="https://twitter.com/share" class="twitter-share-button" data-via="gtuglagos" data-lang="en">Tweet</a>
                        <span class="g-plus" data-action="share"></span>

                </p>
                <p>
                        Pulled From: <?php echo $this->Html->link($articleInfo['Article']['external_link'], $articleInfo['Article']['external_link'], array('target' => '_blank')); ?>
                </p>
                <p>&nbsp;</p>
                <hr />
                <p>&nbsp;</p>
                <h3>Other Articles</h3>

                <ul class="threasdList">
                        <?php
                        foreach ($latestArticles as $article) {
                                ?>
                                <li>
                                        <?php echo $this->Html->link($article['Article']['name'], "viewArticle/{$article['Article']['slug']}"); ?>
                                </li>
                                <?php
                        }
                        ?>
                </ul>

        </div>
        <div class="span4">
                <?php echo $this->element('sidebar'); ?>
        </div>
</div>
