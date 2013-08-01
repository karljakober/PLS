<div class="tournaments index">
	<h2><?php echo __('Tournaments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lan_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
	</tr>
	<?php foreach ($tournaments as $tournament): ?>
	<tr>
		<td><?php echo h($tournament['Tournament']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tournament['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $tournament['Lan']['id'])); ?>
		</td>
		<td><?php echo $this->Html->link(h($tournament['Tournament']['name']), array('action' => 'view', $tournament['Tournament']['id'])); ?>&nbsp;</td>
		<td><?php echo h($tournament['Tournament']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($tournament['Tournament']['end_time']); ?>&nbsp;</td>
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
