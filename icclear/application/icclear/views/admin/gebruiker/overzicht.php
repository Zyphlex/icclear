

    <div class="col-md-10">
        
        <h1>Gebruikers beheren.</h1>  
        
        <div class="panel panel-default" role="tablist">
            <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Familienaam</th>
                                <th>Voornaam</th>
                                <th>Email</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($gebruikers as $gebruiker) {?>
                            <tr>
                                <td><?php echo $gebruiker->familienaam ?></td>
                                <td><?php echo $gebruiker->voornaam ?></td>
                                <td><?php echo $gebruiker->emailadres ?></td>
                                <td><?php echo anchor('gebruiker/wijzig/' . $gebruiker->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('gebruiker/verwijder/' . $gebruiker->id, 'Verwijderen','class="btn btn-default"'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>

        </div>
        
        <?php echo anchor('gebruiker/nieuw', 'Nieuwe gebruiker toevoegen','class="btn btn-default"'); ?> 
        
    </div>
