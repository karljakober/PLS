<div class="servers index">
	<h2><?php echo __('Servers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lan_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('additional_info'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($servers as $server): ?>
	<tr>
		<td><?php echo h($server['Server']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($server['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $server['Lan']['id'])); ?>
		</td>
		<td><?php echo h($server['Server']['name']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['address']); ?>&nbsp;</td>
		<td><?php echo h($server['Server']['additional_info']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $server['Server']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $server['Server']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $server['Server']['id']), null, __('Are you sure you want to delete # %s?', $server['Server']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Server'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Lans'), array('controller' => 'lans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lan'), array('controller' => 'lans', 'action' => 'add')); ?> </li>
	</ul>
</div>
