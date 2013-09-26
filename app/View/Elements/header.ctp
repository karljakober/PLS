  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/bootstrap/assets/ico/favicon.png">

    <title><?= $title_for_layout; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/bootstrap/assets/js/html5shiv.js"></script>
      <script src="/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      (function() {
        var usernames = "<?php echo $streamList; ?>";
    
        setInterval(function(){
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