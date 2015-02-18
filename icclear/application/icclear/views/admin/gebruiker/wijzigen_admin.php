
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Admin wijzigen</h1>
        </div>
    </div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('gebruiker/updateAdmin', $attributes);
    echo form_hidden('id', $gebruiker->id);
    ?>

    <div class="row">
        <div class="col-md-6">  

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Voornaam:', 'voornaam'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'field2', 'value' => $gebruiker->voornaam, 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="familienaam">
                        Familienaam:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="familienaam" value="<?php echo $gebruiker->familienaam; ?>" id="field1" class="form-control" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="emailadres">
                        Emailadres: 
                    </label>
                </div>  

                <div class="col-md-8">   
                    <input type="text" name="emailadres" value="<?php echo $gebruiker->emailadres; ?>" id="email" class="form-control" required="required">      
                </div>
            </div>
        </div>
    </div>         

</div>

<?php echo anchor('gebruiker/overzichtAdmins', 'Annuleer', 'class="btn btn-default"'); ?>
<?php echo form_submit('opslaan', 'Opslaan', 'class="btn btn-default"'); ?>

<?php echo form_close(); ?>
</div>
