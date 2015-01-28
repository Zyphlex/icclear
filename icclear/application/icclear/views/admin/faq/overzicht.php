<div class="col-md-10">
        
        <h1>FAQ beheren</h1>  
        
        <div class="panel panel-default" role="tablist">

            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                        Landen
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
                                <th>Beheer</th>
                            </tr>
                        </thead>
<!--                        <tbody>
                            <?php foreach($landen as $land) {?>
                            <tr>
                                <td><?php echo $land->id ?></td>
                                <td><?php echo $land->naam ?></td>
                                <td><?php echo anchor('land/wijzig/' . $land->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('land/verwijder/' . $land->id, 'Verwijderen','class="btn btn-default"'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>-->
                    </table>
                    
                    
                </div>
            </div>

        </div>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>
        <?php echo anchor('land/nieuw', 'Nieuw land toevoegen','class="btn btn-default"'); ?> 
        
    </div>
