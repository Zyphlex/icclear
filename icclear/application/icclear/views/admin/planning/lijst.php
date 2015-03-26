<?php foreach ($conferentiedagen as $dag) { ?>
<h2><?php echo toDDMMYYYY($dag->datum) ?></h2>
<?php } ?>
<!--<table class="table table-beheer">
    <thead>
        <tr>
            <th>Sessie</th>
            <th>Beginuur</th>
            <th>Einduur</th>
            <th>Plenair</th>
            <th>Zaal</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($planningen as $planning) { ?>
            <tr>
                <td><?php echo $planning->sessie->onderwerp ?></td>
                <td><?php echo $planning->beginUur ?></td>
                <td><?php echo $planning->eindUur ?></td>
                <?php
                if ($planning->plenair == 1) {
                    echo '<td>Ja</td>';
                }
                else
                {
                    echo '<td>Nee</td>';
                }
                ?>
                <td><?php echo $planning->zaal->naam ?></td>
                <td>
                    <p>                                        
                        <button class="wijzigPlanning btn btn-primary" data-id="<?php echo $planning->id ?>">Wijzigen</button>
                        <button class="verwijderPlanning btn btn-danger" data-id="<?php echo $planning->id ?>">Verwijderen</button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      -->