<div class="table-responsive">
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
                            <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigAdmin glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $admin->id ?>"></button>
                            <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderAdmin glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $admin->id ?>"></button> 
                        </p>                                 
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>      
</div>