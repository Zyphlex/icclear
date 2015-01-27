<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() . APPPATH; ?>/js/bootstrap.js"></script>
<script type="text/javascript">

    function finishAjax(id, response) {
        $('#' + id).html(unescape(response));
        $('#' + id).fadeIn();
    }
    $(document).ready(function () {
        $('#Loading').hide();
        $('#validate-username').hide();

        $('#username').keyup(function () {
            $('#validate-username').show();
            var u = $('#username').val();
            if(u.length > 3){
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
    function validateMyForm()
    {
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();
        if (password1 != password2)
        {
            alert("Fout wachtwoord!");
            $("#password1").val('');
            $("#password2").val('');
            return false;
        }
        return true;
    }

</script>

<form action="index.php/logon/add" class="registreer" method="post" onsubmit="return validateMyForm();">     
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Registreren</h4>

    </div>

    <div class="modal-body">

        <div class="row">
            <div class="col-md-6">  
                <div class="row">
                <div class="col-md-4">   
                    <label for="gebruikersnaam">
                        Gebruikersnaam:   <span id="validate-username"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span>
                    </label> 
                </div>  

                <div class="col-md-8">        
                    <input type="text" name="gebruikersnaam" id="username" class="form-control" required="required">  
                </div>  
                </div>


 
                <div class="row">
                <div class="col-md-4">   
                    <label for="wachtwoord">
                        Wachtwoord:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="password" name="wachtwoord" id="password1" class="form-control" required="required">
                </div>
                </div>


 
                <div class="row">
                <div class="col-md-4">   
                    <label for="bevestigww">
                        Bevestigen:  <span id="validate-status" class="form-note"></span>
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="password" name="bevestigww" id="password2" class="form-control" required="required">
                </div>
                </div>
                
                
                
                <div class="row">
                <div class="col-md-4">   
                    <label for="voornaam">
                        Voornaam:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="voornaam" id="field2" class="form-control" required="required">
                </div>
                </div>


                 
                <div class="row">
                <div class="col-md-4">   
                    <label for="familienaam">
                        Familienaam:
                    </label>
                </div>

                <div class="col-md-8">   
                    <input type="text" name="familienaam" id="field1" class="form-control" required="required">
                </div>
                </div>


                 
                <div class="row">
                <div class="col-md-4">   
                    <label for="emailadres">
                        Emailadres: 
                        <p><span id="Loading"><img src="<?php echo base_url() . APPPATH; ?>img/default/loader.gif" alt="Ajax Indicator" /></span></p>
                    </label>
                </div>  

                <div class="col-md-8">   
                    <input type="text" name="emailadres" id="email" class="form-control" required="required">      
                </div>
                </div>
            </div>
                        
            
            <div class="col-md-6 border-left">  
                <div class="row">
                <div class="col-md-4">   
                    <label for="geboortedatum">
                        Geboortedatum:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="date" class="form-control" id="field7" maxlength="524288" name="geboortedatum" required="required" style="width: 158px;" tabindex="0" title="">
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="geslacht">
                        Geslacht:
                    </label>  
                </div>  
                
                <div class="col-md-8">        
                    <div class="my-radio">
                    <div class="">
                        <input type="radio" name="geslacht" id="field8-1"  class="form-horizontal" value="Man">
                        <span class="option-title">
                            Man
                        </span>
                    </div>                                
                    <div class="">
                        <input type="radio" name="geslacht" id="field8-2" class="form-horizontal" value="Vrouw">
                        <span class="option-title">
                            Vrouw
                        </span>
                    </div>
                    </div>
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="land">
                        Land:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <select class="form-control"  name="land" id="field9" required="required">
                        <?php
                        foreach ($landen as $land) {
                            echo '<option value="' . $land->id . '">' .
                            $land->naam
                            . '</option>';
                        }
                        ?>
                    </select>
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="gemeente">
                        Gemeente:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="text" name="gemeente" id="field10" class="form-control" required="required">
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="postcode">
                        Postcode:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="text" name="postcode" id="field10-b" class="form-control" required="required">
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="straat">
                        Straat:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="text" name="straat" id="field11" class="form-control" required="required">
                </div>
                </div>



                <div class="row">
                <div class="col-md-4">   
                    <label for="huisnummer">
                        Huisnummer:
                    </label>
                </div>
                
                <div class="col-md-8">   
                    <input type="text" name="huisnummer" id="field12" class="form-control" required="required">
                </div>
                </div>
            </div>
        </div>         

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="mysubmit" value="Submit" class="btn btn-primary"  />

    </div>
    
</form>