

<div class="col-md-10">
    
    <h1>Sessies keuren</h1>
    
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
                                    <a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails/<?php echo $sessie->id; ?>" data-toggle="modal" data-target="#myModal" class="btn btn-default">Details</a>
                                    <?php echo anchor('sessies/goedkeuren/' . $sessie->id, 'Goedkeuren','class="btn btn-default"'); ?>
                                    <?php echo anchor('sessies/afkeuren/' . $sessie->id, 'Afkeuren','class="btn btn-warning"'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>             
    <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>                           
    <?php echo anchor('sessies', 'Terug naar sessies','class="btn btn-default"'); ?>                           
    
    
</div>

<!--      Modal voor details       -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>