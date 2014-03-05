<?php echo $this->element('timeline_js', array('upcominglan', $upcominglan)); ?>
<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="users overview">
          <h2><?php echo __('Welcome'); ?> <?php echo $user[$model]['username']; ?></h2>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Timeline</h3>
          </div>
          <div class="panel-body" style="padding: 0px 0px 0px 0px;">
            <?php if (isset($upcominglan) && count($upcominglan)) { ?>
              <div id="timeline"></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
