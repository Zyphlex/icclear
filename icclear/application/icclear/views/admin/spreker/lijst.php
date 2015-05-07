<div class="table-responsive">
    <table class="table table-beheer">
        <thead>
            <tr>                                
                <th>Naam</th>
                <th>Sessie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programma as $d) {
                foreach ($d->programma as $p) {
                    ?>

                    <tr>
                        <td><?php echo $p->sessie->spreker->voornaam . ' ' . $p->sessie->spreker->familienaam ?></td>
                        <td><?php echo $p->sessie->onderwerp ?></td>
                    </tr>
                <?php } ?>
<?php } ?>
        </tbody>
    </table>
</div>