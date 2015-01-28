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


<form action="spreker/indienen">
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

<br/>

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
        <label for="biografie" class="control-label">Omschrijving: </label>
    </div>
    <div class="col-md-8">
        <textarea id="biografie" name="biografie" rows="10" class="form-control"></textarea>
    </div>
</div>
    
<br/>

<div class="row">
    <div class="col-md-2">
        <label for="sessiebijlage" class="control-label">Bijlage: </label>
    </div>
    <div class="col-md-2 fileUpload btn btn-default">
        <p><span>Bestand selecteren</span>
            <input id="sessiebijlage" type="file" name="sessiebijlage" class="upload"/></p>
    </div>
    <p class="italic">
        Vestibulum in velit at nibh euismod commodo. 
        Aliquam vitae urna consectetur metus convallis sodales. 
        Donec suscipit eu velit ac tempor. 
    </p>
</div>

<br/><br/>

<div class="row">
    <div class="col-md-12">        
        <?php echo anchor('spreker', 'Annuleren','class="btn btn-default"'); ?>     
        <input type="submit" class="btn btn-default" value="Voorstel versturen">
    </div>
</div>

</form>