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
                        <p><em><?php echo $user['Profile']['title']; ?></em></p>
                        <p><?php echo (isset($summarizeProfile) && $summarizeProfile)? $this->Qv->shortenText($user['Profile']['profile_summary'],500):$user['Profile']['profile_summary']; ?></p>
                  </div>
            </div>
      </li>
</ul>
<hr />

<?php echo $this->element("user/contact_prop"); ?>

