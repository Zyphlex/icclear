<script type="text/javascript">
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    //Klikken op de Details knop
    function maakDetailClick() {
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
                        $("#conf1").html(jobject.conferentie.naam);
                        var object = haaloverzicht(iddb);
                        $("#activiteiten1").html(object);
                        $("#onderdeel").html(jobject.confond.omschrijving);
                        $("#prijs").html(jobject.confond.prijs);
                    }
                });
            }
            // dialoogvenster openen
            $("#modalItemDetail").modal('show');
        });
    }
    
    //VALIDATIE
    function validatieOK() {
        ok = true;
        
        if ($('#voornaamp').val() == "") {
            $('.voornaamp').addClass('has-error');
            ok = false;
        } else {
            $('.voornaamp').removeClass('has-error');
        }
        
        if ($('#familienaamp').val() == "") {
            $('.familienaamp').addClass('has-error');
            ok = false;
        } else {
            $('.familienaamp').removeClass('has-error');
        }
        
        if ($('#geboortedatump').val() == "") {
            $('.geboortedatump').addClass('has-error');
            ok = false;
        } else {
            $('.geboortedatump').removeClass('has-error');
        }
        
        if ($('input[type=radio]:checked').size() < 0) {
            $('.geslacht').addClass('has-error');
            ok = false;
        } else {
            $('.geslacht').removeClass('has-error');
        }

        return ok;
    }
    
    function verbergError() {
        $("#msgp").addClass("hidden");
        $('.voornaamp').removeClass('has-error');
        $('.familienaamp').removeClass('has-error');
        $('.geboortedatump').removeClass('has-error');
        $('.geslachtp').removeClass('has-error');
    }
    
    function haaloverzicht(id) {
        $.ajax({type: "GET",
            url: site_url + "/profiel/overzicht",
            async: false,
            data: {id: id},
            success: function (result) {
                $("#activiteiten1").html(result);
            }
        });
    }

    function validate() {
        ok = true;
        var password1 = $("#passwordN1").val();
        var password2 = $("#passwordN2").val();
        if (password1 == password2 && $("#passwordN2").val() != "") {
            $("#validate-statusN").text("Correct");
            $("#validate-statusN").removeClass("form-note-used");
            $("#validate-statusN").addClass("form-note-ok");
            $("#passwordN1div").removeClass("has-error");
            $("#passwordN1div").addClass("has-success");
            $("#passwordN2div").removeClass("has-error");
            $("#passwordN2div").addClass("has-success");
        } else {
            $("#validate-statusN").text("Incorrect");
            $("#validate-statusN").removeClass("form-note-ok");
            $("#validate-statusN").addClass("form-note-used");
            $("#passwordN1div").addClass("has-error");
            $("#passwordN1div").removeClass("has-success");
            $("#passwordN2div").addClass("has-error");
            $("#passwordN2div").removeClass("has-success");
            ok = false;
        }
        return ok;
    }

    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        
        $("#Profiel").click(function (e) {
            verbergError();
        });
        
        $("#VeranderPass").click(function (e) {
            e.preventDefault();
            if (validate()) {
                $("#Password").submit();
            }
        });
        
        $(".opslaanGebruiker").click(function (e) {
            e.preventDefault();
            if (validatieOK()) {
                $("#GebruikerWijzig").submit();
            } else {
                $("#msg").removeClass("hidden");
                $("#msg").html("Oops! U hebt niet alle velden ingevuld!");
            }
        });

        $("#passwordN2").keyup(validate);
    });
</script>

<div class="row">
    <div class="col-sm-2">
        <div class="equalizer panel panel-default">
            <div class="panel-body">
                <div class="space-bottom15">
                    <?php if ($gebruiker->foto == 'spreker' . $gebruiker->id . '.jpg') { ?>
                        <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $gebruiker->foto; ?>" 
                         alt="Foto <?php?php echo$gebruiker->familienaam . ' ' . $gebruiker->voornaam; ?>" 
                         title="Foto <?p    title="Foto <?php echo$gebruiker->familienaam . ' ' . $gebruiker->voornaam; ?>"
                             data-placement="top">
                         <?php } else { ?>
                        <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $gebruiker-default.jpg'; ?>" 
                         alt="Foto niet beschikbaar" title="Foto niet beschikbaar" height="150" width="auto" data-placement="tement="top">
                 <?php } ?>
                </

                    <div class="divider"></div>

                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li role="presentatiid="Profiel"ion" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a></li>
                    <li role="presentation"><a href="#conferenties" aria-controls="conferenties" role="tab" data-toggle="tab">Conblue-back ferenties<span class="pull-right badge"><?php echo count($inschrijvingen); ?></span></a></li>?php
                    $count = 0;
                    foreach ($inschrijvingen as $i) {
                        if ($i->betalingId != null) {
                            $count++;
                        }
                    }
                    ?en); ?></span></a></li>
                    <li role="presentation"><a href="#betalingen" aria-controls="betalingen" role="tab" data-toggle="tab">Bblue-back etalingen<span class="pull-ri$countijvingen->betalingId)); ?></span></a></li>                       <li class="divider"></li>
                    <li role="presentation"><a href="#wwwijzigen" aria-controls="account" role="tab" data-toggle="tab">Wachtwoord veranderen</a></li>
                </ul>                    


            </div>   
        </div>
    </div>

>
    </div>
    
    
    <div class="col-sm-10">                
        <div role="tabpanel">

            <!-- Tab panes -->
            <div class="tab-content">role="tabpanel" class="tab-pane active" id="account">
                    <div class="equalizer panel panel-default">
                        <div class="panel-body">
                            <h1>Profiel wijzigen</h1>


                            <?php
                            $attributes = array('name' => 'GebruikerWijzig', 'id' => 'GebruikerWijzig');
        ', 'id' => 'myform');
                    echo form_open('profiel/update', $attributes)        echo form_hidden('id', $gebruiker->id);
                            ?>
        </div>



                                <div class="row">
          <div class="col-sm-12">
                                    <p class="hidden alert alert-danger" role="alert" id="msgp"></p>  
span>
                          </div>
        div class="my-radio">
  <div class="col-md-6">         
                                    <div class="col-md-4 voornaamp  <div class="col-md-4">   
                                        <Voornaam:', 'voornaam', array('class'=>'voornaampdisabled' => 'disabled')); ?>
              </div>

                                    <div class="col-md-8 voornaamp">div class="col-md-8"> 
                                        <?php echo form_ivoornaam', 'id' => 'voornaampnaam', 'id' => 'field2', 'value' => $gebruiker->voornaam, 'class' => 'form-control')); ?>
              </div>
     <div class="row">
                                   familienaamp  <div class="col-md-4">   
                                        <?php echo form_label('Famili, array('class'=>'familienaamp')); ?>                d' => 'disabled')); ?>
              </div>

                                    <div class="col-md-  familienaamp">                  <div class="col-md-8"> 
                                        <?php echo form_ifamilienaam', 'id' => 'familienaamp, 'id' => 'familienaam', 'value' => $gebruiker->familienaam, 'class' => 'form-control')); ?>
              </div>



     <div class="row">
                                   emailadresp  <div class="col-md-4">   
                                        <E-mailadres:', 'emailadres'); ?>                                                      
              </div>                  </div>

                                   emailadresp">  <div class="col-md-8"> 
                                        <?php echo form_iemailadres', 'id' => 'emailadresp', 'id' => 'emailadres', 'value' => $gebruiker->emailadres, 'class' => 'form-control', 'disabled' => 'disabled')); ?>
              </div>

                                    <div class="col-md-4 geboortedatump">
col-md-4">   
                                                <?pboortedatum:', 'geboortedatum', array('class'=>'geboortedatump')); ?>      ode:', 'postcode'); ?>                                          
              </div>

                      </div>

      <div class="col-md-8 geboortedatump"> 
div class="">
                                                <?php echo form_input(array('name' => 'geboortedatum', p'id' => 'geboortedatum', 'value' => $gebruiker->geboortedatum, 'class' => 'form-control', 'style' => 'width: 158px;', 'tabindex' => '0', 'type' => 'date')); ?>                
              </div>
     <div class="row">
                                   geslachtp">   
col-md-4">   
                                                <?php echo form_label('Geslacht:', 'geslacht'); ?>                                                                
              </div>  

                </div>  

                               geslachtp  <div class="col-md-8">        
                  <div class="my-radio">
    div class="my-radio">
                                        <?php
                      if (strtolower($gebruiker->geslacht) == "man") {
    geslacht) == "man") {
                                            ?>
                          <div class="">
           <div class="">
                                                <?php echo form_input(array('name' =>man', 'value' => 'Manuw', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                            
                                                    <span class="option-title">
                                  Man
                    Vrouw
                                                </span>
                          </div> 
        <?php } else { ?>
                                            <div class="">
                                                    <?php echo form_input(array('name' => 'geslacht', 'id' => 'vrouw', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                            
                                                    <span class="option-title">
                                  Vrouw
                    Vrouw
                                                </span>
                          </div>
                                            <?php } else { ?>
        <?php } else { ?>
                                            <div class="">
                                                    <?php echo form_input(array('name' => 'geslacht', 'id' => 'man', 'value' => 'Man', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                            
                                                    <span class="option-title">
                                  Man
                    Vrouw
                                                </span>
                          </div> 
        <?php } else { ?>
                                            <div class="">
                                                    <?php echo form_input(array('name' => 'geslacht', 'id' => 'vrouw', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                            
                                                    <span class="option-title">
                                  Vrouw
                    Vrouw
                                                </span>
                          </div>
        div class="my-radio">
                                        <?php
                      }>geslacht) == "man") {
                                            ?>
                  </div>                                                          
              </div>>                                                
                                </div>

                             6 border-left">      
                </div>



                                <div class="row">
                  <div class="col-md-4">  
        v class="col-md-4">  
                                    <?php echo form_label('Land:', 'land'); ?>                   
                  </div>

                  </div>

                                    <div class="col-md-8">   
                      <?php
                        <?php
                                    foreach ($landen as $land) {
                          $options[$land->id] = $land->naam;
        d->id] = $land->naam;
                                    }
                                            echo form_dropdown('land', $options, $gebruiker->landId, 'clalandprm-control" id="field9"');
                      ?>
                                        </div>



                    </div>



                          gemeentep       <div class="row">
                                            <div class="col-md-4">   
                          <                     <?php echo form_label('Gemeente:', 'gemeente'); ?>                       
                      </div>

                      </div>

                                    <div class="col-md-8">   
                                                <?php echo form_input(array('name' => 'gemeenpte', 'id' => 'gemeente', 'value' => $gebruiker->gemeente, 'class' => 'form-control')); ?>                    
                      </div>
                                        </div>



                    </div>



                          postcodep       <div class="row">
                                            <div class="col-md-4">   
                          <                     <?php echo form_label('Postcode:', 'postcode'); ?>                                          
                      </div>

                      </div>

                                    <div class="col-md-8">   
                                                <?php echo form_input(array('name' => 'postcop', 'value' => $gebruiker->postcod=> $gebruiker->gemeente, 'class' => 'form-control')); ?>                    
                      </div>
                                        </div>



                    </div>



                          straatp       <div class="row">
                                            <div class="col-md-4">   
                          <?php echo form_label('Straat:', 'straat'); ?>                                             
                      </div>

                      </div>

                                    <div class="col-md-8">   
                                                <input type="text" name="straat" value="<?php echo $gebrustraatp" class="form-control">
        >                    
                                    </div>
                  </div>



                    </div>



                          huisnummerp       <div class="row">
                                            <div class="col-md-4">   
                          <label for="huisnummer">
        bel for="huisnummer">
                                            Huisnummer:
                          </label>
                                            </div>

                      </div>

                                    <div class="col-md-8">   
                                                <input type="number" name="huisnummer" value="<?php echo $gebruhuisnummerp" class="form-control">
        >                    
                                    </div>
                                                                            </div>
              </div>
                                </div>         
                            </div>
                   </div>
                     profiel/instellingen?php echo anchor('home', 'Annuleer', 'class="btn btn-default"'); ?>
  >
   button type="button" class="opslaanGebruiker btn btn-primary">Wijzigingen opslaan</button"btn btn-primary"'); ?>
      <?php echo form_close(); ?> 
                        </div>
                    </div>echo form_close(); ?> 
                </div>

                <div rtab-pane" id="conferenties">
                    <div class="equalizer panel panel-default">
                        <div class="panel-body">

                            <h1>Ingeschreven conferenties</h1>
        pen conferenties</h1>
    if ($inschrijvingen == null) { ?>
                            <br>
                                <p>Er zijn geen conferenties gevonden.</p>
                                <br>
                                <?php
                            }

                            foreach ($inschrijvingen as $i) {
                               nschrijvingen as $i) { ?>
          <?php if ($i != null && $i->conferentieId == $conferentie->id) { ?>
                                    <div class=" table-responsive">
                                        <table class="table">
                           </tr>

            head>                </tr>

                          <tr>
                                 <tr>
                         w30        <th class="w35">Conferentie</th>
              >
                          15">Plaats</th>
                                                    <th class="w20">Periode</th>
                                                    <th class="w20">Bedrag</th>
                                                    <th class="w5"></th>
                                                    <th class="w5">Details</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                             
                           ($i->betaling == null) { ?> ?>
                                                          
                              <tr class="danger">
             niet betaald!</span>
                                        <?php } else { ?>      
                              <tr class="success">
                    taald!</span>
                                        <?php } ?>
               <tr>
                                <td><?php echo $i->conferentie->naam; ?></td>
                              <td><?php echo $i->conferentie->stad; ?></td>
                rentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
              >
                  &euro; <?php echo toKomma($i->geld); ?></td>                   </td>
              >
              <td>            php echo $i->geld; ?>
                                                          
                                           ($i->betaling == null) { ?> ?>
                                                          
                                                         textass="right label label-danger">Nog niet betaald!</span>
                                                        <?php } else { ?>      
                                                         textass="right label label-success">Reeds betaald!</span>
                                  <?php } ?>
                           <?php } ?>
                                      </td>
              >
              <td class="center-block">
                                                        <button data-toggle="tooltip" data-placement="bottom" title="Details bekijken" class="detailsItem glyphicon glyphicon-info-sign btn btn-primary" data-id="<?php echo $i->id ?>"></button>                                           <?php } ?>
                              </td>
                                                </tr>
                                            </tbody>
                                        </table>?>                    
                                    </div>
           ?php } ?>
                            <?php } ?>

                            <h1 class="space-top">Afgelopen conferenties</h1>
        pen conferenties</h11>
    if ($inschrijvingen == null) { ?>
                            <br>
                                <p>Er zijn geen conferenties gevonden.</p>
                                <br>
                                
                            <?php }
                                             <?php foreach ($inschrijvingen as $i) { ?>
          <?php if ($i != null && $i->conferentieId != $conferentie->id) { ?>
                                    <div class=" table-responsive">
                                        <table class="table">
                           </tr>

            head>                </tr>

                          <tr>
                                 <tr>
                         w30        <th class="w35">Conferentie</th>
              >
                          15">Plaats</th>
                                                    <th class="w20">Periode</th>
                                                    <th class="w20">Bedrag</th>
                                                    <th class="w5"></th>
                                                    <th class="w5">Details</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                             
                           ($i->betaling == null) { ?> ?>
                                                          
                              <tr class="danger">
             niet betaald!</span>
                                        <?php } else { ?>      
                              <tr class="success">
                    taald!</span>
                                        <?php } ?>
               <tr>
                                <td><?php echo $i->conferentie->naam; ?></td>
                              <td><?php echo $i->conferentie->stad; ?></td>
                rentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
              >
                  &euro; <?php echo toKomma($i->geld); ?></td>                   </td>
              >
              <td>            php echo $i->geld; ?>
                                                          
                                           ($i->betaling == null) { ?> ?>
                                                          
                                                         textass="right label label-danger">Nog niet betaald!</span>
                                                        <?php } else { ?>      
                                                         textass="right label label-success">Reeds betaald!</span>
                                  <?php } ?>
                           <?php } ?>
                                      </td>
              >
              <td class="center-block">
                                                        <button data-toggle="tooltip" data-placement="bottom" title="Details bekijken" class="detailsItem glyphicon glyphicon-info-sign btn btn-primary" data-id="<?php echo $i->id ?>"></button>                                           <?php } ?>
                              </td>
                                                </tr>
                                            </tbody>
                                        </table>?>                    
                                    </div>
           ?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="betalingen">
                    <div class="equalizer panel panel-default">
                        <div class="panel-body">

                            <h1>Betalingen</h1>  
        pen conferenties</h1>
    if ($inschrijvingen == null) { ?>
                            <br>
                                <p>Er zijn geen betalingen gevonden.</p>
                                
                                
                            <?php }
                                            <?php foreach ($inschrijvingen as $i) { ?>
          <?php if ($i != null && $i->betaling != null) { ?>
                                    <div class="table-responsive">
                                        <table class="table">
                           </tr>

            head>                </tr>

                          <tr>
                                 <tr>
                         w30        <th class="w35">Conferentie</th>
                              <th class="w25">Datum</th>
                                                    <th class="w25">Methode</th>
                                                    <th class="w20    <th class="profBed">Bedrag</th>                                 
                          </tr>
                                </tr>
       /thead>
                                            <tbody>
                               </tr>

                                <tr>
               <tr>
                                <td><?php echo $i->conferentie->naam; ?></td>
                              <td><?php echo $i->datum; ?></td>
                    ho $i->datum; ?></td>
                                <td><?php echo $i->type->omschrijving; ?></td>
          ; ?></td>
              &euro;                   <td><?php echo $i->geld; ?></td>                                    
                          </tr>
                                            </tbody>
                                        </table>?>                    
                                    </div>
           ?php } ?>
                            <?php } ?>
                        </div>                        
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="wwwijzigen">
                    <div class="equalizer panel panel-default">
                        <div class="panel-body">                        
                            <h1>Wachtwoord veranderen</h1>                    

                            <?php
                            $attributes = array('class' => 'registreer', 'id' => 'Password');
                            echo form_open('profiel/wijzigWachtwoord', $attributes);
                            ?>

                            <div id="passwordN1div"> 
                                <?php echo form_label('Wachtwoord:', 'passwordN', array('class' => 'col-sm-3 control-label')); ?>    
                                <div class="col-sm-8">    <div class="col-md-8">                   
                              password(array('name' => 'passwordN', 'id' => 'passwordN1', 'class' => 'form-control')); ?> 
                                </div>
                            </div>

                            <div id="passwordN2div">
                                <?php echo form_label('Wachtwoord bevestigen:', 'bevestigwwN', array('class' => 'col-sm-3 control-label')); ?>
                                <span id="validate-statusN" class="form-note"></span>              
                                <div class="col-sm-8">                                        
                                    <?php echo form_password(array('name' => 'bevestigwwN', 'id' => 'passwordN2'> $gebruiker->postcode, 'class' => 'form-control')); ?>                    
          </div>
                            </div>

                            <div class="btn-group col-xs-offset-3 col-xs-8">
                                <button name="mysubmit" id="VeranderPass" class="col-xs-6 btn btn-primary">Wijziging opslaan</button>
                                <?php echo anchor('profiel/instellingen', 'Annuleren', 'class="btn btn-default col-xs-3"') ?>
                            </div>
                            <?php echo form_close(); ?>

                        </div>                        
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

                <div class="modal-body">        
                    <p><span class="bold" id="onderdeel"></span>: &euro; <span id="prijs"></span></p>  

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