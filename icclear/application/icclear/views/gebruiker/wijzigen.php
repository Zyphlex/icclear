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
                <label for="emailadres">
                    Emailadres: 
                </label>
            </div>  

            <div class="col-md-8">   
                <input type="text" name="emailadres" value="<?php echo $gebruiker->emailadres; ?>" id="email" class="form-control" disabled="true">      
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">   
                <label for="geboortedatum">
                    Geboortedatum:
                </label>
            </div>

            <div class="col-md-8">   
                <input type="date" class="form-control" value="<?php echo $gebruiker->geboortedatum; ?>" id="field7" maxlength="524288" name="geboortedatum" style="width: 158px;" tabindex="0" title="">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">   
                <label for="geslacht">
                    Geslacht:
                </label>  
            </div>  

            <div class="col-md-8">        
                <div class="my-radio">
                    <?php
                    if (strtolower($gebruiker->geslacht) == "man") {
                        echo '<div class="">
                                            <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" checked="checked" value="Man">
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div> 
                                        <div class="">
                                            <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" value="Vrouw">
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>';
                    } else {
                        echo '<div class="">
                                            <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" value="Man">
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div> 
                                                <div class="">
                                            <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" checked="checked" value="Vrouw">
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php if ($inschrijving != null) { ?>
            <div class="row">
                <div class="col-md-4">   
                    <label for="betaling">
                        Betaling:
                    </label>
                </div>
                <div class="col-md-8">   
                    <input type="text" class="form-control" value="€ <?php
                    echo $inschrijving->confonderdeel->prijs;
                    if ($inschrijving->confonderdeel->prijs > 0 && $inschrijving->betaling->methode != "Overschrijving") {
                        echo " - Betaald";
                    } else if ($inschrijving->confonderdeel->prijs > 0 && $inschrijving->betaling->methode == "Overschrijving") {
                        echo " - Niet betaald";
                    }
                    ?>" id="betaling" name="betaling" disabled="true">
                </div>
            </div>
        <?php } ?>
        <?php if ($gebruiker->typeId == 2) { ?>
            <div class="row">
                <div class="col-md-4">   
                    <label for="type">
                        Type:
                    </label>  
                </div>  

                <div class="col-md-8">        
                    <div class="my-radio">
                        <?php
                        if ($gebruiker->typeId == 2) {
                            echo '<div class="">
                                            <input type="radio" name="type" id="field9-1"  class="form-horizontal" checked="checked" value="2">
                                            <span class="option-title">
                                                Spreker
                                            </span>
                                        </div> 
                                        <div class="">
                                            <input type="radio" name="type" id="field9-2" class="form-horizontal" value="1">
                                            <span class="option-title">
                                                Bezoeker
                                            </span>
                                        </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>


    <div class="col-md-6 border-left">      
        <div class="row">
            <div class="col-md-4">   
                <label for="land">
                    Land:
                </label>
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
                    <label for="gemeente">
                        Gemeente:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="gemeente" value="<?php echo $gebruiker->gemeente; ?>" id="field10" class="form-control">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="postcode">
                        Postcode:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="postcode" value="<?php echo $gebruiker->postcode; ?>" id="field10-b" class="form-control">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="straat">
                        Straat:
                    </label>
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

</div>

<?php echo anchor('home', 'Annuleer', 'class="btn btn-default"'); ?>
<?php echo form_submit('profiel/update', 'Opslaan', 'class="btn btn-default"'); ?>

<?php echo form_close(); ?>

