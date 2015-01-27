

    <div class="col-md-10">        
        <h1>Admin dashboard</h1>  
        
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
                                <th>#</th>
                                <th>Naam</th>
                                <th>Stad</th>
                                <th>Begin datum</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $teller = 1; foreach($conferenties as $gebruiker) {?>
                            <tr>
                                <td><?php echo $teller ?></td>
                                <td><?php echo $gebruiker->naam ?></td>
                                <td><?php echo $gebruiker->stad ?></td>
                                <td><?php echo $gebruiker->beginDatum ?></td>
                                <td><?php echo anchor('admin/dashboard/' . $gebruiker->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                            </tr>
                            <?php $teller++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
