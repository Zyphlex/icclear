

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
                            <th>Familienaam</th>
                            <th>Voornaam</th>
                            <th>Beheer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inschrijvingen as $inschrijving) { ?>
                            <tr>                                
                                <td><?php echo $inschrijving->gebruiker->familienaam; ?></td>
                                <td><?php echo $inschrijving->gebruiker->voornaam; ?></td>
                                <td>
                                    <?php echo anchor('gebruiker/gebruikersConferentie', 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('gebruiker/gebruikersConferentie', 'Verwijderen','class="btn btn-default"'); ?>
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
