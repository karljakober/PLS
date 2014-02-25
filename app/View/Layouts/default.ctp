<!DOCTYPE html>
<html lang="en">

    <?php echo $this->element('header'); ?>

  <body>
      
    <?php echo $this->element('navbar'); ?>

    <?php 
    if (isset($user) && $user) {
        echo $this->element('chat');
    }

    if (isset($isAdmin) && $isAdmin) {
        echo $this->element('admin_panel');
    } ?>
    
	  <?php echo $this->fetch('content'); ?>

    <?php echo $this->element('footer'); ?>

  </body>
</html>
