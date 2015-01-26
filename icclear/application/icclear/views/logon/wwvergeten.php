

<?php 
    $attributes = array('name' => 'myform', 'method' => 'post');
    echo form_open('logon/resetPass', $attributes);
?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Wachtwoord Vergeten</h4>
    </div>


    <div class="modal-body">        
        
        <div class="row">
            <div class="col-md-4">   
                <label for="emailadres">
                    Emailadres: 
                </label>
            </div>  

            <div class="col-md-8">   
                <input type="text" name="emailadres" id="email" class="form-control" required="required">      
            </div>
        </div>
        

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="mysubmit" value="Send Email" class="btn btn-primary"  />
    </div>
    
</form>