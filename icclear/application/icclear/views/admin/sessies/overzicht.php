

<div class="col-md-10">
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
                            <th>Stad</th>
                            <th>Begin datum</th>
                            <th>Beheer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gebruikers as $gebruiker) { ?>
                            <tr>
                                <td><?php echo $sessie->onderwerp ?></td>
                                <td><?php echo $sessie->sessie->beginUur ?></td>
                                <td><?php echo $sessie->zaalId ?></td>
                                <td><?php echo anchor('admin/dashboard/' . $gebruiker->id, 'Beheren'); ?><a class="btn btn-default">Beheren</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
