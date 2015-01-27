<!--    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>            
        </div>
    </div>-->
    
    <div class="col-md-2">  
        
        <h1></h1>
        
        <div class="panel panel-default">
            
            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    Beheren
                </h4>
            </div>

            <div class="panel-body">
                <h3>Algemeen</h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">Landen</a></li>
                    <li><?php echo anchor('gebruiker/overzichtGebruikers' , 'Gebruikers'); ?></li>
                    <li><a href="#">F.A.Q.</a></li>
            
            
            <?php if($conferentieId != null) { ?>
                    
                <h3>Conferentie</h3>
                    <li><?php echo anchor('gebruiker', 'Gebruikers'); ?></li>
                    <li><?php echo anchor('sessies', 'Sessies'); ?></li>
                
            <?php } ?>            
            
                </ul>
            </div>
        </div>
        
        
        
    </div>