<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht () {
        $.ajax({type : "GET",
                url : site_url + "/sessies/overzicht",
                success : function(result){
                    $("#resultaat").html(result);
                    maakDetailClick();
                    maakDeleteClick();
                }
        });
    }
    
    //Wijzigen refreshen
    function refreshData () {
        haaloverzicht ();
    }
    
    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderSessie").click(function() {
            deleteid = $(this).data("id");
            $( "#sessieDelete" ).modal('show');
        });        
    }
    
    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
          $(".wijzigSessie").click(function() {
            var iddb = $(this).data("id");
            $( "#id" ).val( iddb );
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type : "GET",
                    url : site_url + "/sessies/detail",
                    async: false,
                    data : { id : iddb },
                    success : function(result){
                        var jobject = jQuery.parseJSON(result);
                        $( "#vraag" ).val(jobject.vraag);
                        $( "#antwoord" ).val(jobject.antwoord);
                    }
                });
            }
            // dialoogvenster openen
            $( "#sessieModal" ).modal('show'); 
        }); 
    }
        
    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();
                
        //Klikken op "OPSLAAN" in de Detail modal
        $(".opslaanFaq").click(function() {
              var dataString = $("#JqAjaxForm:eq(0)").serialize();
                      $.ajax({
                      type: "POST",
                              url: site_url + "/sessies/update",
                              async: false,
                              data: dataString,
                              dataType: "json"
                      });
                      refreshData();
                      $( "#sessieModal" ).modal('hide');
        });
        
        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteFaq").click(function() {
                      $.ajax({
                        type: "POST",
                        url: site_url + "/sessies/delete",
                        async: false,
                        data : { id : deleteid },
                        success : function(result){
                            if (result == '0') {
                                alert("Er is iets foutgelopen!");
                            } else {
                                refreshData();
                            }  
                            $( "#sessieDelete" ).modal('hide');                          
                        }
                    });
        });
        
    });
</script>


<div class="col-md-10">

    <h1>FAQ beheren</h1>  
            
    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>
    
    <button class="wijzigSessie btn btn-primary" data-id="0">Nieuwe FAQ Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="sessieModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  
                
                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <p><?php echo form_label('Vraag:', 'onderwerp'); ?></p>
                    <p><?php echo form_input(array('name' => 'onderwerp', 'id' => 'onderwerp', 'class' => 'form-control')); ?></p>

                    <p><?php echo form_label('Spreker:', 'spreker'); ?></p>
                    <p><?php echo form_input(array('name' => 'spreker', 'id' => 'spreker', 'class' => 'disabled form-control')); ?></p>
                                        
                    <p><?php echo form_label('Antwoord:', 'omschrijving'); ?></td>
                    <p><?php echo form_textarea(array('name' => 'omschrijving', 'id' => 'omschrijving', 'class' => 'form-control', 'rows' => '5', 'cols' => '10')); ?></p>
                </form>                
            </div>
            
             <div class="modal-footer">
                <button type="button" class="opslaanFaq btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
            
        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="sessieDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze vraag wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>
            
             <div class="modal-footer">
                <button type="button" class="deleteFaq btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
            
        </div>            
    </div>
</div> 