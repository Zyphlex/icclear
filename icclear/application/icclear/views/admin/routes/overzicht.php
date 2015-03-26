<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/routesbeheer/overzicht",
            success: function(result) {
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
        $(".verwijderItem").click(function() {
            deleteid = $(this).data("id");
            $("#modalItemDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigItem").click(function() {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/routesbeheer/detail",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#vertrekpunt").val(jobject.vertrekPunt);
                        $("#beschrijving").val(jobject.beschrijving);
                        $("#gebouw").val(jobject.gebouwId);
                        $("#url").val(jobject.url);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#vertrekpunt").val("");
                $("#beschrijving").val("");
                $("#gebouw").val("");
                $("#url").val("");
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }
    
    function sorteer() {
                $('.table').DataTable({
                    paging:false,
                    info:false
                });
            }

    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();
        sorteer();

        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanItem").click(function() {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/routesbeheer/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#modalItemDetail").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteItem").click(function() {
            $.ajax({
                type: "POST",
                url: site_url + "/routesbeheer/delete",
                async: false,
                data: {id: deleteid},
                success: function(result) {
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

    <h1>Routes beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigItem btn btn-primary" data-id="0">Nieuwe Route Toevoegen</button>
    
    
<table class="table table-beheer">
    <thead>
        <tr>                                
            <th>Vertrekpunt</th>   
            <th>Bestemming</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody
            <tr>
                <td><?php echo "vertrekPunt" ?></td>
                <td><?php echo "naam" ?></td>
                <td>
                    <button class="wijzigItem btn btn-primary" data-id="<?php echo "" ?>">Wijzigen</button>
                    <button class="verwijderItem btn btn-danger" data-id="<?php echo "" ?>">Verwijderen</button>                                 
                </td>
            </tr>
            <tr>
                <td><?php echo "aaaaaaaaaaaaaa" ?></td>
                <td><?php echo "nbbaam" ?></td>
                <td>
                    <button class="wijzigItem btn btn-primary" data-id="<?php echo "" ?>">Wijzigen</button>
                    <button class="verwijderItem btn btn-danger" data-id="<?php echo "" ?>">Verwijderen</button>                                 
                </td>
            </tr>
    </tbody>
</table>

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
                    <p><?php echo form_label('Vertrekpunt:', 'vertrekpunt'); ?></td>
                    <p><?php echo form_input(array('name' => 'vertrekpunt', 'id' => 'vertrekpunt', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Route beschrijving:', 'beschrijving'); ?></td>
                    <p><?php echo form_textarea(array('rows'=>'10','cols'=>'50','name' => 'beschrijving', 'id' => 'beschrijving', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Gebouw:', 'gebouw'); ?></td>
                    <p><?php
                        $options = array();
                        foreach ($gebouwen as $gebouw) {
                            $options[$gebouw->id] = $gebouw->naam;
                        }
                        echo form_dropdown('gebouw', $options, '', 'id="gebouw" class="form-control"');
                        ?></p>
                    
                    <p><?php echo form_label('Googlemaps URL:', 'url'); ?></td>
                    <p><?php echo form_input(array('name' => 'url', 'id' => 'url', 'class' => 'form-control')); ?></p>

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
                <p>Bent u zeker dat u deze route wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteItem btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  