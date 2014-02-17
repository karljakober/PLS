<style>
.cbp-spmenu {
    position: fixed;
    width: 240px;
    /* Firefox */
    height: -moz-calc(100% - 50px);
    /* WebKit */
    height: -webkit-calc(100% - 50px);
    /* Opera */
    height: -o-calc(100% - 50px);
    /* Standard */
    height: calc(100% - 50px);
    z-index: 1000;
}
 
.cbp-spmenu a:active {
    background: #afdefa;
    color: #47a3da;
}

.cbp-spmenu-push {
    overflow-x: hidden;
    position: relative;
    left: 0;
}
 
.cbp-spmenu-push-toright {
    left: 240px;
    padding-right:240px;
}
 
.cbp-spmenu-left {
    left: -240px;
}

.cbp-spmenu-left.cbp-spmenu-open {
    left: 0px;
}

/* Transitions */
 
.cbp-spmenu,
.cbp-spmenu-push {
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

div.chatfooter{
   position:fixed;
   bottom:0px;
   height:40px;
   width: 230px;
   display: block;
   margin-left: 5px;
   margin-right: 5px;
}

div.emptyspace{
   height:40px;
}

</style>
<nav class="cbp-spmenu cbp-spmenu-left" id="cbp-spmenu-s1">
    <div class="nano">
        <div class="nano-content">
            <ul class="list-group" id="messages">
                <?php 
                foreach( $messages as $message ) {
                    if ($message['Message']['to']) { 
                ?>
                <li class="list-group-item">
                  <h5 class="list-group-item-heading"><?php echo $message['Message']['username']; ?> > <?php echo $message['Message']['to']; ?></h5>
                  <p class="list-group-item-text"><?php echo $message['Message']['message']; ?></p>
                </li>
                <?php 
                    } else { 
                ?>
                <li class="list-group-item">
                  <h5 class="list-group-item-heading"><?php echo $message['Message']['username']; ?></h5>
                  <p class="list-group-item-text"><?php echo $message['Message']['message']; ?></p>
                </li>
                <?php 
                    }
                }?>
            </ul>
            <div class="emptyspace"></div>
            <div class="chatfooter">
                <div class="input-group">
                    <input type="text" class="form-control" id="messageInput" />
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" id="messageSubmit">Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</nav>
