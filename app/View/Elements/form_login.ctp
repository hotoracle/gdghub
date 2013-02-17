<?php
echo $this->Form->create
(
	'User',
	array
	(
		'url' => array
		(
			'controller' => 'users',
			'action'	 => 'login'
		),
		'class'			=> 'well',
		'inputDefaults' => array
		(
			'label' => false,
			'error' => false
		)
	)
); 


echo $this->Form->input('username',array('placeholder' => __('Username'),'class' => 'span12'));
echo $this->Form->input('password',array('placeholder' => __('Password'),'type' => 'password', 'class' => 'span12'));

?> 
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success"><i class="icon-play-circle icon-white"></i> Login</button>      
    </div>
  </div>

<div class="control-group">
    <a class="btn btn-primary" href="http://localhost/gdghub/auth/facebook">
    <i class="icon-facebook"></i>Login With Facebook
    </a>
</div>
<div class="control-group">
    <a class="btn btn-danger" href="http://localhost/gdghub/auth/google">
    <i class="icon-google-plus"></i>Login With Google
    </a>
</div>
<div class="control-group">
    <a class="btn btn-info" href="http://localhost/gdghub/auth/twitter">
    <i class="icon-twitter"></i>Login With Twitter
    </a>
</div>
<div class="control-group">
    <a class="btn btn-info" href="http://localhost/gdghub/auth/linkedin">
    <i class="icon-linkedin"></i>Login With LinkedIn
    </a>
</div>



        <div class="control-group">
  	<div class="controls">
  		<span><?php echo __('Forgot your password?') ?><br/> <?php echo $this->Html->link(__('Remember my password'),array('controller' => 'users', 'action' => 'remember_password')) ?></span>
        </div>

      <div class="<?php echo $this->action == 'register' ? 'active' : ''; ?>">
                   <?php echo $this->Html->link(__('Register'),array('controller' => 'users','action' => 'register')) ?>
      </div>
      
  </div> 
</form>