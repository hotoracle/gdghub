<?php

/**
  Filename: question_comment_posted.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 26, 2013  6:23:26 PM
 */


?>
      <h3>An answer has just been posted to this question - <?php echo $question['Question']['name']; ?></h3>
      <?php
echo $this->element('questions/question_answer_posted');
?>
