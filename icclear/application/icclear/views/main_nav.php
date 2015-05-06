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
                    
                    <?php if($conferentie->isPlanningZichtbaar) { ?>
                        <li <?php if ($active == 'programma'){ echo 'class="active"'; } ?>><?php echo anchor('programma/', 'PROGRAMMA'); ?></li>
                    <?php } else { ?>
                        <li <?php if ($active == 'programma'){ echo 'class="active"'; } ?>><?php echo anchor('spreker/voorstel', 'WORD SPREKER'); ?></li>
                    <?php } ?>
                    <?php if ($inschrijving == null && $conferentie->beginDatum >= date('Y-m-d',strtotime('-1 month'))){ ?>
                        <li <?php if ($active == 'inschrijven'){ echo 'class="active"'; } ?>><?php echo anchor('inschrijven/', 'INSCHRIJVEN'); ?></li>
                    <?php } ?>
                    <li <?php if ($active == 'spreker'){ echo 'class="active"'; } ?>><?php echo anchor('spreker/', 'SPREKERS'); ?></li>
                    <li <?php if ($active == 'venue'){ echo 'class="active"'; } ?>><?php echo anchor('locatie/', 'VENUES/ROUTES'); ?></li>
                    <li <?php if ($active == 'hotel'){ echo 'class="active"'; } ?>><?php echo anchor('locatie/hotel', 'HOTELS'); ?></li>
                    <li <?php if ($active == 'sponsors'){ echo 'class="active"'; } ?>><?php echo anchor('sponsor/', 'SPONSORS'); ?></li>
                    <?php
                if ($user != null) {
                    switch ($user->typeId) {                        
                        case 3: // administrator ?>
                            <li class="pull-right <?php if ($active == 'admin'){ echo "active"; }?>"><?php echo anchor('admin', 'ADMIN'); ?></li>
                        <?php break;
                    }
                }
                ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav>
</div>


                    