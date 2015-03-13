<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() . APPPATH; ?>/js/bootstrap.js"></script>
<script type="text/javascript">

    function finishAjax(id, response) {
        $('#' + id).html(unescape(response));
        $('#' + id).fadeIn();
    }
    $(document).ready(function () {


        function validatieOK() {
            ok = true;
            if ($("#username").val() == "") {
                $("#usernamediv").addClass("has-error");
                ok = false;
            }
            return ok;
        }

        $("#mySubmit").click(function (e) {
            e.preventDefault();
            if (validatieOK()) {
                $("#myForm").submit();
            }
        });

        $('#Loading').hide();
        $('#validate-username').hide();
        $('#username').keyup(function () {
            $('#validate-username').show();
            var u = $('#username').val();
            if (u.length > 3) {
                $.post("<?php echo base_url() ?>icclear.php/logon/check_username_availablity", {
                    username: $("#username").val()
                }, function (response) {
                    $('#validate-username').hide();
                    setTimeout("finishAjax('validate-username', '" + escape(response) + "')", 400);
                });
                return false;
            }
        });
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
                    //#emailInfo is a span which will show you message
                    $('#Loading').hide();
                    setTimeout("finishAjax('Loading', '" + escape(response) + "')", 400);
                });
                return false;
            }

            if ($('#email').val() == '') {
                $('#Loading').hide();
            }

        });
        $("#password2").keyup(validate);
    });
    function validate() {
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
        }
    }
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
        <div class="col-md-6">  
            <div class="row" id="usernamediv">
                <div class="col-md-4">   
                    <?php echo form_label('Gebruikersnaam:', 'username'); ?>                    
                    <span id="validate-username"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span>                     
                </div>  

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'gebruikersnaam', 'id' => 'username', 'class' => 'form-control')); ?>                    
                </div>  
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Wachtwoord:', 'password'); ?>                    
                </div>

                <div class="col-md-8">                       
                    <?php echo form_password(array('name' => 'wachtwoord1', 'id' => 'password1', 'class' => 'form-control')); ?> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Bevestigen:', 'bevestigww'); ?>
                    <span id="validate-status" class="form-note"></span>                    
                </div>

                <div class="col-md-8">                                        
                    <?php echo form_password(array('name' => 'bevestigww', 'id' => 'password2', 'class' => 'form-control')); ?>                    
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Voornaam:', 'voornaam'); ?>                    
                </div>

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaam', 'class' => 'form-control')); ?>                                        
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Familienaam:', 'familienaam'); ?>                                        
                </div>

                <div class="col-md-8">  
                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaam', 'class' => 'form-control')); ?>                                        
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Emailadres:', 'email'); ?>                        
                    <p><span id="Loading"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span></p>                    
                </div>  

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'email', 'class' => 'form-control')); ?>                    
                </div>
            </div>
        </div>


        <div class="col-md-6 border-left">  
            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Geboortedatum:', 'geboortedatum'); ?>                    
                </div>

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatum', 'class' => 'form-control', 'maxLength' => '52488', 'type' => 'date')); ?>                    
                    <!--                    width 185 px-->
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Geslacht:', 'geslacht'); ?>                    
                </div>  

                <div class="col-md-8">        
                    <div class="my-radio">
                        <div class="">
                            <?php echo form_radio(array('name' => 'geslacht', 'id' => 'geslacht', 'class' => 'form-horizontal', 'value' => 'Man')); ?>                            
                            <span class="option-title">
                                Man
                            </span>
                        </div>                                
                        <div class="">
                            <?php echo form_radio(array('name' => 'geslacht', 'id' => 'geslacht2', 'class' => 'form-horizontal', 'value' => 'Vrouw')); ?>                                                        
                            <span class="option-title">
                                Vrouw
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Land:', 'land'); ?>                    
                </div>

                <div class="col-md-8">                          
                    <?php
                    $drop = array();
                    foreach ($landen as $land) {
                        $drop[$land->id] = $land->naam;
                    }
                    echo form_dropdown('land', $drop, '', 'id="land" class="form-control"');
                    ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Gemeente:', 'gemeente'); ?>                    
                </div>

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control')); ?>                                        
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Postcode:', 'postcode'); ?>                    
                </div>

                <div class="col-md-8"> 
                    <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control')); ?>                                        
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Straat:', 'straat'); ?>                    
                </div>

                <div class="col-md-8">   
                    <?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'class' => 'form-control')); ?>                                        
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Huisnummer:', 'huisnummer'); ?>                    
                </div>

                <div class="col-md-8">  
                    <?php echo form_input(array('name' => 'huisnummer', 'id' => 'huisnummer', 'class' => 'form-control')); ?>                                        
                </div>
            </div>
        </div>
    </div>         

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleer</button>        
    <button name="mysubmit" id="mysubmit" class="btn btn-primary">Verzend</button>
</div>    
<?php echo form_close(); ?>