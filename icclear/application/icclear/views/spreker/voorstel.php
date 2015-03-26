<div class="row">
    <div class="col-md-12">
        <h1>Conferentie <?php echo $conferentie->naam ?> - Voorstel voor sessie indienen</h1>
    </div>
</div>    


    
    
<form action="indienen" method="POST">
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
        <label for="sessieomschrijving" class="control-label">Omschrijving: </label>
    </div>
    <div class="col-md-8">
        <textarea id="sessieomschrijving" name="sessieomschrijving" rows="10" class="form-control"></textarea>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-md-2">
        <label for="sessiebijlage" class="control-label">Bijlage: </label>
    </div>
    <div class="col-md-2 fileUpload btn btn-default">
        <span>Bestand selecteren</span>
        <input id="sessiebijlage" type="file" name="sessiebijlage" class="upload"/>
    </div>
</div>

<div class="row">
    <div class="col-md-4 italic">
        Als u bestanden hebt die u later zal gebruiken, dan kan u ze hier uploaden.
    </div>
</div>

<br/><br/>

<div class="row">
    <div class="col-md-12">        
        <?php echo anchor('spreker', 'Annuleren','class="btn btn-default"'); ?>     
        <input type="submit" class="btn btn-default" value="Voorstel versturen">
    </div>
</div>

</form>