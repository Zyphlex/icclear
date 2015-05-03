<table class="table table-responsive table-beheer">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Gebouw</th>
            <th>Max personen</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($zalen as $zaal) { ?>
            <tr>
                <td><?php echo $zaal->naam ?></td>
                <td><?php echo $zaal->gebouw->naam ?></td>
                <td><?php echo $zaal->maximumAantalPersonen ?></td>
                <td>
                    <p>                                        
                        <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigZaal glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $zaal->id ?>"></button>
                        <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderZaal glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $zaal->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      