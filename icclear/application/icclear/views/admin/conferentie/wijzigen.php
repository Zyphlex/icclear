<div class="col-md-10">
    <h1>Conferentie wijzigen.</h1>

        <?php
        $attributes = array('class' => 'registreer', 'id' => 'myForm', 'method'=>'post');
        echo form_open('conferentie/opslaan', $attributes);
        ?>
        
        <div class="row">  
            <div class="col-md-2 control-label">
                <?php echo form_label('Naam:', 'naam');?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("class" => "form-control", "type" => "text", "name" => "naam", "value" => $conferentie->naam)); ?>
            </div>
        </div>

        <br/>
        
        <div class="row">    
            <div class="col-md-2 control-label">
                <?php echo form_label('Begin datum:','begindatum'); ?>
            </div>
            <div class="col-md-4">    
                <?php echo form_input(array("disabled" => "true","class" => "form-control", "type" => "date", "name" => "begindatum", "value" => $conferentie->beginDatum)); ?>
            </div>
            
            <div class="col-md-2 control-label  border-left">
                <?php echo form_label('Eind datum:','einddatum'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("disabled" => "true","class" => "form-control", "type" => "date", "name" => "einddatum", "value" => $conferentie->eindDatum)); ?>
            </div>
        </div>
        
        <br/>
        
        <div class="row">     
            <div class="col-md-2 control-label">    
                <?php echo form_label('Land:','land'); ?>   
            </div>
            <div class="col-md-4">                  
                <?php
                    $opties = array();
                    foreach ($landen as $land) {
                        $opties[$land->id] = $land->naam;
                }?>
                <?php echo form_dropdown('land', $opties, $conferentie->landId, 'id="land" class="form-control"'); ?>
            </div>            
            
            <div class="col-md-2 control-label border-left">   
                <?php echo form_label('Stad:', 'stad') ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array('value' => $conferentie->stad ,'type' => 'text', 'id' => 'stad', 'name' => 'stad', 'class' => 'form-control')); ?>
            </div>
        </div>
        
        <br/>
        
        <div class="row">    
            <div class="col-md-3 control-label">  
                <?php echo form_label('Max inschrijvingen','maxinschrijvingen') ?>
            </div>
            <div class="col-md-2">
                <?php echo form_input(array('value'=>$conferentie->maxInschrijvingen,'type'=>'number','class'=>'form-control','name'=>'maxinschrijvingen')) ?>               
            </div>
        </div>
        
        <div class="row">      
            <div class="col-md-3 control-label">       
                <?php echo form_label('Seminariedag:','seminariedag') ?>
            </div>
            <div class="col-md-2">    
                <?php if($conferentie->seminarieDag == 1){ ?>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'1','checked'=>'checked')); ?>
                    Ja</label>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'0')); ?>
                    Nee</label>    
                <?php } else {?>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'1')); ?>
                    Ja</label>
                    <label class="radio">
                        <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'0','checked'=>'checked')); ?>
                    Nee</label>
                <?php } ?>
            </div>
        </div>       
        
        <br/><br/>
        
<!--        <div class="row">
            <div class="col-md-12">
                <div class=" panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Conferentie</h4>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><label for="formule">Formule</label></th>
                                    <th><label for="prijs">Prijs</label></th>
                                    <th><label for="korting">Korting</label></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="formule"></td>
                                        <td><input type="text" class="form-control" name="prijs"></td>
                                        <td><input type="text" class="form-control" name="korting"></td>
                                        <td><a href="" class="glyphicon glyphicon-plus btn btn-default"></a></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        -->
        
        <br/><br/>
        
        <div class="row">
            <div class="col-md-12">
                <?php echo form_label('Beschrijving:','beschrijving') ?> 
            </div>

            <div class="col-md-12">
                <?php echo form_textarea(array('value'=>$conferentie->beschrijving,'rows'=>'10','name'=>'beschrijving','class'=>'form-control')) ?>
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
                <?php echo form_hidden('id',$conferentie->id); ?>
                
                <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>         
                <?php echo form_submit(array('value'=>'Opslaan','class'=>'btn btn-default')) ?>            
            </div>
        </div>
        
    <?php echo form_close(); ?>


</div>
