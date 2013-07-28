<?= $this->Html->docType() ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<?= $this->Html->charset() ?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>PONG</title>

<?= $this->Html->css('style.css') ?>

<!--[if lt IE 7]>
<?= $this->Html->script('iepngfix') ?>
<?= $this->Html->css('ie6') ?>
<![endif]--> 

<?= $this->Html->script('jquery-1.9.1') ?>
<?= $this->Html->script('jquery-ui-1.10.0.custom.min') ?>
<script type="text/javascript">
  (function() {
    var usernames = "<?php echo $streamList; ?>";

    setInterval(function(){
      alert('going');
      $.ajax({
        url:        'https://api.twitch.tv/kraken/streams?channel=' + usernames + '&callback=?',
        dataType:   "jsonp",
        success:    function(data){
            console.log(JSON.stringify(data));
            //do stuff with returned data here
        }
      });
    }, 60000);
  })(); 
</script>

</head>

<body>
<div id="wrapper">
  <div id="contents">
    <div class="header-menu-wrapper clearfix">
      <div id="pngfix-right">
      </div>
      <ul class="menu" id="menu">
        <?php 
        foreach ($navigation as $element => $url) { ?>
          <li class="page_item"><a href="<?= $url ?>"><?= $element ?></a></li>
        <?php 
        } ?>
      </ul>
      <div id="pngfix-left">
      </div>
    </div>
    <div id="header">
      <a class="headerimage" href="/"></a>
    </div>
    <div id="single-middle-contents" class="clearfix">
      <div id="full-col">
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>
    <!-- #middle-contents end -->
    <div id="footer-noside">
    </div>
  </div>
  <!-- #contents end -->
</div>
<!-- #wrapper end -->
<script type="text/javascript">
  var menu=new menu.dd("menu");
  menu.init("menu","menuhover");
</script>
</body>
</html>