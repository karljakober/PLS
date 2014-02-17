    <div class="container">
      <hr>
      <footer>
        <p>Powered by <a href="http://github.com/karljakober/PLS">PLS</a></p>
      </footer>
    </div> <!-- /container -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/json2.js"></script>
	<script src="/js/socket.io.js"></script>
    <script src="/js/jquery.nanoscroller.js"></script>
    <script src="/js/nodeClient.js"></script>
    <?php if (isset($js_include)) { ?>
    <script src="/js/<?php echo $js_include; ?>"></script>
    <?php } ?>
