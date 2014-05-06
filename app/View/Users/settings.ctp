<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <?php if ($user['User']['username'] == "" || $user['User']['email'] == "" || $user['User']['password'] == "") { ?>
        <div class="col-lg-6">
          <div class="well">
            <?php 
            echo $this->Form->create('User', array(
              'class' => 'bs-example form-horizontal',
              'id' => 'SettingsForm'
            ));
            ?>
            <fieldset>
              <legend><?php echo __d('users', 'Account Settings'); ?></legend>
              <?php if ($user['User']['username'] == "") { ?>
              <div class="form-group">
                <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                  <?php
                  echo $this->Form->input('username', array(
                    'class' => 'form-control',
                    'label' => false
                  ));
                  ?>
                </div>
              </div>
              <?php }
              if ($user['User']['email'] == "") { ?>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                  <?php
                  echo $this->Form->input('settingsemail', array(
                    'class' => 'form-control',
                    'label' => false
                  ));
                  ?>
                </div>
              </div>
              <?php }
              if ($user['User']['password'] == "") { ?>
              <div class="form-group">
                <label for="firstTimePassword1" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                  <?php
                  echo $this->Form->input('password1', array(
                    'class' => 'form-control',
                    'label' => false
                  ));
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="firstTimePassword2" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                  <?php
                  echo $this->Form->input('password2', array(
                    'class' => 'form-control',
                    'label' => false
                  )); 
                  ?>
                </div>
              </div>
              <span class="help-block">Password is useful if you want to log into your account without steam for any reason, however it is not required.</span>
              <?php } ?>
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
        <?php } ?>
        <div class="col-lg-6">
          <div class="well">
            <?php 
            echo $this->Form->create('User', array(
              'class' => 'bs-example form-horizontal',
              'id' => 'SettingsForm'
            ));
            ?>
            <fieldset>
              <legend><?php echo __d('users', 'Other Settings'); ?></legend>
                      <?php
                      echo $this->Form->input('twitch_id', array( 'type' => 'text' ) );
                      ?>
            </fieldset>
            <?php
            echo $this->Form->end(__('Submit')); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>