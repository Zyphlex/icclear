<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/adminbeheer/overzicht",
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
        $(".verwijderAdmin").click(function () {
            deleteid = $(this).data("id");
            $("#adminDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigAdmin").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/adminbeheer/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#voornaama").val(jobject.voornaam);
                        $("#familienaama").val(jobject.familienaam);
                        $("#emailadresa").val(jobject.emailadres);
                        $("#wachtwoorda").val(jobject.paswoord);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken                
                $("#voornaama").val("");
                $("#familienaama").val("");
                $("#emailadresa").val("");
                $("#wachtwoorda").val("");
            }
            // dialoogvenster openen
            $("#adminModal").modal('show');
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanAdmin").click(function () {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/adminbeheer/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#adminModal").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteAdmin").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/adminbeheer/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#adminDelete").modal('hide');
                }
            });
        });

    });
</script>


<div class="col-md-10">

    <h1>Admin beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigAdmin btn btn-primary" data-id="0">Nieuwe Admin Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <p><?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaama', 'class' => 'form-control')); ?></p>                               

                    <p><?php echo form_label('Familienaam:', 'familienaam'); ?></p>
                    <p><?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaama', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Emailadres:', 'emailadres'); ?></p>
                    <p><?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadresa', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Wachtwoord:', 'wachtwoord'); ?></p>
                    <p><?php echo form_password(array('name' => 'wachtwoord', 'id' => 'wachtwoorda', 'class' => 'form-control')); ?></p>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanAdmin btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="adminDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze admin wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteAdmin btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  