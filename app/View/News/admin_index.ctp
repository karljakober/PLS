<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="lans index">
          <h2><?php echo __('News'); ?></h2>
          <table class="table table-striped table-bordered table-hover">
          <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('author_id'); ?></th>
            <th class="actions"><?php echo __d('news', 'Actions'); ?></th>
          </tr>
          <?php foreach ($news as $article): ?>
            <tr>
              <td><?php echo h($article['News']['id']); ?>&nbsp;</td>
              <td><?php echo $this->Html->link(h($article['News']['title']), array('action' => 'edit', $article['News']['id'])); ?>&nbsp;</td>
              <td><?php echo h($article['News']['created']); ?>&nbsp;</td>
              <td><?php echo $this->Html->link(h($article['Author']['username']), array('controller' => 'Users', 'action' => 'view', 'admin' => false, $article['Author']['id'])); ?>&nbsp;</td>
              <td class="actions">
                <?php echo $this->Html->link(__d('news', 'View'), array('action' => 'view', 'admin' => false, $article[$model]['id'])); ?>
                <?php echo $this->Html->link(__d('news', 'Edit'), array('action' => 'edit', $article[$model]['id'])); ?>
                <?php echo $this->Html->link(__d('news', 'Delete'), array('action' => 'delete', $article[$model]['id']), null, sprintf(__d('news', 'Are you sure you want to delete # %s?'), $article[$model]['id'])); ?>
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
