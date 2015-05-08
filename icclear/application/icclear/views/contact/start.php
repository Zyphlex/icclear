<div class="row">
    <div class="col-md-12">
        <h1 style="text-align: center;">Neem contact op met ons</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-offset-1">
        <p>ICClear Brussel</p>
        <p>014/404040</p>
        <p>Nieuwstraat 1</p>
        <p>1000 Brussel</p>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-offset-1">
        <form action="contact/insturen" method="post">        
            <p><?php echo form_label('Uw emailadres:', 'emailadresverzender'); ?></p>
            <p><?php echo form_input(array('name' => 'emailadresverzender', 'id' => 'emailadresverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

            <p><?php echo form_label('Onderwerp:', 'onderwerpverzender'); ?></p>
            <p><?php echo form_input(array('name' => 'onderwerpverzender', 'id' => 'onderwerpverzender', 'class' => 'form-control', 'required' => 'required')); ?></p>

            <p><?php echo form_label('Boodschap/vraag:', 'boodschapcontact'); ?></p>
            <p><?php echo form_textarea(array('name' => 'boodschapcontact', 'id' => 'boodschapcontact', 'rows' => '10', 'cols' => '50', 'class' => 'form-control', 'required' => 'required')); ?></p>
            <p><input type="submit" value="Verzenden" class="btn btn-default"/></p>
        </form>
    </div>
</div>




