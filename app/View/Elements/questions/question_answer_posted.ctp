<?php

/**
  Filename: question_comment_posted.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 26, 2013  6:23:26 PM
 */
?>

<div style="border:1px solid #ccc;padding:8px;">
<p><?php echo $this->Qv->highlight($comment['QuestionComment']['description']); ?></p>
</div>
      <p></p>
<div style="border:1px solid #ccc;padding:8px;">

<p>Posted By                                  
      <?php echo $this->element('user/basic', array('user' => $comment['User'],'noPhoto'=>true)); ?>
      . Posted @ <?php echo $this->Qv->longTime($comment['QuestionComment']['created']); ?>
</p>
</div>
      <hr />
<p>
<?php echo $this->Html->link('Go to Question',$this->Html->url("/Questions/viewQuestion/{$question['Question']['id']}/{$question['Question']['slug']}",true)); ?>
</p>