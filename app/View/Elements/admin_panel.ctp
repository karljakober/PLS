		<!-- tournaments -->
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('New Tournament'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Lans'), array('controller' => 'lans', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Lan'), array('controller' => 'lans', 'action' => 'add')); ?> </li>
			</ul>
		</div>

		<!-- lans -->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lan['Lan']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lan['Lan']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lan['Lan']['id']), null, __('Are you sure you want to delete # %s?', $lan['Lan']['id'])); ?>
		</td>

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