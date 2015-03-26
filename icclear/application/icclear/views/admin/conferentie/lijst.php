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
                                <td><input type="text" class="form-control" name="formule"><?php echo $ond->omschrijving ?></td>
                                <td><input type="text" class="form-control" name="prijs"><?php echo $ond->prijs ?></td>
                                <td><input type="text" class="form-control" name="korting"><?php echo $ond->korting ?></td>
                                <td>
                                    <a href="" class="glyphicon glyphicon-ok-sign btn btn-default"></a>
                                    <a href="" class="glyphicon glyphicon-remove-sign btn btn-default"></a>
                                </td>
                            </tr>
                        <?php } ?>
                        
                        <tr>
                            <td><input type="text" class="form-control" name="formule"></td>
                            <td><input type="text" class="form-control" name="prijs"></td>
                            <td><input type="text" class="form-control" name="korting"></td>
                            <td>
                                <a href="" class="glyphicon glyphicon-plus-sign btn btn-default"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>