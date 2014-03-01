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
          <div class="col-lg-12">
            <div class="news form">
            <?php echo $this->Form->create('News', array('onSubmit' => 'return postForm();')); ?>
            	<fieldset>
            		<legend><?php echo __('Add News Article'); ?></legend>
            	<?php
            		echo $this->Form->input('title');
            	?>
              <textarea class="input-block-level" id="editor" name="data[News][content]" rows="18"></textarea>
            	</fieldset>
            <?php echo $this->Form->end(__('Submit')); ?>
            </div>
          </div>
        </div>
    </div>
</div>
