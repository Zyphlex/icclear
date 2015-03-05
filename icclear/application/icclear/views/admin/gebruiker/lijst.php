<table class="table table-beheer">
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
                <td>
                    <p>                                        
                        <button class="wijzigFaq btn btn-primary" data-id="<?php echo $gebruiker->id ?>">Wijzigen</button>
                        <button class="verwijderFaq btn btn-danger" data-id="<?php echo $gebruiker->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      