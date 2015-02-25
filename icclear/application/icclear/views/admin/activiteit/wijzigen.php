
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Activiteit wijzigen</h1>
        </div>
    </div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('activiteit/update', $attributes);
    echo form_hidden('id', $activiteit->id);
    ?>

    <div class="row">
        <div class="col-md-6">  

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Naam:', 'naam'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'naam', 'id' => 'field2', 'value' => $activiteit->naam, 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="omschrijving">
                        Omschrijving:
                    </label>
                </div>

                <div class="col-md-8">   
                    
                    <textarea name="omschrijving" id="field1" class="form-control" required="required" id="omschrijving">
                    <?php echo $activiteit->omschrijving; ?>
                    </textarea>
                </div>
            </div>

        </div>


        <div class="col-md-6 border-left">      
            <div class="row">
                <div class="col-md-4">   
                    <label for="conferentie">
                        Conferentie:
                    </label>
                </div>

                <div class="col-md-8">   
                    <?php
                    foreach ($conferenties as $conferentie) {
                        $options[$conferentie->id] = $conferentie->naam;
                    }
                    echo form_dropdown('conferentie', $options, $activiteit->conferentieId, 'class="form-control" id="field9" required="required"');
                    ?>
                </div>



                <div class="row">
                    <div class="col-md-4">   
                        <label for="prijs">
                            Prijs:
                        </label>
                    </div>

                    <div class="col-md-8">   
                        <input type="text" name="prijs" value="<?php echo $activiteit->prijs; ?>" id="field10" class="form-control" required="required">
                    </div>
                </div>
            </div>
        </div>         

    </div>

    <?php echo anchor('gebruiker/overzichtGebruikers', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('opslaan', 'Opslaan', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>
</div>
