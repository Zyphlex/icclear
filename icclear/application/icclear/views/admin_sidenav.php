    <div class="row">
        <div class="col-md-12">
            <h1>Admin Dashboard</h1>
        </div>
    </div>

    <div class="col-md-2">  
        
        <div class="panel panel-default">
            
            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    Algemeen
                </h4>
            </div>

            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">Landen</a></li>
                    <li><a href="#">Gebruikers</a></li>
                    <li><a href="#">F.A.Q.</a></li>
                </ul>
            </div>
            
        </div>
        
        <?php if($conferentieId != null) { ?>
        <div class="panel panel-default">
            
            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    Algemeen
                </h4>
            </div>

            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">Gebruikers</a></li>
                    <li><a href="#">Sessies</a></li>
                </ul>
            </div>
            
        </div>
        <?php } ?>
        
    </div>