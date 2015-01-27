<div class="col-md-10">

    <h1>Sessies wijzigen.</h1>   

    <div class="row">
            <div class="col-md-3">      
                <label for="naam">Gebruikersnaam:</label>    
            </div>

            <div class="col-md-4">
                <input type="text" name="naam" value="" id="naam" size="30" class="form-control"  />    
            </div>
        </div>

        <div class="row">     
            <div class="col-md-3">
                <label for="password">Wachtwoord:</label>    
            </div>

            <div class="col-md-4">
                <input type="password" name="password" value="" id="password" size="30" class="form-control"  />    
            </div>
        </div>
        
        <div class="row">     
            <div class="col-md-3"></div>

            <div class="col-md-4">  
                <a href="<?php echo base_url(); ?>index.php/logon/vergeten" data-dismiss="modal" data-toggle="modal" data-target="#myModal2">Wachtwoord vergeten?</a>
            </div>
        </div>
    
</div>
