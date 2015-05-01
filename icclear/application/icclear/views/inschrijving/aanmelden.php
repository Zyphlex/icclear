<script language="javascript">
function finishAjax(id, response) {
        $('#' + id).html(unescape(response));
        $('#' + id).fadeIn();
    }
    $(document).ready(function() {
        var resu;
        $('#Loading').hide();
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
            if ($("#password2").val() == "" || validate() == false) {
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
            if (($("#email").val() == "") || $("#email").empty()) {
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

        $("#mySubmit").click(function(e) {
            alert($("#email").val());
            e.preventDefault();
            realCheck();
            if (validatieOK() && validate() && emailCheck()) {
                $("#myForm").submit();
            }

        });
        function emailCheck() {
            ok = true;
            if (resu == 0) {
                ok = false;
            }
            else {
                ok = true;
            }
            return ok;
        }

        function realCheck() {                            
                var a = $("#email").val();
                var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
                if (filter.test(a)) {
                    $.post("<?php echo base_url() ?>icclear.php/logon/check_email_availablity", {
                        email: $('#email').val()
                    }, function(response) {
                        resu = response;
                        $('#Loading').hide();
                        if (response == 0) {
                            $("#feedbackemail").html("<p class='form-note form-note-used'>Niet beschikbaar</p>");
                        }
                        else {
                            $("#feedbackemail").html("<p class='form-note form-note-ok'>Beschikbaar</p>");
                        }
                    }
                    );
                }            
        }

        function validate() {
            ok = true;
            var password1 = $("#password1").val();
            var password2 = $("#password2").val();
            if (password1 == password2) {
                $("#validate-status").text("Correct");
                $("#validate-status").removeClass("form-note-used");
                $("#validate-status").addClass("form-note-ok");
            }
            else {
                $("#validate-status").text("Incorrect");
                $("#validate-status").removeClass("form-note-ok");
                $("#validate-status").addClass("form-note-used");
                ok = false;
            }
            return ok;
        }

        $("#password2").keyup(validate);
               
    });
</script>


<div class="row">
    <div class="col-sm-12 space-bottom">
        <h1>Gelieve eerst in te loggen of registreren</h1>
        <p>Vooraleer wij uw inschrijving kunnen verwerken, moet u eerst inloggen of registreren.</p>
        <p>De inschrijving zal dan automatisch verwerkt worden. U hoeft dus <strong>niet</strong> nog eens in te schrijven.</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <?php
            $attributes = array('name' => 'myform', 'class' => 'form-horizontal');
            echo form_open('inschrijven/aanmelden', $attributes);
            ?>
            <div class="row">
                
                <div class="text-center underline">
                    <h3>Aanmelden</h3>
                </div>   
                
                <?php echo form_label('Emailadres:', 'emaillogon', array('class' => 'col-sm-4 control-label')); ?> 
                <div class="col-sm-8">
                    <?php echo form_input(array('type' => 'email', 'name' => 'emaillogon', 'id' => 'emaillogon', 'class' => 'form-control', 'size' => '30')); ?>        
                </div>

                <?php echo form_label('Wachtwoord:', 'passwordlogon', array('class' => 'col-sm-4 control-label')); ?>           
                <div class="col-sm-8">
                    <?php echo form_password(array('name' => 'passwordlogon', 'id' => 'passwordlogon', 'class' => 'form-control', 'size' => '30')); ?> 
                </div>


                <div class="col-sm-8 col-sm-offset-4">  
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#vergetenModal">Wachtwoord vergeten?</a>
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







    <div class="col-sm-6">
        <div class="panel panel-default">            

            <?php
            $attributes = array('class' => 'registreer', 'id' => 'myForm', 'class' => 'form-horizontal');
            echo form_open('inschrijven/registreer', $attributes);
            ?>

            <div class="text-center underline">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Registreren</h3>
            </div>

            <div class="row">
                <div class=""> 
                    <div id="emaildiv">
<!--                        <span id="Loading">
                            <img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" />
                        </span>-->
                        <div id="feedbackemail"></div>
                        <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?> 
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'emailadres', 'id' => 'email', 'class' => 'form-control')); ?>                    
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
                
            <div class="col-xs-12 margin-top">
                <div class="btn-group btn-block">
                    <a href="javascript:history.go(-1)" class="col-xs-4 btn btn-default">Terug</a>
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
