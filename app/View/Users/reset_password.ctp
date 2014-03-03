<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users form">
        <h2><?php echo __d('users', 'Reset your password'); ?></h2>
        <?php
        	echo $this->Form->create($model, array(
        		'url' => array(
        			'action' => 'reset_password',
        			$token
        		)
        	));
        	echo $this->Form->input('new_password', array(
        		'label' => __d('users', 'New Password'),
        		'type' => 'password'
        	));
        	echo $this->Form->input('confirm_password', array(
        		'label' => __d('users', 'Confirm'),
        		'type' => 'password'
        	));
        	echo $this->Form->submit(__d('users', 'Submit'));
        	echo $this->Form->end();
        ?>
        </div>
      </div>
    </div>
  </div>
</div>