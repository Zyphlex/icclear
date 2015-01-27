<div class="col-md-10">
    <h1>Conferentie toevoegen.</h1>

    <form action="conferentie/opslaan" method="post">

        <div class="row">            
            <label for="naam" class="control-label col-md-2">Naam:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="naam" name="naam"/>                
            </div>
        </div>

        
        <div class="row">            
            <label for="begindatum" class="control-label col-md-2">Begin datum:</label>    
            <div class="col-md-4">            
                <input type="date" id="begindatum" name="begindatum" class="form-control"/>
            </div>
            
            <label for="einddatum" class="control-label col-md-2 border-left">Eind datum:</label>
            <div class="col-md-4">
                <input type="date" id="einddatum" name="einddatum" class="form-control"/>
            </div>
        </div>
        
        
        <div class="row">            
            <label for="land" class="control-label col-md-2">Land:</label>
            <div class="col-md-4">
                <select id="land" name="land" class="form-control">
                    <option>België</option>
                </select>
            </div>            
        </div>
        
        
        <div class="row"> 
            <label for="stad" class="control-label col-md-2">Stad:</label>
            <div class="col-md-4">
                <input type="text" id="stad" name="stad" class="form-control"/>
            </div>
        </div>
        
        <div class="row">            
            <label for="straat" class="control-label col-md-2">Straat:</label>
            <div class="col-md-4">
                <input type="text" id="straat" name="straat" class="form-control"/>
            </div>
            
            <label for="nr" class="control-label col-md-2 border-left">Nr:</label>
            <div class="col-md-2">
                <input type="number" id="nr" name="nr" class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <label for="beschrijving">Beschrijving:</label>    
            </div>

            <div class="col-md-12">
               <textarea cols="50" rows="15" name="beschrijving" class="form-control"><?php echo $sessie->omschrijving ?></textarea>    
            </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Opslaan" class="btn btn-default"/>
                <a href="javascript:history.go(-1);" class="btn btn-danger">Annuleren</a>                
            </div>
        </div>
        
    </form>


</div>