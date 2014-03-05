<script type="text/javascript">
$(document).ready(function() {
  $('#editor').summernote();
});
var postForm = function() {
  var content = $('textarea[name="data[News][content]"]').html($('#editor').code());
}
</script>
<link href="/css/summernote.css" rel="stylesheet">
<link href="/css/summernote-bs3.css" rel="stylesheet">
<div class="container">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12 well">
        <?php echo $this->Session->flash(); ?>
        <div class="news form">
        <?php echo $this->Form->create('News', array('onSubmit' => 'return postForm();')); ?>
          <fieldset>
            <legend><?php echo __('Add News Article'); ?></legend>
            <?php
              echo $this->Form->input('title', array(
                  'label' => __d('news', 'Title'),
                  'div' => array('class' => 'form-group'),
                  'label' => array('class' => 'col-lg-2 control-label'),
                  'class' => 'form-control',
                  'between' => '<div class="col-lg-10">',
                  'after' => '</div>'
                ));
            ?>
          <div class="clearfix">&nbsp;</div>
          <div class="form-group">
            <textarea class="input-block-level" id="editor" name="data[News][content]" rows="18"></textarea>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <?php
              echo $this->Form->button(__d('news', 'Submit'), array(
                'type' => 'submit',
                'class' => 'btn btn-primary'
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
