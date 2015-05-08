<div class="row">
    <div class="col-md-12">
        <h1 style="text-align: center;">Contact</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    <form action="contact/insturen" method="post">        
        <p><?php echo form_label('Uw emailadres:', 'emailadresverzender'); ?></p>
        <p><?php echo form_input(array('name' => 'emailadresverzender', 'id' => 'emailadresverzender', 'class' => 'form-control')); ?></p>
        
        <p><?php echo form_label('Onderwerp:', 'onderwerpverzender'); ?></p>
        <p><?php echo form_input(array('name' => 'onderwerpverzender', 'id' => 'onderwerpverzender', 'class' => 'form-control')); ?></p>
        
        <p><?php echo form_label('Boodschap/vraag:', 'boodschapcontact'); ?></p>
        <p><?php echo form_textarea(array('name' => 'boodschapcontact', 'id' => 'boodschapcontact', 'rows' => '10', 'cols' => '50', 'class' => 'form-control')); ?></p>
        <p><input type="submit" value="Verzenden"/></p>
    </form>
        </div>
</div>




