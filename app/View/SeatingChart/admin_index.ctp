<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="seatingcharts index">
          <h2><?php echo __('Seating Charts'); ?></h2>
          <table class="table table-striped table-bordered table-hover">
          <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('width'); ?></th>
            <th><?php echo $this->Paginator->sort('height'); ?></th>
            <th class="actions"><?php echo __d('seatingcharts', 'Actions'); ?></th>
          </tr>
          <?php foreach ($seatingcharts as $seatingchart): ?>
          <tr>
            <td><?php echo h($seatingchart[$model]['id']); ?>&nbsp;</td>
            <td><?php echo $this->Html->link(h($seatingchart[$model]['name']), array('action' => 'view', $seatingchart[$model]['id'])); ?>&nbsp;</td>
            <td><?php echo h($seatingchart[$model]['width']); ?>&nbsp;</td>
            <td><?php echo h($seatingchart[$model]['height']); ?>&nbsp;</td>
            <td class="actions">
              <?php echo $this->Html->link(__d('seatingcharts', 'Edit'), array('action'=>'edit', $seatingchart[$model]['id'])); ?>
              <?php echo $this->Html->link(__d('seatingcharts', 'Delete'), array('action'=>'delete', $seatingchart[$model]['id']), null, sprintf(__d('seatingcharts', 'Are you sure you want to delete # %s?'), $seatingchart[$model]['id'])); ?>
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
