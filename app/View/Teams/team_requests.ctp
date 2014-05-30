<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
        <?php echo $this->Session->flash(); ?>
          <h1 id="TeamRequests"><?php echo __('Team Requests'); ?></h1>
        </div>
        <div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
    			<th>User ID</th>
    			<th>Accept/Decline</th>
              </tr>
            </thead>
            <tbody>
            	<?php
            	$i = 0;

            	foreach ($requests as $request):
            		$class = null;
            		if ($i++ % 2 == 0) {
            			$class = ' class="altrow"';
            		}
            		?>
            		
            		<tr<?php echo $class; ?>>
            		
                		<td><?php echo $this->Html->link($request['User']['username'], array('controller' => 'Users', 'action' => 'view', $request['User']['id'])); ?></td>
                		
                		
                		<td>
                		    <form method="post" action="/Teams/accept/<?php echo h($request['TeamRequests']['team_id']) ?>">
                		        <button type="submit">Accept</button>
                		    </form>
                		    <form method="post" action="/Teams/<?php echo h($request['TeamRequests']['team_id']) ?>/decline">
                		        <button type="submit">Decline</button>
                		    </form>
                		</td>
            		</tr>
            	<?php endforeach; ?>
            	
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
