<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/inschrijven/overzicht",
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
            deletebetaalid = $(this).data("gebruiker");
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
                    url: site_url + "/inschrijven/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        
                        var jobject = jQuery.parseJSON(result);
                        $("#gebruiker").val(jobject.gebruikerId);
                        $("#confonderdeel").val(jobject.conferentieOnderdeelId);
                        $("#betalingId").val(jobject.betalingId);
                        $("#methode").val(jobject.methodeId);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#gebruiker").val("");
                $("#confonderdeel").val("");
                $("#betalingId").val("");
                $("#methode").val("");
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
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
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/inschrijven/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#modalItemDetail").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteItem").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/inschrijven/delete",
                async: false,
                data: {id: deleteid, gebruiker: deletebetaalid},
                success: function (result) {
                    alert(deleteid + " " + deletebetaalid);
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

    <h1>Ingeschrevenen</h1>  

    <div id="resultaat"></div>

    <?php echo anchor('admin/dashboard' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?> 
    <button class="wijzigItem btn btn-primary" data-id="0">Nieuwe inschrijving toevoegen</button>

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

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="gebruiker" id="gebruiker" />


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
                <p>Bent u zeker dat u deze gebruiker wilt uitschrijven?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteItem btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  