<div class="row">
    <div class="col-md-12">
        <h1>Admin Dashboard</h1>
    </div>
</div>

<div class="row">
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
    </div>


    <div class="col-md-10">
        <div class="panel panel-default" role="tablist">

            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                        Conferentie selecteren om te beheren
                    </span>
                </h4>
            </div>
            
            <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Stad</th>
                                <th>Begin datum</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($conferenties as $conferentie) {?>
                            <tr>
                                <td><?php echo $conferentie->naam ?></td>
                                <td><?php echo $conferentie->stad ?></td>
                                <td><?php echo $conferentie->beginDatum ?></td>
                                <td><a class="btn btn-default">Beheren</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>