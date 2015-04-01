<div class="row">
    <div class="col-md-6">  
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
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Profiel wijzigen</h1>
                                </div>
                            </div>
                            <?php
                            $attributes = array('name' => 'myform', 'id' => 'myform');
                            echo form_open('profiel/update', $attributes);
                            echo form_hidden('id', $gebruiker->id);
                            ?>
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
                                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadres', 'value' => $gebruiker->emailadres, 'class' => 'form-control', 'disabled' => 'true')); ?>
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

                            <?php if ($gebruiker->typeId == 2) { ?>
                                <div class="row">
                                    <div class="col-md-4">  
                                        <?php echo form_label('Type:', 'type'); ?>                        
                                    </div>  

                                    <div class="col-md-8">        
                                        <div class="my-radio">
                                            <?php
                                            if ($gebruiker->typeId == 2) {
                                                ?>
                                                <div class="">
                                                    <?php echo form_input(array('name' => 'type', 'id' => 'spreker', 'value' => '2', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                                                            
                                                    <span class="option-title">
                                                        Spreker
                                                    </span>
                                                </div> 
                                                <div class="">
                                                    <?php echo form_input(array('name' => 'type', 'id' => 'bezoeker', 'value' => '1', 'class' => 'form-horizontal', 'type' => 'radio', 'checked' => 'checked')); ?>                                
                                                    <span class="option-title">
                                                        Bezoeker
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>




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
                                    <div class="row">
                                        <div class="col-md-4">   
                                            <label for="methode">
                                                Betaalmethode:
                                            </label>
                                        </div>

                                        <div class="col-md-8">   
                                            <input type="text" name="methode" value="<?php echo $inschrijving->betaling->methode ?>" id="methode" class="form-control" disabled="true">
                                        </div>
                                    </div>
                                </div>
                            </div>         
                            <?php echo anchor('home', 'Annuleer', 'class="btn btn-default"'); ?>
                            <?php echo form_submit('profiel/update', 'Opslaan', 'class="btn btn-default"'); ?>
                            <?php echo form_close(); ?> 
                        </div>

                        <div role="tabpanel" class="tab-pane" id="conferenties">
                            <h2>Ingeschreven conferenties</h2>
                            <table>
                                <tr>
                                    <th>Conferentie</th>
                                    <th>Plaats</th>
                                    <th>Periode</th>
                                    <th>Prijs</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td><?php echo $inschrijving->conferentie->naam;?></td>
                                    <td><?php echo $inschrijving->conferentie->stad;?></td>
                                    <td><?php echo $inschrijving->datum;?></td>
                                    <td><?php echo $inschrijving->betaling->methode;?></td>
                                    <td></td>
                                </tr>
                            </table>
                            <h2>Afgelopen conferenties</h2>
                            
                        </div>
                        <div role="tabpanel" class="tab-pane" id="betalingen">
                            <h1>Betalingen</h1>
                            <table>
                                <tr>
                                    <th>Conferentie</th>
                                    <th>Datum</th>
                                    <th>Methode</th>
                                    <th>Bedrag</th>                                    
                                </tr>
                                <tr>
                                    <td><?php echo $inschrijving->conferentie->naam;?></td>
                                    <td></td>
                                    <td><?php echo $inschrijving->betaling->methode;?></td>
                                    <td></td>                                    
                                </tr>
                            </table>
                        </div>                        
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#myTab a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>