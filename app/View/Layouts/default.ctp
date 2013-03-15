<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PLS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="/css/flat-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
    <link rel="shortcut icon" href="/img/flat-ui/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->
  </head>
  <body>

    <header>
      <div class="container">
        <div class="row">
          <div class="span6">
            <a class="header-brand" href="http://pong.uwstout.edu/" target="_blank">
              <img src="/img/pong-logo.png" alt="PLS" />
            </a>
          </div> <!-- /span8 -->
          <?php 
          $zebra = true;
          foreach ($navigation as $element => $url) { ?>
          <div class="span1">
            <div id="<?= str_replace(" ", "", $element) ?>" class="header-banner <?php if ($zebra) { echo 'palette-carrot'; } else { echo 'palette-bright-dark'; } ?>">
              <h3 class="header-title"><?= $element ?></h3>
            </div>
          </div>
          <?php 
          $zebra = !$zebra;
          } ?>
        </div>
      </div>
    </header>
    <div class="container palette-bright-dark" style="margin-top: 14px;">
      <div class="demo-headline">
        <h1 class="demo-logo">
          Welcome to PLS
          <small>Thursday March 14, 2013 - Posted by Blaine0002</small>
        </h1>
        This is the development version of PLS (Pong lan software) developed for the Peoples Organization of Network Gaming at UW-Stout.
      </div> <!-- /demo-headline -->
    </div> <!-- /container -->

    <!-- Load JS here for greater good =============================-->
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="/js/jquery.dropkick-1.0.0.js"></script>
    <script src="/js/custom_checkbox_and_radio.js"></script>
    <script src="/js/custom_radio.js"></script>
    <script src="/js/jquery.tagsinput.js"></script>
    <script src="/js/bootstrap-tooltip.js"></script>
    <script src="/js/jquery.placeholder.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <script src="/js/application.js"></script>
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>
    <!--[if lt IE 8]>
      <script src="/js/icon-font-ie7.js"></script>
      <script src="/js/icon-font-ie7-24.js"></script>
    <![endif]-->
    <script type="text/javascript">
    $(document).ready(function() {
      $('.fancybox').fancybox();
      <?php foreach ($navigation as $element => $url) { ?>
      $('#<?= str_replace(" ", "", $element) ?>').click(function() {
        $.fancybox.open({
          href : '<?= $url ?>',
          title : '<?= $element ?>',
          padding : 0   
        });
        alert('test');
        return false;
      });
      <?php } ?>
    });
    </script>
  </body>
</html>
