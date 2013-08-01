<div class="lans index">
	<h2><?php echo __('Lans'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th><?php echo $this->Paginator->sort('max_attendants'); ?></th>
	</tr>
	<?php foreach ($lans as $lan): ?>
	<tr>
		<td><?php echo h($lan['Lan']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(h($lan['Lan']['name']), array('action' => 'view', $lan['Lan']['id'])); ?>&nbsp;</td>
		<td><?php echo h($lan['Lan']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($lan['Lan']['end_time']); ?>&nbsp;</td>
		<td><?php echo h($lan['Lan']['max_attendants']); ?>&nbsp;</td>
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
