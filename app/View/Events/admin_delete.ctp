<?php
/**
  Filename: admin_delete.ctp
  @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
  Created: Mar 24, 2013  05:10:18 AM
 */
?>
<h5>Are you sure you want to delete : <span><?php echo $this->Html->link($event['Event']['name'],"viewEvent/{$event['Event']['id']}/{$event['Event']['slug']}"); ?></span></h5>

<div class="answerForm bordered">
        <?php echo $this->Form->create('Remove'); ?>
	
        <?php echo $this->Form->hidden('dummy value'); ?>
        <?php echo $this->Form->submit('Delete', array('class' => 'btn btn-danger')); ?>
</div>

<?php //echo $this->Html->link('Back to '.$question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?>
