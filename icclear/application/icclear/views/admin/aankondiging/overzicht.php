<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/aankondiging/overzicht",
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
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/aankondiging/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#titel").val(jobject.titel);
                        $("textarea[name=inhoud]").html(jobject.inhoud);

                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#titel").val("");
                $("textarea[name=inhoud]").html("");
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }

    function verbergError() {
        $("#msg").addClass("hidden");
        $('.titel').removeClass('has-error');
        $('.inhoud').removeClass('has-error');
    }

    //VALIDATIE
    function validatieOK() {
        ok = true;

        if ($('#titel').val() == "") {
            $('.titel').addClass('has-error');
            ok = false;
        } else {
            $('.titel').removeClass('has-error');
        }

        if ($('#inhoud').val() == "") {
            $('.inhoud').addClass('has-error');
            ok = false;
        } else {
            $('.inhoud').removeClass('has-error');
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
                    url: site_url + "/aankondiging/update",
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
                url: site_url + "/aankondiging/delete",
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

    <h1>Aankondigingen beheren</h1>  
    <button class="wijzigItem btn btn-primary" data-id="0">Nieuwe Aankondiging Toevoegen</button>

    <div id="resultaat"></div>        

    <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?>
    <button class="wijzigItem btn btn-primary" data-id="0">Nieuwe Aankondiging Toevoegen</button>

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
                    <p><?php echo form_label('Titel:', 'titel'); ?></p>
                    <p class="titel"><?php echo form_input(array('name' => 'titel', 'id' => 'titel', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Inhoud:', 'inhoud'); ?></p>
                    <p class="inhoud"><?php echo form_textarea(array('name' => 'inhoud', 'id' => 'inhoud', 'rows' => '10', 'cols' => '50', 'class' => 'form-control')); ?></p>

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
                <p>Bent u zeker dat u deze aankondiging wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteItem btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  