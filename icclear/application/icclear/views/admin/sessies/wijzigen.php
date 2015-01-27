<div class="col-md-10">

    <h1>Sessies wijzigen.</h1>   
    
                <label for="onderwerp">Onderwerp:</label>    
            
                <input type="text" name="onderwerp" value="<?php $sessie->onderwerp ?>" id="onderwerp" size="30" class="form-control"  />    
            

                <label for="omschrijving">Omschrijving:</label>    
           
                <input type="text" name="omschrijving" value="<?php $sessie->omschrijving ?>" id="omschrijving" size="30" class="form-control"  />    
           
                <input type="hidden" name="sessieId" id="sessieId" value="<?php $sessie->id ?>"/>
                
                <inut type="submit" value="Opslaan"/>
                <a href="javascript:history.go(-1);">Annuleren</a>
    
</div>
