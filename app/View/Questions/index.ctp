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
                                <div class="postedQuestions">
                                        <?php
                                        foreach ($questions as $question) {
                                                $questionId = $question['Question']['id'];
                                                ?>
                                                <div class="postedQuestion">

                                                        <span class="questionTitle"><?php echo $question['Question']['name']; ?></span>
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



                </div>
        </div>
        <div class="span3">
                <div class="bordered minH600">
                        <h3>Tags</h3>
                </div>
        </div>
</div>
