
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Gebruiker toevoegen</h1>
        </div>
    </div>
    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('gebruiker/insert', $attributes);
    ?>

    <div class="row">
        <div class="col-md-6">  
            <div class="row">
                <div class="col-md-4">   
                    <label for="gebruikersnaam">
                        Gebruikersnaam:   
                    </label> 
                </div>  

                <div class="col-md-8">        
                    <input type="text" name="gebruikersnaam" id="username" class="form-control" required="required">  
                </div>  
            </div>             

            <div class="row">
                <div class="col-md-4">   
                    <label for="voornaam">
                        Voornaam:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="voornaam" id="field2" class="form-control" required="required">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="familienaam">
                        Familienaam:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="familienaam" id="field1" class="form-control" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="emailadres">
                        Emailadres: 
                    </label>
                </div>  

                <div class="col-md-8">   
                    <input type="text" name="emailadres" id="email" class="form-control" required="required">      
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="geboortedatum">
                        Geboortedatum:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="date" class="form-control" id="field7" maxlength="524288" name="geboortedatum" required="required" style="width: 158px;" tabindex="0" title="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="geslacht">
                        Geslacht:
                    </label>  
                </div>  

                <div class="col-md-8">        
                    <div class="my-radio">
                        <div class="">
                            <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" value="Man">
                            <span class="option-title">
                                Man
                            </span>
                        </div>                                
                        <div class="">
                            <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" value="Vrouw">
                            <span class="option-title">
                                Vrouw
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 border-left"> 

            <div class="row">
                <div class="col-md-4">   
                    <label for="land">
                        Land:
                    </label>
                </div>

                <div class="col-md-8">   
                    <select class="form-control"  name="land" id="field9" required="required">
                        <?php
                        foreach ($landen as $land) {
                            echo '<option value="' . $land->id . '">' .
                            $land->naam
                            . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="gemeente">
                        Gemeente:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="gemeente" id="field10" class="form-control" required="required">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="postcode">
                        Postcode:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="postcode" id="field10-b" class="form-control" required="required">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="straat">
                        Straat:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="straat" id="field11" class="form-control" required="required">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="huisnummer">
                        Huisnummer:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="huisnummer" id="field12" class="form-control" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="type">
                        Type:
                    </label>  
                </div>  

                <div class="col-md-8">        
                    <div class="my-radio">
                        <div class="">
                            <input type="radio" name="type" id="field9-1"  class="form-horizontal" value="1">
                            <span class="option-title">
                                Bezoeker
                            </span>
                        </div>                                
                        <div class="">
                            <input type="radio" name="type" id="field9-2" class="form-horizontal" value="2">
                            <span class="option-title">
                                Spreker
                            </span>
                        </div>
                        <div class="">
                            <input type="radio" name="type" id="field9-3" class="form-horizontal" value="3">
                            <span class="option-title">
                                Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <?php echo anchor('gebruiker/overzichtGebruikers', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('toevoegen', 'Toevoegen', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>
</div>
