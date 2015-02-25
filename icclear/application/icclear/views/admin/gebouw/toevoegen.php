<div class="col-md-10">
    <h1>Gebouw toevoegen</h1>

    <form action="<?php echo base_url(); ?>icclear.php/gebouw/insert" method="post">

        <div class="row">            
            <label for="naam" class="control-label col-md-2">Naam:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="naam" name="naam"/>                
            </div>
        </div>
        <div class="row">            
            <label for="postcode" class="control-label col-md-2">Postcode:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="postcode" name="postcode"/>                
            </div>
        </div>
        <div class="row">            
            <label for="gemeente" class="control-label col-md-2">Gemeente:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="gemeente" name="gemeente"/>                
            </div>
        </div>
        <div class="row">            
            <label for="straat" class="control-label col-md-2">Straat:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="straat" name="straat"/>                
            </div>
        </div>
        <div class="row">            
            <label for="nummer" class="control-label col-md-2">Nummer:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="nummer" name="nummer"/>                
            </div>
        </div>        

       

<div class="row">
    <div class="col-md-12">                
        <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>         
        <input type="submit" value="Toevoegen" class="btn btn-default"/>             
    </div>
</div>

</form>


</div>
    