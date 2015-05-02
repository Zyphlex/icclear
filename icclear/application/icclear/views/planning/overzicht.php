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

<div class='row'>
    <div class='col-md-12 underline'>
        <h1>Programma overzicht - <?php echo $actieveId->naam ?></h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Curabitur finibus tortor at erat sodales ornare. 
            Donec eget tellus sit amet purus blandit varius ac a dui. Sed lobortis laoreet eleifend. 
            Morbi tristique velit non tristique ultrices. In posuere libero malesuada porta blandit. 
            Etiam vestibulum, velit nec consequat faucibus, nisi lectus tincidunt mi, in mattis eros mauris lobortis felis. 
            Sed nec tincidunt tortor, ac fermentum sem. 
            Aliquam dignissim, tellus id tincidunt facilisis, massa lectus tincidunt lacus, in pellentesque nulla magna vel neque.
        </p>                               
    </div>
</div>


<div class='row'>
    <div class='col-md-12'>
        <h3 class="underline">Sessies</h3>        
        
                <?php
                $id = 0;
                $counter = 1;
                foreach ($planningen as $dag) {
                    if ($dag->conferentiedag->id != $id && $dag->conferentiedag->conferentieId == $actieveId->id) { ?>
                        <h4>Dag <?php echo $counter . " " . date('d',$dag->conferentiedag->datum); ?></h4>
                        <?php $counter++;
                        ?>
                <div class="table-responsive space-bottom">
                        <table class = "table-bordered table-condensed table">
                            <thead>
                                <tr>
                                    <th class="w15">Tijdstip</th>
                                    <th class="w65">Onderwerp</th>                                                                                                                
                                    <th class="w20">Spreker</th>
                                </tr>
                            </thead>  
                            <tbody>            
                                <?php $id = $dag->conferentiedag->id; ?>                
                                <?php
                                foreach ($planningen as $planning) {
                                    if ($dag->conferentiedag->id == $planning->conferentiedag->id && $planning->conferentiedag->conferentieId == $actieveId->id) {
                                        ?>
                                
                                        <tr class="under-link">
                                            <td><p>
                                                <span class="label label-warning">
                                                <span aria-hidden="true" class="glyphicon glyphicon-time"></span> <?php echo $planning->beginUur . ' - ' . $planning->eindUur ?>
                                                </span></p>
                                            </td> 
                                            <td><a href="" data-toggle="modal" class="toonItem" data-id="<?php echo $planning->sessie->id ?>"><span class="glyphicon glyphicon-info-sign link-icon"></span> <?php echo $planning->sessie->onderwerp ?></a></td>                                    
                                            <td><a href="" data-toggle="modal" class="toonSpreker" data-id="<?php echo $planning->spreker->id ?>"> <span class="glyphicon glyphicon-user link-icon"></span> <?php echo $planning->spreker->voornaam . ' ' . $planning->spreker->familienaam ?></a></td>
                                        </tr> 
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>   
                </div>
                        <?php
                    }
                }
                ?>
            </div>
            
</div>

<div class='row'>
    <div class='col-md-12'>
        <h3>Activiteiten</h3>        
        <div class="panel panel-default">
            <div class="panel-body">   
                <div class="table-responsive">
                <table class = "table-condensed table">
                    <thead>
                        <tr>
                            <th class="w15">Naam</th>
                            <th class="w65">Omschrijving</th>
                            <th class="w20">Prijs</th>
                        </tr>
                    </thead>  
                    <tbody>            
                        <?php foreach ($activiteiten as $activiteit) { ?>
                            <tr>
                                <td><?php echo $activiteit->naam ?></td>
                                <td><?php echo $activiteit->omschrijving ?></td>
                                <td><?php echo toKomma($activiteit->prijs) ?> EUR</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>         
                </div>
            </div>
        </div>

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