

<div class="col-md-10">
    
    <h1>Hotels beheren.</h1>   
    
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
                            <th>Naam</th>
                            <th>Gemeente</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hotels as $hotel) { ?>
                            <tr>
                                <td><?php echo $hotel->naam ?></td>
                                <td><?php echo $hotel->gemeente ?></td>
                                <td>
                                    <?php echo anchor('#', 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('#', 'Verwijderen','class="btn btn-default"'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
<!--            </div>
        </div>

    </div>-->
    
    <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>                           
    
    
</div>
