<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="tournaments form">
        <?php echo $this->Form->create('Tournament'); ?>
            <fieldset>
                <legend><?php echo __('Add Tournament'); ?></legend>
            <?php
                echo $this->Form->input('lan_id');
                echo $this->Form->input('name');
                echo $this->Form->input('start_time');
                echo $this->Form->input('end_time');
            ?>
            </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
        </div>
        <div class="actions">
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('List Tournaments'), array('action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('List Lans'), array('controller' => 'lans', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New Lan'), array('controller' => 'lans', 'action' => 'add')); ?> </li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
