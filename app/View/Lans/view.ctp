<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="lans view">
        <h2><?php echo h($lan['Lan']['name']); ?></h2>
            <dl>
                <dt><?php echo __('Start Time'); ?></dt>
                <dd>
                    <?php echo h($lan['Lan']['start_time']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('End Time'); ?></dt>
                <dd>
                    <?php echo h($lan['Lan']['end_time']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Max Attendants'); ?></dt>
                <dd>
                    <?php echo h($lan['Lan']['max_attendants']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Current Attendants'); ?></dt>
                <dd>
                    <?php //echo h($lan['Lan']['max_attendants']); ?>
                    &nbsp;
                </dd>
            </dl>
        </div>
        <div class="related">
            <h3><?php echo __('Related Servers'); ?></h3>
            <?php if (!empty($lan['Server'])): ?>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Address'); ?></th>
                <th><?php echo __('Additional Info'); ?></th>
                <th></th>
            </tr>
            <?php
                $i = 0;
                foreach ($lan['Server'] as $server): ?>
                <tr>
                    <td><?php echo $server['name']; ?></td>
                    <td><?php echo $server['address']; ?></td>
                    <td><?php echo $server['additional_info']; ?></td>
                    <?php if ($server['user_id'] == $user['User']['id']) { ?>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'servers', 'action' => 'edit', $server['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'servers', 'action' => 'delete', $server['id']), null, __('Are you sure you want to delete # %s?', $server['id'])); ?>
                    </td>
                    <?php } else { ?>
                    <td></td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <?php if($lanActive) { ?>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        <?php } ?>
        </div>
        <div class="related">
            <h3><?php echo __('Related Tournaments'); ?></h3>
            <?php if (!empty($lan['Tournament'])): ?>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Start Time'); ?></th>
                <th><?php echo __('End Time'); ?></th>
            </tr>
            <?php
                $i = 0;
                foreach ($lan['Tournament'] as $tournament): ?>
                <tr>
                    <td><?php echo $this->Html->link($tournament['name'], array('controller' => 'tournaments', 'action' => 'view', $tournament['id'])); ?></td>
                    <td><?php echo $tournament['start_time']; ?></td>
                    <td><?php echo $tournament['end_time']; ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
