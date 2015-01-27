<div class="col-md-10">
    <h1>Conferentie wijzigen</h1>

    

    <form action="conferentie/opslaan" method="post">

        <div class="row">            
            <div class="col-md-6">
                <label for="naam">Naam:</label>
                <input class="form-control" type="text" id="naam" name="naam"/>
            </div>
            
        </div>

        <div class="row">            
            <div class="col-md-6">
                <label for="begindatum">Begin datum:</label>
                <input type="date" id="begindatum" name="begindatum" class="form-control"/>
            </div>
            
            <div class="col-md-6  border-left">
                <label for="einddatum">Eind datum:</label>
                <input type="date" id="einddatum" name="einddatum" class="form-control"/>
            </div>
        </div>
        
        <div class="row">            
            <div class="col-md-6">
                <label for="land">Begin datum:</label>
                <select id="land" name="land" class="form-controls">
                    <option></option>
                </select>
            </div>            
        </div>
        
        <div class="row"> 
            <div class="col-md-4  border-left">
                <label for="stad">Stad</label>
                <input type="text" id="stad" name="stad" class="form-control"/>
            </div>
            
            <div class="col-md-4  border-left">
                <label for="straat">Straat</label>
                <input type="text" id="straat" name="straat" class="form-control"/>
            </div>
            
            <div class="col-md-4  border-left">
                <label for="nr">Nr.</label>
                <input type="number" id="nr" name="nr" class="form-control"/>
            </div>
        </div>
        
    </form>


</div>