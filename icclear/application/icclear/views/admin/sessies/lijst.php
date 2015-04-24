<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-beheer">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Dag</th>
            <th>Beginuur</th>
            <th>Omschrijving</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessies as $sessie) { ?>
            <tr>
                <td><?php echo $sessie->onderwerp ?></td>
                <?php if ($sessie->planning != null) { ?>
                    <td><?php echo toDDMMYYYY($sessie->conferentiedag->datum) ?></td>
                    <td><?php echo $sessie->planning->beginUur . " - " . $sessie->planning->eindUur ?></td>
                <?php } else { ?>
                    <td>Nog niet ingepland</td>  
                    <td><?php echo anchor('planningbeheer', '<span class="glyphicon glyphicon-calendar white"></span> Planning','class="btn btn-primary"'); ?></td>
                <?php } ?>
                <td><?php echo $sessie->omschrijving ?></td>
                <td>
                    <p>
                        <button class="wijzigSessie glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $sessie->id ?>"></button>
                        <button class="verwijderSessie glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $sessie->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>