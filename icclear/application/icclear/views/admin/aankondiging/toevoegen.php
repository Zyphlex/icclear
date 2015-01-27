<div class="col-md-10">    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('aankondiging/insert', $attributes);
    ?>             
    <div class="row">
        <div class="col-md-6">  
            <div class="row">
                <div class="col-md-4">   
                    <label for="titel">
                        Titel:
                    </label>
                </div>
                <div class="col-md-8">   
                    <input type="text" name="titel" id="titel" class="form-control" required="required">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">   
                    <label for="inhoud">
                        Inhoud:
                    </label>
                </div>
                <div class="col-md-8">   
                    <textarea name="inhoud" id="inhoud" class="form-control" required="required">
                        
                    </textarea>
                </div>
            </div>
            <input type="hidden" name="gebruiker" value=""/>
            <input type="hidden" name="conferentie" value=""/>
        </div>      
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-push-4">
            <input type="submit" value="Toevoegen" class="btn btn-default"/>
    <?php echo anchor('admin/', 'Annuleer', 'class="btn btn-default"'); ?>
        </div>
    </div>    
    <?php echo form_close(); ?>                                     
</div>

