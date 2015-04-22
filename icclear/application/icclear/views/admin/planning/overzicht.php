<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/planningbeheer/overzicht",
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
        $(".verwijderPlanning").click(function () {
            deleteid = $(this).data("id");
            $("#planningDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigPlanning").click(function () {
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

                $("#sessie").val("");
                $("#beginuur").val("");
                $("#einduur").val("");
                $("#plenair").val("");
                $("#zaal").val("");
            }
            // dialoogvenster openen
            $("#planningModal").modal('show');
        });
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanPlanning").click(function () {
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

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

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

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />

                    <p><?php echo form_label('Datum:', 'datum'); ?></p>
                    <?php
                    $drop = array();
                    foreach ($dagen as $dag) {
                        $drop[$dag->id] = $dag->datum;
                    }
                    echo form_dropdown('datum', $drop, '', 'id="datum" class="form-control"');
                    ?>
                    
                    <p><?php echo form_label('Beginuur:', 'beginuur'); ?></p>
                    <p><?php echo form_input(array('name' => 'beginuur', 'id' => 'beginuur', 'class' => 'form-control', 'type' => 'time')); ?></p>

                    <p><?php echo form_label('Einduur:', 'einduur'); ?></p>
                    <p><?php echo form_input(array('name' => 'einduur', 'id' => 'einduur', 'class' => 'form-control', 'type' => 'time')); ?></p>

                    <p><?php echo form_label('Sessie:', 'sessie'); ?></p>
                    <?php
                    $drop = array();
                    $teller = 1;
                    foreach ($sessies as $sessie) {
                        $drop[$sessie->id] = $sessie->onderwerp;
                        $teller++;
                    }
                    echo form_dropdown('sessie', $drop, '', 'id="sessie" class="form-control"');
                    ?>

                    <p><?php echo form_label('Zaal:', 'zaal'); ?></p>
                    <?php
                    $drop = array();
                    $teller = 1;
                    foreach ($zalen as $zaal) {
                        $drop[$zaal->id] = $zaal->naam;
                        $teller++;
                    }
                    echo form_dropdown('zaal', $drop, '', 'id="zaal" class="form-control"');
                    ?>

                    <p><?php echo form_label('Plenair:', 'plenair'); ?> </p>
                    <p>
                        <?php echo form_radio(array('name' => 'plenair', 'class' => 'form-horizontal', 'value' => '1')); ?> Ja
                        <?php echo form_radio(array('name' => 'plenair', 'class' => 'form-horizontal', 'value' => '0')); ?> Nee
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