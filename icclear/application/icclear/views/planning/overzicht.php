<script type="text/javascript">
    //Link leggen met de knoppen die gemaakt worden in lijst.php
    $(document).ready(function () {
        $(".toonItem").click(function () {
//            var iddb = $(this).data("id");
//            $("#id").val(iddb);
//            if (iddb != 0) {
//                // gegevens ophalen via ajax (doorgeven van server met json)
//                $.ajax({type: "GET",
//                    url: site_url + "/land/detail",
//                    async: false,
//                    data: {id: iddb},
//                    success: function (result) {
//                        var jobject = jQuery.parseJSON(result);
//                        $("#naam").val(jobject.naam);                        
//                    }
//                });
//            } else {
//                // bij toevoegen gewoon vakken leeg maken                
//                $("#naam").val("");                
//            }
            // dialoogvenster openen
            $("#itemModal").modal('show');
        });        
    });
//    //function maakDetailClick() {
//        $(".sessie").click(function () {
//            /* var iddb = $(this).data("id");
//            $("#id").val(iddb);
//            if (iddb != 0) {
//                // gegevens ophalen via ajax (doorgeven van server met json)
//                $.ajax({type: "GET",
//                    url: site_url + "/sessies/detail",
//                    async: false,
//                    data: {id: iddb},
//                    success: function (result) {
//                        var jobject = jQuery.parseJSON(result);
//                        $("#onderwerp").val(jobject.onderwerp);
//                        $("#omschrijving").val(jobject.omschrijving);
//                    }
//                });
//            } else {
//                // bij toevoegen gewoon vakken leeg maken
//                $("#onderwerp").val("");
//                $("#omschrijving").val("");
//            } */
//            alert("test6");
//            // dialoogvenster openen
//            $("#test").modal('show');
//        });
//    //}
//    
//    //maakDetailClick();
    
    

</script>

<div class='row'>
    <div class='col-md-12'>
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
        <h3>Sessies</h3>        
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                $id = 0;
                $counter = 1;
                foreach ($planningen as $dag) {
                    if ($dag->conferentiedag->id != $id && $dag->conferentiedag->conferentieId == $actieveId->id) {
                        echo "\n" . '<h4>Dag ' . $counter . '</h4>' . "\n";
                        $counter++;
                        ?>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th><span class="glyphicon glyphicon-time"></span> Tijdstip</th>
                                    <th><span class="glyphicon glyphicon-paperclip"></span> Onderwerp</th>                                                                                                                
                                    <th><span class="glyphicon glyphicon-bullhorn"></span> Spreker</th>
                                </tr>
                            </thead>  
                            <tbody>            
                                <?php $id = $dag->conferentiedag->id; ?>                
                                <?php
                                foreach ($planningen as $planning) {
                                    if ($dag->conferentiedag->id == $planning->conferentiedag->id && $planning->conferentiedag->conferentieId == $actieveId->id) {
                                        ?>
                                        <tr>
                                            <td><?php echo $planning->beginUur . ' - ' . $planning->eindUur ?></td> 
                                            <td><a href="" class="sessie" data-id="<?php echo $planning->sessie->id ?>"><?php echo $planning->sessie->onderwerp ?></a></td>                                    
                                            <td><?php echo $planning->spreker->voornaam . ' ' . $planning->spreker->familienaam ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>   
                        <br/>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>    
</div>

<div class='row'>
    <div class='col-md-12'>
        <h3>Activiteiten</h3>        
        <div class="panel panel-default">
            <div class="panel-body">                
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                            <th>Prijs</th>
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



<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">                     
                    <?php echo form_input(array('name' => 'id', 'type'=>'hidden', 'id' =>'id'));?>
                    <p><?php echo form_label('Naam:', 'naam'); ?></p>
                    <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>                   
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanLand btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  


<!--<div class="modal" id="test" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <div class="modal-body">                  
                <p>Test</p>

            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Sluiten</button>
            </div>

        </div>            
    </div>
</div> -->