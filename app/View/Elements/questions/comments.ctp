<?php
/**
  Filename: comments.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 15, 2013  3:25:53 PM
 */
if (isset($comments) && $comments) {
        ?>
        <div class="dotBordered nearFull floatRight directComments">
                <h4>Comments</h4>
                <div class="directCommentsBody">
                        <?php foreach ($comments as $comment) { ?>
                                <?php echo $comment['QuestionComment']['description']; ?> <br />
                                <div class="alignRight"><?php echo $this->element('user/basic', array('user' => $comment['User'], 'noPhoto' => true)); ?>
                                        <span class="badge">
                                                @ <?php echo $this->Qv->longTime($comment['QuestionComment']['created']); ?> 
                                        </span>
                                </div>
                                <hr />
                        <?php } ?>
                </div>
        </div>
        <div class="clear"></div>
<?php } ?>