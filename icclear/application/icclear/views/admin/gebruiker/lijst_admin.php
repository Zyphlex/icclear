<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-beheer">
    <thead>
        <tr>            
            <th>Voornaam</th>
            <th>Familienaam</th>
            <th>Emailadres</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($admins as $admin) { ?>
            <tr>                
                <td><?php echo $admin->voornaam ?></td>
                <td><?php echo $admin->familienaam ?></td>
                <td><?php echo $admin->emailadres ?></td>
                <td>
                    <p>                                        
                        <button class="wijzigAdmin glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $admin->id ?>"></button>
                        <button class="verwijderAdmin glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $admin->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      