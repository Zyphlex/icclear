<div class="row">
    <div class="col-md-12">
        <div class=" panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Conferentie onderdelen toevoegen</h4>
            </div>

            <div class="panel-body">
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
                                    <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $ond->id ?>">Wijzigen</button>
                                    <button class="verwijderItem glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $ond->id ?>">Verwijderen</button>  
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>