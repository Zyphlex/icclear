<div class="row">
    <div class="col-sm-6">
        <div class="col-md-8">
            <h1>Contactpagina</h1>
        </div>


        <div class="col-md-8">
            <h3>Adres:</h3>
        </div>
        <div class="col-md-8">
            <p>ICClear Brussel</p>
            <p>014/404040</p>
            <p>Nieuwstraat 1</p>
            <p>1000 Brussel</p>
        </div>


    </div>

    <div class="col-sm-6">
        <h1 class="underline">Neem contact op met ons</h1>
        
            <?php
            $attributes = array('name' => 'myform');
            echo form_open('contact/insturen', $attributes);
            ?>    
                <p><?php echo form_label('Uw emailadres:', 'emailadresverzender'); ?></p>
                <p class="col-sm-8"><?php echo form_input(array('name' => 'emailadresverzender', 'id' => 'emailadresverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

                <p><?php echo form_label('Onderwerp:', 'onderwerpverzender'); ?></p>
                <p class="col-sm-8"><?php echo form_input(array('name' => 'onderwerpverzender', 'id' => 'onderwerpverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

                <p><?php echo form_label('Boodschap/vraag:', 'boodschapcontact'); ?></p>
                <p class="col-sm-12"><?php echo form_textarea(array('name' => 'boodschapcontact', 'id' => 'boodschapcontact', 'rows' => '10', 'cols' => '50', 'class' => 'form-control', 'required' => 'required')); ?></p>
                <?php echo anchor('home','Annuleren','class="col-xs-4 btn btn-default"') ?>
                <?php echo form_submit('mysubmit', 'Bericht versturen', 'class="col-xs-8 btn btn-primary"'); ?>        
            <?php echo form_close(); ?>
        
    </div>
</div>




