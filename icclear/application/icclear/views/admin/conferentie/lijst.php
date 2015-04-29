<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<h2>Conferentie onderdelen</h2>

<table class="table table-responsive table-beheer">
    <thead>
        <tr>
            <th><label for="formule">Onderdeel</label></th>
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
                    <button class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $ond->id ?>"></button>  
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<button class="wijzigItem btn btn-primary" data-id="0"><span class="btn glyphicon glyphicon-plus white"></span> Toevoegen</button>
