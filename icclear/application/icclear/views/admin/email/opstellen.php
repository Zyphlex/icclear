<div class="col-md-10">    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('email/verzend', $attributes);
    ?>             
    <div class="row">
        <div class="col-md-8">  
            <div class="row">
                <div class="col-md-4">   
                    <label for="onderwerp">
                        Onderwerp:
                    </label>
                </div>
                <div class="col-md-8">   
                    <input type="text" name="onderwerp" id="onderwerp" class="form-control" required="required">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">   
                    <label for="Ontvanger">
                        Ontvanger(s):
                    </label>
                </div>
                <div class="col-md-8">   
                    <input type="text" name="ontvanger" id="ontvanger" class="form-control" required="required">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">   
                    <label for="inhoud">
                        Inhoud:
                    </label>
                </div>
                <div class="col-md-8">   
                    <textarea name="inhoud" id="inhoud" class="form-control" required="required" rows="10" cols="150">
                        
                    </textarea>
                </div>
            </div>
<!--            <input type="hidden" name="gebruiker" value="<?php echo $user->id ?>"/>            -->
            <input type="hidden" name="conferentie" value="<?php echo $conferentieId; ?>"/>
        </div>      
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-1"> </div>
        <div class="col-md-3">
            <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>     
            <input type="submit" value="Verzenden" class="btn btn-default"/>    
        </div>
    </div>    
    <?php echo form_close(); ?>                                     
</div>

