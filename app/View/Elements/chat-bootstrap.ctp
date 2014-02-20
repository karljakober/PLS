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

.flap {
  font-size:18px;
  color:#FFF;
  top:0;
  margin-right:-37px;
  background:#000;
  width:40px;
  position:absolute;
  right:0;
  -moz-border-radius:0 8px;
  -webkit-border-top-left-radius:0;
  -webkit-border-top-right-radius:8px;
  -webkit-border-bottom-left-radius:0;
  -webkit-border-bottom-right-radius:8px;
  border-top-left-radius:0;
  border-top-right-radius:8px;
  border-bottom-left-radius:0;
  border-bottom-right-radius:8px;
  -moz-box-shadow:2px 0 5px #999;
  -webkit-box-shadow:2px 0 5px #999;
  box-shadow:2px 0 5px #999;
  padding:10px 0 10px 10px;
}


</style>
<nav class="cbp-spmenu cbp-spmenu-left" id="cbp-spmenu-s1">
    <div class="flap" style="top: 100px;" id="showLeftPush">
    	<span class="flapLabel" style="white-space: nowrap; position: relative; width: 27px;">
    		<object data="data:image/svg+xml; charset=utf-8 ,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot;&gt;&lt;rect x=&quot;0&quot; y=&quot;0&quot; width=&quot;27px&quot; height=&quot;249px&quot; stroke=&quot;none&quot;&gt;&lt;/rect&gt;&lt;text  x=&quot;-0&quot; y=&quot;0&quot; font-family=&quot;Arial,Helvetica,sans-serif&quot;  fill=&quot;rgb(255, 255, 255)&quot; font-size=&quot;18&quot;  style=&quot;text-anchor: end; dominant-baseline: hanging&quot; transform=&quot;rotate(-90)&quot; text-rendering=&quot;optimizeSpeed&quot;&gt;Chat&lt;/text&gt;&lt;/svg&gt;" type="image/svg+xml" style="height:249px; width:27px;" class="flip_label"></object>
    	</span>
    	<div style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background: none repeat scroll 0% 0% transparent;"></div>
    </div>
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
