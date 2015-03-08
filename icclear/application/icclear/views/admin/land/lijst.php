<table class="table table-beheer">
    <thead>
        <tr>                                
            <th>Naam</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($landen as $land) { ?>
            <tr>
                <td><?php echo $land->naam ?></td>
                <td>
                    <button class="wijzigLand btn btn-primary" data-id="<?php echo $land->id ?>">Wijzigen</button>
                    <button class="verwijderLand btn btn-danger" data-id="<?php echo $land->id ?>">Verwijderen</button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>