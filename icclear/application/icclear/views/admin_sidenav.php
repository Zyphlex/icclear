<!--    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>            
        </div>
    </div>-->
    
    <div class="col-md-2">  
        <h4><span class="glyphicon glyphicon-th-large"></span> DASHBOARD</h4>                         
        <div class="panel panel-default">
            
            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    Beheren
                </h4>
            </div>

        <div class="row">
            <div class="panel-body">
                <div class="col-md-12 col-xs-6">
                <h4>Algemeen</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li><?php echo anchor('adminbeheer' , 'Admins'); ?></li>
                    <li><?php echo anchor('gebruiker' , 'Gebruikers'); ?></li>
                    <li><?php echo anchor('activiteit' , 'Activiteiten'); ?></li>
                    <li><?php echo anchor('land' , 'Landen'); ?></li>
                    <li><?php echo anchor('zaal' , 'Zalen'); ?></li>
                    <li><?php echo anchor('gebouw' , 'Gebouwen'); ?></li>
                    <li><?php echo anchor('routesbeheer' , 'Routes'); ?></li>
                    <li><?php echo anchor('hotels' , 'Hotels'); ?></li>
                    <li><?php echo anchor('sponsorbeheer', 'Sponsors'); ?></li>
                    <li><?php echo anchor('faqbeheer' , 'F.A.Q.'); ?></li>
                </ul>
                </div>
            
            
            <?php if($conferentieId != null) { ?>
                    <div class="col-md-12 col-xs-6">
                <ul class="nav nav-pills nav-stacked">
                <h4>Conferentie</h4>
                    <li><?php echo anchor('conferentie', 'Conferentie'); ?></li>
                    <li><?php echo anchor('inschrijvenbeheer/opvolgen', 'Inschrijvingen'); ?></li>
                    <li><?php echo anchor('sessies', 'Sessies'); ?></li>
                    <li><?php echo anchor('aankondiging/', 'Aankondigingen'); ?></li>
                    <li><?php echo anchor('planningbeheer' , 'Planningen'); ?></li>
                    <li><?php echo anchor('gebouw/gebouwPerDag/' . $conferentieId, 'Gebouwen') ?></li>
                </ul>
                    </div>
            <?php } ?>            
            
            </div>
        </div>
        
        
        </div>
    </div>