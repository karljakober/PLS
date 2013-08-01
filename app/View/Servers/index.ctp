<div class="servers index">
	<h2><?php echo __('Official Servers for ') . $this->Html->link($activeLan['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $activeLan['Lan']['id'])); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('additional_info'); ?></th>
			<th></th>
	</tr>
	<?php foreach ($servers as $server):
		if ($server['Server']['lan_id'] == $activeLan['Lan']['id'] && $server['Server']['official'] == 1) { ?>
	<tr>
		<td><?php echo h($server['Server']['name']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['address']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['additional_info']); ?>&nbsp;</td>
		<?php if ($isAdmin || $server['Server']['user_id'] == $user['User']['id']) { ?>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $server['Server']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $server['Server']['id']), null, __('Are you sure you want to delete # %s?', $server['Server']['id'])); ?>
			</td>
		<?php } else { ?>
			<td></td>
		<?php } ?>
	</tr>
	<?php } ?>
<?php endforeach; ?>
	</table>
	<h2><?php echo __('User owned Servers for ') . $this->Html->link($activeLan['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $activeLan['Lan']['id'])); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('additional_info'); ?></th>
			<th></th>
	</tr>
	<?php foreach ($servers as $server):
		if ($server['Server']['lan_id'] == $activeLan['Lan']['id'] && $server['Server']['official'] == 0) { ?>
	<tr>
		<td><?php echo h($server['Server']['name']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['address']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['additional_info']); ?>&nbsp;</td>
		<?php if ($isAdmin || $server['Server']['user_id'] == $user['User']['id']) { ?>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $server['Server']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $server['Server']['id']), null, __('Are you sure you want to delete # %s?', $server['Server']['id'])); ?>
			</td>
		<?php } else { ?>
			<td></td>
		<?php } ?>
	</tr>
	<?php } ?>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Server'), array('action' => 'add')); ?></li>
	</ul>
</div>
