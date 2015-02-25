<div class="col-md-10">

    <h1>Activiteiten beheren</h1>  
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Conferentie</th>
                <th>Prijs</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activiteiten as $inschrijving) { ?>
                <tr>
                    <td><?php echo $inschrijving->naam ?></td>
                    <td><?php echo $inschrijving->conferentie->naam ?></td>
                    <td><?php echo $inschrijving->prijs ?></td>

                    <td><?php echo anchor('activiteit/wijzig/' . $gebruiker->id, 'Wijzigen', 'class="btn btn-default"'); ?>
                    <?php echo anchor('activiteit/verwijder/' . $gebruiker->id, 'Verwijderen', 'class="btn btn-default"'); ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <?php echo anchor('activiteit/nieuw', 'Nieuwe activiteit toevoegen', 'class="btn btn-default"'); ?> 

</div>