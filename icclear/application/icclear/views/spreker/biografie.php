<div class="row">
    <div class="col-sm-12">
        <h1><?php echo $spreker->familienaam . ' ' . $spreker->voornaam ?> - Biografie en foto</h1>
    </div>
</div>    

<div class="row">
    <div class="col-sm-8">
        <p>
            Van alle sprekers voor onze conferenties wordt verwacht dat ze een profielfoto uploaden. Ook een biografie
            is van elke spreker gewenst.
        </p>
        <p>Gelieve deze informatie hier in te geven.</p>
    </div> 
</div>

<?php
$attributes = array('name' => 'myform', 'enctype' => 'multipart/form-data');
echo form_open('spreker/updateBiografie', $attributes);
?>
<div class="row">
        <label for="userfile" class="col-sm-2 control-label">Foto: </label>
        
    <div class="col-sm-4">
        <input id="userfile" type="file" name="userfile" class=""/>
    </div>
</div>
<div class="italic col-sm-8">
    Enkel JPG afbeeldingen toegestaan. Maximum 250x250 pixels.
</div>

<br/>

<div class="row">
    <label for="biografie" class="col-sm-2 control-label">Biografie: </label>    
    <div class="col-sm-8">
        <textarea required id="biografie" name="biografie" rows="10" class="form-control"></textarea>
    </div>
</div>

<input type="submit" value="Bevestigen" class="space-top col-sm-offset-2 col-sm-4 btn btn-primary"/>
</form>