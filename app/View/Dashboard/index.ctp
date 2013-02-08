<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:01:59 PM
 */
?>

<div class="row">
        <div class="span8">
                <ul class="threadList">
                        <?php
                        if (!isset($lead))
                                $lead = false;
                        if (!isset($summarizeAll))
                                $summarizeAll = true;
                        $articlesDisplayed = 0;
                        foreach ($publishedArticles as $article) {
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
                <p><?php
                        echo $this->Paginator->counter(array(
                            'format' => __d('cake', 'Page {:page} of {:pages}, showing {:current} articles out of {:count}')
                        ));
                        ?></p>
                <div class="pagination pagination-large">
                        <ul>
                        <?php
                        echo $this->Paginator->prev(__('Previous'), array('tag'=>'li'), null, array('class' => 'prev disabled'));
                        echo $this->Paginator->numbers(array('separator' => '', 'currentClass' => 'active hidden', 'class' => '', 'tag' => 'li'));
                        echo $this->Paginator->next(__('Next'), array('tag'=>'li'), null, array('class' => 'next disabled'));

                        ?>
                        </ul>
                </div>
        </div>
        <div class="span4">
                <?php echo $this->element('sidebar'); ?>
                
        </div>

</div>