<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/sponsorbeheer/overzicht",
            success: function(result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
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
                        $("#land").val(jobject.land);
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

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanSponsor").click(function() {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/sponsorbeheer/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#sponsorModal").modal('hide');
        });

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

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <p><?php echo form_label('Naam:', 'naam'); ?></p>
                    <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Land:', 'land'); ?></p>
                    <p><?php
                        $optionsLand = array();
                        foreach ($landen as $land) {
                            $optionsLand[$land->id] = $land->naam;
                        }
                        echo form_dropdown('land', $optionsLand, 'class="form-control"');
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
                    <p><?php
                        $optionsType = array('Sponsor' => 'Sponsor', 'Partner' => 'Partner');
                        if ($sponsor->type == 'Sponsor') {
                            echo form_dropdown('type', $optionsType, 'Sponsor', 'class="form-control"');
                        } else {
                            echo form_dropdown('type', $optionsType, 'Partner', 'class="form-control"');
                        }
                        ?></p>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanSponsor btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

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
                <p>Bent u zeker dat u deze vraag wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteSponsor btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  