<div class="col-md-10">
    <h1>Conferentie toevoegen.</h1>

    <form action="conferentie/opslaan" method="post">

        <div class="row">            
            <label for="naam" class="control-label col-md-2">Naam:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="naam" name="naam"/>                
            </div>
        </div>

        <br/>
        
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
        
        <br/>
        
        <div class="row">            
            <label for="land" class="control-label col-md-2">Land:</label>
            <div class="col-md-4">
                <select id="land" name="land" class="form-control">
                    <option>België</option>
                </select>
            </div>            
            
            <label for="stad" class="control-label col-md-2 border-left">Stad:</label>
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
        
        <br/>
        
        <div class="row">            
            <label for="maxinschrijvingen" class="control-label col-md-3">Max inschrijvingen:</label>
            <div class="col-md-2">
                <input class="form-control" type="number" id="maxinschrijvingen" name="maxinschrijvingen"/>                
            </div>
        </div>
        
        <div class="row">            
            <label for="seminariedag" class="control-label col-md-3">Seminariedag:</label>
            <div class="col-md-2">                
                <label class="radio"><input type="radio" name="seminariedag">Ja</label>
                <label class="radio"><input type="radio" name="seminariedag">Nee</label>               
            </div>
        </div>       
        
        <br/><br/>
        
        <div class="row panel">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Formule</th>
                            <th>Prijs</th>
                            <th>Korting</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>        
        
        <br/><br/>
        
        <div class="row">
            <div class="col-md-12">
                <label for="beschrijving">Beschrijving:</label>    
            </div>

            <div class="col-md-12">
               <textarea rows="10" name="beschrijving" class="form-control"></textarea>    
            </div>
        </div>        
                
        <br/><br/>
        
        <div class="row">
            <div class="col-md-12">
            
            </div>
        </div>
        
        
        
        
        
        <br/>
        
        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Opslaan" class="btn btn-default"/>
                <a href="javascript:history.go(-1);" class="btn btn-danger">Annuleren</a>                
            </div>
        </div>
        
    </form>


</div>