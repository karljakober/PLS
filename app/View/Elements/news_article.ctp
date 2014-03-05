<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $article['News']['title']; ?></h3>
  </div>
  <div class="panel-body">
    <h4><?php echo date_format(date_create($article['News']['created']), 'g:i A \- d M Y'); ?> by <a href="/Users/view/<?php echo $article['Author']['id']; ?>" alt="<?php echo $article['Author']['username']; ?>'s profile"><?php echo $article['Author']['username']; ?></a></h4>
    <?php echo $article['News']['content']; ?>
  </div>
</div>