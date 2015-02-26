<div class="col-md-10">
    <h1>Gebouw wijzigen</h1>   
    <?php echo form_open('gebouw/opslaan'); ?>

    <div class="row">            

        <?php
        $attributesLabel = array('class' => 'control-label col-md-2');
        $attributesButton = array('class' => 'btn btn-default');
        echo form_label('Naam:', 'naam', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php echo form_input(array('id' => 'naam', 'name' => 'naam', 'class' => 'form-control', 'value' => $gebouw->naam)) ?>                     
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Postcode:', 'postcode', $attributesLabel); ?>
        <div class="col-md-4">
            <input class="form-control" type="text" id="postcode" name="postcode" value="<?php echo $gebouw->postcode ?>"/>
            <?php echo form_input(array('id' => 'postcode', 'name' => 'postcode', 'class' => 'form-control', 'value' => $gebouw->postcode)) ?>    
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Gemeente:', 'gemeente', $attributesLabel); ?>
        <div class="col-md-4">                
            <?php echo form_input(array('id' => 'gemeente', 'name' => 'gemeente', 'class' => 'form-control', 'value' => $gebouw->gemeente)) ?> 
        </div>
    </div>
    <div class="row">            
        <label for="straat" class="control-label col-md-2">Straat:</label>
        <div class="col-md-4">                 
            <?php echo form_input(array('id' => 'straat', 'name' => 'straat', 'class' => 'form-control', 'value' => $gebouw->straat)) ?> 
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Nummer:', 'nummer', $attributesLabel); ?>
        <div class="col-md-4">
            <input class="form-control" type="text" id="nummer" name="nummer" value="<?php echo $gebouw->nummer ?>"/>                
        </div>
    </div>        

    <div class="row">
        <div class="col-md-12">                
            <?php form_hidden('id', $gebouw->id); ?>
            <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
            <?php echo form_submit('submit', 'Opslaan', $attributesButton); ?>                           
        </div>
    </div>

    <?php form_close(); ?>


</div>