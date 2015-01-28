<div class="row">
    <div class="col-md-12">
        <h1>Conferentie <?php echo $conferentie->naam ?> - Voorstel voor sessie indienen</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h2>Profielfoto en biografie</h2>
    </div> 
</div>

<div class="row">
    <div class="col-md-2">
        <label for="foto" class="control-label">Foto: </label>
    </div>
    <div class="col-md-4 file btn btn-primary">
        <input id="foto" type="file" name="foto" size="20" class="upload"/>
    </div>
</div>
    
    <br/>
    
<div class="row">
    <div class="col-md-2">
        <label for="biografie">Biografie: </label>
    </div>
    <div class="col-md-8">
        <textarea id="biografie" name="biografie" rows="10" class="form-control"></textarea>
    </div>
</div>