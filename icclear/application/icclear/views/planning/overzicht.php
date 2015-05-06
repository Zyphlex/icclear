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

<div class='row '>
    <div class='col-md-12'>
        <h1>Programma overzicht - <?php echo $conferentie->naam . " " . "<span class='italic'>(" . toDDMMYYYY($conferentie->beginDatum) . " - " . toDDMMYYYY($conferentie->eindDatum) . ")</span>" ?></h1>
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
        <h2 class="underline-full">Sessies</h2>        

        <?php $teller = 0; foreach ($programma as $d) { $teller++; ?>
        <h4>Conferentiedag <?php echo $teller ?> <span class="italic">(<?php echo toDDMMYYYY($d->datum); ?>)</span></h4>
            <div class="table-responsive space-bottom">
                <table class = "table-hover table-condensed table">
                    <thead>
                        <tr>
                            <th class="w15">Tijdstip</th>
                            <th class="w65">Onderwerp</th>                                                                                                                
                            <th class="w20">Spreker</th>
                        </tr>
                    </thead>  
                    <tbody>                        
                        <?php foreach ($d->programma as $p) { ?>                             
                            <tr class="under-link">
                                <td>
                                    <p>
                                        <span class="label label-warning">
                                            <span aria-hidden="true" class="glyphicon glyphicon-time"></span> <?php echo $p->beginUur . ' - ' . $p->eindUur ?>
                                        </span>
                                    </p>
                                </td> 
                                <td>
                                    <a href="" data-toggle="modal" class="toonItem" data-id="<?php echo $p->sessieId ?>">
                                        <span class="glyphicon glyphicon-info-sign link-icon"></span> <?php echo $p->sessie->onderwerp ?>
                                    </a>
                                </td>                                    
                                <td>
                                    <a href="" data-toggle="modal" class="toonSpreker" data-id="<?php echo $p->sessie->gebruikerIdSpreker ?>"> 
                                        <span class="glyphicon glyphicon-user link-icon"></span> <?php echo $p->sessie->spreker->voornaam . ' ' . $p->sessie->spreker->familienaam ?>
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

<div class='row space-bottom'>
    <div class='col-md-12'>
        <h2 class="underline-full">Activiteiten</h2>        
        
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
                            <td>&euro; <?php echo toKomma($activiteit->prijs) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
        </div>    
        
    </div>
</div>


<div class='row'>
    <?php echo anchor('','Inschrijven voor "' . $conferentie->naam .'"', 'class="col-sm-6 col-sm-offset-3 btn btn-large btn-primary"') ?>
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







