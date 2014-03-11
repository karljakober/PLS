<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="teams form">
        <?php echo $this->Form->create('Team'); ?>
        	<fieldset>
	        	<legend><?php echo __('Edit Team'); ?></legend>
        	<?php
        		echo $this->Form->input('id');
        		echo $this->Form->input('name');
        		echo $this->Form->input('description');
        		echo $this->Form->input('invite_only');
        	?>
        	</fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
        <?php /**<div class="actions">
	        <h3><?php echo __('Actions'); ?></h3>
        	<ul>
	        	<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tournament.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tournament.id'))); ?></li>
	        </ul>*/?>
        </div>
    </div>
  </div>
</div>
