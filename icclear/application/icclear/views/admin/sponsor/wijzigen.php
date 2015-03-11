<div class="col-md-10">
    <h1><?php echo $sponsor->type; ?> wijzigen</h1>

    <?php
    $attributes = array('name' => 'myform');
    echo form_open('sponsor/update', $attributes);
    form_hidden('id', $sponsor->id);
    ?>

    <div class="row">
        <?php
        $attributesLabel = array('class' => 'control-label col-md-2');
        echo form_label('Naam:', 'naam', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'naam', 'name' => 'naam', 'class' => 'form-control', 'value' => $sponsor->naam));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Land:', 'land', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            $optionsLand = array();
            foreach ($landen as $land) {
                $optionsLand[$land->id] = $land->naam;
            }
            echo form_dropdown('land', $optionsLand, $sponsor->land->id, 'class="form-control"');
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Postcode:', 'postcode', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'postcode', 'name' => 'postcode', 'class' => 'form-control', 'value' => $sponsor->postcode));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Gemeente:', 'gemeente', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'gemeente', 'name' => 'postcode', 'class' => 'form-control', 'value' => $sponsor->gemeente));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Straat:', 'straat', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'straat', 'name' => 'straat', 'class' => 'form-control', 'value' => $sponsor->straat));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Nuumer:', 'nummer', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'nummer', 'name' => 'nummer', 'class' => 'form-control', 'value' => $sponsor->nummer));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Naam:', 'naam', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            echo form_input(array('id' => 'naam', 'name' => 'naam', 'class' => 'form-control', 'value' => $sponsor->naam));
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_label('Type:', 'type', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php
            $optionsType = array('Sponsor' => 'Sponsor', 'Partner' => 'Partner');
            if ($sponsor->type == 'Sponsor') {
                echo form_dropdown('type', $optionsType, 'Sponsor', 'class="form-control"');
            } else {
                echo form_dropdown('type', $optionsType, 'Partner', 'class="form-control"');
            }
            ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"');
            echo form_submit('mysubmit', 'Opslaan', 'class="btn btn-default"');?>         
                        
        </div>
    </div>

</form>


</div>