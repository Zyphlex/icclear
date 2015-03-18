<div class="col-md-10">
    <h1>Conferentie wijzigen.</h1>

    <form action="conferentie/opslaan" method="post">

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
                <?php echo form_input(array("class" => "form-control", "type" => "date", "name" => "begindatum", "value" => $conferentie->beginDatum)); ?>
            </div>
            
            <div class="col-md-2 control-label  border-left">
                <?php echo form_label('Eind datum:','einddatum'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array("class" => "form-control", "type" => "date", "name" => "einddatum", "value" => $conferentie->eindDatum)); ?>
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
        
        <div class="row">       
            <div class="col-md-2 control-label">     
                <?php echo form_label('Straat:','straat'); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_input(array('value'=>$conferentie->straat,'type'=>'text','id'=>'straat','name'=>'straat','class'=>'form-control')) ?>
            </div>
            
            <div class="col-md-2 control-label border-left">   
                <?php echo form_label('Nr:','nr'); ?>
            </div>
            <div class="col-md-2">
                <?php echo form_input(array('value'=>$conferentie->nr,'type'=>'number','id'=>'nr','name'=>'nr','class'=>'form-control')); ?>
            </div>
        </div>
        
        <br/>
        
        <div class="row">    
            <div class="col-md-3 control-label">  
                <?php echo form_label('Max inschrijvingen','maxinschrijvingen') ?>
            </div>
            <div class="col-md-2">
                <?php echo form_input(array('value'=>$conferentie->maxInschrijvingen,'type'=>'number','class'=>'form-control','name'=>'maxinschrijvingen')) ?>
                <input class="form-control" type="number" id="maxinschrijvingen" name="maxinschrijvingen"/>                
            </div>
        </div>
        
        <div class="row">      
            <div class="col-md-3 control-label">       
                <?php echo form_label('Seminariedag:','seminariedag') ?>
            </div>
            <div class="col-md-2">       
                <label class="radio">
                    <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'1')); ?>
                    Ja</label>
                <label class="radio">
                    <?php echo form_radio(array('type'=>'radio','name'=>'seminariedag','value'=>'0')); ?>
                    Nee</label>               
            </div>
        </div>       
        
        <br/><br/>
        
        <div class="row">
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
        </div>        
        
        <br/><br/>
        
        <div class="row">
            <div class="col-md-12">
                <label for="beschrijving">Beschrijving:</label>    
            </div>

            <div class="col-md-12">
               <textarea rows="10" name="beschrijving" class="form-control"></textarea>    
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
                <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>         
                <input type="submit" value="Opslaan" class="btn btn-default"/>             
            </div>
        </div>
        
    </form>


</div>
