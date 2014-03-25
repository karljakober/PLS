<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
        <?php echo $this->Session->flash(); ?>
          <h1 id="Teams"><?php echo __('Teams'); ?></h1>
        </div>
    	<p>
    		<?php echo $this->element('paging'); ?>
      </p>
        <div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
    			<th><?php echo $this->Paginator->sort('id'); ?></th>
    			<th><?php echo $this->Paginator->sort('name'); ?></th>
    			<th><?php echo $this->Paginator->sort('description'); ?></th>
    			<th><?php echo $this->Paginator->sort('manager_id'); ?></th>
    			<th><?php echo $this->Paginator->sort('invite_only');?></th>
              </tr>
            </thead>
            <tbody>
            	<?php
            	$i = 0;

            	foreach ($teams as $team):
            		$class = null;
            		if ($i++ % 2 == 0) {
            			$class = ' class="altrow"';
            		}
            		?>
            		<tr<?php echo $class; ?>>
                		<td><?php echo h($team['Team']['id']); ?>&nbsp;</td>
                		<td>
                			<?php echo $this->Html->link($team['Team']['name'], array('controller' => 'Teams', 'action' => 'view', $team['Team']['id'])); ?>
                		</td>
                		<td><?php echo h($team['Team']['description']); ?>&nbsp;</td>
                		<td>
                		    <?php echo $this->Html->link($team['Manager']['username'], array('controller' => 'Users', 'action' => 'view', $team['Team']['manager_id'])); ?>
                		</td>
                		<td><?php echo h($team['Team']['invite_only']); ?>&nbsp;</td>
            		</tr>
            	<?php endforeach; ?>
            	
            </tbody>
          </table>
        </div>
        <?php echo $this->Html->link(__('Add Team'), array('controller' => 'Teams', 'action' => 'add')); ?>
    	<?php echo $this->element('pagination'); ?>
      </div>
    </div>
</div>
