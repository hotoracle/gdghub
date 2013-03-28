<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:01:59 PM
 */
?>

<div class="row">
        <div class="span8">
           <div  >
            <h1 class="hidden-phone"><?php echo cRead('Application.name'); ?></h1>   
            <p class="lead">Technologies, Developers and Solutions, Learning and Development, APIs and Tools </p>	
            </div>
            <hr>

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
                                                <div class="hidden-phone">
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
                                        </div>
                                        <span class="threadLink hidden-phone">
                                                <?php echo $this->Html->link('More', "viewArticle/{$article['Article']['slug']}"); ?>
                                        </span>
                                </li>
                                <?php
                                $articlesDisplayed++;
                        }
                        ?>
                </ul>
                <?php echo $this->element('paginator'); ?>
              <hr />
              <div class="row-fluid">
                    <div class="span6">
                          <div class="bordered">
                                <h4>Questions</h4>
                                
                                <?php foreach($unansweredQuestions as $question){ $questionId = $question['Question']['id'];
                                                ?>
                                                <div>
                                                        <span class="questionTitle"><?php echo $this->Html->link($question['Question']['name'], "/Questions/viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?></span><br />
                                                        <?php echo $this->Html->link($this->Qv->shortenText($question['Question']['description'],160),"/Questions/viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}",array('escape'=>false,'class' => 'textLikeLink')); ?>
                                                        <div class="clear"></div>
                                                        <span class="badge badge-info floatRight">
                                                                posted by <?php echo $this->element('user/basic', array('user' => $question['User'], 'noPhoto' => true)); ?> </span>
                                                        <div class="clear"></div>
                                                </div>
                                <hr />
                                <?php } ?>
                          </div>
                    </div>
                    <div class="span6">
                          <div class="bordered">
                                    <h4>Upcoming Tech-Related Events</h4>
                                    <?php foreach($upcomingEvents as $event){ 
                                          $eventId = $event['Event']['id'];
                                                ?>
                                                <div>
                                                        <span class="questionTitle"><?php echo $this->Html->link($event['Event']['name'], "/Events/viewEvent/{$event['Event']['id']}/{$event['Event']['slug']}"); ?></span><br />
                                                        <?php echo $this->Html->link($this->Qv->shortenText($event['Event']['description'],160),"/Events/viewEvent/{$event['Event']['id']}/{$event['Event']['slug']}",array('escape'=>false,'class' => 'textLikeLink')); ?>
                                                        <div class="clear"></div>
                                                        <span class="label label-info">
                                                        <?php echo $event['Event']['start']; ?>        
                                                        </span>
                                                        <div class="clear"></div>
                                                </div>
                                <hr />
                                <?php } ?>
                          </div>
                    </div>
                    
                    
                    
              </div>
        </div>
        <div class="span4">
                <?php echo $this->element('sidebar'); ?>
        </div>

</div>