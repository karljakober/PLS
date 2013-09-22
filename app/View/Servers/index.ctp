<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="OfficialServers"><?php echo __('Official Servers for ') . $this->Html->link($activeLan['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $activeLan['Lan']['id'])); ?></h1>
        </div>
        <div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
    			<th><?php echo $this->Paginator->sort('name'); ?></th>
    			<th><?php echo $this->Paginator->sort('address'); ?></th>
    			<th><?php echo $this->Paginator->sort('additional_info'); ?></th>
    			<th></th>
              </tr>
            </thead>
            <tbody>
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="UserServers"><?php echo __('User owned Servers for ') . $this->Html->link($activeLan['Lan']['name'], array('controller' => 'lans', 'action' => 'view', $activeLan['Lan']['id'])); ?></h1>
        </div>
        <div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
    			<th><?php echo $this->Paginator->sort('name'); ?></th>
    			<th><?php echo $this->Paginator->sort('address'); ?></th>
    			<th><?php echo $this->Paginator->sort('additional_info'); ?></th>
    			<th></th>
              </tr>
            </thead>
            <tbody>
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
            </tbody>
          </table>
        </div>
        <div class="actions">
        	<h3><?php echo __('Actions'); ?></h3>
        	<ul>
        		<li><?php echo $this->Html->link(__('New Server'), array('action' => 'add')); ?></li>
        	</ul>
        </div>
      </div>
    </div>
</div>
