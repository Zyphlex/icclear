<div class="col-md-10">

    <h1>Sessies wijzigen.</h1>   
    
    <?php
        $attributes = array('name' => 'myform');
        echo form_open('sessie/opslaan', $attributes);
    ?>
        
    <div class="row">
        <div class="col-md-3">
        <label for="onderwerp">Onderwerp:</label>   
        </div>
        
        <div class="col-md-5">
        <input type="text" name="onderwerp" value="<?php echo $sessie->onderwerp ?>" id="onderwerp" size="30" class="form-control"  />    
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-3">
            <label for="sprekernaam">Spreker:</label>
        </div>
        
        <div class="col-md-5">
            <p name="sprekernaam" class="form-control"><?php echo $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam ?></p>    
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-3">
        <label for="zaal">Zaal:</label>   
        </div>
        
        <div class="col-md-5">
        <select name="zaal" id="zaal" class="form-control">
            <?php foreach($zalen as $z) { 
            if ($zalen->id == $sessie->zaalId) { ?>
                <option selected="selected"><?php echo $z->naam ?></option>
            <?php } else { ?>
                <option><?php echo $z->naam ?></option>
            <?php }} ?>
        </select>
        
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-3">
        <label for="omschrijving">Omschrijving:</label>    
        </div>
        
        <div class="col-md-5">
            <textarea cols="10" rows="10" name="omschrijving" class="form-control"><?php echo $sessie->omschrijving ?></textarea>    
        </div>
    </div>
    
    <input type="hidden" name="sessieId" id="sessieId" value="<?php echo $sessie->id ?>"/>
    <div class="row">
        <div class="col-md-3">
            <p>
                <input type="submit" value="Opslaan" class="btn btn-default"/>
                <a href="javascript:history.go(-1);" class="btn btn-danger">Annuleren</a>
            </p>
        </div>
    </div>
        
    <?php echo form_close(); ?>
    
</div>
