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
        <div>Gelieve deze informatie hier in te geven.</div>
    </div> 
</div>


<div class="row">
    <div class="col-md-2">
        <label for="foto" class="control-label">Foto: </label>
    </div>
    <div class="col-md-2 fileUpload btn btn-default">
        <span>Bestand selecteren</span>
        <input id="foto" type="file" name="foto" class="upload"/>
    </div>
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