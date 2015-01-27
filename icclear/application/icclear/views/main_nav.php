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
                    <li <?php if ($active == 'home'){ echo 'class="active"'; } ?>><?php echo anchor('home', 'HOME'); ?></li>
                    <li <?php if ($active == 'inschrijven'){ echo 'class="active"'; } ?>><?php echo anchor('inschrijven/', 'INSCHRIJVEN'); ?></li>
                    <li <?php if ($active == 'programma'){ echo 'class="active"'; } ?>><?php echo anchor('programma/', 'PROGRAMMA'); ?></li>
                    <li <?php if ($active == 'spreker'){ echo 'class="active"'; } ?>><?php echo anchor('spreker/', 'SPREKERS'); ?></li>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">VENUES/ROUTES<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><?php echo anchor('locatie/', 'VENUE'); ?></li>                            
                            <li><?php echo anchor('locatie/route', 'ROUTES'); ?></li>
                            </ul>
                            </li>
                    <li <?php if ($active == 'hotel'){ echo 'class="active"'; } ?>><?php echo anchor('locatie/hotel', 'HOTELS'); ?></li>
                    <?php
                if ($user != null) {
                    switch ($user->typeId) {                        
                        case 3: // administrator ?>
                            <li <?php if ($active == 'admin'){ echo 'class="active"'; } ?>><?php echo anchor('admin', 'ADMIN'); ?></li>
                        <?php break;
                    }
                }
                ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav>
</div>


                    