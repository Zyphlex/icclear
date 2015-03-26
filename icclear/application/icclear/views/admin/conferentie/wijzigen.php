<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/conferentie/overzicht",
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
                    url: site_url + "/conferentie/detail",
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

    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();
        
        $('.table').DataTable();
        
        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanItem").click(function() {
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
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteItem").click(function() {
            $.ajax({
                type: "POST",
                url: site_url + "/conferentie/delete",
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
    <h1>Conferentie wijzigen.</h1>

        <?php
        $attributes = array('class' => 'registreer', 'id' => 'myForm', 'method'=>'post');
        echo form_open('', $attributes);
        ?>
        
        <div class="row">  
            <div class="col-md-2 control-label">
                <?php echo form_label('Naam:', 'naam');?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("class" => "form-control", "type" => "text", "name" => "naam", "value" => $conferentie->naam)); ?>
            </div>
        </div>

        <br/>
        
        <div class="row">    
            <div class="col-md-2 control-label">
                <?php echo form_label('Begin datum:','begindatum'); ?>
            </div>
            <div class="col-md-4">    
                <?php echo form_input(array("disabled" => "true","class" => "form-control", "type" => "date", "name" => "begindatum", "value" => $conferentie->beginDatum)); ?>
            </div>
            
            <div class="col-md-2 control-label  border-left">
                <?php echo form_label('Eind datum:','einddatum'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("disabled" => "true","class" => "form-control", "type" => "date", "name" => "einddatum", "value" => $conferentie->eindDatum)); ?>
            </div>
        </div>
        
        <br/>
        
        <div class="row">     
            <div class="col-md-2 control-label">    
                <?php echo form_label('Land:','land'); ?>   
            </div>
            <div class="col-md-4">                  
                <?php
                    $opties = array();
                    foreach ($landen as $land) {
                        $opties[$land->id] = $land->naam;
                }?>
                <?php echo form_dropdown('land', $opties, $conferentie->landId, 'id="land" class="form-control"'); ?>
            </div>            
            
            <div class="col-md-2 control-label border-left">   
                <?php echo form_label('Stad:', 'stad') ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array('value' => $conferentie->stad ,'type' => 'text', 'id' => 'stad', 'name' => 'stad', 'class' => 'form-control')); ?>
            </div>
        </div>
        
        <br/>
        
        <div class="row">    
            <div class="col-md-3 control-label">  
                <?php echo form_label('Max inschrijvingen','maxinschrijvingen') ?>
            </div>
            <div class="col-md-2">
                <?php echo form_input(array('value'=>$conferentie->maxInschrijvingen,'type'=>'number','class'=>'form-control','name'=>'maxinschrijvingen')) ?>               
            </div>
        </div>
        
        <div class="row">      
            <div class="col-md-3 control-label">       
                <?php echo form_label('Seminariedag:','seminariedag') ?>
            </div>
            <div class="col-md-2">    
                <?php if($conferentie->seminarieDag == 1){ ?>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'1','checked'=>'checked')); ?>
                    Ja</label>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'0')); ?>
                    Nee</label>    
                <?php } else {?>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'1')); ?>
                    Ja</label>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'0','checked'=>'checked')); ?>
                    Nee</label>
                <?php } ?>
            </div>
        </div>       
        
        <br/><br/>
        
        
        <br/><br/>
        
        <div class="row">
            <div class="col-md-12">
                <?php echo form_label('Beschrijving:','beschrijving') ?> 
            </div>

            <div class="col-md-12">
                <?php echo form_textarea(array('value'=>$conferentie->beschrijving,'rows'=>'10','name'=>'beschrijving','class'=>'form-control')) ?>
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
                <?php echo form_hidden('id',$conferentie->id); ?>
                
                <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>         
                <?php echo form_submit(array('value'=>'Opslaan','class'=>'btn btn-default')) ?>            
            </div>
        </div>
        
    <?php echo form_close(); ?>
        
        
    <div id="resultaat"></div>

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
                    <p><?php echo form_label('Onderdeel omschrijving:', 'onderdeel'); ?></td>
                    <p><?php echo form_input(array('name' => 'onderdeel', 'id' => 'onderdeel', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Prijs:', 'prijs'); ?></td>
                    <p><?php echo form_input(array('name' => 'prijs', 'id' => 'prijs', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Korting:', 'korting'); ?></td>
                    <p><?php echo form_input(array('name' => 'korting', 'id' => 'korting', 'class' => 'form-control')); ?>%</p>
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
