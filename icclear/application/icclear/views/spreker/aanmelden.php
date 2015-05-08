<div class="row">
    <div class="col-sm-12 space-bottom">
        <h1>Gelieve eerst in te loggen of registreren</h1>
        <p>Vooraleer wij uw voorstel kunnen verwerken, moet u eerst inloggen of registreren.</p>
        <p>Het voorstel zal dan automatisch verstuurt worden. U hoeft het dus <strong>niet</strong> nog eens te versturen!</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <?php
            $attributes = array('name' => 'myform', 'class' => 'form-horizontal');
            echo form_open('spreker/aanmelden', $attributes);
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

<script language="javascript">
                function finishAjax(id, response) {
                    $('#' + id).html(unescape(response));
                    $('#' + id).fadeIn();
                }
                $(document).ready(function () {                    

                    $("#mySubmits").click(function (e) {
                        e.preventDefault();
                        if (validatieOK() && validate() && realCheck1()) {
                            $("#myForms").submit();
                        }

                    });

                    $("#password2s").keyup(validate);

                });
                
                
                function validatieOK() {
                        ok = true;
                        if ($("#password1s").val() == "") {
                            $("#password1divs").addClass("has-error");
                            $("#password1divs").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#password1divs").removeClass("has-error");
                            $("#password1divs").addClass("has-success");
                        }
                        if ($("#password2s").val() == "") {
                            $("#password2divs").addClass("has-error");
                            $("#password2divs").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#password2divs").removeClass("has-error");
                            $("#password2divs").addClass("has-success");
                        }

                        if ($("#voornaams").val() == "") {
                            $("#voornaamdivs").addClass("has-error");
                            $("#voornaamdivs").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#voornaamdivs").removeClass("has-error");
                            $("#voornaamdivs").addClass("has-success");
                        }

                        if ($("#familienaams").val() == "") {
                            $("#familienaamdivs").addClass("has-error");
                            $("#familienaamdivs").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#familienaamdivs").removeClass("has-error");
                            $("#familienaamdivs").addClass("has-success");
                        }
                        if ($("#emailadress").val() == "") {
                            $("#emaildivs").addClass("has-error");
                            $("#emaildivs").removeClass("has-success");
                            ok = false;
                        }
                        else {
                            $("#emaildivs").removeClass("has-error");
                            $("#emaildivs").addClass("has-success");
                        }

                        return ok;
                }
                
                
                function validate() {
                        ok = true;
                        var password1 = $("#password1s").val();
                        var password2 = $("#password2s").val();
                        if (password1 == password2) {
                            $("#validate-statuss").text("Correct");
                            $("#validate-statuss").removeClass("form-note-used");
                            $("#validate-statuss").addClass("form-note-ok");
                            $("#password2divs").removeClass("has-error");
                            $("#password2divs").addClass("has-success");
                        }
                        else {
                            $("#validate-statuss").text("Incorrect");
                            $("#validate-statuss").removeClass("form-note-ok");
                            $("#validate-statuss").addClass("form-note-used");
                            $("#password2divs").addClass("has-error");
                            $("#password2divs").removeClass("has-success");
                            ok = false;
                        }
                    return ok;
                }

                function realCheck1() {
                    ok = false;
                    mail = $('#emailadress').val();
                    $.ajax({
                        type: "POST",
                        url: site_url + "/logon/check_email_availablity",
                        async: false,
                        data: {email: mail},
                        success: function(result) {
                            if (result == '0') {
                                $('#feedbackemails').html("<p class='form-note form-note-used'>Niet beschikbaar</p>");
                                $("#emaildivs").addClass("has-error");
                                $("#emaildivs").removeClass("has-success");
                            } else {
                                $('#feedbackemails').html("<p class='form-note form-note-ok'>Beschikbaar</p>");
                                $("#emaildivs").removeClass("has-error");
                                $("#emaildivs").addClass("has-success");
                                ok = true;
                            }
                        }
                    });
                    return ok;
                }

            </script>





    <div class="col-sm-6">
        <div class="panel panel-default">            

            <?php
            $attributes = array('class' => 'registreer', 'id' => 'myForms', 'class' => 'form-horizontal');
            echo form_open('spreker/registreer', $attributes);
            ?>

            <div class="text-center underline">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Registreren</h3>
            </div>

            <div class="row">
                <div class=""> 
                    <div id="emaildivs">
                        <div id="feedbackemails"></div>
                        <?php echo form_label('Emailadres:', 'emails', array('class' => 'col-sm-4 control-label')); ?> 
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'emailadresV', 'id' => 'emails', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="password1divs"> 
                        <?php echo form_label('Wachtwoord:', 'passwords', array('class' => 'col-sm-4 control-label')); ?>    
                        <div class="col-sm-8">                       
                            <?php echo form_password(array('name' => 'wachtwoord1V', 'id' => 'password1s', 'class' => 'form-control')); ?> 
                        </div>
                    </div>

                    <div id="password2divs">
                        <?php echo form_label('Bevestigen:', 'bevestigwws', array('class' => 'col-sm-4 control-label')); ?>
                        <span id="validate-status" class="form-note"></span>              
                        <div class="col-sm-8">                                        
                            <?php echo form_password(array('name' => 'bevestigwwV', 'id' => 'password2s', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="voornaamdivs">
                        <?php echo form_label('Voornaam:', 'voornaams', array('class' => 'col-sm-4 control-label')); ?>   
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'voornaamV', 'id' => 'voornaams', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="familienaamdivs">
                        <?php echo form_label('Familienaam:', 'familienaams', array('class' => 'col-sm-4 control-label')); ?>  
                        <div class="col-sm-8">  
                            <?php echo form_input(array('name' => 'familienaamV', 'id' => 'familienaams', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="geslachtdiv">     
                        <?php echo form_label('Geslacht:', 'geslacht', array('class' => 'col-sm-4 control-label')); ?>       
                        <div class="col-sm-8">  
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslachtV', 'value' => 'Man', 'type' => 'radio')); ?>   
                                <span class="option-title">Man</span>
                            </div> 
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslachtV', 'value' => 'Vrouw', 'type' => 'radio')); ?>                                
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











<script type="text/javascript">
    $(document).ready(function() {

        $("#mySubmit1").click(function(e) {
            e.preventDefault();
            if (validatieOK() && validate() && realCheck1()) {
                $("#FormRegistreren1").submit();
            } else {
                if (!realCheck1()) {
                    $("#mailTaken1").removeClass("hidden");
                    $("#mailTaken1").html("Oops! Dit email adres is reeds in gebruik!");
                }
                $("#msgReg1").removeClass("hidden");
                $("#msgReg1").html("Oops! U hebt niet alle velden ingevuld!");
            }
        });

        $("#submitInlog1").click(function(e) {
            e.preventDefault();
            if (inloggenOK()) {
                $("#FormInloggen1").submit();
            } else {
                $("#msgInl1").removeClass("hidden");
                $("#msgInl1").html("Oops! U hebt niet alle velden ingevuld!");
            }
        });

        $("#submitVergeten1").click(function(e) {
            e.preventDefault();
            if (vergetenOK()) {
                $("#FormVergeten1").submit();
            } else {
                $("#msgVer1").removeClass("hidden");
                $("#msgVer1").html("Oops! U hebt niet alle velden ingevuld!");
            }
        });


        $("#password21").keyup(validate);

    });


//Alle velden bij inloggen ingevuld controle
    function inloggenOK() {
        ok = true;
        if ($("#passwordI11").val() == "") {
            $(".passwordI1").addClass("has-error");
            ok = false;
        } else {
            $(".passwordI1").removeClass("has-error");
        }

        if ($("#email1").val() == "") {
            $(".emailI1").addClass("has-error");
            ok = false;
        } else {
            $(".emailI1").removeClass("has-error");
        }
        return ok;
    }

//Alle velden bij vergeten modal ingevuld controle
    function vergetenOK() {
        ok = true;

        if ($("#emailVergeten1").val() == "") {
            $(".emailVergetenI1").addClass("has-error");
            ok = false;
        } else {
            $(".emailVergetenI1").removeClass("has-error");
        }

        return ok;
    }

//Alle velden bij registreren ingevuld controle
    function validatieOK() {
        ok = true;

        if ($("#password11").val() == "") {
            $("#password1div1").addClass("has-error");
            ok = false;
        } else {
            $("#password1div1").removeClass("has-error");
        }

        if ($("#password21").val() == "") {
            $("#password2div1").addClass("has-error");
            ok = false;
        } else {
            $("#password2div1").removeClass("has-error");
        }

        if ($("#voornaam1").val() == "") {
            $("#voornaamdiv1").addClass("has-error");
            ok = false;
        } else {
            $("#voornaamdiv1").removeClass("has-error");
        }

        if ($("#familienaam1").val() == "") {
            $("#familienaamdiv1").addClass("has-error");
            ok = false;
        } else {
            $("#familienaamdiv1").removeClass("has-error");
        }

        if ($("#emailadres1").val() == "") {
            $("#emaildiv1").addClass("has-error");
            ok = false;
        } else {
            $("#emaildiv1").removeClass("has-error");
        }

        return ok;
    }

//Zijn de 2 wachtwoord velden gelijk
    function validate() {
        ok = true;
        var password1 = $("#password11").val();
        var password2 = $("#password21").val();
        if (password1 == password2) {
            $("#validate-status1").text("Correct");
            $("#validate-status1").removeClass("form-note-used");
            $("#validate-status1").addClass("form-note-ok");
            $("#password2div1").removeClass("has-error");
        }
        else {
            $("#validate-status1").text("Incorrect");
            $("#validate-status1").removeClass("form-note-ok");
            $("#validate-status1").addClass("form-note-used");
            $("#password2div1").addClass("has-error");
            ok = false;
        }
        return ok;
    }

//Controleren of de email al gebruikt is of niet
    function realCheck1() {
        ok = false;
        mail = $('#emailadres1').val();
        $.ajax({
            type: "POST",
            url: site_url + "/logon/check_email_availablity",
            async: false,
            data: {email: mail},
            success: function(result) {
                if (result == '0') {
                    $('#feedbackemail1').html("<p class='form-note form-note-used'>Niet beschikbaar</p>");
                    $("#emaildiv1").addClass("has-error");
                } else {
                    $('#feedbackemail1').html("<p class='form-note form-note-ok'>Beschikbaar</p>");
                    $("#emaildiv1").removeClass("has-error");
                    $("#mailTaken1").addClass("hidden");
                    $("#mailTaken1").html("");
                    ok = true;
                }
            }
        });
        return ok;
    }
</script>




<div class="row">
    <div class="col-sm-12 space-bottom">
        <h1>Gelieve eerst in te loggen of registreren</h1>
        <p>Vooraleer wij uw voorstel kunnen verwerken, moet u eerst inloggen of registreren.</p>
        <p>Het voorstel zal dan automatisch verstuurt worden. U hoeft het dus <strong>niet</strong> nog eens te versturen!</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <?php
            $attributes = array('name' => 'myform', 'id'=>'FormInloggen1','class' => 'form-horizontal');
            echo form_open('spreker/aanmelden', $attributes);
            ?>
            <div class="row">

                <div class="text-center underline">
                    <h3>Aanmelden</h3>
                </div>   

                <div class="col-sm-12">
                <p class="hidden alert alert-danger" role="alert" id="msgInl1"></p>                  
                </div>
                
                <div class="emailI1">
                    <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?> 
                    <div class="col-sm-8">
                        <?php echo form_input(array('type' => 'email', 'name' => 'emaillogon', 'id' => 'email1', 'class' => 'form-control', 'size' => '30')); ?>        
                    </div>
                </div>
                
                <div class="passwordI1">
                    <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>           
                    <div class="col-sm-8">
                        <?php echo form_password(array('name' => 'passwordlogon', 'id' => 'passwordI11', 'class' => 'form-control', 'size' => '30')); ?> 
                    </div>
                </div>
                
                <div class="col-sm-8 col-sm-offset-4">  
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#vergetenModal1">Wachtwoord vergeten?</a>
                </div>


                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <a href="javascript:history.go(-1)" class="col-xs-4 btn btn-default">Terug</a>
                        <button name="submitInlog" id="submitInlog1" class="col-xs-8 btn btn-primary">Aanmelden</button>
                    </div>
                </div>

            </div>  
            <?php echo form_close(); ?>


        </div>
    </div>


    <div class="col-sm-6">
        <div class="panel panel-default">            

            <?php
            $attributes = array('class' => 'registreer', 'id' => 'FormRegistreren1', 'class' => 'form-horizontal');
            echo form_open('spreker/registreer', $attributes);
            ?>

            <div class="text-center underline">
                <h3>Registreren</h3>
            </div>

            <div class="row">
                <div class="col-sm-12">
                <p class="hidden alert alert-danger" role="alert" id="msgReg1"></p>  
                <p class="hidden alert alert-danger" role="alert" id="mailTaken1"></p>  
                </div>
                <div class=""> 
                    <div id="emaildiv1">                        
                        <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?>                         
                        <span id="feedbackemail" class="form-note"></span> 
                        <div class="col-sm-8">   
                            <?php echo form_input(array('type'=>'email', 'name' => 'emailadresI', 'id' => 'emailadres1', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="password1div1"> 
                        <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>    
                        <div class="col-sm-8">                       
                            <?php echo form_password(array('name' => 'wachtwoord1I', 'id' => 'password11', 'class' => 'form-control')); ?> 
                        </div>
                    </div>

                    <div id="password2div1">
                        <?php echo form_label('Bevestigen:', 'bevestigww', array('class' => 'col-sm-4 control-label')); ?>
                        <span id="validate-status1" class="form-note"></span>              
                        <div class="col-sm-8">                                        
                            <?php echo form_password(array('name' => 'bevestigwwI', 'id' => 'password21', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="voornaamdiv1">
                        <?php echo form_label('Voornaam:', 'voornaam', array('class' => 'col-sm-4 control-label')); ?>   
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'voornaamI', 'id' => 'voornaam1', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="familienaamdiv1">
                        <?php echo form_label('Familienaam:', 'familienaam', array('class' => 'col-sm-4 control-label')); ?>  
                        <div class="col-sm-8">  
                            <?php echo form_input(array('name' => 'familienaamI', 'id' => 'familienaam1', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="geslachtdiv1">     
                        <?php echo form_label('Geslacht:', 'geslacht', array('class' => 'col-sm-4 control-label')); ?>       
                        <div class="col-sm-8">  
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslachtI', 'value' => 'Man', 'type' => 'radio')); ?>   
                                <span class="option-title">Man</span>
                            </div> 
                            <div class="checkbox">
                                <?php echo form_input(array('name' => 'geslachtI', 'value' => 'Vrouw', 'type' => 'radio')); ?>                                
                                <span class="option-title">Vrouw</span>
                            </div>
                        </div>
                    </div>

                </div>    

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <a href="javascript:history.go(-1)" class="col-xs-4 btn btn-default">Terug</a>
                        <button name="mysubmit" id="mySubmit1" class="col-xs-8 btn btn-primary">Registreren</button>
                    </div>
                </div>

            </div>      
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<!-- Modal wachtwoord vergeten -->
<div class="modal fade" id="vergetenModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <?php
            $attributes = array('name' => 'FormVergeten1', 'id' => 'FormVergeten1','method' => 'post', 'class' => 'form-horizontal');
            echo form_open('logon/resetPass', $attributes);
            ?>   

            <div class="row">
                <div class="text-center underline">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Wachtwoord vergeten</h3>
                </div>   

                <div class="col-sm-12">
                <p class="col-sm-12 hidden alert alert-danger" role="alert" id="msgVer1"></p>  
                </div>
                
                <div class="EmailVergetenI1">
                <?php echo form_label('Emailadres:', 'email', array('class' => 'col-sm-4 control-label')); ?> 
                <div class="col-sm-8">
                    <?php echo form_input(array('type' => 'email', 'name' => 'emailVergeten', 'id' => 'emailVergeten1', 'class' => 'form-control', 'size' => '30')); ?>        
                </div>
                </div>

                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-4 btn btn-default" data-dismiss="modal">Annuleren</button>  
                        <button name="submitVergeten" id="submitVergeten1" class="col-xs-8 btn btn-primary">Verstuur Email</button>
                    </div>
                </div>

            </div>
            <?php echo form_close(); ?>

        </div>            
    </div>
</div>
