<?php
/**
  Filename: post_comment.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 15, 2013  6:39:18 PM
 */
?>
<h3>Post Comment on: <span><?php echo $this->Html->link($question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?></span></h3>

<div class="answerForm bordered">
        <?php echo $this->Form->create('Answer'); ?>
        <?php echo $this->element('form_validator'); ?>
        <?php echo $this->Form->label('answer', 'Your Answer:'); ?>

        <pre>
Please be respectful. Ask questions if the question or comment is not clear
        </pre>

        <?php echo $this->Form->textarea('answer'); ?>
        <?php echo $this->Form->submit('Post Comment', array('class' => 'btn btn-primary')); ?>
</div>

<?php echo $this->Html->link('Back to '.$question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?>