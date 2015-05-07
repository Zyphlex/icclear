<div class="table-responsive">
    <table class="table table-beheer">
        <thead>
            <tr>                                
                <th>Naam</th>
                <th>Sessie</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programma as $d) {
                foreach ($d->programma as $p) {
                    ?>

                    <tr>
                        <td><?php echo $p->sessie->spreker->voornaam . ' ' . $p->sessie->spreker->familienaam ?></td>
                        <td><?php echo $p->sessie->onderwerp ?></td>
                        <td>
                            <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigSpreker glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $p->sessie->spreker->id ?>"></button>
                            <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderSpreker glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $p->sessie->id ?>"></button>                                 
                        </td>
                    </tr>
                <?php } ?>
<?php } ?>
        </tbody>
    </table>
</div>