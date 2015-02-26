<div class="col-md-10">
    <h1>Gebouw wijzigen</h1>

    <form action="<?php echo base_url(); ?>icclear.php/gebouw/opslaan" method="post">

        <div class="row">            
            
            <?php
//            $attributesLabel = array('style' => 'control-label col-md-2');
//            echo form_label('Naam:', 'naam', $attributesLabel);
            echo form_label(array('for' => 'email' , 'class' => 'control-label col-md-2', 'value' => 'Naam:'));
            ?>
            <div class="col-md-4">
                <?php echo form_input(array('id' => 'naam', 'name' => 'naam', 'class' => 'form-control', 'value' => $gebouw->naam)) ?>                     
            </div>
        </div>
        <div class="row">            
            <label for="postcode" class="control-label col-md-2">Postcode:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="postcode" name="postcode" value="<?php echo $gebouw->postcode ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="gemeente" class="control-label col-md-2">Gemeente:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="gemeente" name="gemeente" value="<?php echo $gebouw->gemeente ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="straat" class="control-label col-md-2">Straat:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="straat" name="straat" value="<?php echo $gebouw->straat ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="nummer" class="control-label col-md-2">Nummer:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="nummer" name="nummer" value="<?php echo $gebouw->nummer ?>"/>                
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