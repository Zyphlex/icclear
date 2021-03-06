<div class="col-md-10">
    <h1>Conferentie toevoegen.</h1>

    <?php
        $attributes = array('class' => 'registreer', 'id' => 'myForm', 'method' => 'post');
        echo form_open('conferentie/nieuwopslaan', $attributes);
        ?>

        <div class="row">  
            <div class="col-md-2 control-label">
                <?php echo form_label('Naam:', 'naam'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("class" => "form-control", "type" => "text", "name" => "naam", "required" => "required")); ?>
            </div>
        </div>

        <br/>

        <div class="row">    
            <div class="col-md-2 control-label">
                <?php echo form_label('Begin datum:', 'begindatum'); ?>
            </div>
            <div class="col-md-4">    
                <?php echo form_input(array("class" => "form-control", "type" => "date", "name" => "begindatum", "required" => "required")); ?>
            </div>

            <div class="col-md-2 control-label  border-left">
                <?php echo form_label('Eind datum:', 'einddatum'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("class" => "form-control", "type" => "date", "name" => "einddatum", "required" => "required")); ?>
            </div>
        </div>

        <br/>

        <div class="row">     
            <div class="col-md-2 control-label">    
                <?php echo form_label('Land:', 'land'); ?>   
            </div>
            <div class="col-md-4">                  
                <?php
                $opties = array();
                foreach ($landen as $land) {
                    $opties[$land->id] = $land->naam;
                }
                ?>
            <?php echo form_dropdown('land', $opties, '' , 'id="land" class="form-control" required="required"'); ?>
            </div>            

            <div class="col-md-2 control-label border-left">   
            <?php echo form_label('Stad:', 'stad') ?>
            </div>
            <div class="col-md-4">
            <?php echo form_input(array('type' => 'text', 'id' => 'stad', 'name' => 'stad', 'class' => 'form-control', "required" => "required")); ?>
            </div>
        </div>

        <br/>

        <div class="row">    
            <div class="col-md-3 control-label">  
            <?php echo form_label('Max inschrijvingen', 'maxinschrijvingen') ?>
            </div>
            <div class="col-md-2">
            <?php echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => 'maxinschrijvingen', "required" => "required")) ?>               
            </div>
        </div>

        <div class="row">      
            <div class="col-md-3 control-label">       
                <?php echo form_label('Seminariedag:', 'seminariedag') ?>
            </div>
            <div class="col-md-2">  
                    <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '1', "required" => "required")); ?>
                        Ja</label>
                    <label class="radio">
                    <?php echo form_radio(array('type' => 'radio', 'name' => 'seminariedag', 'value' => '0', "required" => "required")); ?>
                        Nee</label>
            </div>
        </div>       

        <br/><br/>


        <br/><br/>

        <div class="row">
            <div class="col-md-12">
                <?php echo form_label('Beschrijving:', 'beschrijving') ?> 
            </div>

            <div class="col-md-12">
                <?php echo form_textarea(array('rows' => '10', 'name' => 'beschrijving', 'class' => 'form-control', "required" => "required")) ?>
            </div>
        </div>        

        <br/><br/>

        <div class="row">
            <div class="col-md-12">

            </div>
        </div>


        <br/>

        <div class="row">
            <div class="col-md-12">   
                <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
                <?php echo form_submit(array('value' => 'Opslaan', 'class' => 'btn btn-primary')) ?>            
            </div>
        </div>
        
        <br/>

        <?php echo form_close(); ?>


</div>