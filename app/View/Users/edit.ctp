<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users form">
          <?php echo $this->Form->create($model); ?>
            <fieldset>
              <legend><?php echo __d('users', 'Edit User'); ?></legend>
              <p>
                <?php echo $this->Html->link(__d('users', 'Change your password'), array('action' => 'change_password')); ?>
              </p>
            </fieldset>
          <?php echo $this->Form->end(__d('users', 'Submit')); ?>
        </div>
      </div>
    </div>
  </div>
</div>
