<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/inschrijvenbeheer/overzicht",
            success: function (result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
                maakInfoClick();
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
                    url: site_url + "/inschrijvenbeheer/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#gebruiker").val(jobject.gebruikerId);
                        $("#confonderdeel").val(jobject.conferentieOnderdeelId);
                        if (jobject.betalingId == null) {
                            $(':radio[name="betaling"][value="nee"]').prop('checked', 'checked');
                        }
                        else
                        {
                            $(':radio[name="betaling"][value="ja"]').prop('checked', 'checked');
                        }
                        $("#hiddenGeb").val(jobject.gebruikerId);
                        $("#methode").val(jobject.methodeId);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#gebruiker").val("");
                $("#confonderdeel").val("");
                $("#methode").val("");
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }

    //Klikken op de Details knop
    function maakInfoClick() {
        $(".detailsItem").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/profiel/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#conf1").html(jobject.gebruiker.voornaam + " " + jobject.gebruiker.familienaam);
                        var object = haalActOverzicht(iddb);
                        $("#activiteiten1").html(object);
                        $("#onderdeel").html(jobject.confond.omschrijving);
                        $("#prijs").html(jobject.confond.prijs);
                    }
                });
            }
            // dialoogvenster openen
            $("#modalItemInfo").modal('show');
        });
    }

    function haalActOverzicht(id) {
        $.ajax({type: "GET",
            url: site_url + "/inschrijvenbeheer/actDetail",
            async: false,
            data: {id: id},
            success: function (result) {
                $("#activiteiten1").html(result);
            }
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        maakInfoClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanItem").click(function () {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/inschrijvenbeheer/update",
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
                url: site_url + "/inschrijvenbeheer/delete",
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

    <h1>Ingeschrevenen</h1>  

    <div id="resultaat"></div>
    <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?> 

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

                    <input type="hidden" name="gebruikerId" id="hiddenGeb" />  
                    <p><?php echo form_label('Gebruiker:', 'gebruiker'); ?></p>
                    <p><?php
                        $optionsGebruiker = array();
                        foreach ($gebruikers as $gebruiker) {
                            $optionsGebruiker[$gebruiker->id] = $gebruiker->voornaam . " " . $gebruiker->familienaam . " (" . $gebruiker->type->omschrijving . ")";
                        }

                        echo form_dropdown('gebruiker', $optionsGebruiker, '', 'id="gebruiker" class="form-control" disabled="disabled"');
                        ?></p>

                    <p><?php echo form_label('Formule:', 'formule'); ?></p>
                    <p><?php
                        $optionsOnderdeel = array();
                        foreach ($onderdelen as $onder) {
                            $optionsOnderdeel[$onder->id] = $onder->omschrijving;
                        }

                        echo form_dropdown('confonderdeel', $optionsOnderdeel, '', 'id="confonderdeel" class="form-control"');
                        ?></p>

                    <p><?php echo form_label('Methode:', 'methode'); ?></p>
                    <p><?php
                        $optionsMethode = array();
                        foreach ($methodes as $methode) {
                            $optionsMethode[$methode->id] = $methode->omschrijving;
                        }

                        echo form_dropdown('methode', $optionsMethode, '', 'id="methode" class="form-control"');
                        ?></p>

                    <p><?php echo form_label('Betaling:', 'betaling'); ?></p>
                    <div class="">
                        <?php echo form_radio(array('name' => 'betaling', 'class' => 'form-horizontal', 'value' => 'ja')); ?>                            
                        <span class="option-title">
                            Reeds betaald
                        </span>
                    </div> 
                    <div class="">
                        <?php echo form_radio(array('name' => 'betaling', 'class' => 'form-horizontal', 'value' => 'nee')); ?>                            
                        <span class="option-title">
                            Nog niet betaald
                        </span>
                    </div> 


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

<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="modalItemInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="row">

                <div class="text-center underline">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Details voor <span id="conf1"></span></h3>
                </div>   

                <div class="modal-body">        
                    <h3><span class="bold" id="onderdeel"></span>: &euro; <span id="prijs"></span></h3>  

                    <div id="activiteiten1"></div>
                </div>

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-12 btn btn-primary" data-dismiss="modal">Sluiten</button>   
                    </div>
                </div>

            </div>       

        </div>               
    </div>
</div>  