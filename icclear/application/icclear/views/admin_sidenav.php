<!--    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>            
        </div>
    </div>-->
    
    <div class="col-md-2">  
        
        <div class="panel panel-default">
            
            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    Beheren
                </h4>
            </div>

            <div class="panel-body">
                <h4>Algemeen</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li><?php echo anchor('hotels' , 'Hotels'); ?></li>
                    <li><?php echo anchor('land' , 'Landen'); ?></li>
                    <li><?php echo anchor('gebruiker/overzichtGebruikers' , 'Gebruikers'); ?></li>
                    <li><?php echo anchor('gebruiker/overzichtAdmins' , 'Admins'); ?></li>
                    <li><?php echo anchor('faqbeheer' , 'F.A.Q.'); ?></li>
            
            
            <?php if($conferentieId != null) { ?>
                    
                <h4>Conferentie</h4>
                    <li><?php echo anchor('conferentie', 'Conferentie'); ?></li>
                    <li><?php echo anchor('gebruiker/gebruikersConferentie', 'Gebruikers'); ?></li>
                    <li><?php echo anchor('sessies', 'Sessies'); ?></li>
                
            <?php } ?>            
            
                </ul>
            </div>
        </div>
        
        
        
    </div>