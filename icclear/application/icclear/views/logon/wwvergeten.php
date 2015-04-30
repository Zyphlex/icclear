

<?php 
    $attributes = array('name' => 'myform', 'method' => 'post','class' => 'form-horizontal');
    echo form_open('logon/resetPass', $attributes);
?>   
        
        <div class="row">
            <div class="text-center underline">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Aanmelden</h3>
            </div>   
                
            <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?> 
            <div class="col-sm-8">
                <?php echo form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control', 'size' => '30')); ?>        
            </div>
        </div>


        <div class="col-xs-12 margin-top space-bottom">
            <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
            <input type="submit" name="mysubmit" value="Verstuur Email" class="btn btn-primary"  />
        </div>
    
<?php echo form_close(); ?>