<table class="table table-responsive">
    <thead>
        <tr>
            <th>Onderwerp</th>
            <th>Spreker</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessies as $sessie) { ?>
            <tr>
                <td><?php echo $sessie->onderwerp; ?></td>
                <td><?php echo $sessie->spreker->familienaam . ' ' . $sessie->spreker->voornaam; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails/<?php echo $sessie->id; ?>" data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-info-sign btn btn-info">Details</a>
                    <button class="goedVoorstel glyphicon glyphicon-ok btn btn-success" data-id="<?php echo $sessie->id ?>"></button>                                    
                    <button class="verwijderVoorstel glyphicon glyphicon-remove  btn btn-danger" data-id="<?php echo $sessie->id ?>"></button>   
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>          