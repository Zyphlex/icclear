<div class="col-md-10">

    <h1>Sessies wijzigen.</h1>   
    
    <?php
        $attributes = array('name' => 'myform');
        echo form_open('home/aanmelden', $attributes);
    ?>
        <label for="onderwerp">Onderwerp:</label>    
        <input type="text" name="onderwerp" value="<?php $sessie->onderwerp ?>" id="onderwerp" size="30" class="form-control"  />    


        <label for="omschrijving">Omschrijving:</label>    

        <input type="text" name="omschrijving" value="<?php $sessie->omschrijving ?>" id="omschrijving" size="30" class="form-control"  />    

        <input type="hidden" name="sessieId" id="sessieId" value="<?php $sessie->id ?>"/>

        <p>
            <input type="submit" value="Opslaan"/>
            <a href="javascript:history.go(-1);" class="btn btn-danger">Annuleren</a>
        </p>

    <?php echo form_close(); ?>
    
</div>
