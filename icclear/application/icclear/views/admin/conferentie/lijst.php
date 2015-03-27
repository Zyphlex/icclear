
<h2>Conferentie onderdelen</h2>

<table class="table">
    <thead>
        <tr>
            <th><label for="formule">Formule</label></th>
            <th><label for="prijs">Prijs</label></th>
            <th><label for="korting">Korting</label></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($onderdelen as $ond) { ?>                        
            <tr>
                <td><?php echo $ond->omschrijving ?></td>
                <td><?php echo $ond->prijs ?></td>
                <td><?php echo $ond->korting ?></td>
                <td>
                    <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $ond->id ?>"></button>
                    <button class="verwijderItem glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $ond->id ?>"></button>  
                </td>
            </tr>
        <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button class="verwijderItem glyphicon glyphicon-plus btn btn-primary" data-id="0"></button>
                </td>
            </tr>
    </tbody>
</table>
