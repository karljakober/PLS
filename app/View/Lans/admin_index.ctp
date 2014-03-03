<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash();
        <div class="lans index">
        	<h2><?php echo __('Lans'); ?></h2>
          <table class="table table-striped table-bordered table-hover">
        	<tr>
      			<th><?php echo $this->Paginator->sort('id'); ?></th>
      			<th><?php echo $this->Paginator->sort('name'); ?></th>
      			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
      			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
      			<th><?php echo $this->Paginator->sort('max_attendants'); ?></th>
      			<th class="actions"><?php echo __d('lans', 'Actions'); ?></th>
        	</tr>
        	<?php foreach ($lans as $lan): ?>
        	<tr>
        		<td><?php echo h($lan[$model]['id']); ?>&nbsp;</td>
        		<td><?php echo $this->Html->link(h($lan[$model]['name']), array('action' => 'view', 'admin' => false, $lan[$model]['id'])); ?>&nbsp;</td>
        		<td><?php echo h($lan[$model]['start_time']); ?>&nbsp;</td>
        		<td><?php echo h($lan[$model]['end_time']); ?>&nbsp;</td>
        		<td><?php echo h($lan[$model]['max_attendants']); ?>&nbsp;</td>
    				<td class="actions">
    					<?php echo $this->Html->link(__d('lans', 'Edit'), array('action'=>'edit', $lan[$model]['id'])); ?>
    					<?php echo $this->Html->link(__d('lans', 'Delete'), array('action'=>'delete', $lan[$model]['id']), null, sprintf(__d('lans', 'Are you sure you want to delete # %s?'), $lan[$model]['id'])); ?>
    				</td>
        	</tr>
        <?php endforeach; ?>
        	</table>
        	<p><?php echo $this->element('paging'); ?></p>
	        <?php echo $this->element('pagination'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
