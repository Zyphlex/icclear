

<div class="col-md-10">
    
    <h1>Sessies keuren</h1>
    
<!--    <div class="panel panel-default" role="tablist">

        <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
                <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                    Sessies
                </span>
            </h4>
        </div>

        <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <div class="panel-body">-->
                <table class="table">
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
                                    <a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails" data-toggle="modal" data-target="#myModal">Details</a>
                                    <?php echo anchor('sessies/wijzigen/' . $sessie->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('sessies/verwijderen' . $sessie->id, 'Verwijderen','class="btn btn-default"'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
<!--            </div>
        </div>

    </div>-->
    
    <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>                           
    
    
</div>

<!--      Modal        -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>