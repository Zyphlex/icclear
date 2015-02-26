<script src="<?php echo base_url() . APPPATH; ?>js/jquery-1.11.2.min.js"></script>   
<script type="text/javascript">
    function haaloverzicht () {
        $.ajax({type : "GET",
                url : site_url + "/faqbeheer/overzicht",
                success : function(result){
                    $("#resultaat").html(result);
                }
        });
    }
    
    function refreshData () {
        haaloverzicht ();
    }
    
    function maakDetailClick() {
        $(".wijzigFaq").click(function(e) {
            e.preventDefault();
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
            // eventuele fouten van vorig dialoogvenster wegdoen
            $( "#vraag" ).removeClass( "" );
            $( "#antwoord" ).removeClass( "" );
            // dialoogvenster openen
            $( "#faqModal" ).modal('show'); 
        });   
    }
    
    $(document).ready(function() {
        haaloverzicht();
        $( ".opslaanFaq" ).click(function() {    
            haaloverzicht ();
        });
        
    });
</script>


<div class="col-md-10">

    <h1>FAQ beheren</h1>  
            
    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>
    <?php echo anchor('faqbeheer/toevoegen/', 'Nieuwe FAQ toevoegen', 'class="btn btn-default"'); ?> 

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