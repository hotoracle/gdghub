<?php
/**
  Filename: view_question.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 14, 2013  6:42:47 AM
 */
?>
<div class="row">
        <div class="span9">
                <div class="bordered">
                        <h1 class="questionTitle">
                                <?php echo $question['Question']['name']; ?>
                        </h1>
                        <?php echo $question['Question']['description']; ?>
                        <div class="floatRight posterInfo">
                                <?php echo $this->element('user/basic', array('user' => $question['User'])); ?>
                                <br />Asked @ <?php echo $this->Qv->longTime($question['Question']['created']); ?>
                        </div>
                        <hr />
                        Tags: <?php foreach ($questionTags as $tag) { ?>
                                <span class="badge badge-success">
                                        <?php echo $this->Html->link($tag['Tag']['name'], "browseByTag/{$tag['Tag']['id']}"); ?>
                                </span>
                        <?php } ?>
                        <div class="clear"></div>
                        <?php echo $this->element('questions/comments', array('comments' => $directComments)); ?>
                        <div class="clear"></div>

                </div>
                <div class="postedAnswers">
                        <h4 class="answersHeader">Answers</h4>
                        <?php
                        if ($postedAnswers) {
                                ?>
                                <div class="">
                                        <?php foreach ($postedAnswers as $postedAnswer) {
                                                ?>
                                                <div class="postedAnswer bordered">
                                                        <div class="votingOptions">


                                                        </div>
                                                        <?php echo $postedAnswer['QuestionComment']['description']; ?>
                                                        <div class="floatRight posterInfo">
                                                                <?php echo $this->element('user/basic', array('user' => $postedAnswer['User'])); ?>
                                                                <br />Asked @ <?php echo $this->Qv->longTime($postedAnswer['QuestionComment']['created']); ?>
                                                        </div>
                                                        <div class="clear"></div>
                                                        <?php
                                                        $answerId = $postedAnswer['QuestionComment']['id'];
                                                        if (isset($postedComments[$answerId])) {
                                                                echo $this->element('questions/comments', array('comments' => $postedComments[$answerId]));
                                                        }
                                                        ?>
                                                </div>
                                        <?php } ?>

                                </div>
                        <?php } ?>
                </div>
                <?php if ($question['Question']['flag'] == 0) { //still open for replies ?>
                        <h4 class="answersHeader">Post an Answer</h4>

                        <div class="answerForm bordered"><pre>
        Your Answer
        Thanks for contributing an answer to this question.

        Please be sure to answer the question. Provide details and share your research!
        But avoid …

        - Asking for help, clarification, or responding to other answers.
        - Making statements based on opinion; back them up with references or personal experience.
                                </pre>
                                <?php echo $this->element('form_validator'); ?>
                                <?php echo $this->Form->create('Answer'); ?>
                                <?php echo $this->Form->textarea('answer'); ?>
                                <?php echo $this->Form->submit('Post Your Answer', array('class' => 'btn btn-success')); ?>
                        </div>
                <?php } ?>

        </div>
</div>