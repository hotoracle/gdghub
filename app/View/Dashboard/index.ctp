<?php

/**
  Filename: index.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:01:59 PM
 */
?>

<div class="row">
        <div class="span7">
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
		'format' => __d('cake', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?></p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __d('cake', 'previous  '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' &middot; '));
		echo $this->Paginator->next(__d('cake', ' next') .' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
        </div>
        <div class="span5">
                <div class="hero-unit">
        <h2>Welcome!</h2>
        <p>
                The Google Developers Group [GDG] Lagos is a group for those who are interested in learning about and using Google technologies.
        </p>
        <p>
                <?php echo $this->Html->link('Join',"http://bit.ly/lagosgtuggroup",array('class'=>'btn btn-primary')); ?>
        </p>
</div>
        </div>
        
        </div>