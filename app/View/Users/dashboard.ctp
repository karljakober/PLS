<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<script type="text/javascript">
$(function() {
    $('.ui.chatroom')
      .chatroom({ key: '0736db8ea27503bc4724', channelName: 'test_channel', endpoint: { message: 'test', authentication: '/pusher/auth'}})
    ;
});
</script>

<div class="container">

    <div class="users overview">
    	<h2><?php echo __d('users', 'Welcome'); ?> <?php echo $user[$model]['username']; ?></h2>
    	<h3><?php echo __d('users', 'Recent broadcasts'); ?></h3>
    </div>
    <button id="showLeftPush">Show/Hide Left Push Menu</button>
</div>
<div class="ui chatroom">
</div>