<!--    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>            
        </div>
    </div>-->






<div class="col-md-2">  
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">Admin Nav
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminnav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <h4><span class="glyphicon glyphicon-th-large"></span> DASHBOARD</h4>                         
                <div class="panel panel-default">

                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                        <h4 class="panel-title">
                            Beheren
                        </h4>
                    </div>

                    <div class="panel-body">
                        <h4>Algemeen</h4>
                        <ul class="nav nav-pills nav-stacked">
                            <li><?php echo anchor('adminbeheer', 'Admins'); ?></li>
                            <li><?php echo anchor('gebruiker', 'Gebruikers'); ?></li>
                            <li><?php echo anchor('activiteit', 'Activiteiten'); ?></li>
                            <li><?php echo anchor('land', 'Landen'); ?></li>
                            <li><?php echo anchor('zaal', 'Zalen'); ?></li>
                            <li><?php echo anchor('gebouw', 'Gebouwen'); ?></li>
                            <li><?php echo anchor('routesbeheer', 'Routes'); ?></li>
                            <li><?php echo anchor('hotels', 'Hotels'); ?></li>
                            <li><?php echo anchor('sponsorbeheer', 'Sponsors'); ?></li>
                            <li><?php echo anchor('faqbeheer', 'F.A.Q.'); ?></li>



                            <?php if ($conferentieId != null) { ?>

                                <h4>Conferentie</h4>
                                <li><?php echo anchor('conferentie', 'Conferentie'); ?></li>
                                <li><?php echo anchor('inschrijven/opvolgen', 'Inschrijvingen'); ?></li>
                                <li><?php echo anchor('sessies', 'Sessies'); ?></li>
                                <li><?php echo anchor('aankondiging/', 'Aankondigingen'); ?></li>
                                <li><?php echo anchor('planningbeheer', 'Planningen'); ?></li>
                                <li><?php echo anchor('gebouw/gebouwPerDag/' . $conferentieId, 'Gebouwen') ?></li>

                            <?php } ?>            

                        </ul>
                    </div>
                </div>

            </ul>

        </div><!-- /.navbar-collapse -->
    </nav>
</div>
