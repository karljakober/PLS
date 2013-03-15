<div class="lans form">
<?php echo $this->Form->create('Lan'); ?>
	<fieldset>
		<legend><?php echo __('Add Lan'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('max_attendants');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lans'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Servers'), array('controller' => 'servers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
