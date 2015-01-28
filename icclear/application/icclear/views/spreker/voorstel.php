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
    <div class="col-md-2 fileUpload btn btn-default">
        <span>Bestand selecteren</span>
        <input id="foto" type="file" name="foto" class="upload"/>
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
    
    
<br/><br/>
    
    
<div class="row">
    <div class="col-md-8">
        <h2>Sessie voorstel</h2>
        <p>
            Praesent sed est id leo molestie malesuada. Pellentesque interdum elit eu neque facilisis, eget elementum ante tempor. 
            Nunc dictum venenatis magna non tincidunt. Vestibulum vitae faucibus odio, et posuere est. Sed ac nisi ex. 
            Donec porttitor vitae sapien nec laoreet. Maecenas dignissim dignissim justo a maximus.
        </p>        
    </div> 
</div>

<div class="row">
    <div class="col-md-2">
        <label for="sessieonderwerp" class="control-label">Onderwerp: </label>
    </div>
    <div class="col-md-2">
        <input id="sessieonderwerp" type="text" name="sessieonderwerp" class="form-control"/>
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
    
<div class="row">
    <div class="col-md-2">
        <label for="sessiebijlage" class="control-label">Bijlage: </label>
    </div>
    <div class="col-md-2 fileUpload btn btn-default">
        <span>Bestand selecteren</span>
        <input id="sessiebijlage" type="file" name="sessiebijlage" class="upload"/>
    </div>
</div>