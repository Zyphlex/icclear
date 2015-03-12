<table class="table table-beheer">
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
                        <button class="wijzigZaal btn btn-primary" data-id="<?php echo $zaal->id ?>">Wijzigen</button>
                        <button class="verwijderZaal btn btn-danger" data-id="<?php echo $zaal->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      