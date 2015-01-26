<div class="row">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php echo $active_home ?>><?php echo anchor('home', 'HOME'); ?></li>
                    <li <?php echo $active_register ?>><a href="food/index.html">REGISTER</a></li>
                    <li <?php echo $active_programme ?>><a href="kleding/index.html">PROGRAMME</a></li>
                    <li <?php echo $active_speakers ?>><a href="gallerij/index.html">SPEAKERS</a></li>
                    <li <?php echo $active_venue ?>><a href="gallerij/index.html">VENUE</a></li>
                    <?php
                if ($user != null) {
                    switch ($user->typeId) {                        
                        case 3: // administrator
                            echo '<li> ' . anchor('admin', 'ADMIN') . '</li>' . "\n";
                            echo "\t\t".'<li class="dropdown">' . "\n";
                            echo "\t\t".'<a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMIN<b class="caret"></b></a>' . "\n";
                            echo "\t\t".'<ul class="dropdown-menu">';
                            echo "\t\t".'<li> ' . anchor('admin/algemeen', 'BEHEER ALGEMEEN') . '</li>' . "\n";
                            echo "\t\t".'<li> ' . anchor('admin/conferentie', 'BEHEER CONFERENTIE') . '</li>' . "\n";
                            echo "\t\t".'</ul>' . "\n";
                            echo "\t\t".'</li>' . "\n";
                            break;
                    }
                }
                ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav>
</div>