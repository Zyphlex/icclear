<table class="table table-responsive">
    <thead>
        <?php if ($sessies == null) { ?>
        <br>
        <p>Er zijn geen sessies om gekeurd te worden.</p>
        <br>
    <?php } else { ?>
        <tr>
            <th>Onderwerp</th>
            <th>Spreker</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($sessies as $sessie) {
            ?>
            <tr>
                <td><?php echo $sessie->onderwerp; ?></td>
                <td><?php echo $sessie->spreker->familienaam . ' ' . $sessie->spreker->voornaam; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails/<?php echo $sessie->id; ?>" data-toggle="modal" data-target="#myModal" title="Details" class="glyphicon glyphicon-info-sign btn btn-info"></a>
                    <button title="Goedkeuren" class="goedVoorstel glyphicon glyphicon-ok btn btn-success" data-id="<?php echo $sessie->id ?>"></button>                                    
                    <button title="Afkeuren" class="verwijderVoorstel glyphicon glyphicon-remove  btn btn-danger" data-id="<?php echo $sessie->id ?>"></button>   
                </td>
            </tr>
        <?php
        }
    }
    ?>
</tbody>
</table>          