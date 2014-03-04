<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users overview">
          <h2><?php echo __d('users', 'Welcome'); ?> <?php echo $user[$model]['username']; ?></h2>
          <h3><?php echo __d('users', 'Recent broadcasts'); ?></h3>
        </div>
      </div>
    </div>
  </div>
</div>
