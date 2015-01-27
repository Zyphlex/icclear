<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() . APPPATH; ?>/js/bootstrap.js"></script>

<script type="text/javascript">

    $(function() {
        
        $( "button" ).button();
        $( "#geboortedatum" ).datepicker({ dateFormat: 'dd/mm/yy', 
                                        changeMonth: true, 
                                        changeYear: true });
        
    });
    
</script>

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
                echo form_open('gebruiker/toevoegen', $attributes);
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
                                        <?php echo form_label('Familienaam:', 'familienaam'); ?>
                                    </label>
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'field1', 'value' => $gebruiker->familienaam, 'class' => 'form-control', 'required' => 'required')); ?>
                            </div>



                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="emailadres">
                                        <?php echo form_label('Email:', 'emailadres'); ?>
                                    </label>
                                </div>  

                                <div class="col-md-8"> 
                                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'email', 'value' => $gebruiker->emailadres, 'class' => 'form-control', 'required' => 'required')); ?>     
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="geboortedatum">
                                        <?php echo form_label('Geboortedatum:', 'geboortedatum'); ?>
                                    </label>
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatum', 'value' => $gebruiker->geboortedatum, 'class' => 'form-control', 'required' => 'required')); ?>     
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="geslacht">
                                        <?php echo form_label('Geslacht:', 'geslacht'); ?>
                                    </label>  
                                </div>  

                                <div class="col-md-8">        
                                    <div class="my-radio">
                                        <?php
                                        if ($gebruiker->geslacht == strtolower("man")) {
                                            echo '<div class="">
                                            <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" checked="checked" value="Man">
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div> 
                                        <div class="">
                                            <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" value="Vrouw">
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>';
                                        } else {
                                            echo '<div class="">
                                            <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" checked="checked" value="Man">
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div> 
                                                <div class="">
                                            <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" checked="checked" value="Vrouw">
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>';
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
                                       <?php echo form_label('Land:', 'land'); ?>
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
                                            <?php echo form_label('Gemeente:', 'gemeente'); ?>
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="gemeente" value="<?php echo $gebruiker->gemeente; ?>" id="field10" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="postcode">
                                            <?php echo form_label('Postcode:', 'postcode'); ?>
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="postcode" value="<?php echo $gebruiker->postcode; ?>" id="field10-b" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="straat">
                                            <?php echo form_label('Straat:', 'straat'); ?>
                                        </label>
                                    </div>

                                    <div class="col-md-8">   
                                        <input type="text" name="straat" value="<?php echo $gebruiker->straat; ?>" id="field11" class="form-control" required="required">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">   
                                        <label for="huisnummer">
                                            <?php echo form_label('Huisnummer:', 'huisnummer'); ?>
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

                <?php echo form_button('annuleer', 'Annuleer', 'id="annuleer"', 'class="btn btn-default"', 'javascript:history.go(-1)'); ?>
                <?php $class = 'class = "btn btn-priamary"';
                echo form_submit('opslaan', 'Opslaan', $class); ?>

                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
