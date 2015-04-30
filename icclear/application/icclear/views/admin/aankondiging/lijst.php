<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
    
<table class="table table-responsive table-beheer">
    <thead>
        <tr>                                
            <th>Titel</th>   
            <th>Inhoud</th>
            <th>Gepost door</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($aankondigingen as $aankondiging) { ?>
            <tr>
                <td><?php echo $aankondiging->titel ?></td>
                <td><?php echo $aankondiging->inhoud ?></td>
                <td><?php echo $aankondiging->poster->voornaam ?></td>
                <td>
                    <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $aankondiging->id ?>"></button>
                    <button class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $aankondiging->id ?>"></button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>