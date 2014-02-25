<div class="container">
    <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="users form">
            	<?php echo $this->Form->create($model); ?>
            		<fieldset>
            			<legend><?php echo __d('users', 'Edit User'); ?></legend>
            			<?php
            				echo $this->Form->input('id');
            				echo $this->Form->input('username', array(
            					'label' => __d('users', 'Username')));
            				echo $this->Form->input('email', array(
            					'label' => __d('users', 'Email')));
                            if (!empty($roles)) {
                                echo $this->Form->input('role', array(
                                    'label' => __d('users', 'Role'), 'values' => $roles));
                            }
                            echo $this->Form->input('is_admin', array(
                                    'label' => __d('users', 'Is Admin')));
                                echo $this->Form->input('active', array(
                                    'label' => __d('users', 'Active')));
            			?>
            		</fieldset>
            	<?php echo $this->Form->end('Submit'); ?>
            </div>
          </div>
        </div>
    </div>
</div>
