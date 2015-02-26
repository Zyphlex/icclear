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
            <?php foreach ($activiteiten as $activiteit) { ?>
                <tr>
                    <td><?php echo $activiteit->naam ?></td>
                    <td><?php echo $activiteit->conferentie->naam ?></td>
                    <td><?php echo "€ " . $activiteit->prijs ?></td>

                    <td><?php echo anchor('activiteit/wijzig/' . $activiteit->id, 'Wijzigen', 'class="btn btn-default"'); ?>
                    <?php echo anchor('activiteit/verwijder/' . $activiteit->id, 'Verwijderen', 'class="btn btn-default"'); ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <?php echo anchor('activiteit/nieuw', 'Nieuwe activiteit toevoegen', 'class="btn btn-default"'); ?> 

</div>