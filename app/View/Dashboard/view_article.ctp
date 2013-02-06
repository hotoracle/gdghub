<?php

/**
  Filename: view_article.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 6, 2013  8:24:33 AM
 */
?>
<div class="row">
        <div class="span9">
<h1><?php echo $articleInfo['Article']['name']; ?></h1>
<?php echo $articleInfo['Article']['description']; ?>
        </div>
        <div class="span3">
                                <?php echo $this->element('feed_thread',array('feedId'=>4,'summarizeAll'=>true)); ?>

        </div>
        </div>
        