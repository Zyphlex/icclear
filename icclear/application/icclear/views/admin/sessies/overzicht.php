

<div class="col-md-10">
    
    <h1>Sessies beheren.</h1>   
    
    <div class="panel panel-default" role="tablist">

        <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
                <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                    Sessies
                </span>
            </h4>
        </div>

        <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Dag</th>
                            <th>Beginuur</th>
                            <th>Einduur</th>
                            <th>Zaal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sessies as $sessie) { ?>
                            <tr>
                                <td><?php echo $sessie->onderwerp ?></td>
                                <td><?php echo toDDMMYYYY($sessie->conferentiedag->datum) ?></td>
                                <td><?php echo $sessie->planning->beginUur ?></td>
                                <td><?php echo $sessie->planning->eindUur ?></td>
                                <td><?php echo $sessie->zaal->naam ?></td>
                                <td>
                                    <?php echo anchor('sessies/wijzigen/' . $sessie->id, 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('sessies/verwijderen' , 'Verwijderen','class="btn btn-default"'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    <?php echo anchor('sessies/toevoegen' . $sessie->id, 'Nieuwe sessie toevoegen','class="btn btn-default"'); ?>                           
    
    
</div>
