<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="teams form">
        <?php echo $this->Form->create('Team'); ?>
        	<fieldset>
        		<legend><?php echo __('Add Team'); ?></legend>
        	<?php
        		echo $this->Form->input('id');
        		echo $this->Form->input('name');
        		echo $this->Form->input('description');
        		echo $this->Form->input('manager');
        		echo $this->Form->input('invite_only');
        	?>
        	</fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
        <div class="actions">
        	<h3><?php echo __('Actions'); ?></h3>
        	<ul>
        		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?></li>
        	</ul>
        </div>
    </div>
  </div>
</div>