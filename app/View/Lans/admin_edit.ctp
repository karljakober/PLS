<div class="container">
    <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="lans form">
            <?php echo $this->Form->create('Lan'); ?>
            	<fieldset>
            		<legend><?php echo __('Edit Lan'); ?></legend>
            	<?php
            		echo $this->Form->input('id');
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
            
            		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lan.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Lan.id'))); ?></li>
            		<li><?php echo $this->Html->link(__('List Lans'), array('action' => 'index')); ?></li>
            		<li><?php echo $this->Html->link(__('List Servers'), array('controller' => 'servers', 'action' => 'index')); ?> </li>
            		<li><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?> </li>
            		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
            		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
            	</ul>
            </div>
          </div>
        </div>
    </div>
</div>
