

<div class="col-md-10">
    
    <h1>Gebruikers beheren.</h1>   
    
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
                            <th>Gebruiker ID</th>
                            <th>Familienaam</th>
                            <th>Voornaam</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inschrijvingen as $inschrijving) { ?>
                            <tr>
                                <td><?php echo $inschrijving->omschrijving; ?></td>
                                <td><?php echo $inschrijving->inschrijving->gebruikerId; ?></td>
                                <td><?php echo $inschrijving->gebruiker->voornaam; ?></td>
                                <td>
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
