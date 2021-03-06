<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/sponsorbeheer/overzicht",
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
        $(".verwijderSponsor").click(function() {
            deleteid = $(this).data("id");
            $("#sponsorDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigSponsor").click(function() {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/sponsorbeheer/detail",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#land").val(jobject.landId);
                        $("#postcode").val(jobject.postcode);
                        $("#gemeente").val(jobject.gemeente);
                        $("#straat").val(jobject.straat);
                        $("#nummer").val(jobject.nummer);
                        $("#type").val(jobject.type);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#naam").val("");
                $("#land").val("");
                $("#postcode").val("");
                $("#gemeente").val("");
                $("#straat").val("");
                $("#nummer").val("");
                $("#type").val("");
            }
            // dialoogvenster openen
            $("#sponsorModal").modal('show');
        });
    }

    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteSponsor").click(function() {
            $.ajax({
                type: "POST",
                url: site_url + "/sponsorbeheer/delete",
                async: false,
                data: {id: deleteid},
                success: function(result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#sponsorDelete").modal('hide');
                }
            });
        });

    });
</script>


<div class="col-md-10">

    <h1>Sponsor beheren</h1>  
    <button class="wijzigSponsor btn btn-primary" data-id="0">Nieuwe Sponsor Toevoegen</button>

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigSponsor btn btn-primary" data-id="0">Nieuwe Sponsor Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="sponsorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <?php
                $attributes = array('id' => 'JqAjaxForm', 'name' => 'JqAjaxForm', 'enctype' => 'multipart/form-data');
                echo form_open('sponsorbeheer/update', $attributes);
                ?>
                <input type="hidden" name="id" id="id" />
                <p><?php echo form_label('Naam:', 'naam'); ?></p>
                <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Land:', 'land'); ?></p>
                <p><?php
                    $optionsLand = array();
                    foreach ($landen as $land) {
                        $optionsLand[$land->id] = $land->naam;
                    }

                    echo form_dropdown('land', $optionsLand, '', 'id="land" class="form-control"');
                    ?></p>

                <p><?php echo form_label('Gemeente:', 'gemeente'); ?></td>
                <p><?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Postcode:', 'postcode'); ?></td>
                <p><?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Straat:', 'straat'); ?></td>
                <p><?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Nummer:', 'nummer'); ?></td>
                <p><?php echo form_input(array('name' => 'nummer', 'id' => 'nummer', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Type:', 'type'); ?></td>
                <p><?php $optionsType = array('Sponsor' => 'Sponsor', 'Partner' => 'Partner');
                    echo form_dropdown('type', $optionsType, '', 'class="form-control"');
                    ?></p>

                <p><?php echo form_label('Afbeelding:', 'userfile'); ?></p>
                <p><?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control')); ?></p>
                <div>JPG, max grootte 200kB, 350x350 pixels</div>

            </div>

            <div class="modal-footer">
<?php echo form_submit(array('name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Opslaan')); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
<?php echo form_close(); ?>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="sponsorDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze sponsor wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteSponsor btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  