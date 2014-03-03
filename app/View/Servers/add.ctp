<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3">
        <?php echo $this->Session->flash(); ?>
        <div class="well">
          <?php 
            echo $this->Form->create('Server', array(
              'class' => 'bs-example form-horizontal'
            ));
	        ?>
          <fieldset>
            <legend><?php echo __('Add Server'); ?></legend>

              <div class="form-group">
                <label for="ServerLanId" class="col-lg-2 control-label">Lan</label>
              	<?php
                	echo $this->Form->input('lan_id', array(
        				    'label' => false,
        				    'div' => 'col-lg-10',
        				    'class' => 'form-control'
    				      ));
  				      ?>
              </div>
              <div class="form-group">
                <label for="ServerName" class="col-lg-2 control-label">Name</label>
              	<?php
                	echo $this->Form->input('name', array(
        				    'label' => false,
        				    'div' => 'col-lg-10',
        				    'class' => 'form-control'
    				      ));
  				      ?>
              </div>
              <div class="form-group">
                <label for="ServerAddress" class="col-lg-2 control-label">Address:ip</label>
              	<?php
                	echo $this->Form->input('address', array(
        				    'label' => false,
        				    'div' => 'col-lg-10',
        				    'class' => 'form-control'
    				      ));
  				      ?>
              </div>
              <div class="form-group">
                <label for="ServerAdditionalInfo" class="col-lg-2 control-label">Additional Info</label>
              	<?php
                	echo $this->Form->input('additional_info', array(
        				    'label' => false,
        				    'div' => 'col-lg-10',
        				    'class' => 'form-control'
    				      ));
  				      ?>
              </div>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <?php
      			        echo $this->Form->submit(__('Submit'),
      			        array(
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
