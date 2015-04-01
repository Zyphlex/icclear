

<div class="col-md-10">        
    <h1>Admin dashboard</h1>  
    <h2>Verleden</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Begindatum</th>
                <th>Einddatum</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($verleden as $ver) { ?>
                <tr>
                    <td style="width:200px"><?php echo $ver->naam ?></td>
                    <td style="width:200px"><?php echo $ver->stad ?></td>
                    <td style="width:200px"><?php echo toDDMMYYYY($ver->beginDatum) ?></td>
                    <td style="width:200px"><?php echo toDDMMYYYY($ver->eindDatum) ?></td>
                    <td><?php echo anchor('admin/dashboard/' . $ver->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Huidige</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Begindatum</th>
                <th>Einddatum</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:230px"><?php echo $actieve->naam ?></td>
                <td style="width:200px"><?php echo $actieve->stad ?></td>
                <td style="width:200px"><?php echo toDDMMYYYY($actieve->beginDatum) ?></td>
                <td style="width:200px"><?php echo toDDMMYYYY($actieve->eindDatum) ?></td>
                <td style="width:200px"><?php echo anchor('admin/dashboard/' . $actieve->id, 'Beheren', 'class="btn btn-default"'); ?></td>
            </tr>

        </tbody>
    </table>

    <h2>Aankomende</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Begindatum</th>
                <th>Einddatum</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($toekomenden as $toe) { ?>
                <tr>
                    <td style="width:230px"><?php echo $toe->naam ?></td>
                    <td style="width:200px"><?php echo $toe->stad ?></td>
                    <td style="width:200px"><?php echo toDDMMYYYY($toe->beginDatum) ?></td>
                    <td style="width:200px"><?php echo toDDMMYYYY($actieve->eindDatum) ?></td>
                    <td style="width:200px"><?php echo anchor('admin/dashboard/' . $toe->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                </tr>
<?php } ?>
        </tbody>
    </table>


<?php echo anchor('conferentie/toevoegen', 'Nieuwe conferentie toevoegen', 'class="btn btn-default"'); ?>  


</div>
