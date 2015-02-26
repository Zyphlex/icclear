<div class="col-md-10">
    <h1>Gebouw toevoegen</h1>   
    <?php echo form_open('gebouw/insert'); ?>
    <div class="row">            
        <?php
        $attributesLabel = array('class' => 'control-label col-md-2');        
        echo form_label('Naam:', 'naam', $attributesLabel);
        ?>
        <div class="col-md-4">
            <?php echo form_input(array('id' => 'naam', 'name' => 'naam', 'class' => 'form-control')) ?>                     
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Postcode:', 'postcode', $attributesLabel); ?>
        <div class="col-md-4">            
            <?php echo form_input(array('id' => 'postcode', 'name' => 'postcode', 'class' => 'form-control')) ?>    
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Gemeente:', 'gemeente', $attributesLabel); ?>
        <div class="col-md-4">                
            <?php echo form_input(array('id' => 'gemeente', 'name' => 'gemeente', 'class' => 'form-control')) ?> 
        </div>
    </div>
    <div class="row">            
        <label for="straat" class="control-label col-md-2">Straat:</label>
        <div class="col-md-4">                 
            <?php echo form_input(array('id' => 'straat', 'name' => 'straat', 'class' => 'form-control')) ?> 
        </div>
    </div>
    <div class="row">            
        <?php echo form_label('Nummer:', 'nummer', $attributesLabel); ?>
        <div class="col-md-4">                           
            <?php echo form_input(array('id' => 'nummer', 'name' => 'nummer', 'class' => 'form-control')) ?> 
        </div>
    </div>        

    <div class="row">
        <div class="col-md-12">                            
            <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
            <?php echo form_submit('submit', 'Toevoegen', "class='btn btn-default'");?>                           
        </div>
    </div>

    <?php form_close(); ?>


</div>