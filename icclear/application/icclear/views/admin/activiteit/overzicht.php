<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/activiteit/overzicht",
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
        $(".verwijderActiviteit").click(function () {
            deleteid = $(this).data("id");
            $("#activiteitDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigActiviteit").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/activiteit/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#omschrijving").val(jobject.omschrijving);
                        $("#conferentie").val(jobject.conferentieId);
                        $("#prijs").val(jobject.prijs);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken                
                $("#naam").val("");
                $("#omschrijving").val("");
                $("#conferentie").val("");
                $("#prijs").val("");
            }
            // dialoogvenster openen
            $("#activiteitModal").modal('show');
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanActiviteit").click(function () {            
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/activiteit/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#activiteitModal").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteActiviteit").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/activiteit/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#activiteitDelete").modal('hide');
                }
            });
        });

    });
</script>

<div class="col-md-10">

    <h1>Activiteiten beheren </h1>  
    <button class="wijzigActiviteit btn btn-primary" data-id="0">Nieuwe activiteit toevoegen</button>

    <div id="resultaat"></div>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <button class="wijzigActiviteit btn btn-primary" data-id="0">Nieuwe activiteit toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="activiteitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">                     
                    <?php                    
                    echo form_input(array('name' => 'id', 'type'=>'hidden', 'id' =>'id'));                    
                    ?>
                    <p><?php echo form_label('Naam:', 'naam'); ?></p>
                    <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>
                    
                    <p><?php echo form_label('Omschrijving:', 'omschrijving'); ?></p>
                    <p><?php echo form_textarea(array('name' => 'omschrijving', 'id' => 'omschrijving', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Conferentie:', 'conferentie'); ?></p>                    
                    <?php
                    $drop = array();
                    foreach ($conferenties as $conferentie) {
                        $drop[$conferentie->id] = $conferentie->naam;
                    }
                    ?>
                    <p><?php echo form_dropdown('conferentie', $drop, '', 'id="conferentie" class="form-control"'); ?></p>

                    <p><?php echo form_label('Prijs:', 'prijs'); ?></p>
                    <p><?php echo form_input(array('name' => 'prijs', 'id' => 'prijs', 'class' => 'form-control')); ?></p>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanActiviteit btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="activiteitDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze activiteit wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteActiviteit btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  