

<div class="col-md-10">

    <h1>Gebruikers beheren</h1>  
    <table class="table">
        <thead>
            <tr>
                <th>Familienaam</th>
                <th>Voornaam</th>
                <th>Email</th>
                <th>Type</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gebruikers as $gebruiker) { ?>
                <tr>
                    <td><?php echo $gebruiker->familienaam ?></td>
                    <td><?php echo $gebruiker->voornaam ?></td>
                    <td><?php echo $gebruiker->emailadres ?></td>
                    <?php if ($gebruiker->typeId == 1) { ?>
                        <td>Bezoeker</td>
                    <?php } else { ?>
                        <td>Spreker</td>
                    <?php } ?>

                    <td><?php echo anchor('gebruiker/wijzigAdmin/' . $gebruiker->id, 'Wijzigen', 'class="btn btn-default"'); ?>
                        <?php echo anchor('gebruiker/verwijder/' . $gebruiker->id, 'Verwijderen', 'class="btn btn-default"'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <?php echo anchor('gebruiker/nieuw', 'Nieuwe gebruiker toevoegen', 'class="btn btn-default"'); ?> 

</div>
