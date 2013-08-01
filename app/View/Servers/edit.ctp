<div class="servers form">
<?php echo $this->Form->create('Server'); ?>
	<fieldset>
		<legend><?php echo __('Edit Server'); ?></legend>
	<?php
		echo $this->Form->input('lan_id');
		if ($isAdmin) {
			echo $this->Form->input('user_id');
			echo $this->Form->input('official');

		}
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('additional_info');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Server.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Server.id'))); ?></li>
	</ul>
</div>
