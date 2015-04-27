<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Te betalen</th>
            <th>Datum</th>
            <th>Betaling</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inschrijvingen as $i) { ?>
            <tr>
                <td><?php echo $i->gebruiker->voornaam . " " . $i->gebruiker->familienaam ?></td>

                <td><?php echo "€ " . $i->geld ?>
                    <?php if ($i->betaling == null) { ?>                                        
                        <span class="right label label-danger">Nog niet betaald!</span>
                    <?php } else { ?>      
                        <span class="right label label-success">Reeds betaald!</span>
                    <?php } ?>
                </td>
                <td><?php echo toDDMMYYYY($i->datum) ?></td>
                <td><?php echo $i->type->omschrijving ?></td>
                <td>
                    <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $i->id ?>"></button>
                    <button class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $i->id ?>"></button>   
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>