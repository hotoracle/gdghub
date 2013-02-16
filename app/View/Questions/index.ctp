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
                        <h1>Questions
                                <div class="floatRight">
                                        <?php echo $this->Html->link('Ask a Question', 'ask', array('class' => 'btn btn-success')); ?>
                                </div>
                        </h1>
                        <?php if (!$questions) { ?>
                                <div class="alert alert-danger">
                                        Unfortunately there are no questions here
                                </div>
                        <?php } else {
                                ?>
<!--                        <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#home">Home</a></li>
                                        <li><a href="#profile">Profile</a></li>
                                        <li><a href="#messages">Messages</a></li>
                                        <li><a href="#settings">Settings</a></li>
                                </ul>

                                <div class="tab-content">
                                        <div class="tab-pane active" id="home">...</div>
                                        <div class="tab-pane" id="profile">...</div>
                                        <div class="tab-pane" id="messages">...</div>
                                        <div class="tab-pane" id="settings">...</div>
                                </div>-->
                                <div class="postedQuestions">
                                        <?php
                                        foreach ($questions as $question) {
                                                $questionId = $question['Question']['id'];
                                                ?>
                                                <div class="postedQuestion">

                                                        <span class="questionTitle"><?php echo $this->Html->link($question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?></span>
                                                        <?php echo $this->Qv->shortenText($question['Question']['description']); ?>
                                                        <br />
                                                        <?php
                                                        $thisQuestionTags = isset($questionsTags[$questionId]) ? $questionsTags[$questionId] : array();
                                                        if ($thisQuestionTags) {
                                                                ?>
                                                                        <?php foreach ($thisQuestionTags as $tag) { ?>
                                                                                <span class="badge badge-success">
                                                                                        <?php echo $this->Html->link($tag['Tag']['name'], "browseByTag/{$tag['Tag']['id']}"); ?>
                                                                                </span>
                                                                        <?php } ?>
                                                        <?php } ?>
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
                        <?php foreach($storedTags as $tag){ ?>
                        <span class="badge badge-success">
                                <?php echo $this->Html->link($tag['Tag']['name'],"browseByTag/{$tag['Tag']['id']}",array('escape'=>false)); ?>
                        </span><span class="qCount"> x <?php echo $tag['QTag']['qcount']; ?> </span> &nbsp;     
                        <? } ?>
                </div>
        </div>
</div>
