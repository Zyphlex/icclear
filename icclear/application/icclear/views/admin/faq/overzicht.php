<script type="text/javascript">
    function haaloverzicht () {
        $.ajax({type : "GET",
                url : site_url + "/faqbeheer/overzicht",
                success : function(result){
                    $("#resultaat").html(result);
                    maakDetailClick();
                }
        });
    }
    
    function refreshData () {
        haaloverzicht ();
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
        haaloverzicht();
        $( ".opslaanFaq" ).click(function() {    
            haaloverzicht ();
        });
        
        $( ".wijzigFaq" ).click(function() {    
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
        
    });
</script>


<div class="col-md-10">

    <h1>FAQ beheren</h1>  
            
    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>
    
    <button class="wijzigFaq btn btn-primary">Nieuwe Toevoegen</button>
    <?php echo anchor('faqbeheer/toevoegen/', 'Nieuwe FAQ toevoegen', 'class="wijzigFaq btn btn-default"'); ?> 

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