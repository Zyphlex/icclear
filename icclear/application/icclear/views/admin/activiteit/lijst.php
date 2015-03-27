<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-beheer">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Conferentie</th>
            <th>Prijs</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activiteiten as $activiteit) { ?>
            <tr>
                <td><?php echo $activiteit->naam ?></td>
                <td><?php echo $activiteit->conferentie->naam ?></td>
                <td><?php echo "€ " . $activiteit->prijs ?></td>

                <td>
                    <button class="wijzigActiviteit btn btn-primary" data-id="<?php echo $activiteit->id ?>">Wijzigen</button>
                        <button class="verwijderActiviteit btn btn-danger" data-id="<?php echo $activiteit->id ?>">Verwijderen</button> 
                </td>    
            </tr>
        <?php } ?>
    </tbody>
</table>
