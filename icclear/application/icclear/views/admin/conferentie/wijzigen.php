<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/conferentie/overzicht",
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

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderItem").click(function () {
            deleteid = $(this).data("id");
            $("#modalItemDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigItem").click(function () {
            verbergError();
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/conferentie/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#onderdeel").val(jobject.omschrijving);
                        $("#prijs").val(jobject.prijs);
                        $("#korting").val(jobject.korting);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#onderdeel").val("");
                $("#prijs").val("");
                $("#korting").val("");
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }

    function verbergError() {
        $("#msg").addClass("hidden");
        $('.onderdeel').removeClass('has-error');
        $('.prijs').removeClass('has-error');
        $('.korting').removeClass('has-error');
    }

    //VALIDATIE
    function validatieOK() {
        ok = true;

        if ($('#onderdeel').val() == "") {
            $('.onderdeel').addClass('has-error');
            ok = false;
        } else {
            $('.onderdeel').removeClass('has-error');
        }

        if ($('#prijs').val() == "") {
            $('.prijs').addClass('has-error');
            ok = false;
        } else {
            $('.prijs').removeClass('has-error');
        }

        if ($('#korting').val() == "") {
            $('.korting').addClass('has-error');
            ok = false;
        } else {
            $('.korting').removeClass('has-error');
        }

        return ok;
    }


    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        $('.table').DataTable();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanItem").click(function () {
            if (validatieOK()) {
                var dataString = $("#JqAjaxForm:eq(0)").serialize();
                $.ajax({
                    type: "POST",
                    url: site_url + "/conferentie/update",
                    async: false,
                    data: dataString,
                    dataType: "json"
                });
                refreshData();
                $("#modalItemDetail").modal('hide');
            } else {
                $("#msg").removeClass("hidden");
                $("#msg").html("Oops! U hebt niet alle velden ingevuld!");
            }
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteItem").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/conferentie/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#modalItemDelete").modal('hide');
                }
            });
        });

    });
</script>

<div class="col-md-10">
    <h1>Conferentie</h1>

    <?php if (count($inschrijvingen) >= 1) { ?>
        <div class="space-bottom alert alert-warning">
            <h3>Opgelet! De conferentie kan niet meer gewijzigd worden!</h3>
            <p class="space-bottom15">Er zijn al <span class="bold"><?php echo count($inschrijvingen) ?></span> inschrijvingen gevonden!</p>
        </div>
    <?php } ?>

    <div id="resultaat"></div>    

    <h2>Conferentie wijzigen</h2>


    <?php
    $attributes = array('class' => 'registreer', 'id' => 'myForm', 'method' => 'post');
    echo form_open('conferentie/opslaan', $attributes);
    ?>

    <div class="row">  
        <div class="col-md-2 control-label">
            <?php echo form_label('Naam:', 'naam'); ?>
        </div>
        <div class="col-md-4">
            <?php echo form_input(array("class" => "form-control", "required" => "required", "type" => "text", "name" => "naam", "value" => $conferentie->naam)); ?>
        </div>
    </div>

    <br/>

    <div class="row">    
        <div class="col-md-2 control-label">
            <?php echo form_label('Begin datum:', 'begindatum'); ?>
        </div>
        <div class="col-md-4">    
            <?php echo form_input(array("disabled" => "true", "class" => "form-control", "type" => "date", "name" => "begindatum", "value" => $conferentie->beginDatum)); ?>
        </div>

        <div class="col-md-2 control-label  border-left">
            <?php echo form_label('Eind datum:', 'einddatum'); ?>
        </div>
        <div class="col-md-4">
            <?php echo form_input(array("disabled" => "true", "class" => "form-control", "type" => "date", "name" => "einddatum", "value" => $conferentie->eindDatum)); ?>
        </div>
    </div>

    <br/>

    <div class="row">     
        <div class="col-md-2 control-label">    
            <?php echo form_label('Land:', 'land'); ?>   
        </div>
        <div class="col-md-4">                  
            <?php
            $opties = array();
            foreach ($landen as $land) {
                $opties[$land->id] = $land->naam;
            }
            ?>
            <?php echo form_dropdown('land', $opties, $conferentie->landId, 'id="land" class="form-control" required="required"'); ?>
        </div>            

        <div class="col-md-2 control-label border-left">   
            <?php echo form_label('Stad:', 'stad') ?>
        </div>
        <div class="col-md-4">
            <?php echo form_input(array('value' => $conferentie->stad, 'type' => 'text', 'id' => 'stad', 'name' => 'stad', 'class' => 'form-control', "required" => "required")); ?>
        </div>
    </div>

    <br/>

    <div class="row">    
        <div class="col-md-3 control-label">  
            <?php echo form_label('Max inschrijvingen', 'maxinschrijvingen') ?>
        </div>
        <div class="col-md-2">
            <?php echo form_input(array('value' => $conferentie->maxInschrijvingen, 'type' => 'number', 'class' => 'form-control', 'name' => 'maxinschrijvingen', "required" => "required")) ?>               
        </div>
    </div>

    <div class="row">      
        <div class="col-md-3 control-label">       
            <?php echo form_label('Seminariedag:', 'seminariedag') ?>
        </div>
        <div class="col-md-2">    
            <?php if ($conferentie->seminarieDag == 1) { ?>
                <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '1', 'checked' => 'checked', "required" => "required")); ?>
                    Ja</label>
                <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '0', "required" => "required")); ?>
                    Nee</label>    
            <?php } else { ?>
                <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '1', "required" => "required")); ?>
                    Ja</label>
                <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '0', 'checked' => 'checked', "required" => "required")); ?>
                    Nee</label>
            <?php } ?>
        </div>
    </div>       

    <br/><br/>


    <br/><br/>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_label('Beschrijving:', 'beschrijving') ?> 
        </div>

        <div class="col-md-12">
            <?php echo form_textarea(array('value' => $conferentie->beschrijving, 'rows' => '10', 'name' => 'beschrijving', 'class' => 'form-control', "required" => "required")) ?>
        </div>
    </div>        

    <br/><br/>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>





    <br/>

    <div class="row">
        <div class="col-md-12">   
            <?php echo form_hidden('id', $conferentie->id); ?>

            <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?> 
            <?php if (count($inschrijvingen) < 1) { ?>
                <?php echo form_submit(array('value' => 'Opslaan', 'class' => 'btn btn-primary')) ?>          
            <?php } ?>
        </div>
    </div>

    <br/>

    <?php echo form_close(); ?>



</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="modalItemDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <p><?php echo form_label('Onderdeel omschrijving:', 'onderdeel'); ?></p>
                    <p class="onderdeel"><?php echo form_input(array('name' => 'onderdeel', 'id' => 'onderdeel', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Prijs:', 'prijs'); ?></p>
                    <p class="prijs">
                    <div class="input-group">
                        <span class="input-group-addon">&euro;</span>
                        <?php echo form_input(array('name' => 'prijs', 'id' => 'prijs', 'class' => 'form-control')); ?>
                    </div>
                    </p>

                    <p><?php echo form_label('Korting:', 'korting'); ?></p>
                    <p class="korting">
                    <div class="input-group">
                        <span class="input-group-addon">&percnt;</span>
                        <?php echo form_input(array('name' => 'korting', 'id' => 'korting', 'class' => 'form-control')); ?>
                    </div>
                    </p>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanItem btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="modalItemDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u dit onderdeel wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteItem btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  
