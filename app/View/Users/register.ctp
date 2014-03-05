<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-6">
        <div class="well">
        <fieldset>
          <legend><?php echo __d('users', 'Easy Register'); ?></legend>
          <div class="form-group">
            <a href="/users/steam_login"><img src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_border.png" alt="Sign in with steam" /></a>
          </div>
        </fieldset>
        </div>
      </div>
      <div class="col-lg-6">
        <?php echo $this->Session->flash(); ?>
        <div class="well">
          <?php 
          echo $this->Form->create($model, array(
            'class' => 'bs-example form-horizontal'
          ));
          ?>
          <fieldset>
            <legend>Dont have steam? Register</legend>
              <div class="form-group">
                <label for="UserUsername" class="col-lg-2 control-label"><?php echo __d('users', 'Username'); ?></label>
                <?php
                echo $this->Form->input('username', array(
                  'label' => false,
                  'div' => 'col-lg-10',
                  'placeholder' => 'Username',
                  'class' => 'form-control'
                ));
                ?>
              </div>
              <div class="form-group">
                <label for="UserEmail" class="col-lg-2 control-label"><?php echo __d('users', 'E-mail (used as login)'); ?></label>
                <?php
                echo $this->Form->input('email', array(
                  'label' => false,
                  'div' => 'col-lg-10',
                  'placeholder' => 'Email',
                  'class' => 'form-control',
                  'error' => array(
                    'isValid' => __d('users', 'Must be a valid email address'),
                    'isUnique' => __d('users', 'An account with that email already exists')
                  )
                ));
                ?>
              </div>
              <div class="form-group">
                <label for="UserPassword" class="col-lg-2 control-label"><?php echo __d('users', 'Password'); ?></label>
                <div class="col-lg-10">
                <?php
                echo $this->Form->input('password',  array(
                  'label' => false,
                  'div' => false,
                  'placeholder' => 'Password',
                  'class' => 'form-control'
                ));
                ?>
                </div>
              </div>
              <div class="form-group">
                <label for="UserPassword" class="col-lg-2 control-label"><?php echo __d('users', 'Password (confirm)'); ?></label>
                <div class="col-lg-10">
                <?php
                echo $this->Form->input('temppassword',  array(
                  'label' => false,
                  'div' => false,
                  'type' => 'password',
                  'placeholder' => 'Password (again)',
                  'class' => 'form-control'
                ));
                $tosLink = $this->Html->link(__d('users', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
                echo $this->Form->input('tos', array(
                  'type' => 'checkbox',
                  'div' => 'checkbox',
                  'label' => __d('users', 'I have read and agreed to ') . $tosLink
                ));
                ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <?php
                  echo $this->Form->submit(__d('users', 'Submit'), array(
                    'class' => 'btn btn-primary',
                    'div' => false
                  ));
                  ?>
                </div>
              </div>
            </fieldset>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>