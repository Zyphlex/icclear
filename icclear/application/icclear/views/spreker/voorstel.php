<div class="row">
    <div class="col-md-12">
        <h1>Voorstel voor sessie indienen - Conferentie <?php echo $conferentie->naam ?></h1>
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
    <div class="col-md-4">
        <input id="foto" type="file" name="foto" size="20" class="form-control"/>
    </div>
</div>
    
    <br/>
    
<div class="row">
    <div class="col-md-2">
        <label for="biografie">Biografie: </label>
    </div>
    <div class="col-md-8">
        <textarea id="biografie" name="biografie" rows="20" cols="20"></textarea>
    </div>
</div>