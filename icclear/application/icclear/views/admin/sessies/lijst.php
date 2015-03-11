<table class="table table-beheer">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Dag</th>
            <th>Beginuur</th>
            <th>Omschrijving</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessies as $sessie) { ?>
            <tr>
                <td><?php echo $sessie->onderwerp ?></td>
                <?php if ($sessie->planning != null) { ?>
                    <td><?php echo toDDMMYYYY($sessie->conferentiedag->datum) ?></td>
                    <td><?php echo $sessie->planning->beginUur . " - " . $sessie->planning->eindUur ?></td
                <?php } else { ?>
                    <td colspan="2">Nog niet ingepland</td>
                <?php } ?>>
                <td><?php echo $sessie->omschrijving ?></td>
                <td>
                    <p>
                        <button class="wijzigSessie btn btn-primary" data-id="<?php echo $sessie->id ?>">Wijzigen</button>
                        <button class="verwijderSessie btn btn-danger" data-id="<?php echo $sessie->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>