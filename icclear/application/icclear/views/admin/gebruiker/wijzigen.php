
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
                echo form_open('gebruiker/update', $attributes);
                echo form_hidden('id', $gebruiker->id);
                ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">  

                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('Voornnaam:', 'voornaam'); ?>
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

                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="geboortedatum">
                                        Geboortedatum:
                                    </label>
                                </div>

                                <div class="col-md-8">   
                                    <input type="date" class="form-control" value="<?php echo $gebruiker->geboortedatum; ?>" id="field7" maxlength="524288" name="geboortedatum" required="required" style="width: 158px;" tabindex="0" title="">
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
                                            <input type="radio" name="geslacht" id="field8-1" <?php if (strtolower($gebruiker->geslacht) == "man") echo 'checked="checked"'; ?> class="form-horizontal" checked="checked" value="Man">
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div> 
                                        
                                        <div class="">
                                            <input type="radio" name="geslacht" id="field8-2" <?php if (strtolower($gebruiker->geslacht) == "vrouw") echo 'checked="checked"'; ?> class="form-horizontal" value="Vrouw">
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>
                                        
                                        }
                                        ?>
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
                                    <?php
                                    foreach ($landen as $land) {
                                        $options[$land->id] = $land->naam;
                                    }
                                    echo form_dropdown('land', $options, $gebruiker->landId, 'class="form-control" id="field9" required="required"');
                                    ?>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="gemeente">
                                            Gemeente:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="gemeente" value="<?php echo $gebruiker->gemeente; ?>" id="field10" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="postcode">
                                            Postcode:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="postcode" value="<?php echo $gebruiker->postcode; ?>" id="field10-b" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="straat">
                                            Straat:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="straat" value="<?php echo $gebruiker->straat; ?>" id="field11" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="huisnummer">
                                            Huisnummer:
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="number" name="huisnummer" value="<?php echo $gebruiker->nummer; ?>" id="field12" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>         

                    </div>

                </div>

                <?php echo form_button('annuleer', 'Annuleer', 'id="annuleer"', 'class="btn btn-default"'); ?>
                <?php echo form_submit('opslaan', 'Opslaan', 'id="opslaan"', 'class="btn btn-primary"'); ?>

                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
