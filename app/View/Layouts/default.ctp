<!DOCTYPE html>
<html lang="en">

    <?php //echo $this->element('header-semantic'); ?>
    <?php echo $this->element('header-bootstrap'); ?>

  <body>
      
    <?php //echo $this->element('navbar-semantic'); ?>
    <?php echo $this->element('navbar-bootstrap'); ?>

    <?php 
    if (isset($user) && $user) {
        //echo $this->element('chat-semantic');
        echo $this->element('chat-bootstrap');
    }
    ?>
    
	<?php echo $this->fetch('content'); ?>

    <?php //echo $this->element('footer-semantic'); ?>
    <?php echo $this->element('footer-bootstrap'); ?>

  </body>
</html>
