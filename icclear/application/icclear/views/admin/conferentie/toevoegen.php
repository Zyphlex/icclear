<div class="col-md-10">
    <h1>Conferentie wijzigen</h1>

    

    <form class="form-horizontal" action="conferentie/opslaan" method="post">

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
            <label for="land" class="control-label col-md-2">Stad</label>
            <div class="col-md-4">
                <select id="land" name="land" class="form-control">
                    <option>België</option>
                </select>
            </div>            
        </div>
        
        <div class="row"> 
            <label for="stad" class="control-label col-md-1">Stad</label>
            <div class="col-md-3">
                <input type="text" id="stad" name="stad" class="form-control"/>
            </div>
            
            <label for="straat" class="control-label col-md-1 border-left">Straat</label>
            <div class="col-md-4">
                <input type="text" id="straat" name="straat" class="form-control"/>
            </div>
            
            <label for="nr" class="control-label col-md-1">Nr.</label>
            <div class="col-md-2">
                <input type="number" id="nr" name="nr" class="form-control"/>
            </div>
        </div>
        
    </form>


</div>