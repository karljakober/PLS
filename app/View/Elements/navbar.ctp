    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><img src="/img/white-pong-logo.png" class="navbar-logo" /></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
              <?php 
              if (isset($navigationleft)) {
                foreach ($navigationleft as $element => $url) {
                    if (!is_array($url)) { ?>
                        <li><a href="<?php echo $url; ?>"><?php echo $element; ?></a></li>
                    <?php } else { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="<?php echo $element; ?>"><?php echo $element; ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu" aria-labelledby="<?php echo $element; ?>">
                            <?php foreach ($url as $dropdownelement => $dropdownurl) { ?>
                                <li><a tabindex="-1" href="<?php echo $dropdownurl; ?>"><?php echo $dropdownelement; ?></a></li>
                            <?php } ?>
                          </ul>
                        </a>
                    </li>
                    <?php } 
                }
              } ?>
              </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php 
              if (isset($navigationright)) {
                foreach ($navigationright as $element => $url) {
                    if (!is_array($url)) { ?>
                        <li><a href="<?php echo $url; ?>"><?php echo $element; ?></a></li>
                    <?php } else { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="<?php echo $element; ?>"><?php echo $element; ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu" aria-labelledby="<?php echo $element; ?>">
                            <?php foreach ($url as $dropdownelement => $dropdownurl) { ?>
                                <li><a tabindex="-1" href="<?php echo $dropdownurl; ?>"><?php echo $dropdownelement; ?></a></li>
                            <?php } ?>
                          </ul>
                        </a>
                    </li>
                    <?php } 
                }
              }?>
          </ul>
          <!--<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="../default/">Default</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="../amelia/">Amelia</a></li>
                <li><a tabindex="-1" href="../cerulean/">Cerulean</a></li>
                <li><a tabindex="-1" href="../cosmo/">Cosmo</a></li>
                <li><a tabindex="-1" href="../cyborg/">Cyborg</a></li>
                <li><a tabindex="-1" href="../flatly/">Flatly</a></li>
                <li><a tabindex="-1" href="../journal/">Journal</a></li>
                <li><a tabindex="-1" href="../readable/">Readable</a></li>
                <li><a tabindex="-1" href="../simplex/">Simplex</a></li>
                <li><a tabindex="-1" href="../slate/">Slate</a></li>
                <li><a tabindex="-1" href="../spacelab/">Spacelab</a></li>
                <li><a tabindex="-1" href="../united/">United</a></li>
              </ul>
            </li>
            <li>
              <a href="../help/">Help</a>
            </li>
            <li>
              <a href="http://news.bootswatch.com">Blog</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a tabindex="-1" href="./bootstrap.min.css">bootstrap.min.css</a></li>
                <li><a tabindex="-1" href="./bootstrap.css">bootstrap.css</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
            <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
          </ul> -->

        </div>
      </div>
    </div>