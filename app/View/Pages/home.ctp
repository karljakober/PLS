<?php
if (isset($user) && $user) {
    header('Location: /dashboard');
    exit;
} ?>
<?php echo $this->element('timeline_js', array('upcominglan', $upcominglan)); ?>

<div class="jumbotron"<?php if (isset($upcominglan) && count($upcominglan)) { ?> style="margin-bottom: 0px;" <?php } ?>>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>Pong Lan Software</h1>
        <p>Welcome to the dev site for the upcoming PLS (Pong lan software), hopefully you will be able to tinker around here, and submit bugs, comments and complaints to jakoberk@uwstout.edu</p>
      </div>
      <?php echo $this->element('home_lan_info', array('upcominglan' => $upcominglan,
      'activeLan' => $activeLan)); ?>
    </div>
  </div>
</div>
<?php if (isset($upcominglan) && count($upcominglan)) { ?>
  <div id="timeline" style="margin-bottom: 30px;"></div>
<?php } ?>
<div class="container">
  <?php 
  if (!count($news)) {
    echo $this->element('news_article_empty');
  }
  foreach ($news as $article) {
    echo $this->element('news_article', array('article' => $article));
  } ?>
</div>
