

    <div class="col-md-10">
        
        <h1>Inschijvingen beheren.</h1>  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Familienaam</th>
                                <th>Voornaam</th>
                                <th>ConfOnderdeel</th>
                                <th>Datum</th>
                                <th>Betaling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inschrijvingen as $inschrijving) {?>
                            <tr>
                                <td><?php echo $inschrijving->gebruiker->familienaam ?></td>
                                <td><?php echo $inschrijving->gebruiker->voornaam ?></td>
                                <td><?php echo $inschrijving->conferentieOnderdeelId ?></td>
                                <td><?php echo toDDMMYYYY($inschrijving->datum) ?></td>
                                <td><?php echo $inschrijving->betaling->methode ?></td>
                                <td><?php echo anchor('gebruiker/wijzig/' . $inschrijving->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('gebruiker/verwijder/' . $inschrijving->id, 'Verwijderen','class="btn btn-default"'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?> 
        <?php echo anchor('gebruiker/nieuw', 'Nieuwe gebruiker toevoegen','class="btn btn-default"'); ?> 
        
    </div>
