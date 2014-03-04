<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users form">
        	<?php echo $this->Form->create($model); ?>
        		<fieldset>
        			<legend><?php echo __d('users', 'Add User'); ?></legend>
        			<?php
                echo $this->Form->input('username', array(
                  'label' => __d('users', 'Username')
                ));
                echo $this->Form->input('email', array(
                  'label' => __d('users', 'E-mail (used as login)'),
                  'error' => array('isValid' => __d('users', 'Must be a valid email address'),
                    'isUnique' => __d('users', 'An account with that email already exists')
                  )
                ));
                echo $this->Form->input('password', array(
                  'label' => __d('users', 'Password'),
                  'type' => 'password')
                );
                echo $this->Form->input('temppassword', array(
                  'label' => __d('users', 'Password (confirm)'),
                  'type' => 'password')
                );
                if (!empty($roles)) {
                  echo $this->Form->input('role', array(
                    'label' => __d('users', 'Role'), 'values' => $roles)
                  );
                }
                echo $this->Form->input('is_admin', array(
                  'label' => __d('users', 'Is Admin')
                ));
                echo $this->Form->input('active', array(
                  'label' => __d('users', 'Active')
                ));
              ?>
        		</fieldset>
        	<?php echo $this->Form->end('Submit'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
