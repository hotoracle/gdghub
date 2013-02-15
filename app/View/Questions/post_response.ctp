<?php

/**
  Filename: post_response.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 15, 2013  6:07:38 PM
 */
?>
<h3>Post Answer to: <span><?php echo $this->Html->link($question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?></span></h3>
        <?php echo $this->element('questions/response_form'); ?>

<style>
        .answersHeader{
                display:none;
        }
</style>

<?php echo $this->Html->link('Back to '.$question['Question']['name'],"viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}"); ?>