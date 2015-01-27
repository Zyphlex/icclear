

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


                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="voornaam">
                                            Voornaam:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="voornaam" value="<?php echo $gebruiker->voornaam; ?>"  id="field2" class="form-control" required="required">
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
                                            <p><span id="Loading"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span></p>
                                        </label>
                                    </div>  

                                    <div class="col-md-8">   
                                        <input type="text" name="emailadres" value="<?php echo $gebruiker->emailadres; ?>" id="email" class="form-control" required="required">      
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="geboortedatum">
                                            Geboortedatum:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="date" class="form-control" id="field7" maxlength="524288" name="geboortedatum" value="<?php echo $gebruiker->geboortedatum; ?>" required="required" style="width: 158px;" tabindex="0" title="">
                                    </div>
                                </div>
                            </div>
                        </div>         

                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
