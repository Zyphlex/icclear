<table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Dag</th>
            <th>Beginuur</th>
            <th>Einduur</th>
            <th>Zaal</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessies as $sessie) { ?>
            <tr>
                <td><?php echo $sessie->onderwerp ?></td>
                <?php if ($sessie->planning != null) { ?>
                    <td><?php echo toDDMMYYYY($sessie->conferentiedag->datum) ?></td>
                    <td><?php echo $sessie->planning->beginUur ?></td>
                    <td><?php echo $sessie->planning->eindUur ?></td>
                    <td><?php echo $sessie->planning->zaal->naam ?></td>
                <?php } else { ?>
                    <td colspan="5">Nog niet ingepland</td>
                <?php } ?>
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