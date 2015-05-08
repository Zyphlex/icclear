<script type="text/javascript">
    $(document).ready(function() {

        $("#mySubmit").click(function(e) {
            e.preventDefault();
            if (validatieOK() && validate() && realCheck1()) {
                $("#FormRegistreren").submit();
            } else {
                $("#msgReg").removeClass("hidden");
                $("#msgReg").html("Oops! U hebt niet alle velden ingevuld!");
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


        $(".modalHeader").click(function() {
            verbergError();
        });

        $("#password2").keyup(validate);

    });

    function verbergError() {
        $("#msgVer1").addClass("hidden");
        $("#msgInl").addClass("hidden");
        $("#msgReg").addClass("hidden");
        $('.passwordI1').removeClass('has-error');
        $('.emailI1').removeClass('has-error');
        $('.emailVergetenI1').removeClass('has-error');
        $('#password1div').removeClass('has-error');
        $('#password2div').removeClass('has-error');
        $('#voornaamdiv').removeClass('has-error');
        $('#familienaamdiv').removeClass('has-error');
        $('#emaildiv').removeClass('has-error');
    }

//Alle velden bij inloggen ingevuld controle
    function inloggenOK() {
        ok = true;
        if ($("#password1").val() == "") {
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

        if ($("#password1").val() == "") {
            $("#password1div").addClass("has-error");
            ok = false;
        } else {
            $("#password1div").removeClass("has-error");
            $("#password1div").addClass("has-success");
        }

        if ($("#password2").val() == "") {
            $("#password2div").addClass("has-error");
            $("#password2div").removeClass("has-success");
            ok = false;
        } else {
            $("#password2div").removeClass("has-error");
            $("#password2div").addClass("has-success");
        }

        if ($("#voornaam").val() == "") {
            $("#voornaamdiv").addClass("has-error");
            $("#voornaamdiv").removeClass("has-success");
            ok = false;
        } else {
            $("#voornaamdiv").removeClass("has-error");
            $("#voornaamdiv").addClass("has-success");
        }

        if ($("#familienaam").val() == "") {
            $("#familienaamdiv").addClass("has-error");
            $("#familienaamdiv").removeClass("has-success");
            ok = false;
        } else {
            $("#familienaamdiv").removeClass("has-error");
            $("#familienaamdiv").addClass("has-success");
        }

        if ($("#emailadres").val() == "") {
            $("#emaildiv").addClass("has-error");
            $("#emaildiv").removeClass("has-success");
            ok = false;
        } else {
            $("#emaildiv").removeClass("has-error");
            $("#emaildiv").addClass("has-success");
        }

        return ok;
    }

//Zijn de 2 wachtwoord velden gelijk
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

//Controleren of de email al gebruikt is of niet
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
            $attributes = array('name' => 'myform', 'id'=>'FormInloggen1','class' => 'form-horizontal');
            echo form_open('inschrijven/aanmelden', $attributes);
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
                        <?php echo form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email1', 'class' => 'form-control', 'size' => '30')); ?>        
                    </div>
                </div>
                
                <div class="passwordI1">
                    <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>           
                    <div class="col-sm-8">
                        <?php echo form_password(array('name' => 'password', 'id' => 'password11', 'class' => 'form-control', 'size' => '30')); ?> 
                    </div>
                </div>
                
                <div class="col-sm-8 col-sm-offset-4">  
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#vergetenModal1">Wachtwoord vergeten?</a>
                </div>


                <div class="col-xs-12 margin-top space-bottom15">
                    <div class="btn-group btn-block">
                        <button type="button" class="col-xs-4 btn btn-default" data-dismiss="modal">Annuleren</button>   
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
                        <div id="feedbackemail"></div>
                        <?php echo form_label('Emailadres:', 'emailadres', array('class' => 'col-sm-4 control-label')); ?> 
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'emailadresI', 'id' => 'emailadres', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="password1div"> 
                        <?php echo form_label('Wachtwoord:', 'password', array('class' => 'col-sm-4 control-label')); ?>    
                        <div class="col-sm-8">                       
                            <?php echo form_password(array('name' => 'wachtwoord1I', 'id' => 'password1', 'class' => 'form-control')); ?> 
                        </div>
                    </div>

                    <div id="password2div">
                        <?php echo form_label('Bevestigen:', 'bevestigww', array('class' => 'col-sm-4 control-label')); ?>
                        <span id="validate-status" class="form-note"></span>              
                        <div class="col-sm-8">                                        
                            <?php echo form_password(array('name' => 'bevestigwwI', 'id' => 'password2', 'class' => 'form-control')); ?>                    
                        </div>
                    </div>

                    <div id="voornaamdiv">
                        <?php echo form_label('Voornaam:', 'voornaam', array('class' => 'col-sm-4 control-label')); ?>   
                        <div class="col-sm-8">   
                            <?php echo form_input(array('name' => 'voornaamI', 'id' => 'voornaam', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="familienaamdiv">
                        <?php echo form_label('Familienaam:', 'familienaam', array('class' => 'col-sm-4 control-label')); ?>  
                        <div class="col-sm-8">  
                            <?php echo form_input(array('name' => 'familienaamI', 'id' => 'familienaam', 'class' => 'form-control')); ?>                                        
                        </div>
                    </div>

                    <div id="geslachtdiv">     
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
                    <?php echo form_input(array('type' => 'email', 'name' => 'email', 'id' => 'emailVergeten1', 'class' => 'form-control', 'size' => '30')); ?>        
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
