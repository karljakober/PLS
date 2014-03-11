<div class="container">
    <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="teams view">
            <h2><?php  echo h($team['Team']['name']); ?></h2>
            	<dl>
            		<dt><?php echo __('Manager'); ?></dt>
            		<dd>
            			<?php echo $this->Html->link($team['Manager']['username'], array('controller' => 'Users', 'action' => 'view', $team['Team']['manager_id'])); ?>
            			&nbsp;
            		</dd>
            		<dt><?php echo __('Members'); ?></dt>
            		<dd>
            		<?php foreach($team['Member'] as $member) {
            		    echo $this->Html->link($member['username'], array('controller' => 'Users', 'action' => 'view', $member['id'])) . '<br />';
            		} ?>
            		</dd>
            	</dl>
            </div>
          </div>
        </div>
    </div>
</div>
