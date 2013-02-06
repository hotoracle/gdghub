<?php

/**
  Filename: index.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:01:59 PM
 */
?>

<!--<div class="hero-unit">
        <h2>Welcome!</h2>
        <p>
                The Google Developers Group [GDG] Lagos is a group for those who are interested in learning about and using Google technologies.
        </p>
        <p>
                <?php echo $this->Html->link('Join',"/Dashboard/join",array('class'=>'btn btn-primary')); ?>
        </p>
</div>-->
<div class="row">
        <div class="span7">
                <?php echo $this->element('feed_thread',array('feedId'=>4,'lead'=>true)); ?>

                <?php echo $this->element('feed_thread',array('feedId'=>2)); ?>
        </div>
        <div class="span5">
                <h4>&nbsp;Google Developers Live</h4>
                <?php echo $this->element('feed_thread',array('feedId'=>3)); ?>

        </div>
        
        </div>