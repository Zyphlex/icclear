<div class="col-md-10">
    <h1><?php echo $sponsor->type; ?> wijzigen</h1>

    <?php
    $attributes = array('name' => 'myform');
    echo form_open('sponsor/update', $attributes);
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
            echo form_input(array('id' => 'land', 'name' => 'land', 'class' => 'form-control', 'value' => $sponsor->land->naam));
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
            //dropdown
            ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="<?php echo $gebouw->id; ?>" name="id"/>
<?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
            <input type="submit" value="Opslaan" class="btn btn-default"/>             
        </div>
    </div>

</form>


</div>