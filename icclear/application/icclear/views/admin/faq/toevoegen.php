<div class="col-md-10">  

    <div class="row">
        <div class="col-md-12">
            <h1>FAQ toevoegen</h1>
        </div>
    </div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('faqbeheer/insert', $attributes);
    ?>           
    <div class="row">
        <div class="col-md-6">  

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Vraag:', 'vraag'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'vraag', 'id' => 'vraag', 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <label for="antwoord">
                        Antwoord:
                    </label>
                </div>

                <div class="col-md-8">   
                    <textarea name="antwoord" id="antwoord" class="form-control" required="required" rows="3"></textarea>
                </div>
            </div>

        </div>

    </div>

    <?php echo anchor('faq/beheer', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('opslaan', 'Opslaan', 'class="btn btn-primary"'); ?>

    <?php echo form_close(); ?>

</div>
