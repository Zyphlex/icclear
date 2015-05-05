<script type="text/javascript">
    $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    //Klikken op de Details knop
    function maakDetailClick() {
        $(".detailsItem").click(function() {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/profiel/detail",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#conf1").html(jobject.conferentie.naam);  
                        haaloverzicht(iddb);
                    }
                });
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }
    
    function haaloverzicht(var id) {
        $.ajax({type: "GET",
            url: site_url + "/profiel/overzicht",
            data: {id: id},
            success: function (result) {
                $("#activiteiten1").html(result);
            }
        });
    }
    
    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
    });
</script>

<div class="row">
    <div class="col-sm-2">
        <div class="equalizer panel panel-default">
            <div class="panel-body">
                <div class="space-bottom15">
                <?php if ($gebruiker->foto == 'spreker' . $gebruiker->id . '.jpg') { ?>
                    <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $gebruiker->foto; ?>" 
                         alt="Foto <?php echo$gebruiker->familienaam . ' ' . $gebruiker->voornaam; ?>" 
                         title="Foto <?php echo$gebruiker->familienaam . ' ' . $gebruiker->voornaam; ?>"
                         height="150" width="auto" data-placement="top">
                 <?php } else { ?>
                    <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/default.jpg'; ?>" 
                         alt="Foto niet beschikbaar" title="Foto niet beschikbaar" height="150" width="auto" data-placement="top">
                 <?php } ?>
                </div>

                    <div class="divider"></div>

                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a></li>
                    <li role="presentation"><a href="#conferenties" aria-controls="conferenties" role="tab" data-toggle="tab">Conblue-back ferenties<span class="pull-right badge"><?php echo count($inschrijvingen); ?></span></a></li>?php $count=0; foreach ($inschrijvingen as $i) { if ($i->betalingId != null) { $count++; }} ?en); ?></span></a></li>
                    <li role="presentation"><a href="#betalingen" aria-controls="betalingen" role="tab" data-toggle="tab">Bblue-back etalingen<span class="pull-ri$countijvingen->betalingId)); ?></span></a></li>                        
                </ul>
            </div>   
        </div>
    </div>
    
    
    <div class="col-sm-10">                
        <div role="tabpanel">

            <!-- Tab panes -->
            <div class="tab-content">role="tabpanel" class="tab-pane active" id="account">
                <div class="equalizer panel panel-default">
                    <div class="panel-body">
                unt">
                    <h1 class="margin-top">Profiel wijzigen</h1>
                    

                    <?php
                    $attributes = array('name' => 'myform', 'id' => 'myform');
                    echo form_open('profiel/update', $attributes);
                    echo form_hidden('id', $gebruiker->id);
                    ?>
                    <div class="row">
                                 
<div class="row">
                                    <div class="col-md-4">   
                                    <?php echo form_label('Voornaam:', 'voornaam'); ?>
                                </div>

                                <div class="col-md-8">
                                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'field2', 'value' => $gebruiker->voornaam, 'class' => 'form-control')); ?>
                                </div>
      
<div class="row">
                                    <div class="col-md-4">   
                                    <?php echo form_label('Familienaam:', 'familienaam'); ?>                
                                </div>

                                <div class="col-md-8">                   
                                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'value' => $gebruiker->familienaam, 'class' => 'form-control')); ?>
                                </div>
      
                            
                            
                            
<div class="row">
                                    <div class="col-md-4">   
                                    <?php echo form_label('E-mailadres:', 'emailadres'); ?>                                
                                </div>  

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadres', 'value' => $gebruiker->emailadres, 'class' => 'form-control', 'disabled' => 'disabled')); ?>
                                </div>
           <div class="row">
                                <div class="col-md-4">
                                    <?php echo form_label('Geboortedatum:', 'geboortedatum'); ?>                                                
                                </div>

                                <div class="col-md-8"> 
                                    <?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatum', 'value' => $gebruiker->geboortedatum, 'class' => 'form-control', 'style' => 'width: 158px;', 'tabindex' => '0', 'type' => 'date')); ?>                
                                </div>
  
<div class="row">
                                    <div class="col-md-4">   
                                    <?php echo form_label('Geslacht:', 'geslacht'); ?>                                                                
                                </div>  

                                <div class="col-md-8">        
                                    <div class="my-radio">
                                        <?php
                                        if (strtolower($gebruiker->geslacht) == "man") {
                                            ?>
                                            <div class="">
                                                <?php echo form_input(array('name' => 'geslacht', 'id' => 'man', 'value' => 'Man', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                            
                                                <span class="option-title">
                                                    Man
                                                </span>
                                            </div> 
                                            <div class="">
                                                <?php echo form_input(array('name' => 'geslacht', 'id' => 'vrouw', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                            
                                                <span class="option-title">
                                                    Vrouw
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="">
                                                <?php echo form_input(array('name' => 'geslacht', 'id' => 'man', 'value' => 'Man', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                            
                                                <span class="option-title">
                                                    Man
                                                </span>
                                            </div> 
                                            <div class="">
                                                <?php echo form_input(array('name' => 'geslacht', 'id' => 'vrouw', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                            
                                                <span class="option-title">
                                                    Vrouw
                                                </span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                                                        </div>
                                </div>                           
                        </div>

                        <div class="col-md-6 border-left">      
                            <div class="row">
                                <div class="col-md-4">  
                                    <?php echo form_label('Land:', 'land'); ?>                   
                                </div>

                                <div class="col-md-8">   
                                    <?php
                                    foreach ($landen as $land) {
                                        $options[$land->id] = $land->naam;
                                    }
                                    echo form_dropdown('land', $options, $gebruiker->landId, 'class="form-control" id="field9"');
                                    ?>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <?php echo form_label('Gemeente:', 'gemeente'); ?>                       
                                    </div>

                                    <div class="col-md-8">   
                                        <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'value' => $gebruiker->gemeente, 'class' => 'form-control')); ?>                    
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <?php echo form_label('Postcode:', 'postcode'); ?>                                          
                                    </div>

                                    <div class="col-md-8">   
                                        <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'value' => $gebruiker->postcode, 'class' => 'form-control')); ?>                    
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <?php echo form_label('Straat:', 'straat'); ?>                       
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="straat" value="<?php echo $gebruiker->straat; ?>" id="field11" class="form-control">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="huisnummer">
                                            Huisnummer:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="number" name="huisnummer" value="<?php echo $gebruiker->nummer; ?>" id="field12" class="form-control">
                                    </div>
                                </div>                                    
                            </div>
                        </div>         
                    </div>
                        <?php echo anchor('home', 'Annuleer', 'class="btn btn-default"'); ?>
                        <?php echo form_submit('profiel/update', 'Opslaan', 'class="btn btn-primary"'); ?>
                        <?php echo form_close(); ?> 
                 </div>echo form_close(); ?> 
                </div>

                <div rtab-pane" id="conferenties">
                <div class="equalizer panel panel-default">
                    <div class="panel-body">
                unt"e" id="conferenties">

                    <h1 class="margin-top">Ingeschreven conferenties</h1>
                    <?php foreach ($inschrijvingen as $i) { ?>
                        <?php if ($i != null && $i->conferentieId == $conferentie->id) { ?<div class=" table-responsive">
                            <table class="table">                </tr>

            head>                </tr>

                                <tr>
                         w30        <th class="w35">Conferentie</th>
                          15">Plaats</th>
                                    <th class="w20">Periode</th>
                                    <th class="w20">Bedrag</th>
                                    <th class="w5"></th>
                                    <th class="w5">Details<th class="w18">Bedrag</th>
          </tr>
                                </thead>
                              
             
                   tbody>
             
                           ($i->betaling == null) { ?> ?>
                                                          
              <tr class="danger">
taald!</span>
                                        <?php } else { ?>      
              <tr class="success">
taald!</span>
                                        <?php } ?>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                  &euro; <?php echo toKomma($i->geld); ?></td>                   </td>
              <td>            php echo $i->geld; ?>
                                                          
                           ($i->betaling == null) { ?> ?>
                                                          
                                         textass="right label label-danger">Nog niet betaald!</span>
                                        <?php } else { ?>      
                                         textass="right label label-success">Reeds betaald!</span>
                                        <?php } ?>
                                      </td>
              <td class="center-block">
                                        <button data-toggle="tooltip" data-placement="bottom" title="Details bekijken" class="detailsItem glyphicon glyphicon-info-sign btn btn-primary" data-id="<?php echo $i->id ?>"></button>                                           <?php } ?>
                                    </td>
               
                                </tbody>
                            </table>
                 </table>
   /div               </table>
                        <?php } ?>
                    <?php } ?>
                            
                    <h1 class="margin-top">Afgelopen conferenties</h1>
                    <?php foreach ($inschrijvingen as $i) { ?>
                        <?php if ($i != null && $i->conferentieId != $conferentie->id) { ?>
       div class=" table-responsive">
                            <table class="table">                </tr>

            head>                </tr>

                                <tr>
                         w30        <th class="w35">Conferentie</th>
                          15">Plaats</th>
                                    <th class="w20">Periode</th>
                                    <th class="w20">Bedrag</th>
                                    <th class="w5"></th>
                                    <th class="w5">Details<th class="w18">Bedrag</th>
          </tr>
                                </thead>
                              
             
                   tbody>
             
                           ($i->betaling == null) { ?> ?>
                                                          
              <tr class="danger">
taald!</span>
                                        <?php } else { ?>      
              <tr class="success">
taald!</span>
                                        <?php } ?>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                  &euro; <?php echo toKomma($i->geld); ?></td>                   </td>
              <td>            php echo $i->geld; ?>
                                                          
                           ($i->betaling == null) { ?> ?>
                                                          
                                         textass="right label label-danger">Nog niet betaald!</span>
                                        <?php } else { ?>      
                                         textass="right label label-success">Reeds betaald!</span>
                                        <?php } ?>
                                      </td>
              <td class="center-block">
                                        <button data-toggle="tooltip" data-placement="bottom" title="Details bekijken" class="detailsItem glyphicon glyphicon-info-sign btn btn-primary" data-id="<?php echo $i->id ?>"></button>                                           <?php } ?>
                                    </td>
               
                                </tbody>
                            </table>
                 </table>
   /div               </table>
                        <?php } ?>
                    <?php } ?>
                <</div>
                </div>                      
                
                <div rtab-pane" id="betalingen">
                <div class="equalizer panel panel-default">
                    <div class="panel-body">
                unt"    pane" id="betalingen">
                    <h1 class="margin-top">Betalingen</h1>                    
                    <?php foreach ($inschrijvingen as $i) { ?>
                        <?php if ($i != null && $i->betaling != null) { ?>
   div class="table-responsive">
                        <table class="table">
           </tr>

            head>
           </tr>

                                <tr>
                     w30">Conferentie</th>
                                <th class="w25">Datum</th>
                                <th class="w25">Methode</th>
                                <th class="w20    <th class="profBed">Bedrag</th>                                 
                            </tr>
       /thead>
                            <tbody                  </tr>
                            <tr>
                                <td><?php echo $i->conferentie->naam; ?></td>
                                <td><?php echo $i->datum; ?></td>
                                <td><?php echo $i->type->omschrijving; ?></td>
              &euro;                   <td><?php echo $i->geld; ?></td>                                    
                            </tr>
      </tbody                  </tr>
                        </table>
   /div               </table>
                        <?php } ?>
                    <?php } ?>
                </div>                        
              </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="modalItemDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="row">
                
                <div class="text-center underline">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Details voor <span id="conf1"></span></h3>
                </div>   
                
                <table id="activiteiten1">
                    
                </table>
                

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-12 btn btn-primary" data-dismiss="modal">Sluiten</button>   
                    </div>
                </div>
                
            </div>       
            
        </div>               
    </div>
</div>  