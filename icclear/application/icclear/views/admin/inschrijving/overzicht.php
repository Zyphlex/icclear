

<div class="col-md-10">

    <h1>Ingeschreven bezoekers en sprekers</h1>  
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Te betalen</th>
                <th>Betaald</th>
                <th>Datum</th>
                <th>Betaling</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inschrijvingen as $inschrijving) { ?>
                <tr>
                    <td><?php echo $inschrijving->gebruiker->voornaam . " " .$inschrijving->gebruiker->familienaam?></td>

                    <td><?php echo "€ " . $inschrijving->confonderdeel->prijs ?></td>
                    <?php
                    if ($inschrijving->confonderdeel->prijs > 0 && $inschrijving->betaling->methode != "Overschrijving") { ?>

                        echo "<td>Ja</td>";
                    <?php } else if ($inschrijving->confonderdeel->prijs > 0 && $inschrijving->betaling->methode == "Overschrijving") { ?>
                        echo "<td>Nee</td>";
                    <?php } ?>
                    <td><?php echo toDDMMYYYY($inschrijving->datum) ?></td>
                    <td><?php echo $inschrijving->betaling->methode ?></td>
                    <td><?php echo anchor('inschrijving/wijzig/' . $inschrijving->id, 'Wijzigen', 'class="btn btn-default"'); ?>
                        <?php echo anchor('inschrijving/verwijder/' . $inschrijving->id, 'Verwijderen', 'class="btn btn-default"'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <?php echo anchor('inschrijving/nieuw', 'Nieuwe betaling toevoegen', 'class="btn btn-default"'); ?> 

</div>
