<?php
/**
  Filename: edit_profile.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 15, 2013  5:49:41 PM
 */
echo $this->element('breadcrumb');
?>
<h3>Update Public Profile</h3>
<div class="row">
      <div class="span6">
            <div class="bordered">
                  <h4>Edit</h4>   
                  <div class="alert alert-info">
                        Please provide information which can be displayed publicly. 
                  </div>
                  <div class="fullWidth">
                        <?php
                        echo $this->Form->create('MyProfile', array('type' => 'file'));
                        echo $this->element('form_validator');
                        echo $this->Form->input('name', array('label' => 'Display Name'));
                        echo $this->Form->input('profile_summary', array('label' => 'A quick word about you', 'type' => 'textarea'));
                        echo $this->Form->input('public_email', array('label' => 'Email <span>This will be displayed publicly.</span>'));
                        echo $this->Form->input('public_website', array('label' => 'Website'));
                        echo $this->Form->input('public_gplus', array('label' => 'Google+ ID<span>e.g 108000156525307744962</span>'));
                        echo $this->Form->input('public_twitter', array('label' => 'Twitter Handle<span>e.g dftaiwo</span>'));
                        echo $this->Form->input('public_skype', array('label' => 'Skype ID'));

                        echo $this->Form->input('photo', array('type' => 'file', 'label' => 'Upload Photo'));
                        ?>
                        </li>
                        </ul>
                  </div>
                  <?php
                  echo $this->Form->submit('Update', array('class' => 'btn btn-inverse wideBtn'));
                  echo $this->Form->end();
                  ?>
            </div>
      </div>
      <div class="span6">
            <div class="bordered">
                  <?php echo $this->element('user/profile', array('user' => $userInfo)); ?>
            </div>
      </div>
</div>
