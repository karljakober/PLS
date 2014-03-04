<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users view">
        <h2><?php echo __d('users', 'User'); ?></h2>
            <dl><?php $i = 0; $class = ' class="altrow"';?>
                <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('users', 'Username'); ?></dt>
                <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                    <?php echo $user[$model]['username']; ?>
                    &nbsp;
                </dd>
                <dt<?php if ($i % 2 == 0) echo $class; ?>><?php echo __d('users', 'Created'); ?></dt>
                <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                    <?php echo $user[$model]['created']; ?>
                    &nbsp;
                </dd>
            </dl>
        </div>
      </div>
    </div>
  </div>
</div>
