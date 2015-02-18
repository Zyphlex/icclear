

    <div class="col-md-10">
        
        <h1>Admins beheren</h1>  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Familienaam</th>
                                <th>Voornaam</th>
                                <th>Email</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admins as $admin) {?>
                            <tr>
                                <td><?php echo $admin->familienaam ?></td>
                                <td><?php echo $admin->voornaam ?></td>
                                <td><?php echo $admin->emailadres ?></td>
                                <td><?php echo anchor('gebruiker/wijzigAdmin/' . $admin->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('gebruiker/verwijderAdmin/' . $admin->id, 'Verwijderen','class="btn btn-default"'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?> 
        <?php echo anchor('gebruiker/nieuwAdmin', 'Nieuwe admin toevoegen','class="btn btn-default"'); ?> 
        
    </div>
