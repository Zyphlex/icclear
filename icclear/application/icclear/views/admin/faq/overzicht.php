<div class="col-md-10">
        
        <h1>FAQ beheren</h1>  
        
        <div class="panel panel-default" role="tablist">

            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                    <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                        Vragen
                    </span>
                </h4>
            </div>
            
            <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vraag</th>
                                <th>Antwoord</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vragen as $vraag) {?>
                            <tr>
                                <td><?php echo $vraag->vraag ?></td>
                                <td><?php echo $vraag->antwoord ?></td>
                                <td>
                                    <p>                                        
                                        <?php echo anchor('faq/wijzig/' . $vraag->id, 'Wijzig','class="btn btn-default"'); ?>
                                        <?php echo anchor('faq/verwijder/' . $vraag->id, 'Verwijder','class="btn btn-default"'); ?>   
                                    </p>                                 
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>

        </div>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>
        <?php echo anchor('faq/toevoegen/', 'Nieuwe FAQ toevoegen','class="btn btn-default"'); ?> 
        
    </div>
