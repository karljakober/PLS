		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tournament['Tournament']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tournament['Tournament']['id']), null, __('Are you sure you want to delete # %s?', $tournament['Tournament']['id'])); ?>
		</td>