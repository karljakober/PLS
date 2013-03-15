<div class="tournaments view">
<h2><?php  echo __('Tournament'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lan'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tournament['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $tournament['Lan']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['end_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tournament'), array('action' => 'edit', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tournament'), array('action' => 'delete', $tournament['Tournament']['id']), null, __('Are you sure you want to delete # %s?', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lans'), array('controller' => 'lans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lan'), array('controller' => 'lans', 'action' => 'add')); ?> </li>
	</ul>
</div>
