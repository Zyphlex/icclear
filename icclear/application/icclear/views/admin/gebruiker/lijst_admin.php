<table class="table table-beheer">
    <thead>
        <tr>
            <th>Gebruikersnaam</th>
            <th>Voornaam</th>
            <th>Familienaam</th>
            <th>Emailadres</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($admins as $admin) { ?>
            <tr>
                <td><?php echo $admin->gebruikersnaam ?></td>
                <td><?php echo $admin->voornaam ?></td>
                <td><?php echo $admin->familienaam ?></td>
                <td><?php echo $admin->emailadres ?></td>
                <td>
                    <p>                                        
                        <button class="wijzigAdmin btn btn-primary" data-id="<?php echo $admin->id ?>">Wijzigen</button>
                        <button class="verwijderAdmin btn btn-danger" data-id="<?php echo $admin->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      