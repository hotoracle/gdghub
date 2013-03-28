<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:41:06 PM
 */

?>
<div class="row">
        <div class="span9">
                <div class="bordered minH600">
                        <div class="floatRight questionPanel">
                                <?php echo $this->Form->create('Search',array('url'=>'index')); ?>
                                        
                                        <?php echo $this->Html->link('Ask a Question', 'ask', array('class' => 'btn btn-success strong')); ?>
                                        <?php echo $this->Html->link('Newest Questions', 'index/newest'); ?> | 
                                        <?php echo $this->Html->link('Popular Questions', 'index/popular'); ?> | 
                                        <?php echo $this->Form->input('keywords',array('label'=>false,'div'=>false,'size'=>5,'class'=>'searchBox','placeholder'=>'Search')); ?>
                                        <?php echo $this->Form->end(); ?>
                                </div>
                        <h1 class="questionH1">Questions
                                
                        </h1>
                      <?php if(isset($tagInfo) && $tagInfo) { ?>
                      <h3>
                             
                               Questions Tagged <span class="maroon"><i><?php echo $tagInfo['Tag']['name']; ?></i></span>
                               
                      </h3>
                     <div class="alignRight">
                                                                 <?php echo $this->Html->link('Remove Tag Filter','index',array('class'=>'btn btn-mini')); ?>

                      </div>
                                <?php } ?>
                        <div class="clear"></div>
                        <?php if (!$questions) { ?>
                                <div class="alert alert-danger">
                                       There are no questions here.
                                </div>
                        <?php } else {
                                ?>
                                
                                <div class="postedQuestions">
                                        <?php
                                        foreach ($questions as $question) {
                                                $questionId = $question['Question']['id'];
                                                ?>
                                                <div class="postedQuestion">

                                                        <span class="questionTitle"><?php echo $this->Html->link($question['Question']['name'], "viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?></span>
                                                        <?php echo $this->Html->link($this->Qv->shortenText($question['Question']['description']),"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}",array('escape'=>false,'class' => 'textLikeLink')); ?>
                                                        <div class="clear"></div>
                                                        <span class="badge badge-info floatRight">
                                                                posted by <?php echo $this->element('user/basic', array('user' => $question['User'], 'noPhoto' => true)); ?> </span>
                                                        <span class="badge floatRight">
                                                        <?php echo $this->Qv->longTime($question['Question']['created']); ?>        
                                                        </span>
                                                        <?php
                                                        $thisQuestionTags = isset($questionsTags[$questionId]) ? $questionsTags[$questionId] : array();
                                                        if ($thisQuestionTags) {
                                                                ?>
                                                                <?php foreach ($thisQuestionTags as $tag) { ?>
                                                                        <span class="badge badge-success">
                                                                                <?php echo $this->Html->link($tag['Tag']['name'], "index/tag:{$tag['Tag']['id']}"); ?>
                                                                        </span>
                                                                <?php } ?>
                                                        <?php } ?>
                                                        <div class="clear"></div>

                                                </div>

                                        <?php } ?>
                                </div>

                        <?php } ?>


                        <?php echo $this->element('paginator'); ?>

                </div>
        </div>
        <div class="span3">
                <div class="bordered minH600">
                        <h4>Tags</h4>
                        <?php foreach ($storedTags as $tag) { ?>
                                <span class="badge badge-success">
                                        <?php echo $this->Html->link($tag['Tag']['name'], "index/tag:{$tag['Tag']['id']}", array('escape' => false)); ?>
                                </span><span class="qCount"> x <?php echo $tag['QTag']['qcount']; ?> </span> &nbsp;     
                        <? } ?>
                </div>
        </div>
</div>
