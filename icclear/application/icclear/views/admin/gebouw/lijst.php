<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-beheer">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Gemeente</th>
            <th>Postcode</th>
            <th>Straat</th>
            <th>Nummer</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gebouwen as $gebouw) { ?>
            <tr>
                <td><?php echo $gebouw->naam ?></td>
                <td><?php echo $gebouw->gemeente ?></td>
                <td><?php echo $gebouw->postcode ?></td>
                <td><?php echo $gebouw->straat ?></td>
                <td><?php echo $gebouw->nummer ?></td>
                <td>
                    <p>                                        
                        <button class="wijzigGebouw btn btn-primary" data-id="<?php echo $gebouw->id ?>">Wijzigen</button>
                        <button class="verwijderGebouw btn btn-danger" data-id="<?php echo $gebouw->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      