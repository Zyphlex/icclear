<div class="table-responsive">
    <table class="table table-beheer">
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
                    <td><?php echo $aankondiging->poster->voornaam . " " . $aankondiging->poster->familienaam ?></td>
                    <td>
                        <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $aankondiging->id ?>"></button>
                        <button class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $aankondiging->id ?>"></button>                                 
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>