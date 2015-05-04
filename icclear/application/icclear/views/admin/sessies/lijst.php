<div class="table-responsive">
<table class="table table-beheer">
    <thead>
        <tr>            
            <th>Onderwerp</th>
            <th>Dag</th>
            <th>Tijdstip</th>
            <th>Spreker</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessies as $sessie) { ?>
            <tr>
                <td><?php echo $sessie->onderwerp ?></td>
                <?php if ($sessie->planning != null) { ?>
                    <td><?php echo toDDMMYYYY($sessie->dag->datum) ?></td>
                    <td><?php echo $sessie->planning->beginUur . " - " . $sessie->planning->eindUur ?></td>
                <?php } else { ?>
                    <td>Nog niet ingepland</td>  
                    <td><?php echo anchor('planningbeheer', '<span class="glyphicon glyphicon-calendar white"></span> Planning','class="btn btn-primary"'); ?></td>
                <?php } ?>
                <td><?php echo $sessie->spreker->voornaam . " " . $sessie->spreker->familienaam ?></td>
                <td>
                    <p>
                        <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigSessie glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $sessie->id ?>"></button>
                        <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderSessie glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $sessie->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>