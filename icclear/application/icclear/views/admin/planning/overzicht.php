<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/planningbeheer/overzicht",
            success: function (result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
                $('.table').DataTable({
                    "aaSorting": []
                });
            }
        });
    }
    
    //sessies ophalen
    function haalsessies() {
        $("#sessie").text("");
        $.ajax({type: "GET",
            url: site_url + "/planningbeheer/sessiesOver",
            success: function (result) {
                $("#sessie").html('');
                var jobject = jQuery.parseJSON(result);
                var string;
                $.each(jobject, function(index,val) {
                    string += '<option value="' + val.id + '">' + val.onderwerp + '</option>';
                });
                $("#sessie").html(string);
                }
        });
    }

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
        haalsessies();
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderPlanning").click(function () {
            deleteid = $(this).data("id");
            $("#planningDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigPlanning").click(function () {
            verbergError();
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/planningbeheer/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#datum").val(jobject.conferentiedagId);
                        $("#sessie").val(jobject.sessieId);
                        $("#beginuur").val(jobject.beginUur);
                        $("#einduur").val(jobject.eindUur);
                        $("#plenair").val(jobject.plenair);
                        $(':radio[name="plenair"][value="' + jobject.plenair + '"]').prop('checked', 'checked');
                        $("#zaal").val(jobject.zaalId);

                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#datum").val("");
                $("#sessie").val("");
                $("#beginuur").val("");
                $("#einduur").val("");
                $("#plenair").val("");
                $(':radio[name="plenair"]').prop('checked', false);
                $("#zaal").val("");
            }
            // dialoogvenster openen
            $("#planningModal").modal('show');
        });
    }

    function verbergError() {
        $("#msg").addClass("hidden");
        $('.datum').removeClass('has-error');
        $('.beginuur').removeClass('has-error');
        $('.einduur').removeClass('has-error');
        $('.sessie').removeClass('has-error');
        $('.zaal').removeClass('has-error');
        $('.plenair').removeClass('has-error');
    }
        
    //VALIDATIE
    function validatieOK() {
        ok = true;
        if($('#datum').prop('selectedIndex')==-1) {
          $('.datum').addClass('has-error');
          ok = false;
        } else {
          $('.datum').removeClass('has-error');
        }

        if($('#beginuur').val() == "") {
          $('.beginuur').addClass('has-error');
          ok = false;
        } else {
          $('.beginuur').removeClass('has-error');
        }

        if($('#einduur').val() == "") {
          $('.einduur').addClass('has-error');
          ok = false;
        } else {
          $('.einduur').removeClass('has-error');
        }

        if($('#sessie').prop('selectedIndex')==-1) {
          $('.sessie').addClass('has-error');
          ok = false;
        } else {
          $('.sessie').removeClass('has-error');
        }

        if($('#zaal').prop('selectedIndex')==-1) {
          $('.zaal').addClass('has-error');
          ok = false;
        } else {
          $('.zaal').removeClass('has-error');
        }
        
        if($('input[type=radio]:checked').size() < 0) {
          $('.plenair').addClass('has-error');
          ok = false;
        } else {
          $('.plenair').removeClass('has-error');
        }
        
        return ok;
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();
        haalsessies();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanPlanning").click(function () {
        if (validatieOK()) {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/planningbeheer/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#planningModal").modal('hide');
        } else {
            $("#msg").removeClass("hidden");
            $("#msg").html("Oops! U hebt niet alle velden ingevuld!");
        }
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deletePlanning").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/planningbeheer/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#planningDelete").modal('hide');
                }
            });
        });
    
});
</script>



<div class="col-md-10">

    <h1>Planning beheren</h1>  
    <button class="wijzigPlanning btn btn-primary" data-id="0">Nieuwe Planning Toevoegen</button>

    <div id="resultaat"></div>        

    <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?>
    <button class="wijzigPlanning btn btn-primary" data-id="0">Nieuwe Planning Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="planningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">    
                <p class="hidden alert alert-danger" role="alert" id="msg"></p>              

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="dag" id="dag" />
                    
                    <p><?php echo form_label('Datum:', 'datum'); ?></p>
                    <p class="datum"><?php
                        $optionsDag = array();
                        foreach ($dagen as $dag) {
                            $optionsDag[$dag->id] = toDDMMYYYY($dag->datum);
                        }
                        echo form_dropdown('datum', $optionsDag, '', 'id="datum" class="form-control"');
                        ?>
                    </p>

                    <p><?php echo form_label('Beginuur:', 'beginuur'); ?></p>
                    <p class="beginuur"><?php echo form_input(array('name' => 'beginuur', 'id' => 'beginuur', 'class' => 'form-control', 'type' => 'time')); ?></p>

                    <p><?php echo form_label('Einduur:', 'einduur'); ?></p>
                    <p class="einduur"><?php echo form_input(array('name' => 'einduur', 'id' => 'einduur', 'class' => 'form-control', 'type' => 'time')); ?></p>

                    <p><?php echo form_label('Sessie:', 'sessie'); ?></p>
                    <p class="sessie"><?php echo form_dropdown('sessie', array(), '', 'id="sessie" class="form-control" required'); ?></p>

                    <p><?php echo form_label('Zaal:', 'zaal'); ?></p>
                    <p class="zaal">
                        <?php
                        $optionsZaal = array();
                        foreach ($zalen as $d) {
                            foreach ($d->zalen as $z) {
                                    $optionsZaal[$z->id] = $z->naam . " (" . $d->gebouw->naam . " , " . $z->maximumAantalPersonen . " maximum aantal plaatsen)";
                            }
                        }
                        echo form_dropdown('zaal', $optionsZaal, '', 'id="zaal" class="form-control"');
                        ?>
                    </p>

                    <p><?php echo form_label('Plenair:', 'plenair'); ?> </p>
                    <p class="plenair">
                        <?php echo form_radio(array('name' => 'plenair', 'class' => 'plenair', 'value' => '1')); ?> Ja
                        <?php echo form_radio(array('name' => 'plenair', 'class' => 'plenair', 'value' => '0')); ?> Nee
                    </p>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanPlanning btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="planningDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze planning wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deletePlanning btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  