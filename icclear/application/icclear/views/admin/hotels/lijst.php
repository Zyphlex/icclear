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
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hotels as $hotel) { ?>
            <tr>
                <td><?php echo $hotel->naam ?></td>
                <td><?php echo $hotel->gemeente ?></td>
                <td>
                    <p>                                        
                        <button class="wijzigHotel btn btn-primary" data-id="<?php echo $hotel->id ?>">Wijzigen</button>
                        <button class="verwijderHotel btn btn-danger" data-id="<?php echo $hotel->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      