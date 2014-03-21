<div class="container">
	<h2><?php echo __d('cake_dev', 'Fatal Error'); ?></h2>
	<p class="error">
		<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
		<?php echo h($error->getMessage()); ?>
		<br>

		<strong><?php echo __d('cake_dev', 'File'); ?>: </strong>
		<?php echo h($error->getFile()); ?>
		<br>

		<strong><?php echo __d('cake_dev', 'Line'); ?>: </strong>
		<?php echo h($error->getLine()); ?>
	</p>
</div>