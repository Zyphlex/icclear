<div class="col-md-10">
    <h1>Conferentie wijzigen</h1>

    

    <form class="form-horizontal" action="conferentie/opslaan" method="post">

        <div class="row">            
            <div class="col-md-6">
                <p>
                    <label for="naam" class="form-label">Naam:</label>
                    <input class="form-control" type="text" id="naam" name="naam"/>
                </p>
            </div>
            
        </div>

        <div class="row">            
            <div class="col-md-6">
                <label for="begindatum" class="form-label">Begin datum:</label>                
                <input type="date" id="begindatum" name="begindatum" class="form-control"/>
            </div>
            
                <label for="einddatum" class="form-label col-md-2 border-left">Eind datum:</label>
            <div class="col-md-4">
                <input type="date" id="einddatum" name="einddatum" class="form-control"/>
            </div>
        </div>
        
        <div class="row">            
            <div class="col-md-6">
                <label for="land" class="form-label">Stad</label>
                <select id="land" name="land" class="form-control">
                    <option>België</option>
                </select>
            </div>            
        </div>
        
        <div class="row"> 
            <div class="col-md-4">
                <label for="stad" class="form-label">Stad</label>
                <input type="text" id="stad" name="stad" class="form-control"/>
            </div>
            
            <div class="col-md-4 border-left">
                <label for="straat" class="form-label">Straat</label>
                <input type="text" id="straat" name="straat" class="form-control"/>
            </div>
            
            <div class="col-md-4">
                <label for="nr" class="form-label">Nr.</label>
                <input type="number" id="nr" name="nr" class="form-control"/>
            </div>
        </div>
        
    </form>


</div>