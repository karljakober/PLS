<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
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
            
        <h2>Teams:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    	$i = 0;
                    	foreach ($team_tournaments as $team):
                    	    if($team['Team']['tournament_id']  == $tournament['Tournament']['id'])){
                        		$class = null;
                        		if ($i++ % 2 == 0) {
                        			$class = ' class="altrow"';
                        		}
                        		?>
                        		<tr<?php echo $class; ?>>
                            		<td><?php echo h($team['Team']['id']); ?>&nbsp;</td>
                            		<td><?php echo h($team['Team']['team_id']); ?>&nbsp;</td>
                        		</tr>
                        	}
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
