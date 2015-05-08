<script type="text/javascript">
    //Link leggen met de knoppen die gemaakt worden in lijst.php

    $(document).ready(function () {
        $(".toonItem").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/programma/detailSessie",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#onderwerp").html(jobject.onderwerp);
                        $("#omschrijving").html(jobject.omschrijving);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#onderwerp").val("");
                $("#omschrijving").val("");
            }
            // dialoogvenster openen
            $("#itemModal").modal('show');
        });

        $(".toonSpreker").click(function () {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/programma/detailSpreker",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").html(jobject.voornaam + " " + jobject.familienaam);

                        if (jobject.foto == "") {
                            $("#foto").attr("src", jobject.url + "default.jpg");
                        } else {
                            $("#foto").attr("src", jobject.url + jobject.foto);
                        }

                        $("#biografie").html(jobject.biografie);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#naam").val("");
                $("#foto").val("");
                $("#biografie").val("");
            }
            // dialoogvenster openen
            $("#sprekerModal").modal('show');
        });
    });



</script>
<div class="row">
    <h1>Voorkeuren</h1>
    <div class="col-md-12">    
        <?php
        $attributes = array('name' => 'myform', 'id' => 'myform');
        echo form_open('voorkeur/doorgeven', $attributes);
        ?>             
        <div class="row">
            <div class="col-md-12">  
                <div class="row">                
                    <div class="col-md-12"> 
                        <?php
                        $teller = 0;
                        foreach ($programma as $d) {
                            $teller++;
                            ?>
                            <h4>Conferentiedag <?php echo $teller ?> <span class="italic">(<?php echo toDDMMYYYY($d->dag->datum); ?>)</span></h4>
                            <div class="table-responsive space-bottom">
                                <table class = "table-hover table-condensed table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="w15">Tijdstip</th>
                                            <th class="w65">Onderwerp</th>                                                                                                                
                                            <th class="w20">Spreker</th>
                                        </tr>
                                    </thead>  
                                    <tbody>                        
                                        <?php foreach ($d->sessie as $p) { ?>                             
                                            <tr class="under-link">
                                                <td>
                                                  <?php echo form_checkbox(array('name' => 'gekozensessies[]', 'value' => $p->id)); ?>  
                                                </td>
                                                <td>
                                                    <p>
                                                        <span class="label label-warning">
                                                            <span aria-hidden="true" class="glyphicon glyphicon-time"></span> <?php echo $p->beginUur . ' - ' . $p->eindUur ?>
                                                        </span>
                                                    </p>
                                                </td> 
                                                <td>
                                                    <a href="" data-toggle="modal" class="toonItem" data-id="<?php echo $p->sessieId ?>">
                                                        <span class="glyphicon glyphicon-info-sign link-icon"></span> <?php echo $p->onderwerp ?>
                                                    </a>
                                                </td>                                    
                                                <td>
                                                    <a href="" data-toggle="modal" class="toonSpreker" data-id="<?php echo $p->gebruikerIdSpreker ?>"> 
                                                        <span class="glyphicon glyphicon-user link-icon"></span> <?php echo $p->spreker->voornaam . ' ' . $p->spreker->familienaam ?>
                                                    </a>
                                                </td>
                                            </tr> 
                                        <?php } ?>
                                    </tbody>
                                </table>   
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <?php if($user != null){?>
                <input type="hidden" name="gebruiker" value="<?php echo $user->id ?>"/>
                <?php } else { ?>
                <input type="hidden" name="gebruiker" value="<?php echo $geregistreerde->id ?>"/>
                <?php } ?>
                <input type="hidden" name="conferentie" value="<?php echo $conferentieId; ?>"/>
            </div>      
        </div>
        <div class="row">
            <div class="col-md-1"> </div>
            <div class="col-md-3">
                <input type="submit" value="Bevestigen" class="btn btn-default"/>
                <?php echo anchor('home/', 'Annuleer', 'class="btn btn-default"'); ?>
            </div>
        </div>    
        <?php echo form_close(); ?>                                     
    </div>
</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="onderwerp"></h3>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">                     
<?php echo form_input(array('name' => 'id', 'type' => 'hidden', 'id' => 'id')); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Omschrijving:</h3> 
                            <p id="omschrijving"></p> 
                        </div>
                    </div>
                </form>

            </div>

        </div>            
    </div>
</div>  

<div class="modal fade" id="sprekerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="naam" class="modal-title"></h3>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">                     
<?php echo form_input(array('name' => 'id', 'type' => 'hidden', 'id' => 'id')); ?>
                    <div class="row">
                        <div class="col-sm-4"><img width="100%" height="auto" id="foto" src=""></div>

                        <div class="col-sm-8">
                            <h3>Biografie:</h3> 
                            <p id="biografie"></p> 
                        </div>
                    </div>
                </form>

            </div>

        </div>            
    </div>
</div> 

