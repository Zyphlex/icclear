<!DOCTYPE html">

<html>
<head>
    <?php

    // +----------------------------------------------------------
    // | PHP Project - IT Ninjas
    // +----------------------------------------------------------
    // | 
    // |
    // +----------------------------------------------------------
    // | Rob Oosthoek
    // +----------------------------------------------------------

    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <meta charset="utf-8"> 
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/style.css" />
    
    <link rel="icon" type="image/png" href="<?php echo base_url() . APPPATH; ?>img/default/favicon.png"/>
    
    <script src="<?php echo base_url() . APPPATH; ?>js/jquery-1.11.2.min.js"></script>  
    <script src="<?php echo base_url() . APPPATH; ?>js/bootstrap.js"></script>
    <script src="<?php echo base_url() . APPPATH; ?>js/jquery.dataTables.js"></script>  
    <script src="<?php echo base_url() . APPPATH; ?>js/script.js"></script>
        
    <script type="text/javascript">
        var site_url = '<?php echo site_url();?>';
	var img_url = '<?php echo base_url() . APPPATH; ?>';
   
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
                $("#password1div").removeClass("has-success");
                ok = false;
            }
            else {
                $("#password2div").removeClass("has-error");
                $("#password1div").addClass("has-success");
            }

            if ($("#voornaam").val() == "") {
                $("#voornaamdiv").addClass("has-error");
                $("#password1div").removeClass("has-success");
                ok = false;
            }
            else {
                $("#voornaamdiv").removeClass("has-error");
                $("#password1div").addClass("has-success");
            }

            if ($("#familienaam").val() == "") {
                $("#familienaamdiv").addClass("has-error");
                $("#password1div").removeClass("has-success");
                ok = false;
            }
            else {
                $("#familienaamdiv").removeClass("has-error");
                $("#password1div").addClass("has-success");
            }
            if ($("#email").val() == "") {
                $("#emaildiv").addClass("has-error");
                $("#password1div").removeClass("has-success");
                ok = false;
            }
            else {
                $("#emaildiv").removeClass("has-error");
                $("#password1div").addClass("has-success");
            }

            return ok;
        }

        $("#mySubmit").click(function(e) {
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

        function dubbelCheck() {
            if ($('#email').val() == '') {
                $('#Loading').hide();
                $("#feedbackemail").html("");
            } else {
                $('#Loading').show();
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
        $('#email').keyup(function() {
            $('#Loading').show();
            var a = $("#email").val();
            var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
            // check if email is valid
            if (filter.test(a)) {
                // show loader                 
                $.post("<?php echo base_url() ?>icclear.php/logon/check_email_availablity", {
                    email: $('#email').val()
                }, function(response) {
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

</head>


<body>
    <div id="container">        
        <div id="hoofding"><?php echo $header; ?></div>
        <div id="navigatie"><?php echo $nav; ?></div>
        <div class="content" id="inhoud"><?php echo $content; ?></div>
        <div class="footer" id="footer"><?php echo $footer; ?></div>
    </div>   
  
</body>
</html>