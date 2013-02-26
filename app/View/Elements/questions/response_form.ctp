<?php

/**
  Filename: response_form.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 15, 2013  6:03:52 PM
 */
?>
 <h4 class="answersHeader">Post an Answer</h4>

                        <div class="answerForm bordered">
                                        <?php echo $this->Form->create('Answer',array('url'=>"postResponse/$questionId/$questionSlug")); ?>
                                        <?php echo $this->element('form_validator'); ?>
                                        <?php echo $this->Form->label('answer', 'Your Answer:'); ?>

                                <pre>
Thanks for contributing an answer to this question.

Please be sure to answer the question. Provide details and share your research!
But avoid …

- Asking for help, clarification, or responding to other answers.
- Making statements based on opinion; back them up with references or personal experience.
                                </pre>
                                
                                <?php echo $this->Form->textarea('answer'); ?>
                       <div class="normalWidth bordered">
                        Click on "Insert Code" to paste your code  - if part of your question contains code : <input type="button" value="Insert Code" class="btn btn-success btn-primary"  data-toggle="modal" data-target="#myModal" />
                        
                  </div>
                              <hr />
                                <?php echo $this->Form->submit('Post Your Answer', array('class' => 'btn btn-success')); ?>
                        </div>
 
 <?php echo $this->element('questions/insert_code',array('insertTargetId'=>'AnswerAnswer')); ?>