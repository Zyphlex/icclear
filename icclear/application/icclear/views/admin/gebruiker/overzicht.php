<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/gebruiker/overzicht",
            success: function (result) {
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
        $(".verwijderGebruiker").click(function () {
            deleteid = $(this).data("id");
            $("#gebruikerDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigGebruiker").click(function () {
            //$(':radio[name="geslacht"][value="man"]').prop('checked', 'checked');
            //alert('hallo');
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/gebruiker/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#voornaam").val(jobject.voornaam);
                        $("#familienaam").val(jobject.familienaam);
                        $("#geboortedatum").val(jobject.geboortedatum);
                        $("#emailadres").val(jobject.emailadres);
                        $(':radio[name="geslacht"][value="' + jobject.geslacht + '"]').prop('checked', 'checked');
                        $("#type").val(jobject.typeId);
                        $(':radio[name="type"][value="' + jobject.typeId + '"]').prop('checked', 'checked');
                        $("#land").val(jobject.landId);
                        $("#gemeente").val(jobject.gemeente);
                        $("#postcode").val(jobject.postcode);
                        $("#straat").val(jobject.straat);
                        $("#nummer").val(jobject.nummer);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#voornaam").val("");
                $("#familienaam").val("");
                $("#geboortedatum").val("");
                $("#emailadres").val("");
                $("#geslacht").val("");
                $("#type").val("");
                $("#land").val("");
                $("#gemeente").val("");
                $("#postcode").val("");
                $("#straat").val("");
                $("#nummer").val("");
            }
            // dialoogvenster openen
            $("#gebruikerModal").modal('show');
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanGebruiker").click(function () {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            alert(dataString);
            $.ajax({
                type: "POST",
                url: site_url + "/gebruiker/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#gebruikerModal").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteGebruiker").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/gebruiker/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#gebruikerDelete").modal('hide');
                }
            });
        });

    });
</script>


<div class="col-md-10">

    <h1>Gebruiker beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigGebruiker btn btn-primary" data-id="0">Nieuwe gebruiker Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="gebruikerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <p><?php echo form_label('Voornaam:', 'voornaam'); ?></p>
                    <p><?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Familienaam:', 'familienaam'); ?></p>
                    <p><?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Emailadres:', 'emailadres'); ?></p>
                    <p><?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadres', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Geboortedatum:', 'geboortedatum'); ?></p>
                    <p><?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatum', 'type' => 'date', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Geslacht:', 'geslacht'); ?></p>
                    <p><?php echo form_radio(array('name' => 'geslacht',  'value' => 'man')); ?> Man
                        <?php echo form_radio(array('name' => 'geslacht', 'value' => 'vrouw')); ?> Vrouw</p>

                    <p><?php echo form_label('Type:', 'type'); ?></p>
                    <p><?php echo form_radio(array('name' => 'type', 'value' => '1')); ?> Bezoeker
                        <?php echo form_radio(array('name' => 'type', 'value' => '2')); ?> Spreker</p>

                    <p><?php echo form_label('Land:', 'land'); ?></p>                    
                    <?php
                    $drop = array();
                    $teller = 1;
                    foreach ($landen as $land) {
                        $drop[$land->id] = $land->naam;
                        $teller++;
                    }
                    ?>
                    <p><?php echo form_dropdown('land', $drop, '', 'id="land" class="form-control"'); ?></p>

                    <p><?php echo form_label('Gemeente:', 'gemeente'); ?></p>
                    <p><?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Postcode:', 'postcode'); ?></p>
                    <p><?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Straat:', 'straat'); ?></p>
                    <p><?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Huisnummer:', 'nummer'); ?></p>
                    <p><?php echo form_input(array('name' => 'nummer', 'id' => 'nummer', 'class' => 'form-control')); ?></p>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanGebruiker btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="gebruikerDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze gebruiker wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteGebruiker btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  