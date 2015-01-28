

    <div class="col-md-10">
        
        <h1>Landen beheren</h1>  
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naam</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($landen as $land) {?>
                            <tr>
                                <td><?php echo $land->id ?></td>
                                <td><?php echo $land->naam ?></td>
                                <td><?php echo anchor('land/wijzig/' . $land->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('land/verwijder/' . $land->id, 'Verwijderen','class="btn btn-default"'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>
        <?php echo anchor('land/nieuw', 'Nieuw land toevoegen','class="btn btn-default"'); ?> 
        
    </div>
