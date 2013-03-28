<?php
/**
  Filename: view_event.ctp
  @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
  Created: Mar 22, 2013  8:42:47 AM

 */
?>
<div class="row">
      <div class="span9">
            <div class="bordered">
                  <h1 class="questionTitle">
                        <?php echo $event['Event']['name']; ?>
                  </h1>
                  <div class="questionQuestion">
                        <?php
                        $fullDescription = $event['Event']['description'];

                        echo $this->Ev->highlight($fullDescription);
                        ?>
                  </div>

                  <div class="floatRight posterInfo">
                        <?php echo $this->element('user/basic', array('user' => $event['User'])); ?>
                        <br />Posted @ <?php echo $this->Ev->longTime($event['Event']['created']); ?>
                  </div>
                  <div><br />
                        <strong>Venue:</strong>  <?php echo $event['Event']['venue']; ?><br />
                        <strong>Starts:</strong>  &nbsp;<?php echo $this->Ev->longTime($event['Event']['start']); ?><br />
                        <strong>Ends:</strong> &nbsp;&nbsp;<?php echo $this->Ev->longTime($event['Event']['end']); ?>
                  </div>

                  <hr />

                  <?php echo $this->element('social_share'); ?>

