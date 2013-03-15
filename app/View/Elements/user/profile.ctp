<?php
/**
  Filename: profile.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 15, 2013  7:21:30 PM
 */
?>


<ul class="thumbnails">
      <li>
            <div class="thumbnail">
                  <?php if ($user['User']['image']) echo $this->Html->image($user['User']['image']); ?>
                  <div class="caption">
                        <h3 class="profileName"><?php echo $user['User']['name']; ?></h3>
                        <p><?php echo $user['Profile']['profile_summary']; ?></p>
                  </div>
            </div>
      </li>
</ul>
<hr />
<ul class="profileProp">
      <?php if ($user['User']['public_website']) { ?>
            <li>
                  <span class=""><span class="icon-link"></span>&nbsp;Url :<?php echo $this->Html->link($user['User']['public_website'], $user['User']['public_website']); ?></span>
            </li>
      <?php } ?>
      <?php if ($user['User']['public_email']) { ?>

            <li>
                  <span class=""><span class="icon-envelope"></span>&nbsp;email :<?php echo $this->Html->link($user['User']['public_email'], 'mailto: ' . $user['User']['public_email']); ?></span>
            </li>
      <?php } ?>
      <?php if ($user['User']['public_twitter']) { ?>

            <li>
                  <span class=""><span class="icon-twitter"></span>&nbsp;Twitter: <?php echo $this->Html->link($user['User']['public_twitter'], "http://twitter.com/{$user['User']['public_twitter']}", array('target' => '_blank')); ?></span>
            </li>
      <?php } ?>
      <?php if ($user['User']['public_gplus']) { ?>

            <li>
                  <span class=""><span class="icon-google-plus"></span>&nbsp;G+: <?php echo $this->Html->link('+' . $user['User']['name'], "http://plus.google.com/{$user['User']['public_gplus']}", array('target' => '_blank')); ?></span>
            </li>

      <?php } ?>
      <?php if ($user['User']['public_skype']) { ?>

            <li>
                  <span class=""><span class="icon-certificate"></span>&nbsp;Skype: <?php echo $this->Html->link('+' . $user['User']['public_skype'], "#", array('target' => '_blank')); ?></span>
            </li>
      <?php } ?>
</ul>



