
<div class="col-md-10">
    <div class="panel panel-default" role="tablist">

        <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
                <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                    Geselecteerde FAQ wijzigen
                </span>
            </h4>
        </div>

        <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <div class="panel-body">
                <?php
                $attributes = array('name' => 'myform', 'id' => 'myform');
                echo form_open('faqbeheer/update', $attributes);
                echo form_hidden('id', $gebruiker->id);
                ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">  

                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('Vraag:', 'vraag'); ?>
                                </div>

                                <div class="col-md-8">
                                    <?php echo form_input(array('name' => 'vraag', 'id' => 'vraag', 'value' => $vraag->vraag, 'class' => 'form-control', 'required' => 'required')); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">   
                                    <label for="antwoord">
                                        Antwoord:
                                    </label>
                                </div>

                                <div class="col-md-8">   
                                    <textarea name="antwoord" value="<?php echo $vraag->antwoord; ?>" id="antwoord" class="form-control" required="required">

                                    </textarea>
                                </div>
                            </div>
                            
                        </div>

        

                    </div>

                </div>

                <?php echo anchor('faq/beheer', 'Annuleer', 'class="btn btn-default"'); ?>
                <?php echo form_submit('opslaan', 'Opslaan', 'class="btn btn-primary"'); ?>

                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
