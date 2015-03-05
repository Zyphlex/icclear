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

                <td><?php echo anchor('activiteit/wijzig/' . $activiteit->id, 'Wijzigen', 'class="wijzigActiviteit btn btn-default"'); ?>
                    <?php echo anchor('activiteit/verwijder/' . $activiteit->id, 'Verwijderen', 'class="verwijderActiviteit btn btn-default"'); ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
