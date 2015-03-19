<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/routesbeheer/overzicht",
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
                    url: site_url + "/routesbeheer/detail",
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
                url: site_url + "/routesbeheer/update",
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
                url: site_url + "/routesbeheer/delete",
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

    <h1>Routes beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigSponsor btn btn-primary" data-id="0">Nieuwe Route Toevoegen</button>

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
                    <p><?php echo form_label('Vertrekpunt:', 'vertrekpunt'); ?></td>
                    <p><?php echo form_input(array('name' => 'vertrekpunt', 'id' => 'vertrekpunt', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Route beschrijving:', 'beschrijving'); ?></td>
                    <p><?php echo form_textarea(array('rows'=>'10','cols'=>'50','name' => 'beschrijving', 'id' => 'beschrijving', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Gebouw:', 'gebouw'); ?></td>
                    <p><?php
                        $options = array();
                        foreach ($gebouwen as $gebouw) {
                            $options[$gebouw->id] = $gebouw->naam;
                        }
                        echo form_dropdown('gebouw', $options, '', 'id="gebouw" class="form-control"');
                        ?></p>
                    
                    <p><?php echo form_label('Googlemaps URL:', 'url'); ?></td>
                    <p><?php echo form_input(array('name' => 'url', 'id' => 'url', 'class' => 'form-control')); ?></p>

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
                <p>Bent u zeker dat u deze route wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteSponsor btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  