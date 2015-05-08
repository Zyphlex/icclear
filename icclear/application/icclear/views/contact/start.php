<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <h1 class="underline">Contactgegevens</h1>

            <div class="col-sm-10 space-bottom">
                <h3><span class="fa fa-home"></span> Adres</h3>
                <p>ICClear Geel</p>
                <p>014/404040</p>
                <p>Kleinhoefstraat 4</p>
                <p>2440 Geel, België</p>
                <h3 class="space-top-15"><span class="fa fa-phone"></span> Telefoon</h3>
                <p>014 / 50 60 70</p>
            </div>
            
            <div class="col-sm-10">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5004.388727366072!2d4.960560861577568!3d51.16020604258717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c14c06d6fc9923%3A0x3632599b5a446df0!2sKleinhoefstraat+4%2C+2440+Geel%2C+Belgium!5e0!3m2!1sen!2s!4v1431101776023" 
                        width="100%" height="auto" class="img-responsive" frameborder="0" style="border:0">                        
                </iframe>
            </div>

    </div>
    </div>

    <div class="col-sm-6">
        <div class="row">
        <h1 class="underline">Neem contact op met ons</h1>
        
            <?php
            $attributes = array('name' => 'myform');
            echo form_open('contact/insturen', $attributes);
            ?>    
                <p class="col-sm-8"><?php echo form_label('Uw emailadres:', 'emailadresverzender'); ?></p>
                <p class="col-sm-8"><?php echo form_input(array('name' => 'emailadresverzender', 'id' => 'emailadresverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

                <p class="col-sm-8"><?php echo form_label('Onderwerp:', 'onderwerpverzender'); ?></p>
                <p class="col-sm-8"><?php echo form_input(array('name' => 'onderwerpverzender', 'id' => 'onderwerpverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

                <p class="col-sm-8"><?php echo form_label('Boodschap/vraag:', 'boodschapcontact'); ?></p>
                <p class="col-sm-12"><?php echo form_textarea(array('name' => 'boodschapcontact', 'id' => 'boodschapcontact', 'rows' => '10', 'cols' => '50', 'class' => 'form-control', 'required' => 'required')); ?></p>
                
                <div class="col-sm-12 btn-group">
                    <?php echo form_submit('mysubmit', 'Bericht versturen', 'class="col-xs-8 btn btn-primary"'); ?>   
                    <?php echo anchor('home','Annuleren','class="col-xs-4 btn btn-default"') ?>     
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>




