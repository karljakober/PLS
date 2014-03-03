<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="lans index">
        	<h2><?php echo __('Lans'); ?></h2>
          <table class="table table-striped table-bordered table-hover">
        	<tr>
      			<th><?php echo $this->Paginator->sort('id'); ?></th>
      			<th><?php echo $this->Paginator->sort('name'); ?></th>
      			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
      			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
      			<th><?php echo $this->Paginator->sort('max_attendants'); ?></th>
        	</tr>
        	<?php foreach ($lans as $lan): ?>
          	<tr>
          		<td><?php echo h($lan['Lan']['id']); ?>&nbsp;</td>
          		<td><?php echo $this->Html->link(h($lan['Lan']['name']), array('action' => 'view', $lan['Lan']['id'])); ?>&nbsp;</td>
          		<td><?php echo h($lan['Lan']['start_time']); ?>&nbsp;</td>
          		<td><?php echo h($lan['Lan']['end_time']); ?>&nbsp;</td>
          		<td><?php echo h($lan['Lan']['max_attendants']); ?>&nbsp;</td>
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
