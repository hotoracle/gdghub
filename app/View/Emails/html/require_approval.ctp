<?php
/**
  Filename: require_approval.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 7, 2013  9:43:40 PM
 */
?>
<?php if ($freshArticles) { ?>
        <?php echo $this->Form->create('Approvals', array('url' =>Configure::read('Application.base_url')."/AdminApprovals/bulkApproval")); ?>
        <p>Below is a list of the new articles requiring approval</p>
        <?php foreach ($freshArticles as $feedName => $feedArticles) {
                ?>
                <p>
                        <strong><u><?php echo $feedName; ?></u> <?php echo count($feedArticles); ?> articles</strong>
                </p>
                <ol>
                <?php foreach ($feedArticles as $article) { ?>
                                <li>
                                        <div class="threadBody">

                                                <span class="threadName">
                        <?php echo $article['name']; ?> 
                                                </span> 

                        <?php //echo $this->Html->link('Approve',Router::url("/AdminApprovals/approve/{$article['id']}",true));  ?> 
                                                <p>
                                                <?php
                                                echo  substr(strip_tags($article['description']), 0, 450) ;
                                                ?>
                                                </p>
                                        </div>
                        <?php
                        $options = array(0 => 'Ignore', 1 => 'Approve');
                        $attributes = array('legend' => false);
                        echo $this->Form->radio("article.{$article['id']}", $options, $attributes);
                        ?>
                                        <span class="threadLink">
                                                <?php echo $this->Html->link('View Link', Router::url("{$article['external_link']}")); ?>
                                        </span>
                                        <hr />
                                </li>


                        <?php } ?>
                </ol>
                <p>&nbsp;</p>
        <?php } ?>
        <?php echo $this->Form->submit(); ?>
        <?php echo $this->Form->end(); ?>
<?php } ?>
