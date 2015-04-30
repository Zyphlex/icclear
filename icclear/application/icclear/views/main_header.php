<div class="row">
    <div class="col-md-8">
        <img id="ic-logo" src="<?php echo base_url() . APPPATH; ?>img/default/icclear.png" />
    </div>
    
<?php if ($user == null) { // niet aangemeld ?>  
    
    <div class="col-md-4 logon">
        <p>
            <span class="">
                <a href="<?php echo base_url(); ?>icclear.php/logon/login" data-toggle="modal" data-target="#myModal">Aanmelden</a> 
                / 
                <a href="<?php echo base_url(); ?>icclear.php/logon/register" data-toggle="modal" data-target="#myModal1">Registreer</a>
            </span>
        </p>
    </div>
    
<?php } else {  // wel aangemeld ?>
    
    <div class="col-md-4">
            <div class="dropdown logon">Welkom, 
                <a data-toggle="dropdown">
                    <span class="login-user"><?php echo strtoupper($user->voornaam) ?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">                                        
                    <li><a href="<?php echo base_url(); ?>icclear.php/profiel/instellingen"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>  Instellingen</a></li>     
                    <li class="divider"></li>
                    <li class="small">  <?php echo anchor('logon/logout', 'LOGOUT'); ?></li>
                </ul>
            </div>
        
            <div class="dropdown">
                <button class="logon" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown trigger
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    ...
                </ul>
            </div>

    </div>
    
<?php } ?>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>
