<div class="container">
    <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="tournaments view">
            <h2><?php  echo h($tournament['Tournament']['name']); ?></h2>
            	<dl>
            		<dt><?php echo __('Start Time'); ?></dt>
            		<dd>
            			<?php echo h($tournament['Tournament']['start_time']); ?>
            			&nbsp;
            		</dd>
            		<dt><?php echo __('End Time'); ?></dt>
            		<dd>
            			<?php echo h($tournament['Tournament']['end_time']); ?>
            			&nbsp;
            		</dd>
            	</dl>
            </div>
          </div>
        </div>
    </div>
</div>
