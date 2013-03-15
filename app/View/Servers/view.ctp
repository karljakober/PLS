<div class="servers view">
<h2><?php  echo __('Server'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($server['Server']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lan'); ?></dt>
		<dd>
			<?php echo $this->Html->link($server['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $server['Lan']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($server['Server']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($server['Server']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Additional Info'); ?></dt>
		<dd>
			<?php echo h($server['Server']['additional_info']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Server'), array('action' => 'edit', $server['Server']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Server'), array('action' => 'delete', $server['Server']['id']), null, __('Are you sure you want to delete # %s?', $server['Server']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Servers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Server'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lans'), array('controller' => 'lans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lan'), array('controller' => 'lans', 'action' => 'add')); ?> </li>
	</ul>
</div>
