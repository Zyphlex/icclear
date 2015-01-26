<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
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
$attributes = array('name' => 'myform', 'method' => 'post');
echo form_open('/logon/nieuwPass', $attributes);
?>

<h2>Nieuw wachtwoord instellen</h2>
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
<input type="hidden" value="<?php echo $generatedKey; ?>" name="key"/>

<input type="submit" name="mysubmit" id="submit" value="Verander wachtwoord" class="btn btn-primary"  />


</form>