<?php
/**
  Filename: contact_prop.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 17, 2013  8:57:11 AM
 */
if(isset($userInfo)) $user  = $userInfo;
?>
<ul class="profileProp">
      <?php if ($user['User']['public_website']) { ?>
            <li>
                  <span class=""><span class="icon-link"></span>&nbsp;Url :<?php echo $this->Html->link($user['User']['public_website'], $user['User']['public_website'],array('target'=>'_blank')); ?></span>
            </li>
      <?php } ?>
      <?php if ($user['User']['public_email']) { ?>

            <li>
                  <span class=""><span class="icon-envelope"></span>&nbsp;Email :<?php echo $this->Html->link($user['User']['public_email'], 'mailto: ' . $user['User']['public_email']); ?></span>
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
                  <span class=""><span class="icon-certificate"></span>&nbsp;Skype: <a href="callto://+<?php echo $user['User']['public_skype']; ?>"><?php echo $user['User']['public_skype']; ?></span>
            </li>
      <?php } ?>
</ul>