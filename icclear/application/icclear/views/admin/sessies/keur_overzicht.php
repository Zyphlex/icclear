<script type="text/javascript">    
    //Wijzigen refreshen
    function refreshData() {
        maakDeleteClick();                
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderVoorstel").click(function () {
            deleteid = $(this).data("id");
            $("#voorstelAfkeuren").modal('show');
        });
    }
    
    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php        
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();


        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteVoorstel").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/sessies/afkeuren",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#voorstelAfkeuren").modal('hide');
                }
            });
        });

    });
</script>
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
                                    <button class="verwijderVoorstel btn btn-danger" data-id="<?php echo $sessie->id ?>">Afkeuren</button>   
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>             
    <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>                           
    <?php echo anchor('sessies', 'Terug naar sessies','class="btn btn-default"'); ?>                           
    
    
    <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderLand glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $land->id ?>"></button>                                 
    
</div>

<!--      Modal voor details       -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>

<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="voorstelAfkeuren" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u dit voorstel wilt afkeuren (en dus verwijderen)?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteVoorstel btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  