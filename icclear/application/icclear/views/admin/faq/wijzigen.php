<div class="col-md-10">  

    <div class="row">
        <div class="col-md-12">
            <h1>FAQ wijzigen</h1>
        </div>
    </div>

    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('faqbeheer/update', $attributes);
    echo form_hidden('id', $id);
    ?>

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
                    <textarea name="antwoord" id="antwoord" class="form-control" required="required" rows="5" cols="10"><?php echo $vraag->antwoord; ?></textarea>
                </div>
            </div>

        </div>
        
    </div>

    <?php echo anchor('faqbeheer', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('faqbeheer/opslaan', 'Opslaan', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>

</div>





