<div class="lans view">
<h2><?php  echo __('Lan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lan['Lan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($lan['Lan']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($lan['Lan']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($lan['Lan']['end_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Attendants'); ?></dt>
		<dd>
			<?php echo h($lan['Lan']['max_attendants']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lan'), array('action' => 'edit', $lan['Lan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lan'), array('action' => 'delete', $lan['Lan']['id']), null, __('Are you sure you want to delete # %s?', $lan['Lan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lan'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Servers'), array('controller' => 'servers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Servers'); ?></h3>
	<?php if (!empty($lan['Server'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lan Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Additional Info'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($lan['Server'] as $server): ?>
		<tr>
			<td><?php echo $server['id']; ?></td>
			<td><?php echo $server['lan_id']; ?></td>
			<td><?php echo $server['name']; ?></td>
			<td><?php echo $server['address']; ?></td>
			<td><?php echo $server['additional_info']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'servers', 'action' => 'view', $server['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'servers', 'action' => 'edit', $server['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'servers', 'action' => 'delete', $server['id']), null, __('Are you sure you want to delete # %s?', $server['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tournaments'); ?></h3>
	<?php if (!empty($lan['Tournament'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lan Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($lan['Tournament'] as $tournament): ?>
		<tr>
			<td><?php echo $tournament['id']; ?></td>
			<td><?php echo $tournament['lan_id']; ?></td>
			<td><?php echo $tournament['name']; ?></td>
			<td><?php echo $tournament['start_time']; ?></td>
			<td><?php echo $tournament['end_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tournaments', 'action' => 'view', $tournament['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tournaments', 'action' => 'edit', $tournament['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tournaments', 'action' => 'delete', $tournament['id']), null, __('Are you sure you want to delete # %s?', $tournament['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
