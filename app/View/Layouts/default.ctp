<!DOCTYPE html>
<html lang="en">

    <?php echo $this->element('header'); ?>

  <body>
  
    <?php echo $this->element('navbar'); ?>

	<?php echo $this->fetch('content'); ?>
    
    <?php echo $this->element('footer'); ?>

  </body>
</html>
