<?php

/**
  Filename: question_answer_chosen.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 26, 2013  10:13:31 PM
 */
?>
<h3>An answer has just been chosen to this question - <?php echo $question['Question']['name']; ?></h3>
      <?php
echo $this->element('questions/question_answer_posted');
?>
