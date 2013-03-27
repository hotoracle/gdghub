<?php

/**
  Filename: mine.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 27, 2013  6:28:37 PM
 */
?>
<h2>Questions Posted By Me</h2>
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
                                                $questionSlug =$question['Question']['slug'];
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
                                                            <?php echo $this->Html->link('Edit',"editQuestion/$questionId/$questionSlug",array('class'=>'btn btn-mini wideBtn')); ?>
                                                            <?php echo $this->Html->link('Delete Question',"deleteQuestion/$questionId",array('class'=>'btn btn-mini wideBtn btn-danger','confirm'=>'Are you really sure you want to do this?')); ?>
                                                </div>

                                        <?php } ?>
                                </div>

                        <?php } ?>


                        <?php echo $this->element('paginator'); ?>

                </div>