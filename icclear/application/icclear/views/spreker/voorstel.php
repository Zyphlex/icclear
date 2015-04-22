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



<br/><br/>

<div class="row">
    <div class="col-md-12">        
        <?php echo anchor('spreker', 'Annuleren','class="btn btn-default"'); ?>   
        
        <?php if ($user == null) { ?>
            <a href="<?php echo base_url(); ?>icclear.php/spreker/login" data-toggle="modal" data-target="#myModal">Aanmelden en verder</a>
        <?php } else { ?>
            <input type="submit" value="Bevestigen en betalen" class="btn btn-default"/>
        <?php } ?>
    </div>
</div>

</form>