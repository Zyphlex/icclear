<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/gebouw/overzicht",
            success: function(result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
                $('.table').DataTable({
                    "aaSorting": []
                });
            }
        });
    }

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderGebouw").click(function() {
            deleteid = $(this).data("id");
            $("#gebouwDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigGebouw").click(function() {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/gebouw/detail",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#postcode").val(jobject.postcode);
                        $("#gemeente").val(jobject.gemeente);
                        $("#straat").val(jobject.straat);
                        $("#nummer").val(jobject.nummer);
                        $("#land").val(jobject.landId);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#naam").val("");
                $("#postcode").val("");
                $("#gemeente").val("");
                $("#straat").val("");
                $("#nummer").val("");
                $("#land").val("");
            }
            // dialoogvenster openen
            $("#gebouwModal").modal('show');
        });
    }

    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteGebouw").click(function() {
            $.ajax({
                type: "POST",
                url: site_url + "/gebouw/delete",
                async: false,
                data: {id: deleteid},
                success: function(result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#gebouwDelete").modal('hide');
                }
            });
        });

    });
</script>


<div class="col-md-10">

    <h1>Gebouw beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigGebouw btn btn-primary" data-id="0">Nieuwe Gebouw Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="gebouwModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <?php
                $attributes = array('id' => 'JqAjaxForm', 'name' => 'JqAjaxForm', 'enctype' => 'multipart/form-data');
                echo form_open('gebouw/update', $attributes);
                ?>
                <input type="hidden" name="id" id="id" />
                <p><?php echo form_label('Naam:', 'naam'); ?></p>
                <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Gemeente:', 'gemeente'); ?></td>
                <p><?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Postcode:', 'postcode'); ?></td>
                <p><?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Straat:', 'straat'); ?></td>
                <p><?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Nummer:', 'nummer'); ?></td>
                <p><?php echo form_input(array('name' => 'nummer', 'id' => 'nummer', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Land:', 'land'); ?></p>
                <p><?php
                   $opties = array();
                   foreach ($landen as $land) {
                       $opties[$land->id] = $land->naam;
                   } ?>
                <?php echo form_dropdown('land', $opties, $conferentie->landId, 'id="land" class="form-control"'); ?>
                </p>
                
                <p><?php echo form_label('Afbeelding:', 'userfile'); ?></p>
                <p><?php echo form_upload(array('type'=>'file','name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control')); ?></p>

            </div>

            <div class="modal-footer">
                <?php echo form_submit(array('name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Opslaan')) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
            <?php echo form_close(); ?>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="gebouwDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze gebouw wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteGebouw btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  