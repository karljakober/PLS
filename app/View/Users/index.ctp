<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="Users"><?php echo __d('users', 'Users'); ?></h1>
        </div>
    	<p><?php
    	echo $this->Paginator->counter(array(
    		'format' => __d('users', 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
    	));
    	?></p>
        <div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
        		<th><?php echo $this->Paginator->sort('username'); ?></th>
        		<th><?php echo $this->Paginator->sort('created'); ?></th>
        		<th class="actions"><?php echo __d('users', 'Actions'); ?></th>
              </tr>
            </thead>
            <tbody>
            	<?php
            	$i = 0;
            	foreach ($users as $user):
            		$class = null;
            		if ($i++ % 2 == 0) {
            			$class = ' class="altrow"';
            		}
            		?>
            		<tr<?php echo $class; ?>>
            			<td><?php echo $this->Html->link($user[$model]['username'], array('action' => 'view', $user[$model]['id'])); ?></td>
            			<td><?php echo $user[$model]['created']; ?></td>
            			<td class="actions">
            				<?php echo $this->Html->link(__d('users', 'View'), array('action' => 'view', $user[$model]['id'])); ?>
            			</td>
            		</tr>
            	<?php endforeach; ?>
            </tbody>
          </table>
        </div>
    	<?php echo $this->element('pagination'); ?>
      </div>
    </div>
</div>