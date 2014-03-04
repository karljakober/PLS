<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="tournaments index">
          <h2><?php echo __('Tournaments'); ?></h2>
          <table class="table table-striped table-bordered table-hover">
          <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('start_time'); ?></th>
            <th><?php echo $this->Paginator->sort('end_time'); ?></th>
            <th><?php echo $this->Paginator->sort('type'); ?></th>
            <th class="actions"><?php echo __d('tournaments', 'Actions'); ?></th>
          </tr>
          <?php foreach ($tournaments as $tournament): ?>
          <tr>
            <td><?php echo h($tournament[$model]['id']); ?>&nbsp;</td>
            <td><?php echo $this->Html->link(h($tournament[$model]['name']), array('action' => 'view', 'admin' => false, $tournament[$model]['id'])); ?>&nbsp;</td>
            <td><?php echo h($tournament[$model]['start_time']); ?>&nbsp;</td>
            <td><?php echo h($tournament[$model]['end_time']); ?>&nbsp;</td>
            <td><?php echo h($tournament[$model]['type']); ?>&nbsp;</td>
            <td class="actions">
              <?php echo $this->Html->link(__d('tournaments', 'Edit'), array('action'=>'edit', $tournament[$model]['id'])); ?>
              <?php echo $this->Html->link(__d('tournaments', 'Delete'), array('action'=>'delete', $tournament[$model]['id']), null, sprintf(__d('tournaments', 'Are you sure you want to delete # %s?'), $tournament[$model]['id'])); ?>
            </td>
          </tr>
        <?php endforeach; ?>
          </table>
          <p>
          <?php echo $this->element('paging'); ?>
          </p>
          <?php echo $this->element('pagination'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
