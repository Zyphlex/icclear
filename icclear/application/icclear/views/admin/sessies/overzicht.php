

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
                            <th>Beheer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sessies as $sessie) { ?>
                            <tr>
                                <td><?php echo $sessie->onderwerp ?></td>
                                <td><?php echo date($sessie->conferentiedag->datum, 'l') ?></td>
                                <td><?php echo $sessie->planning->beginUur ?></td>
                                <td><?php echo $sessie->planning->eindUur ?></td>
                                <td><?php echo $sessie->zaal->naam ?></td>
                                <td><?php echo anchor('admin/dashboard/' . $sessie->id, 'Beheren','class="btn btn-default"'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
