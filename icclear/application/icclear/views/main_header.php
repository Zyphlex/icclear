<div class="row">
    <div class="col-md-8">
        <img id="ic-logo" src="<?php echo base_url() . APPPATH; ?>img/default/icclear.png" />
    </div>
    
<?php if ($user == null) { // niet aangemeld ?>  
    
    <div class="col-md-4">
        <p>
            <span class="logon">
                <a href="#" data-toggle="modal" data-target="#loginModal">Aanmelden</a> 
                / 
                <a href="<?php echo base_url(); ?>icclear.php/logon/register" data-toggle="modal" data-target="#registreerModal">Registreer</a>
            </span>
        </p>
    </div>
    
<?php } else {  // wel aangemeld ?>
    
    <div class="col-md-4">
            <div class="dropdown logon">Welkom, 
                <a data-toggle="dropdown">
                    <span class="login-user"><?php echo strtoupper($user->voornaam)?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">                                        
                    <li><a href="<?php echo base_url(); ?>icclear.php/profiel/instellingen"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>  Instellingen</a></li>     
                    <li class="divider"></li>
                    <li class="small">  <?php echo anchor('logon/logout', 'LOGOUT'); ?></li>
                </ul>
            </div>
        
            <div class="dropdown logon">
                <a href="#" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">                    
                    <span class="login-user"><?php echo strtoupper($user->voornaam) . " " . strtoupper($user->familienaam); ?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="<?php echo base_url(); ?>icclear.php/profiel/instellingen"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>  Instellingen</a></li>     
                    <li class="divider"></li>
                    <li class="small">  <?php echo anchor('logon/logout', 'LOGOUT'); ?></li>
                </ul>
            </div>

    </div>
    
<?php } ?>
</div>



<!-- Modal Inloggen -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <?php
            $attributes = array('name' => 'myform', 'class' => 'form-horizontal');
            echo form_open('logon/aanmelden', $attributes);
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

                <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>           
                <div class="col-sm-8">
                    <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'size' => '30')); ?> 
                </div>


                <div class="col-sm-8 col-sm-offset-4">  
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#vergetenModal">Wachtwoord vergeten?</a>
                </div>


                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-4 btn btn-default" data-dismiss="modal">Annuleren</button>   
                        <?php echo form_submit('mysubmit', 'Aanmelden', 'class="col-xs-8 btn btn-primary"'); ?>
                    </div>
                </div>
                
            </div>     
            <?php echo form_close(); ?>    
            
        </div>            
    </div>
</div>

<!-- Modal Registreren -->
<div class="modal fade" id="registreerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            
            
        </div>            
    </div>
</div>

<!-- Modal wachtwoord vergeten -->
<div class="modal fade" id="vergetenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <?php
            $attributes = array('name' => 'myform', 'method' => 'post', 'class' => 'form-horizontal');
            echo form_open('logon/resetPass', $attributes);
            ?>   

            <div class="row">
                <div class="text-center underline">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Wachtwoord vergeten</h3>
                </div>   

                <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?> 
                <div class="col-sm-8">
                    <?php echo form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control', 'size' => '30')); ?>        
                </div>

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-4 btn btn-default" data-dismiss="modal">Annuleren</button>   
                        <?php echo form_submit('mysubmit', 'Verstuur Email', 'class="col-xs-8 btn btn-primary"'); ?>
                    </div>
                </div>

            </div>
            <?php echo form_close(); ?>
            
        </div>            
    </div>
</div>
