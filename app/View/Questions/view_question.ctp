<?php
/**
  Filename: view_question.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 14, 2013  6:42:47 AM
 */
$isAnswerable = ($question['Question']['flag'] == 0);
?>
<div class="row">
        <div class="span9">
                <div class="bordered">
                        <h1 class="questionTitle">
                                <?php echo $question['Question']['name']; ?>
                        </h1>
                      
  <?php 
  
      $fullDescription = $question['Question']['description']; 
//echo highlight_string($fullDescription);

      echo $this->Qv->highlight($fullDescription);
  
  ?>
                      
                      
                      
                        <div class="floatRight posterInfo">
                                <?php echo $this->element('user/basic', array('user' => $question['User'])); ?>
                                <br />Asked @ <?php echo $this->Qv->longTime($question['Question']['created']); ?>
                        </div>
                        <hr />
                        <div class="tags">
                                Tags: <?php foreach ($questionTags as $tag) { ?>
                                        <span class="badge badge-success">
                                                <?php echo $this->Html->link($tag['Tag']['name'], "index/tag:{$tag['Tag']['id']}"); ?>
                                        </span>
                                <?php } ?>
                        </div>
                        <div class="clear"></div>
                        <?php echo $this->element('questions/comments', array('comments' => $directComments)); ?>
                        <div class="clear"></div>
                        <?php if ($isAnswerable) { ?>
                                &nbsp;

                                <div class="alignRight">
                                        <?php echo $this->Html->link('Share', "#",array('class'=> 'btn btn-mini')); ?> | 
                                        <?php echo $this->Html->link('Post Comment', "#", array('class' => 'btn btn-mini btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'data-remote' => $this->Html->url("postComment/$questionId/$questionSlug"))); ?> | 
                                        <?php echo $this->Html->link('Post Answer', '#postAnswer', array('class' => 'btn btn-mini btn-success')); ?>
                                </div>
                        <?php } ?>
                </div>
                <div class="postedAnswers">
                        <h4 class="answersHeader">Answers</h4>
                        <?php
                        if ($postedAnswers) {
                                ?>
                                <div class="">
                                        <?php
                                        foreach ($postedAnswers as $postedAnswer) {
                                                $answerId = $postedAnswer['QuestionComment']['id'];
                                                ?>
                                                <a name="<?php echo md5($answerId); ?>"></a>
                                                <div class="postedAnswer bordered">
                                                        <div class="votingOptions">


                                                        </div>
                                                        <?php echo $postedAnswer['QuestionComment']['description']; ?>
                                                        <div class="floatRight posterInfo">
                                                                <?php echo $this->element('user/basic', array('user' => $postedAnswer['User'])); ?>
                                                                <br />Asked @ <?php echo $this->Qv->longTime($postedAnswer['QuestionComment']['created']); ?>
                                                        </div>
                                                        <hr />

                                                        <div class="clear"></div>
                                                        <?php
                                                        if (isset($postedComments[$answerId])) {
                                                                echo $this->element('questions/comments', array('comments' => $postedComments[$answerId]));
                                                        }
                                                        ?>
                                                        <?php if ($isAnswerable) { ?>
                                                                &nbsp;

                                                                <div class="alignRight">

                                                                        
                                                                        <?php echo $this->Html->link('Post Comment', "#", array('class' => 'btn btn-mini btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'data-remote' => $this->Html->url("postComment/$questionId/$questionSlug/$answerId"))); ?> | 
                                                                        <?php echo $this->Html->link('Post Answer', '#postAnswer', array('class' => 'btn btn-mini btn-success')); ?>
                                                                </div>
                                                        <?php } ?>
                                                </div>
                                        <?php } ?>

                                </div>
                        <?php } ?>
                </div>
                <?php if ($isAnswerable) { //still open for replies  ?>
                        <a name="postAnswer"></a>
                        <?php echo $this->element('questions/response_form'); ?>
                <?php } ?>

        </div>
</div>
<div class="modal hide custom-width-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
                <!-- content will be loaded here -->
        </div>
        <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
</div>

<?php echo $this->element('syntax_highlighter'); ?>