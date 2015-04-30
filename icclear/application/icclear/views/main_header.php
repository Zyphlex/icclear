<div class="row">
    <div class="col-md-8">
        <img id="ic-logo" src="<?php echo base_url() . APPPATH; ?>img/default/icclear.png" />
    </div>
    
<?php if ($user == null) { // niet aangemeld ?>  
    
    <div class="col-md-4 logon">
        <p>
            <span class="">
                <a href="#" data-toggle="modal" data-target="#myModal">Aanmelden</a> 
                / 
                <a href="<?php echo base_url(); ?>icclear.php/logon/register" data-toggle="modal" data-target="#myModal1">Registreer</a>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <?php
            $attributes = array('name' => 'myform', 'class' => 'form-horizontal');
            echo form_open('inschrijven/aanmelden', $attributes);
            ?>
            <div class="row">
                
                <div class="text-center underline">
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
                    <a href="<?php echo base_url(); ?>icclear.php/logon/vergeten" data-dismiss="modal" data-toggle="modal" data-target="#myModal2">Wachtwoord vergeten?</a>
                </div>


                <div class="col-xs-12 margin-top">
                    <div class="btn-group btn-block">
                        <a href="javascript:history.go(-1)" class="col-xs-4 btn btn-default">Terug</a>
                        <?php echo form_submit('mysubmit', 'Aanmelden', 'class="col-xs-8 btn btn-primary"'); ?>
                    </div>
                </div>
                
            </div>     
            <?php echo form_close(); ?>    
            
        </div>            
    </div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>
