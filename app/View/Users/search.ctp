<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users index">
        	<h2><?php echo __d('users', 'Users'); ?></h2>
        	<?php
        		echo $this->Form->create($model, array(
        			'action' => 'search'));
        		echo $this->Form->input('username', array(
        			'label' => __d('users', 'Username')));
        		echo $this->Form->input('email', array(
        			'label' => __d('users', 'Email')));
        		echo $this->Form->input('Profile.name', array(
        			'label' => __d('users', 'Name')));
        		echo $this->Form->end(__d('users', 'Search'));
        	?>
        
        	<table cellpadding="0" cellspacing="0">
        	<tr>
        		<th><?php echo $this->Paginator->sort('username'); ?></th>
        		<th><?php echo $this->Paginator->sort('created'); ?></th>
        		<th class="actions"><?php echo __d('users', 'Actions'); ?></th>
        	</tr>
        	<?php
        	$i = 0;
        	foreach ($users as $user):
        		$class = null;
        		if ($i++ % 2 == 0) {
        			$class = ' class="altrow"';
        		}
        		?>
        		<tr<?php echo $class; ?>>
        			<td><?php echo $user[$model]['username']; ?></td>
        			<td><?php echo $user[$model]['created']; ?></td>
        			<td class="actions">
        				<?php echo $this->Html->link(__d('users', 'View'), array('action' => 'view', $user[$model]['id'])); ?>
        				<?php echo $this->Html->link(__d('users', 'Edit'), array('action' => 'edit', $user[$model]['id'])); ?>
        				<?php echo $this->Html->link(
        					__d('users', 'Delete'),
        					array('action' => 'delete', $user[$model]['id']),
        					null,
        					sprintf(__d('users', 'Are you sure you want to delete # %s?'), $user[$model]['id'])
        				); ?>
        			</td>
        		</tr>
        	<?php endforeach; ?>
        	</table>
        	<p><?php echo $this->element('paging'); ?>
        	<?php echo $this->element('pagination'); ?>
        </div>
      </div>
    </div>
  </div>
</div>