<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-beheer">
    <thead>
        <tr>                                
            <th>Naam</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($landen as $land) { ?>
            <tr>
                <td><?php echo $land->naam ?></td>
                <td>
                    <button class="wijzigLand glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $land->id ?>"></button>
                    <button class="verwijderLand glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $land->id ?>"></button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>