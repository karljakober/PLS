<div class="container">
  <div class="page-content">
    <div class="row">
      <?php if (Configure::read('steam_login')) { ?>
      <div class="col-lg-6">
        <div class="well">
        <fieldset>
          <legend><?php echo __d('users', 'Easy log in'); ?></legend>
          <div class="form-group">
            <a href="/users/steam_login"><img src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_border.png" alt="Sign in with steam" /></a>
          </div>
        </fieldset>
        </div>
      </div>
      <?php } ?>
      <div class="col-lg-6 <?php if (!Configure::read('steam_login')) { echo 'col-lg-offset-3'; } ?>">
        <?php echo $this->Session->flash(); ?>
        <div class="well">
          <?php 
          echo $this->Form->create($model, array(
            'class' => 'bs-example form-horizontal',
            'action' => 'login',
            'id' => 'LoginForm'
          ));
          ?>
          <fieldset>
            <legend><?php if (Configure::read('steam_login')) { echo 'Dont have steam? '; } ?>Login</legend>
              <div class="form-group">
                <label for="UserEmail" class="col-lg-2 control-label"><?php echo __d('users', 'Email'); ?></label>
                <?php
                echo $this->Form->input('email', array(
                  'label' => false,
                  'div' => 'col-lg-10',
                  'placeholder' => 'Email',
                  'class' => 'form-control'
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
                echo $this->Form->input('remember_me', array(
                  'type' => 'checkbox',
                  'div' => 'checkbox',
                  'label' =>  __d('users', 'Remember Me')
                ));
                echo '<span class="help-block">' . $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password')) . '</span>';
                ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <?php
                  echo $this->Form->hidden('User.return_to', array(
                    'value' => $return_to
                  ));
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