<div class="col-md-10">
    <h1>Gebouw wijzigen</h1>

    <form action="gebouw/opslaan" method="post">

        <div class="row">            
            <label for="naam" class="control-label col-md-2">Naam:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="naam" name="naam" value="<?php echo $gebouw->naam ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="postcode" class="control-label col-md-2">Postcode:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="postcode" name="postcode" value="<?php echo $gebouw->postcode ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="gemeente" class="control-label col-md-2">Gemeente:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="gemeente" name="gemeente" value="<?php echo $gebouw->gemeente ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="straat" class="control-label col-md-2">Straat:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="straat" name="straat" value="<?php echo $gebouw->straat ?>"/>                
            </div>
        </div>
        <div class="row">            
            <label for="nummer" class="control-label col-md-2">Nummer:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="nummer" name="nummer" value="<?php echo $gebouw->nummer ?>"/>                
            </div>
        </div>        

       

<div class="row">
    <div class="col-md-12">                
        <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
        <input type="submit" value="Opslaan" class="btn btn-default"/>             
    </div>
</div>

</form>


</div>