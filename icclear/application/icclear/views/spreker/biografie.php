<div class="row">
    <div class="col-md-12">
        <h1><?php echo $spreker->familienaam . ' ' . $spreker->voornaam ?> - Biografie en foto</h1>
    </div>
</div>    

<div class="row">
    <div class="col-md-8">
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
    <div class="col-md-2">
        <label for="userfile" class="control-label">Foto: </label>
    </div>
    <div class="col-md-2">
        <input id="userfile" type="file" name="userfile" class=""/>
    </div>
</div>
<div class="row">
    Enkel JPG afbeeldingen toegestaan. Maximum 250x250 pixels.
</div>

<br/>

<div class="row">
    <div class="col-md-2">
        <label for="biografie" class="control-label">Biografie: </label>
    </div>
    <div class="col-md-8">
        <textarea id="biografie" name="biografie" rows="10" class="form-control"></textarea>
    </div>
</div>
<input type="submit" value="Bevestigen" class="btn btn-default"/>
</form>