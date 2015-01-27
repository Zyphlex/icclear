<div class="col-md-10">
    <div class="panel panel-default" role="tablist">

        <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
                <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                    Geselecteerde gebruiker om te beheren
                </span>
            </h4>
        </div>

        <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <div class="panel-body">
                <?php
                $attributes = array('name' => 'myform', 'id' => 'myform');
                echo form_open('gebruiker/registreer', $attributes);
                echo form_hidden('id', $gebruiker->id);
                ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">  

                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="voornaam">
                                        Voornaam:
                                    </label>
                                </div>

                                <div class="col-md-8">   
                                    <input type="text" name="voornaam" value="<?php echo $gebruiker->voornaam; ?>" id="field2" class="form-control" required="required">
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
                        </div>      
                    </div>

                    <?php echo form_close(); ?>
                </div>
                <?php echo anchor('gebruiker/overzichtGebruikers', 'Annuleer','class="btn btn-default"'); ?> 
                <?php echo anchor('gebruiker/toevoegen', 'Opslaan','class="btn btn-primary"'); ?> 
            </div>

        </div>
    </div>
</div>
