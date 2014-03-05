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
      <div class="col-lg-6" style="margin-top: 30px;">
        <div class="col-lg-offset-3 panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Upcoming Lan</h3>
          </div>
          <div class="panel-body">
            <h3>PONG EXPO LAN</h3>
            <p>October 4th (Friday) from 4pm to the 6th (Sunday) at 4PM (48 hours)</p> 
            <p>19 days, 11 hours, 43 mins, 11 secs</p>
            <p>Early setup Friday at 12pm!</p>
            <!-- Registration opens September 10th. -->
            <button type="button" class="btn btn-primar">Reserve your seat!</button>
          </div>
        </div>
      </div>
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