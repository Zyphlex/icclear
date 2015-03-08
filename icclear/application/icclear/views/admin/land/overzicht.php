<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/land/overzicht",
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
        $(".verwijderLand").click(function () {
            deleteid = $(this).data("id");
            $("#landDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigLand").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/land/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#conferentie").val(jobject.conferentieId);
                        $("#prijs").val(jobject.prijs);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken                
                $("#naam").val("");
                $("#conferentie").val("");
                $("#prijs").val("");
            }
            // dialoogvenster openen
            $("#landModal").modal('show');
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanLand").click(function () {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/land/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#landModal").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteLand").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/land/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#landDelete").modal('hide');
                }
            });
        });

    });
</script>

    <div class="col-md-10">
        
        <h1>Landen beheren</h1>  
        
        <div id="resultaat"></div>
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>        
    <button class="wijzigLand btn btn-primary" data-id="0">Nieuw land toevoegen</button>
        
    </div>

<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="landModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                    <p><?php echo form_label('Conferentie:', 'conferentie'); ?></p>                    
                    <?php
                    $drop = array();
                    $teller = 1;
                    foreach ($conferenties as $conferentie) {
                        $drop[$teller] = $conferentie->naam;
                        $teller++;
                    }
                    ?>
                    <p><?php echo form_dropdown('conferentie', $drop, '', 'id="conferentie"'); ?></p>

                    <p><?php echo form_label('Prijs:', 'prijs'); ?></p>
                    <p><?php echo form_input(array('name' => 'prijs', 'id' => 'prijs', 'class' => 'form-control')); ?></p>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanLand btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="landDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u dit land wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteLand btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  