<script type="text/javascript">
    $('#myTab a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    
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
                    <?php foreach ($inschrijving as $i) { ?>
                        <?php if ($i != null && $i->conferentieId == $conferentie->id) { ?>
                            <table class="table table-responsive">
                                <tr>
                                    <th class="w35">Conferentie</th>
                                    <th class="w20">Plaats</th>
                                    <th class="w27">Periode</th>
                                    <th class="w18">Bedrag</th>
                                </tr>

                                <tr>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                                    <td><?php echo $i->geld; ?>
                                                          
                                        <?php if($i->betaling == null) {?>                                        
                                            <span class="right label label-danger">Nog niet betaald!</span>
                                        <?php } else { ?>      
                                            <span class="right label label-success">Reeds betaald!</span>
                                        <?php } ?>
                                    </td>
                                </tr>                                
                            </table>
                        <?php } ?>
                    <?php } ?>
                            
                    <h1 class="margin-top">Afgelopen conferenties</h1>
                    <?php foreach ($inschrijving as $i) { ?>
                        <?php if ($i != null && $i->conferentieId != $conferentie->id) { ?>
                            <table class="table table-responsive">
                                <tr>
                                    <th class="profConf">Conferentie</th>
                                    <th class="profPl">Plaats</th>
                                    <th class="profPer">Periode</th>
                                    <th class="profBed">Bedrag</th>
                                </tr>

                                <tr>
                                    <td><?php echo $i->conferentie->naam; ?></td>
                                    <td><?php echo $i->conferentie->stad; ?></td>
                                    <td><?php echo $i->conferentie->beginDatum . " - " . $i->conferentie->eindDatum; ?></td>
                                    <td><?php echo $i->geld; ?></td>
                                </tr>                                
                            </table>
                        <?php } ?>
                    <?php } ?>
                </div>
                                
                
                <div role="tabpanel" class="tab-pane" id="betalingen">
                    <h1 class="margin-top">Betalingen</h1>                    
                    <?php foreach ($inschrijving as $i) { ?>
                        <?php if ($i != null && $i->betaling != null) { ?>
                        <table class="table table-responsive">
                            <tr>
                                <th class="profConf">Conferentie</th>
                                <th class="profPl">Datum</th>
                                <th class="profPer">Methode</th>
                                <th class="profBed">Bedrag</th>                                 
                            </tr>
                            <tr>
                                <td><?php echo $i->conferentie->naam; ?></td>
                                <td><?php echo $i->datum; ?></td>
                                <td><?php echo $i->type->omschrijving; ?></td>
                                <td><?php echo $i->geld; ?></td>                                    
                            </tr>
                        </table>
                        <?php } ?>
                    <?php } ?>
                </div>                        
            </div>

        </div>
    </div>

</div>
