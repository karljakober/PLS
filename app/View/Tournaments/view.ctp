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
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Members</th>
                        <th>Options</tr>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                          $i = 0;
                          foreach ($squads as $squad):
                            $onSquad = false;
                            $onTeam = false;
                            if($user!=null){
                                foreach ($user['squad'] as $uSquad):
                                    if($uSquad['id'] == $squad['Squad']['id']){
                                        $onSquad = true;
                                    }
                                endforeach;
                                foreach ($user['team'] as $uTeam):
                                    if($uTeam['id'] == $squad['Squad']['team_id']){
                                        $onTeam = true;
                                    }
                                endforeach;
                            }
                            $class = null;
                            if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                              <td><?php echo h($squad['Team']['id']); ?>&nbsp;</td>
                              <td><?php echo h($squad['Team']['name']); ?>&nbsp;</td>
                              <td>
                                <?php foreach ($squad['user'] as $member): ?>
                                    <?php echo h($member['username']); ?><br>
                                <?php endforeach; ?>
                              </td>
                              <td>
                                <?php if($user['User']['id']==$squad['Team']['manager_id']) { ?>
                                    <?php
                                        echo $this->Form->create('Tournament',array('action'=>'disband/'.$tournament['Tournament']['id'], 'type'=>'put'));
                                        echo $this->Form->input('squad',array('type'=>'hidden','value'=>$squad['Squad']['id']));
                                        echo $this->Form->end('Disband Squad');
                                    ?>
                                    <br>
                                <?php } ?>
                                
                                <?php if(!$onSquad&&(!$squad['Team']['invite_only']||!$onTeam)) { ?>
                                    <?php 
                                        echo $this->Form->create('Tournament',array('action'=>'join/'.$tournament['Tournament']['id'], 'type'=>'put'));
                                        echo $this->Form->input('user',array('type'=>'hidden','value'=>$user['User']['id']));
                                        echo $this->Form->input('squad',array('type'=>'hidden','value'=>$squad['Squad']['id']));
                                        echo $this->Form->end('Join Squad');
                                    ?>
                                    <br>
                                <?php } ?>
                                
                                <?php if($onSquad) { ?>
                                    <?php 
                                        echo $this->Form->create('Tournament',array('action'=>'leave/'.$tournament['Tournament']['id'], 'type'=>'put'));
                                        echo $this->Form->input('user',array('type'=>'hidden','value'=>$user['User']['id']));
                                        echo $this->Form->input('squad',array('type'=>'hidden','value'=>$squad['Squad']['id']));
                                        echo $this->Form->end('Leave Squad');
                                    ?>
                                    <br>
                                <?php } ?>
                              </td>
                            </tr>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
           
            <?php
                $inputs;
                foreach($user['ownsTeam'] as $ownsTeam):
                    $inputs[$ownsTeam['id']]=$ownsTeam['name'];
                endforeach;
                if(!empty($inputs)){
              ?>
                  Register New Team:
                  <?php
                  echo  $tournament['Tournament']['id'];
                  echo $this->Form->create('Tournament', array(
                    'action' => 'create'
                  ));
                  echo $this->Form->input('tournament',array('type'=>'hidden','value'=>$tournament['Tournament']['id']));
                  echo $this->Form->input('team',array(
                      'options'=> $inputs));
                  echo $this->Form->end('Create Squad');
                }
            ?>
            <br>
        </div>
      </div>
    </div>
  </div>
</div>