<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <?php echo $this->Session->flash(); ?>
      <div class="page-header">
        <h1 id="Users"><?php echo __d('users', 'Users'); ?></h1>
      </div>
      <div class="well col-lg-6">
        <?php echo $this->Form->create($model, array('action' => 'index', 'class' => 'form-horizontal')); ?>
          <fieldset>
            <legend><?php echo __d('users', 'Filter'); ?></legend>
        	    <?php 
          		echo $this->Form->input('username', array(
          		  'label' => __d('users', 'Username'),
          		  'div' => array('class' => 'form-group'),
          		  'label' => array('class' => 'col-lg-2 control-label'),
          		  'class' => 'form-control',
      		      'between' => '<div class="col-lg-10">',
                'after' => '</div>'
          		));
          		echo $this->Form->input('email', array(
          		  'label' => __d('users', 'Email'),
          		  'div' => array('class' => 'form-group'),
          		  'label' => array('class' => 'col-lg-2 control-label'),
          		  'class' => 'form-control',
      		      'between' => '<div class="col-lg-10">',
                'after' => '</div>'
          		)); ?>
          		<div class="form-group">
          		  <div class="col-lg-10 col-lg-offset-2">
              		<?php
              		echo $this->Form->button(__d('users', 'Search'), array(
              		  'type' => 'submit',
              		  'class' => 'btn btn-primary'
              		)); 
              		?>
              	</div>
          		</div>
  	      </fieldset>
      	<?php echo $this->Form->end(); ?>
    	</div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
      			<th><?php echo $this->Paginator->sort('username'); ?></th>
      			<th><?php echo $this->Paginator->sort('email'); ?></th>
      			<th><?php echo $this->Paginator->sort('email_verified'); ?></th>
      			<th><?php echo $this->Paginator->sort('active'); ?></th>
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
              <td>
      					<?php echo $user[$model]['username']; ?>
      				</td>
      				<td>
      					<?php echo $user[$model]['email']; ?>
      				</td>
      				<td>
      					<?php echo $user[$model]['email_verified'] == 1 ? __d('users', 'Yes') : __d('users', 'No'); ?>
      				</td>
      				<td>
      					<?php echo $user[$model]['active'] == 1 ? __d('users', 'Yes') : __d('users', 'No'); ?>
      				</td>
      				<td>
      					<?php echo $user[$model]['created']; ?>
      				</td>
      				<td class="actions">
      					<?php echo $this->Html->link(__d('users', 'View'), array('action'=>'view', 'admin' => false, $user[$model]['id'])); ?>
      					<?php echo $this->Html->link(__d('users', 'Edit'), array('action'=>'edit', $user[$model]['id'])); ?>
      					<?php echo $this->Html->link(__d('users', 'Delete'), array('action'=>'delete', $user[$model]['id']), null, sprintf(__d('users', 'Are you sure you want to delete # %s?'), $user[$model]['id'])); ?>
      				</td>
        		</tr>
      	  <?php endforeach; ?>
        </tbody>
      </table>
    	<p><?php echo $this->element('paging'); ?></p>
    	<?php echo $this->element('pagination'); ?>
    </div>
  </div>
</div>