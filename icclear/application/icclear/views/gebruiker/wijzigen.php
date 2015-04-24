<script type="text/javascript">
    $('#myTab a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    
    $(document).ready(function () {
        maakDetailClick();
    });
    
    function maakDetailClick() {
        $(".toonDetails").click(function () {
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
                        $("#naam").html(jobject.confonderdeel.omschrijving);
                        $("#prijs").html(jobject.confonderdeel.prijs);
                        $("#korting").html(jobject.confonderdeel.korting);
                    }
                });
            }
            // dialoogvenster openen
            $("#bedragDetails").modal('show');
        });
    }
</script>

<div class="row">
    <div class="col-md-12">                
        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a></li>
                <li role="presentation"><a href="#conferenties" aria-controls="conferenties" role="tab" data-toggle="tab">Conferenties</a></li>
                <li role="presentation"><a href="#betalingen" aria-controls="betalingen" role="tab" data-toggle="tab">Betalingen</a></li>                        
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="account">
                    <h1 class="margin-top">Profiel wijzigen</h1>
                    

                    <?php
                    $attributes = array('name' => 'myform', 'id' => 'myform');
                    echo form_open('profiel/update', $attributes);
                    echo form_hidden('id', $gebruiker->id);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">            
                                <div class="col-md-4">   
                                    <?php echo form_label('Voornaam:', 'voornaam'); ?>
                                </div>

                                <div class="col-md-8">
                                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'field2', 'value' => $gebruiker->voornaam, 'class' => 'form-control')); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('Familienaam:', 'familienaam'); ?>                
                                </div>

                                <div class="col-md-8">                   
                                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'value' => $gebruiker->familienaam, 'class' => 'form-control')); ?>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('E-mailadres:', 'emailadres'); ?>                                
                                </div>  

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadres', 'value' => $gebruiker->emailadres, 'class' => 'form-control', 'disabled' => 'disabled')); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo form_label('Geboortedatum:', 'geboortedatum'); ?>                                                
                                </div>

                                <div class="col-md-8"> 
                                    <?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatum', 'value' => $gebruiker->geboortedatum, 'class' => 'form-control', 'style' => 'width: 158px;', 'tabindex' => '0', 'type' => 'date')); ?>                
                                </div>
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
                        <?php echo anchor('home', 'Annuleer', 'class="btn btn-default"'); ?>
                        <?php echo form_submit('profiel/update', 'Opslaan', 'class="btn btn-default"'); ?>
                        <?php echo form_close(); ?> 
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="conferenties">

                    <h1 class="margin-top">Ingeschreven conferenties</h1>
                    <?php
                        $index = 0;
                        foreach ($inschrijving as $i) { ?>
                        <?php if ($i != null && $i->conferentieId == $conferentie->id) { ?>
                            <table class="table">
                                <tr>
                                    <th>Conferentie</th>
                                    <th>Plaats</th>
                                    <th>Periode</th>
                                    <th>Bedrag</th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                                    <td><?php echo $i->geld]; ?></td>
                                    <td><button class="toonDetails btn btn-primary" data-id="<?php $i->id ?>">Details</button></td>
                                </tr>                                
                            </table>
                        <?php } ?>
                    <?php $index++; } ?>
                            
                    <h1 class="margin-top">Afgelopen conferenties</h1>
                    <?php 
                        $index = 0;
                        foreach ($inschrijving as $i) { ?>
                        <?php if ($i != null && $i->conferentieId != $conferentie->id) { ?>
                            <table class="table">
                                <tr>
                                    <th>Conferentie</th>
                                    <th>Plaats</th>
                                    <th>Periode</th>
                                    <th>Bedrag</th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                                    <td><?php echo $geld[$index]; ?></td>
                                    <td><button class="toonDetails btn btn-primary" data-id="<?php $i->id ?>">Details</button></td>
                                </tr>                                
                            </table>
                        <?php } ?>
                    <?php $index++; } ?>

                </div>
                
                
                
                <div role="tabpanel" class="tab-pane" id="betalingen">
                    <h1 class="margin-top">Betalingen</h1>
                    <?php if ($inschrijving != null) { ?>
                        <table class="table">
                            <tr>
                                <th>Conferentie</th>
                                <th>Datum</th>
                                <th>Methode</th>
                                <th>Bedrag</th>                                    
                            </tr>
                            <tr>
                                <td><?php echo $inschrijving->conferentie->naam; ?></td>
                                <td><?php echo $inschrijving->datum; ?></td>
                                <td><?php echo $inschrijving->type->omschrijving; ?></td>
                                <td><?php echo $geld; ?></td>                                    
                            </tr>
                        </table>
                    <?php } else { ?>
                        <p>Geen</p>
                    <?php } ?>
                </div>                        
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="bedragDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Prijs Details</h4>
            </div>

            <div class="modal-body">                  
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Prijs</th>
                            <th>Korting</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="naam"></td>
                            <td id="prijs"></td>
                            <td id="korting"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
            </div>

        </div>            
    </div>
</div>  