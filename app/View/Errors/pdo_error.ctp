<div class="container">
	<h2><?php echo __d('cake_dev', 'Database Error'); ?></h2>
	<p class="error">
		<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
		<?php echo $name; ?>
	</p>
	<?php if (!empty($error->queryString)) : ?>
		<p class="notice">
			<strong><?php echo __d('cake_dev', 'SQL Query'); ?>: </strong>
			<?php echo h($error->queryString); ?>
		</p>
	<?php endif; ?>
	<?php if (!empty($error->params)) : ?>
			<strong><?php echo __d('cake_dev', 'SQL Query Params'); ?>: </strong>
			<?php echo Debugger::dump($error->params); ?>
	<?php endif; ?>
	<?php echo $this->element('exception_stack_trace'); ?>
</div>
