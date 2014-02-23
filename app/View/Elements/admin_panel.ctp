<nav class="cbp-spmenu cbp-spmenu-right" id="cbp-spmenu-s2">
    <div class="flapRight" style="top: 100px;" id="showRightPush">
    	<span class="flapLabel" style="white-space: nowrap; position: relative; width: 27px;">
    		<object data="data:image/svg+xml; charset=utf-8 ,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot;&gt;&lt;rect x=&quot;0&quot; y=&quot;0&quot; width=&quot;27px&quot; height=&quot;249px&quot; stroke=&quot;none&quot;&gt;&lt;/rect&gt;&lt;text  x=&quot;-0&quot; y=&quot;0&quot; font-family=&quot;Arial,Helvetica,sans-serif&quot;  fill=&quot;rgb(255, 255, 255)&quot; font-size=&quot;18&quot;  style=&quot;text-anchor: end; dominant-baseline: hanging&quot; transform=&quot;rotate(-90)&quot; text-rendering=&quot;optimizeSpeed&quot;&gt;Admin Panel&lt;/text&gt;&lt;/svg&gt;" type="image/svg+xml" style="height:249px; width:27px;" class="flip_label"></object>
    	</span>
    	<div style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background: none repeat scroll 0% 0% transparent;"></div>
    </div>
    <div class="nano">
        <div class="nano-content">
          <?php
            foreach ($adminNavigation as $index => $action) { ?>
              <div class="list-group">
                <a class="list-group-item active" href="#">
                  <?php echo $index; ?>
                </a>
                <?php foreach ($action as $name => $url) { ?>
                <a class="list-group-item" href="<?php echo $url; ?>"><?php echo $name; ?></a>
                <?php } ?>
              </div>
          <?php } ?>
        </div>
    </div>
</nav>
