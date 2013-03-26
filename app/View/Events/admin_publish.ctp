<?php
/**
  Filename: admin_publish.ctp
  @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
  Created: Mar 24, 2013  04:39:18 AM
 */
?>
<h5>Publish/ Unpublish Event : <span><?php echo $this->Html->link($event['Event']['name'],"viewEvent/{$event['Event']['id']}/{$event['Event']['slug']}"); ?></span></h5>

<div class="answerForm bordered">
        <?php echo $this->Form->create('Publish'); ?>
        Published: <?php echo $this->Form->checkbox('published',array('default'=>$event['Event']['published'])); ?><br /><br />
        <?php echo $this->Form->submit('Update', array('class' => 'btn btn-success')); ?>
</div>

<?php //echo $this->Html->link('Back to '.$question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?>
