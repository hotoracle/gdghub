<?php
/**
  Filename: feed_thread.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 6, 2013  7:11:41 AM
 */
?>
<ul class="threadList">
        <?php
        $feedArticles = $this->requestAction("/Dashboard/getFeed/$feedId");
        if (!isset($lead))
                $lead = false;
        if (!isset($summarizeAll))
                $summarizeAll = false;
        $articlesDisplayed = 0;
        foreach ($feedArticles as $article) {
                ?>
                <li>
                        <div class="threadBody">
                                <span class="threadName <?php if ($lead && !$articlesDisplayed) echo 'leadArticle'; ?>"><?php echo $this->Html->link($article['Article']['name'], "viewArticle/{$article['Article']['slug']}"); ?> <em><?php echo date('h:ia D F j, Y', strtotime($article['Article']['date_published'])); ?></em></span>
                                <?php
                                if ($lead && $articlesDisplayed) {
                                        echo substr(strip_tags($article['Article']['description']), 0, 400) . '...';
                                } elseif ($summarizeAll) {
                                        echo substr(strip_tags($article['Article']['description']), 0, 400) . '...';
                                } else {
                                        echo $article['Article']['description'];
                                }
                                ?>
                        </div>
                        <span class="threadLink">
                                <?php echo $this->Html->link('More', "viewArticle/{$article['Article']['slug']}"); ?>
                        </span>
                </li>
                <?php
                $articlesDisplayed++;
        }
        ?>
</ul>