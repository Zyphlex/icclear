<div class="row">
    <div class="col-md-8">                         
        <a href="<?php echo base_url(); ?>icclear.php/home">
            <img id="ic-logo" src="<?php echo base_url() . APPPATH; ?>img/default/icclear.png" />
        </a>
    </div>

    <div class="col-md-4">
        <div class="">
        <span class="logonheader italic talen space-right15">
            <a class="red" href="#">NL</a> 
            / 
            <a href="#">EN</a> 
            / 
            <a href="#">FR</a> 
            / 
            <a href="#">GER</a> 
        </span>

        <?php if ($user == null) { // niet aangemeld ?>  

            <span class="logon">
                <a href="#" data-toggle="modal" data-target="#loginModal">Aanmelden</a> 
                / 
                <a href="#" data-toggle="modal" data-target="#registreerModal">Registreer</a>
            </span>

        <?php } else {  // wel aangemeld ?>

            <div class="dropdown logon">
                <span class="glyphicon glyphicon-user"></span>
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

        <?php } ?>
    </div>
    </div>
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
            <script language="javascript">
                function finishAjax(id, response) {
                    $('#' + id).html(unescape(response));
                    $('#' + id).fadeIn();
                }
                $(document).ready(function () {                    

                    $("#mySubmit").click(function (e) {
                        e.preventDefault();
                        if (validatieOK() && validate() && realCheck1()) {
                            $("#myForm").submit();
                        }

                    });

                    $("#password2").keyup(validate);

                });
                
                
                function validatieOK() {
                        ok = true;
                        if ($("#password1").val() == "") {
                            $("#password1div").addClass("has-error");
                            $("#password1div").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#password1div").removeClass("has-error");
                            $("#password1div").addClass("has-success");
                        }
                        if ($("#password2").val() == "") {
                            $("#password2div").addClass("has-error");
                            $("#password2div").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#password2div").removeClass("has-error");
                            $("#password2div").addClass("has-success");
                        }

                        if ($("#voornaam").val() == "") {
                            $("#voornaamdiv").addClass("has-error");
                            $("#voornaamdiv").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#voornaamdiv").removeClass("has-error");
                            $("#voornaamdiv").addClass("has-success");
                        }

                        if ($("#familienaam").val() == "") {
                            $("#familienaamdiv").addClass("has-error");
                            $("#familienaamdiv").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#familienaamdiv").removeClass("has-error");
                            $("#familienaamdiv").addClass("has-success");
                        }
                        if ($("#emailadres").val() == "") {
                            $("#emaildiv").addClass("has-error");
                            $("#emaildiv").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#emaildiv").removeClass("has-error");
                            $("#emaildiv").addClass("has-success");
                        }

                        return ok;
                }
                
                
                function validate() {
                        ok = true;
                        var password1 = $("#password1").val();
                        var password2 = $("#password2").val();
                        if (password1 == password2) {
                            $("#validate-status").text("Correct");
                            $("#validate-status").removeClass("form-note-used");
                            $("#validate-status").addClass("form-note-ok");
                            $("#password2div").removeClass("has-error");
                            $("#password2div").addClass("has-success");
                        }
                        else {
                            $("#validate-status").text("Incorrect");
                            $("#validate-status").removeClass("form-note-ok");
                            $("#validate-status").addClass("form-note-used");
                            $("#password2div").addClass("has-error");
                            $("#password2div").removeClass("has-success");
                            ok = false;
                        }
                    return ok;
                }

                function realCheck1() {
                    ok = false;
                    mail = $('#emailadres').val();
                    $.ajax({
                        type: "POST",
                        url: site_url + "/logon/check_email_availablity",
                        async: false,
                        data: {email: mail},
                        success: function(result) {
                            if (result == '0') {
                                $('#feedbackemail').html("<p class='form-note form-note-used'>Niet beschikbaar</p>");
                                $("#emaildiv").addClass("has-error");
                                $("#emaildiv").removeClass("has-success");
                            } else {
                                $('#feedbackemail').html("<p class='form-note form-note-ok'>Beschikbaar</p>");
                                $("#emaildiv").removeClass("has-error");
                                $("#emaildiv").addClass("has-success");
                                ok = true;
                            }
                        }
                    });
                    return ok;
                }

            </script>

            <?php
            $attributes = array('class' => 'registreer', 'id' => 'myForm', 'class' => 'form-horizontal');
            echo form_open('logon/add', $attributes);
            ?>

            <div class="text-center underline">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Registreren</h3>
            </div>

            <div class="row">
                <div class=""> 
                    <div id="emaildiv">                        
                        <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?>                         
                        <span id="feedbackemail" class="form-note"></span> 
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadres', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="password1div"> 
                        <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>    
                        <div class="col-sm-8">                       
                            <?php echo form_password(array('name' => 'wachtwoord1', 'id' => 'password1', 'class' => 'form-control')); ?> 
                        </div>
                    </div>

                    <div id="password2div">
                        <?php echo form_label('Bevestigen:', 'bevestigww', array('class' => 'col-sm-4 control-label')); ?>
                        <span id="validate-status" class="form-note"></span>              
                        <div class="col-sm-8">                                        
                            <?php echo form_password(array('name' => 'bevestigww', 'id' => 'password2', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="voornaamdiv">
                        <?php echo form_label('Voornaam:', 'voornaam', array('class' => 'col-sm-4 control-label')); ?>   
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="familienaamdiv">
                        <?php echo form_label('Familienaam:', 'familienaam', array('class' => 'col-sm-4 control-label')); ?>  
                        <div class="col-sm-8">  
                            <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="geslachtdiv">     
                        <?php echo form_label('Geslacht:', 'geslacht', array('class' => 'col-sm-4 control-label')); ?>       
                        <div class="col-sm-8">  
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslacht', 'value' => 'Man', 'type' => 'radio')); ?>   
                                <span class="option-title">Man</span>
                            </div> 
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslacht', 'value' => 'Vrouw', 'type' => 'radio')); ?>                                
                                <span class="option-title">Vrouw</span>
                            </div>
                        </div>
                    </div>

                </div>    

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-4 btn btn-default" data-dismiss="modal">Annuleren</button>  
                        <button name="mysubmit" id="mySubmit" class="col-xs-8 btn btn-primary">Registreren</button>
                    </div>
                </div>

            </div>     
            <?php echo form_close(); ?>

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
