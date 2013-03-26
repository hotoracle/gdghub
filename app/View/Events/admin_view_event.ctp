<?php
/**
  Filename: admin_view_event.ctp
  @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
  Created: Mar 24, 2013  05:42:47 AM

*/
?>
<div class="row">
<div class="floatRight"><?php echo $this->Html->link('Browse Events', 'index'); ?></div>
      <div class="span9">
            <div class="bordered">
                  <h1 class="questionTitle">
                        <?php echo $event['Event']['name']; ?>
                  </h1>
                  <div class="questionQuestion">
                        <?php
                        $fullDescription = $event['Event']['description'];
			$published = $event['Event']['published'];
                        echo $this->Ev->highlight($fullDescription);
                        ?>
                  </div>
		<div class="floatRight posterInfo">
                        <?php echo $this->element('user/basic', array('user' => $event['User'])); ?>
                        <br />Submitted @ <?php echo $this->Ev->longTime($event['Event']['created']); ?>
                  </div>
                 <div><br />
		<strong>Venue:</strong>  <?php echo $event['Event']['venue']; ?><br />
		<strong>Starts:</strong>  &nbsp;<?php echo $this->Ev->longTime($event['Event']['start']); ?><br />
		<strong>Ends:</strong> &nbsp;&nbsp;<?php echo $this->Ev->longTime($event['Event']['end']); ?>
		</div>
                  <hr />
		<span class="floatLeft">
			<?php   
				$publish_btn = "";	
				if($published) 
				{$publish_btn = "Unpublish";}
				else{ $publish_btn = "Publish";}
				echo $this->Html->link($publish_btn, "#", array('class' => 'btn btn-mini btn-success', 'data-toggle' => 'modal', 'data-target' => '#publishModal', 'data-remote' => $this->Html->url("publish/$eventId/{$event['Event']['slug']}")));
				echo ' ';
				/*echo $this->Html->link('Edit', "#", array('class' => 'btn btn-mini btn-success', 'data-toggle' => 'modal', 'data-target' => '#editModal', 'data-remote' => $this->Html->url("edit/{$event['Event']['id']}/{$event['Event']['slug']}")));*/
				echo $this->Html->link('Edit', "edit/{$event['Event']['id']}/{$event['Event']['slug']}", array('class' => 'btn btn-mini btn-primary'));
				echo ' | ';
			        echo $this->Html->link('Delete', "#", array('class' => 'btn btn-mini btn-danger', 'data-toggle' => 'modal', 'data-target' => '#deleteModal', 'data-remote' => $this->Html->url("delete/{$event['Event']['id']}/{$event['Event']['slug']}")));
			?>
				        </span>
		 <!--
                  <div class="tags">
                        Tags: <?php foreach ($questionTags as $tag) { ?>
                              <span class="badge badge-success">
                                    <?php echo $this->Html->link($tag['Tag']['name'], "index/tag:{$tag['Tag']['id']}"); ?>
                              </span>
                        <?php } ?>
                  </div>
		 -->
		 <!--
                  
                  <?php echo $this->element('questions/comments', array('comments' => $directComments)); ?>
                  <div class="clear"></div>
		-->
                  &nbsp;
		 <!--
                  <div class="alignRight">
                        <?php echo $this->Html->link('Share', "#", array('class' => 'btn btn-mini')); ?>
                        <?php
                        if ($isAnswerable) {
                              ?>
                              |   <?php
                              if ($_userInfo) {
                                    echo $this->Html->link('Post Comment', "#", array('class' => 'btn btn-mini btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myCommentModal', 'data-remote' => $this->Html->url("postComment/$questionId/$questionSlug")));
                                    echo ' | ';
                                    echo $this->Html->link('Post Answer', "#postAnswer", array('class' => 'btn btn-mini btn-success'));
                              } else {
                                    echo $this->Html->link('Post Comment', "postComment/$questionId/$questionSlug", array('class' => 'btn btn-mini btn-primary'));
                                    echo ' | ';
                                    echo $this->Html->link('Post Answer', "postResponse/$questionId/$questionSlug", array('class' => 'btn btn-mini btn-success'));
                              }
                              ?>
                        </div>
                  <?php } ?>
            </div>
	   -->
	   <!--
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
                                                <?php
                                                echo $this->Html->link('Vote Up', "voteForAnswer/$questionId/$questionSlug/$answerId/1", array('class' => 'block', 'title' => 'This answer is  useful', 'class' => 'block', 'data-toggle' => 'tooltip'));

                                                echo '<span class="answerVoteCount">' . ($postedAnswer['QuestionComment']['vote_ups'] - $postedAnswer['QuestionComment']['vote_downs']) . '</span>';

                                                echo $this->Html->link('Vote Down', "voteForAnswer/$questionId/$questionSlug/$answerId/0", array('title' => 'This answer is not useful', 'class' => 'block', 'data-toggle' => 'tooltip'));
                                                if ($isAnswerable) {
                                                      if ($_thisUserId == $question['Question']['user_id']) {
                                                            echo '<hr />';
                                                            echo $this->Html->link('Choose as Best Answer', "chooseAnswer/{$questionId}/{$questionSlug}/$answerId", array('class' => 'btn btn-mini btn-success', 'data-toggle' => 'tooltip', 'title' => 'As the owner of this question, you can choose which is the best clue or solution among the ones submitted'));
                                                      }
                                                } else {
                                                      if ($postedAnswer['QuestionComment']['accepted_answer']) {
                                                            ?>
                                                            <?php echo $this->Html->image('tick.png'); ?>
                                                            <?php
                                                      }
                                                }
                                                ?>
                                          </div>
                                          <?php
//                                                        echo $postedAnswer['QuestionComment']['description']; 
                                          echo $this->Qv->highlight($postedAnswer['QuestionComment']['description']);
                                          ?>
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


                                                      <?php
                                                      if ($_userInfo) {
                                                            echo $this->Html->link('Post Comment', "#", array('class' => 'btn btn-mini btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myCommentModal', 'data-remote' => $this->Html->url("postComment/$questionId/$questionSlug/$answerId")));
                                                      } else {
                                                            echo $this->Html->link('Post Comment', "postComment/$questionId/$questionSlug/$answerId", array('class' => 'btn btn-mini btn-primary'));
                                                      }
                                                      ?> | 
                                                      <?php echo $this->Html->link('Post Answer', '#postAnswer', array('class' => 'btn btn-mini btn-success')); ?>
                                                </div>
                                          <?php } ?>
                                    </div>
                              <?php } ?>

                        </div>
                  <?php } elseif ($isAnswerable) { ?>
                        <div class="alert alert-info">
                              There are currently no answers posted. 
                        </div>
                  <?php } else { ?>
                        There are currently no answers posted and this question can no longer be answered
                  <?php } ?>
            </div>
-->
<!--
            <?php if ($isAnswerable) { //still open for replies    ?>
                  <a name="postAnswer"></a>
                  <?php
                  if ($_userInfo) {
                        echo $this->element('questions/response_form');
                  } else {
                        ?>
                        <div class="alert alert-info">
                              To post your answer, please log-in first
                              <?php echo $this->Html->link('Log In/Sign Up', "postResponse/$questionId/$questionSlug", array('class' => 'btn')); ?>
                        </div>      
                  <?php } ?>
            <?php } else { ?>
                  <div class="alert alert-info">
                        This question is no longer open for answers.
                  </div>
            <?php } ?>
      </div>
</div>
-->
<div class="modal hide custom-width-modal" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div class="modal hide custom-width-modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
      <div class="modal-body">
            <!-- content will be loaded here -->
      </div>
      <div class="modal-footer">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
</div>
<div class="modal hide custom-width-modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
      <div class="modal-body">
            <!-- content will be loaded here -->
      </div>
      <div class="modal-footer">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
</div>
    <!--
        <div class="span3">
                <div class="bordered minH600">
                        <h4>Tags</h4>
                        <?php //foreach ($storedTags as $tag) { ?>
                                <span class="badge badge-success">
                                        <?php //echo $this->Html->link($tag['Tag']['name'], "index/tag:{$tag['Tag']['id']}", array('escape' => false)); ?>
                                </span><span class="qCount"> x <?php //echo $tag['QTag']['qcount']; ?> </span> &nbsp;     
                        <? //} ?>
                </div>
        </div>
    -->
</div>
<script type="text/javascript">
$('#publishModal').on('hidden',function(){
	$(this).data('modal').$element.removeData();
})
</script>
<script type="text/javascript">
$('#deleteModal').on('hidden',function(){
	$(this).data('modal').$element.removeData();
})
</script>

