<div class="row">
<div class="col-md-6">
    <?php 
    $attributes = array('name' => 'myform');
    echo form_open('logon/aanmelden', $attributes);
?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Aanmelden</h4>
    </div>


    <div class="modal-body">        
        
        <div class="row">
            <div class="col-md-4">      
                <label for="email">E-mailadres:</label>    
            </div>

            <div class="col-md-8">
                <input type="text" name="email" value="" id="email" size="30" class="form-control"  />    
            </div>
        </div>
      
        <div class="row">     
            <div class="col-md-4">
                <label for="password">Wachtwoord:</label>    
            </div>

            <div class="col-md-8">
                <input type="password" name="password" value="" id="password" size="30" class="form-control"  />    
            </div>
        </div>
        
        <div class="row">     
            <div class="col-md-4"></div>

            <div class="col-md-8">  
                <a href="<?php echo base_url(); ?>icclear.php/logon/vergeten" data-dismiss="modal" data-toggle="modal" data-target="#myModal2">Wachtwoord vergeten?</a>
            </div>
        </div>
        

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleer</button>
        <input type="submit" name="mysubmit" value="Aanmelden" class="btn btn-primary"  />
    </div>
    
</form>



</div>
    
    
    
    
    
    
    
    
    
    
    
<div class="col-md-6 col-sm-6 border-left">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() . APPPATH; ?>/js/bootstrap.js"></script>
<script type="text/javascript">

    function finishAjax(id, response) {
        $('#' + id).html(unescape(response));
        $('#' + id).fadeIn();
    }
    $(document).ready(function () {
    var resu;
            $('#Loading').hide();
            function validatieOK() {
            ok = true;
                    if ($("#password1").val() == "") {
            $("#password1div").addClass("has-error");
                    ok = false;
            }
            else {
            $("#password1div").removeClass("has-error");
            }
            if ($("#password2").val() == "" || validate() == false) {
            $("#password2div").addClass("has-error");
                    ok = false;
            }
            else {
            $("#password2div").removeClass("has-error");
            }

            if ($("#voornaam").val() == "") {
            $("#voornaamdiv").addClass("has-error");
                    ok = false;
            }
            else {
            $("#voornaamdiv").removeClass("has-error");
            }

            if ($("#familienaam").val() == "") {
            $("#familienaamdiv").addClass("has-error");
                    ok = false;
            }
            else {
            $("#familienaamdiv").removeClass("has-error");
            }
            if ($("#email").val() == "") {
            $("#emaildiv").addClass("has-error");
                    ok = false;
            }
            else {
            $("#emaildiv").removeClass("has-error");
            }

            return ok;
            }

    $("#mySubmit").click(function (e) {
    e.preventDefault();
            dubbelCheck();
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

    function dubbelCheck(){
    if ($('#email').val() == '') {
    $('#Loading').hide();
            $("#feedbackemail").html("");
    } else{
    $('#Loading').show();
            var a = $("#email").val();
            var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
            if (filter.test(a)) {
    $.post("<?php echo base_url() ?>icclear.php/logon/check_email_availablity", {
    email: $('#email').val()
    }, function (response) {
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
            $('#email').keyup(function () {
    $('#Loading').show();
            var a = $("#email").val();
            var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
            // check if email is valid
            if (filter.test(a)) {
    // show loader                 
    $.post("<?php echo base_url() ?>icclear.php/logon/check_email_availablity", {
    email: $('#email').val()
    }, function (response) {
    resu = response;
            //#emailInfo is a span which will show you message
            $('#Loading').hide();
            if (response == 0) {
    $("#feedbackemail").html("<p class='form-note form-note-used'>Niet beschikbaar</p>");
    }
    else {
    $("#feedbackemail").html("<p class='form-note form-note-ok'>Beschikbaar</p>");
    }
    });
            return false;
    }

    if ($('#email').val() == '') {
    $('#Loading').hide();
            $("#feedbackemail").html("");
    }


    });
    });

</script>

<?php
$attributes = array('class' => 'registreer', 'id' => 'myForm');
echo form_open('logon/add', $attributes);
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Registreren</h4>

</div>

<div class="modal-body">

    <div class="row">
        <div class=""> 
            <div class="row" id="emaildiv">
                <div class="col-md-4">   
                    <?php echo form_label('Emailadres:', 'email'); ?>                        
                    <p><span id="Loading"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span></p>                    
                    <div id="feedbackemail"></div>
                </div>  

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'email', 'class' => 'form-control')); ?>                    
                </div>
            </div>
            <div class="row" id="password1div">
                <div class="col-md-4">   
                    <?php echo form_label('Wachtwoord:', 'password'); ?>                    
                </div>

                <div class="col-md-8">                       
                    <?php echo form_password(array('name' => 'wachtwoord1', 'id' => 'password1', 'class' => 'form-control')); ?> 
                </div>
            </div>

            <div class="row" id="password2div">
                <div class="col-md-4">   
                    <?php echo form_label('Bevestigen:', 'bevestigww'); ?>
                    <span id="validate-status" class="form-note"></span>                    
                </div>

                <div class="col-md-8">                                        
                    <?php echo form_password(array('name' => 'bevestigww', 'id' => 'password2', 'class' => 'form-control')); ?>                    
                </div>
            </div>



            <div class="row" id="voornaamdiv">
                <div class="col-md-4">   
                    <?php echo form_label('Voornaam:', 'voornaam'); ?>                    
                </div>

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control')); ?>                                        
                </div>
            </div>



            <div class="row" id="familienaamdiv">
                <div class="col-md-4">   
                    <?php echo form_label('Familienaam:', 'familienaam'); ?>                                        
                </div>

                <div class="col-md-8">  
                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'class' => 'form-control')); ?>                                        
                </div>
            </div>

            <div class="row" id="geslachtdiv">                                    
                <div class="col-md-4">   
                    <?php echo form_label('Geslacht:', 'geslacht'); ?>                                        
                </div>

                <div class="col-md-8">  

                    <div class="">
                        <?php echo form_input(array('name' => 'geslacht', 'value' => 'Man', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                                                            
                        <span class="option-title">
                            Man
                        </span>
                    </div> 
                    <div class="">
                        <?php echo form_input(array('name' => 'geslacht', 'value' => 'Vrouw', 'class' => 'form-horizontal', 'type' => 'radio')); ?>                                
                        <span class="option-title">
                            Vrouw
                        </span>
                    </div>
                </div>

            </div>

            <div class="row" id="landdiv">
                <div class="col-md-4">   
                    <?php echo form_label('Land:', 'land'); ?>                                        
                </div>              

                <div class="col-md-8">   
                    <?php
                    foreach ($landen as $land) {
                        $options[$land->id] = $land->naam;
                    }
                    echo form_dropdown('land', $options, 0, 'class="form-control" id="land"');
                    ?>
                </div>
            </div>

        </div>
    </div>         

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleer</button>        
    <button name="mysubmit" id="mySubmit" class="btn btn-primary">Registreer</button>
</div>    
<?php echo form_close(); ?>
</div>
</div>
    