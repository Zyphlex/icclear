<div class="table-responsive">
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
            <?php if ($gebruiker->activatie == "1") { ?>
                <tr>
            <?php } else { ?>
                <tr class="warning">
            <?php } ?>
                    <td><?php echo $gebruiker->familienaam ?></td>
                    <td><?php echo $gebruiker->voornaam ?></td>
                    <td>
                        <button data-toggle="tooltip" data-placement="bottom" title="Email versturen" class="emailGebruiker glyphicon glyphicon-envelope btn btn-success white" data-id="<?php echo $gebruiker->id ?>"></button>
                        <?php echo $gebruiker->emailadres ?></td>
                    <?php if ($gebruiker->typeId == 1) { ?>
                        <td>Bezoeker</td>
                    <?php } else { ?>
                        <td>Spreker</td>
                    <?php } ?>
                    <td>
                        <p>                                        
                            <button data-toggle="tooltip" data-placement="bottom" title="Gebruiker wijzigen" class="wijzigGebruiker glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $gebruiker->id ?>"></button>
                            <?php if ($gebruiker->activatie == "1") { ?>
                            <button data-toggle="tooltip" data-placement="bottom" title="Gebruiker deactiveren" class="verwijderGebruiker glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $gebruiker->id ?>"></button>                           
                            <?php } else { ?>
                            <button data-toggle="tooltip" data-placement="bottom" title="Gebruiker activeren" class="activeerGebruiker glyphicon glyphicon-ok btn btn-success" data-id="<?php echo $gebruiker->id ?>"></button> 
                            <?php } ?>
                        </p>                                 
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>     
</div>