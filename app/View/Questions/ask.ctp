<?php
/**
  Filename: ask.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:43:00 PM
 */
?>
<div>
        <h1>Ask a Question</h1>

        <p>
                This portion should explain the rules and provide tips for asking questions
        </p>
        <div class="row">
                <div class="span7 bordered shadowed fullWidth">        

                        <?php echo $this->Form->create('Ask'); ?>
                        <?php echo $this->element('form_validator'); ?>
                        <?php echo $this->Form->input('title'); ?>
                        <?php echo $this->Form->input('description', array('type' => 'textarea')); ?>
                        <?php echo $this->Form->input('tags'); ?>
                        <?php echo $this->Form->submit('Submit'); ?>
                        <?php echo $this->Form->end(); ?>
                </div>
                <div class="span4 bordered shadowed">

                        Provide context sensitive help/tips here
                        
                </div>
        </div>
</div>