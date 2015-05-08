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
                Een conferentie kan niet doorgaan zonder sprekers. Misschien heeft u wel kennis over een onderdeel van klare
                taal die u wil delen? Vul in dat geval onderstaand formulier zeker in. Onze organisatoren zullen uw voorstel 
                bekijken en keuren. U wordt via e-mail op de hoogte gebracht als uw voorstel goed wordt gekeurd.
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



        <div class="col-sm-offset-3 col-sm-9 btn-group">
            <?php if ($user == null) { ?>
                <?php echo form_submit('mysubmit', 'Aanmelden en verzenden', 'class="col-xs-6 btn btn-primary"'); ?>
            <?php } else { ?>
                <?php echo form_submit('mysubmit', 'Verzenden', 'class="col-xs-6 btn btn-primary"'); ?>
            <?php } ?>
            <a href="<?php echo base_url(); ?>icclear.php/home" class="col-xs-3 btn btn-default">Annuleren</a>
        </div>
    </div>
<?php echo form_close(); ?>