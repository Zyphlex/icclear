<div class="table-responsive">
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
                    <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigLand glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $land->id ?>"></button>
                    <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderLand glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $land->id ?>"></button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>