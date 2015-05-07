<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/gebruiker/overzicht",
            success: function (result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
                maakActivatieClick();
                maakMailClick();
                maakVerberg();
                $('.table').DataTable({
                    "aaSorting": []
                });                
            }
        });
    }

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
    }
    
    //Klikken op de Verberg Tonen knop
    function maakVerberg() {
        $(".verbergInactive").click(function () {
            if (!$(this).hasClass('verberg')) {
                $(".warning").show('400');
                $("#oog").removeClass('fa-eye-slash');
                $("#oog").addClass('fa-eye');
                $(this).removeClass('verberg');
            } else {
                $(".warning").hide('400');
                $("#oog").addClass('fa-eye-slash');
                $("#oog").removeClass('fa-eye');
                $(this).addClass('verberg');
            }
        });
    }
    
    //Klikken op de Deactiveren knop
    function maakDeleteClick() {
        $(".verwijderGebruiker").click(function () {
            $("#error").addClass("hidden");
            deleteid = $(this).data("id");
            $("#gebruikerDelete").modal('show');
        });
    }
    
    //Klikken op de Activeren knop
    function maakActivatieClick() {
        $(".activeerGebruiker").click(function () {
            $("#error").addClass("hidden");
            deleteid = $(this).data("id");
            $("#gebruikerActivate").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigGebruiker").click(function () {            
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/gebruiker/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {                        
                        var jobject = jQuery.parseJSON(result);
                        $("#voornaamo").val(jobject.voornaam);
                        $("#familienaamo").val(jobject.familienaam);
                        $("#geboortedatumo").val(jobject.geboortedatum);
                        $("#emailadreso").val(jobject.emailadres);
                        $("#geslachto").val(jobject.geslacht);
                        $(':radio[name="geslacht"][value="' + jobject.geslacht + '"]').prop('checked', 'checked');
                        $("#typeo").val(jobject.typeId);
                        $(':radio[name="type"][value="' + jobject.typeId + '"]').prop('checked', 'checked');
                        $("#lando").val(jobject.landId);
                        $("#gemeenteo").val(jobject.gemeente);
                        $("#postcodeo").val(jobject.postcode);
                        $("#straato").val(jobject.straat);
                        $("#nummero").val(jobject.nummer);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#voornaamo").val("");
                $("#familienaamo").val("");
                $("#geboortedatumo").val("");
                $("#emailadreso").val("");
                $("#geslachto").val("");
                $("#typeo").val("");
                $("#lando").val("");
                $(':radio[name="geslacht"]').prop('checked', false);
                $(':radio[name="type"]').prop('checked', false);
                $("#gemeenteo").val("");
                $("#postcodeo").val("");
                $("#straato").val("");
                $("#nummero").val("");
            }
            // dialoogvenster openen
            $("#gebruikerModal").modal('show');
        });
    }

    function maakMailClick() {
        $(".emailGebruiker").click(function () {            
            var iddb = $(this).data("id");               
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/gebruiker/detail",
                    async: false,
                    data: {id: iddb},
                    success: function (result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#ontvanger").val(jobject.voornaam + " " + jobject.familienaam + " (" + jobject.emailadres + ")");
                        $("#emailzend").val(jobject.emailadres);                        
                        $("#onderwerp").val("");
                        $("#boodschap").val("");
                    }
                });
            }
            // dialoogvenster openen            
            $("#gebruikerEmail").modal('show');
        });
    }
    
    function maakMailsClick() {       
        $(".emailGebruikers").click(function () {                                                                                      
            $("#ontvangerall").val("Alle gebruikers");  
            $("#gebruikerEmails").modal('show');
        });
    }
    
    $(document).ready(function () {         
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        maakActivatieClick();
        maakMailClick();
        maakMailsClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();        
        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanGebruiker").click(function () {
            var dataString = $("#JqAjaxForm:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/gebruiker/update",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();
            $("#gebruikerModal").modal('hide');
        });

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteGebruiker").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/gebruiker/delete",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#gebruikerDelete").modal('hide');
                },
                error: function () {  
                    $("#error").removeClass("hidden");
                    $("#error").html("Oops! U kunt de gebruiker niet deactiveren!");
                }
            });
        });
        
        $(".activateGebruiker").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/gebruiker/activate",
                async: false,
                data: {id: deleteid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#gebruikerActivate").modal('hide');
                },
                error: function () {  
                    $("#error").removeClass("hidden");
                    $("#error").html("Oops! U kunt de gebruiker niet activeren!");
                }
            });
        });
               
        //Verzenden in de Email modal
        $(".verstuurEmail").click(function () {                          
            var dataString = $("#JqAjaxForm1:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/email/verzenden",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();                      
        $("#gebruikerEmail").modal('hide');            
        });
        
        //Verzenden in de Emails modal
        $(".verstuurEmails").click(function () {                            
            var dataString = $("#JqAjaxForm2:eq(0)").serialize();
            $.ajax({
                type: "POST",
                url: site_url + "/email/verzendenAlle",
                async: false,
                data: dataString,
                dataType: "json"
            });
            refreshData();                      
        $("#gebruikerEmails").modal('hide');            
        });

    });
</script>


<div class="col-md-10">

    <h1>Gebruiker beheren</h1>      


    <button class="verberg verbergInactive btn btn-warning" data-id="0"><span id="oog" class="white bold fa fa-eye-slash"></span></button>
    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigGebruiker btn btn-primary" data-id="0">Nieuwe gebruiker Toevoegen</button>
    <button class="emailGebruikers btn btn-warning" data-id="0">Email naar alle gebruikers versturen</button>
</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="gebruikerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Gebruiker beheren</h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id"/>                                        

                    <div class="row">
                        <div class="col-md-6">  

                            <div class="row" id="voornaamdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Voornaam:', 'voornaam'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'voornaam', 'id' => 'voornaamo', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="familienaamdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Familienaam:', 'familienaam'); ?>                                        
                                </div>

                                <div class="col-md-8">  
                                    <?php echo form_input(array('name' => 'familienaam', 'id' => 'familienaamo', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="emaildiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Emailadres:', 'emailadres'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'emailadres', 'id' => 'emailadreso', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="geboortedatumdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Geboortedatum:', 'geboortedatum'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'geboortedatum', 'id' => 'geboortedatumo', 'class' => 'form-control', 'maxLength' => '52488', 'type' => 'date')); ?>                    
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
                                            <?php echo form_radio(array('name' => 'geslacht', 'class' => 'form-horizontal', 'value' => 'man')); ?>                            
                                            <span class="option-title">
                                                Man
                                            </span>
                                        </div>                                
                                        <div class="">
                                            <?php echo form_radio(array('name' => 'geslacht', 'class' => 'form-horizontal', 'value' => 'vrouw')); ?>                                                        
                                            <span class="option-title">
                                                Vrouw
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('Type:', 'type'); ?>                    
                                </div>  

                                <div class="col-md-8">        
                                    <div class="my-radio">
                                        <div class="">
                                            <?php echo form_radio(array('name' => 'type', 'class' => 'form-horizontal', 'value' => '1')); ?>                            
                                            <span class="option-title">
                                                Bezoeker
                                            </span>
                                        </div>                                
                                        <div class="">
                                            <?php echo form_radio(array('name' => 'type', 'class' => 'form-horizontal', 'value' => '2')); ?>                                                        
                                            <span class="option-title">
                                                Spreker
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 border-left">                              

                            <div class="row">
                                <div class="col-md-4">   
                                    <?php echo form_label('Land:', 'land'); ?>                    
                                </div>

                                <div class="col-md-8">                          
                                    <?php
                                    $drop = array();
                                    $teller = 1;
                                    foreach ($landen as $land) {
                                        $drop[$land->id] = $land->naam;
                                        $teller++;
                                    }
                                    echo form_dropdown('land', $drop, '', 'id="lando" class="form-control"');
                                    ?>
                                </div>
                            </div>

                            <div class="row" id="gemeentediv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Gemeente:', 'gemeente'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeenteo', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="postcodediv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Postcode:', 'postcode'); ?>                    
                                </div>

                                <div class="col-md-8"> 
                                    <?php echo form_input(array('name' => 'postcode', 'id' => 'postcodeo', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>


                            <div class="row" id="straatdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Straat:', 'straat'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'straat', 'id' => 'straato', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="huisnummerdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Huisnummer:', 'huisnummer'); ?>                    
                                </div>

                                <div class="col-md-8">  
                                    <?php echo form_input(array('name' => 'nummer', 'id' => 'nummero', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="opslaanGebruiker btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div> 

<!--EMAIL VERSTUREN-->
<div class="modal fade" id="gebruikerEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">E-mail opstellen</h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm1">
                    <input type="hidden" name="emailadreszend" id="emailzend"/>                                                            
                    <div class="row">
                        <div class="col-md-12">  

                            <div class="row" id="ontvangerdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Ontvanger:', 'ontvanger'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'ontvanger', 'id' => 'ontvanger', 'class' => 'form-control', 'disabled' => 'disabled')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="onderwerpdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Onderwerp:', 'onderwerp'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'onderwerp', 'id' => 'onderwerp', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="boodschapdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Boodschap:', 'boodschap'); ?>                                        
                                </div>

                                <div class="col-md-8">                                      
                                    <?php echo form_textarea(array('name' => 'boodschap', 'id' => 'boodschap', 'class' => 'form-control', 'rows' => '10', 'cols' => '150')); ?>                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </form>        
            </div>                 



            <div class="modal-footer">                                
                <button type="button" class="verstuurEmail btn btn-primary">Verzend</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
        </div>
    </div>            
</div> 

<!--EMAILS VERSTUREN-->
<div class="modal fade" id="gebruikerEmails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">E-mail opstellen</h4>
            </div>

            <div class="modal-body">                  

                <form id="JqAjaxForm2">
                    
                    <div class="row">
                        <div class="col-md-12">  

                            <div class="row" id="ontvangerdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Ontvanger:', 'ontvanger'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'ontvangerall', 'id' => 'ontvangerall', 'class' => 'form-control', 'disabled' => 'disabled')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="onderwerpdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Onderwerp:', 'onderwerp'); ?>                    
                                </div>

                                <div class="col-md-8">   
                                    <?php echo form_input(array('name' => 'onderwerpall', 'id' => 'onderwerpall', 'class' => 'form-control')); ?>                                        
                                </div>
                            </div>

                            <div class="row" id="boodschapdiv">
                                <div class="col-md-4">   
                                    <?php echo form_label('Boodschap:', 'boodschap'); ?>                                        
                                </div>

                                <div class="col-md-8">                                      
                                    <?php echo form_textarea(array('name' => 'boodschapall', 'id' => 'boodschapall', 'class' => 'form-control', 'rows' => '10', 'cols' => '150')); ?>                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </form>        
            </div>                 

            <div class="modal-footer"> 
                <span class="text-muted">Het verzenden kan langer duren bij meer ontvangers</span>
                <button type="button" class="verstuurEmails btn btn-primary">Verzend</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
        </div>
    </div>            
</div> 


<!-- MODAL VOOR DEACTIVEREN -->  
<div class="modal fade" id="gebruikerDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">  
                <p class="hidden alert alert-danger" role="alert" id="error"></p>
                <p>Bent u zeker dat u deze gebruiker wilt deactiveren?</p>  
                <p class="italic">Je kan deze later weer activeren!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteGebruiker btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  

<!-- MODAL VOOR ACTIVEREN -->  
<div class="modal fade" id="gebruikerActivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">  
                <p class="hidden alert alert-danger" role="alert" id="error"></p>
                <p>Bent u zeker dat u deze gebruiker wilt activeren?</p>  
                <p class="italic">Je kan deze later weer deactiveren!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="activateGebruiker btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  