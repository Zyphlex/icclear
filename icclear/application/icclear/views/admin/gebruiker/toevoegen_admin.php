
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Admin toevoegen</h1>
        </div>
    </div>
    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('gebruiker/insertAdmin', $attributes);
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
                    <label for="type">
                        Type:
                    </label>  
                </div>  

                <div class="col-md-8">        
                    <div class="my-radio">
                        <div class="">
                            <input type="radio" name="type" id="field9-3" class="form-horizontal" value="3" checked="checked">
                            <span class="option-title">
                                Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <?php echo anchor('gebruiker/overzichtAdmins', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('toevoegen', 'Toevoegen', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>
</div>
