<div class="row">
    <div class="col-sm-12">
        <h1>Conferentie <?php echo $conferentie->naam ?> - Voorstel voor sessie indienen</h1>
    </div>
</div>    


    
<?php
        $attributes = array('name' => 'myform');
        if ($user == null) {
            echo form_open('spreker/aanmeldenEnVerzenden', $attributes);
        } else {
            echo form_open('spreker/indienen', $attributes);
        }
?>  
    <div class="row">
        
        <div class="col-sm-8 space-bottom">
            <h2>Sessie voorstel</h2>
            <p>
                Praesent sed est id leo molestie malesuada. Pellentesque interdum elit eu neque facilisis, eget elementum ante tempor. 
                Nunc dictum venenatis magna non tincidunt. Vestibulum vitae faucibus odio, et posuere est. Sed ac nisi ex. 
                Donec porttitor vitae sapien nec laoreet. Maecenas dignissim dignissim justo a maximus.
            </p>        
        </div> 
    </div>

    <div class="row">
        <label for="sessieonderwerp" class="col-sm-3 control-label">Onderwerp: </label>
        <div class="col-sm-9 space-bottom">
            <input id="sessieonderwerp" type="text" name="sessieonderwerp" class="form-control"/>
        </div>



        <label for="sessieomschrijving" class="col-sm-3 control-label">Omschrijving: </label>
        <div class="col-sm-9 space-bottom">
            <textarea id="sessieomschrijving" name="sessieomschrijving" rows="10" class="form-control"></textarea>
        </div>



        <div class=" col-sm-12 btn-group">
            <a href="<?php echo base_url(); ?>icclear.php/home" class="btn btn-default">Annuleren</a>
            <?php if ($user == null) { ?>
                <?php echo form_submit('mysubmit', 'Aanmelden en verzenden', 'class="btn btn-primary"'); ?>
            <?php } else { ?>
                <?php echo form_submit('mysubmit', 'Verzenden', 'class="btn btn-primary"'); ?>
            <?php } ?>
        </div>
    </div>
<?php echo form_close(); ?>