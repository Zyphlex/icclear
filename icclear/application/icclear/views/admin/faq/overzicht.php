<script type="text/javascript">
    function haaloverzicht () {
        $.ajax({type : "GET",
                url : site_url + "/faqbeheer/overzicht",
                success : function(result){
                    $("#resultaat").html(result);
                    maakDetailClick();
                    maakDeleteClick();
                }
        });
    }
    
    function refreshData () {
        haaloverzicht ();
    }
    
    function maakDeleteClick() {
        $(".verwijderFaq").click(function(e) {
            deleteid = $(this).data("id");
            $( "#faqDelete" ).modal('show');
        });        
    }
    
    function maakDetailClick() {
          $(".wijzigFaq").click(function(e) {
            var iddb = $(this).data("id");
            $( "#id" ).val( iddb );
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type : "GET",
                    url : site_url + "/faqbeheer/faqdetail",
                    async: false,
                    data : { id : iddb },
                    success : function(result){
                        var jobject = jQuery.parseJSON(result);
                        $( "#vraag" ).val(jobject.vraag);
                        $( "#antwoord" ).val(jobject.antwoord);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $( "#vraag" ).val("");
                $( "#antwoord" ).val("");
            }
            // dialoogvenster openen
            $( "#faqModal" ).modal('show'); 
        }); 
    }
    
    $(".opslaanFaq").click(function() {
    // gegevens wegschrijven via ajax (doorgeven naar server via json)
              var dataString = $("#JqAjaxForm:eq(0)").serialize();
                      $.ajax({
                      type: "POST",
                              url: site_url + "/faqbeheer/faqupdate",
                              async: false,
                              data: dataString,
                              dataType: "json"
                      });
                      refreshData();
                      $( "#faqModal" ).modal('hide');
    });
        
    $(document).ready(function() {
        maakDetailClick();
        maakDeleteClick();
        haaloverzicht();
        
        $( ".opslaanFaq" ).click(function() {    
            haaloverzicht ();
        });
        
        $(".opslaanFaq").click(function() {
        // gegevens wegschrijven via ajax (doorgeven naar server via json)
              var dataString = $("#JqAjaxForm:eq(0)").serialize();
                      $.ajax({
                      type: "POST",
                              url: site_url + "/faqbeheer/faqupdate",
                              async: false,
                              data: dataString,
                              dataType: "json"
                      });
                      refreshData();
                      $( "#faqModal" ).modal('hide');
        });
        
        $(".deleteFaq").click(function() {
        // gegevens wegschrijven via ajax (doorgeven naar server via json)
                      $.ajax({
                        type: "GET",
                        url: site_url + "/faqbeheer/faqdelete",
                        async: false,
                        data : { id : deleteid },
                        success : function(result){
                            if (result == '0') {
                                // verwijderen is mislukt, foutmelding tonen
                                alert("error");
                            } else {
                                refreshData();
                                $( "#faqDelete" ).modal('hide');
                            }                            
                        }
                    });
        });
        
    });
</script>


<div class="col-md-10">

    <h1>FAQ beheren</h1>  
            
    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>
    
    <button class="wijzigFaq btn btn-primary" data-id="0">Nieuwe Toevoegen</button>

</div>

         
<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  
                
                <form id="JqAjaxForm">
                    <input type="hidden" name="id" id="id" />
                    <p><?php echo form_label('Vraag:', 'vraag'); ?></p>
                    <p><?php echo form_input(array('name' => 'vraag', 'id' => 'vraag', 'class' => 'form-control', 'required' => 'required')); ?></p>

                    <p><?php echo form_label('Antwoord:', 'antwoord'); ?></td>
                    <p><?php echo form_textarea(array('name' => 'antwoord', 'id' => 'antwoord', 'class' => 'form-control', 'rows' => '5', 'cols' => '10')); ?></p>
                </form>
                
            </div>
            
             <div class="modal-footer">
                <button type="button" class="opslaanFaq btn btn-primary">Opslaan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
            
        </div>            
    </div>
</div>  

<div class="modal fade" id="faqDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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