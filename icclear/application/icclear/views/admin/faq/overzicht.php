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
    
    $(document).ready(function() {
        haaloverzicht();
        $( ".opslaanFaq" ).click(function() {
            
        });
        
    });
</script>


<div class="col-md-10">

    <h1>FAQ beheren</h1>  

    <table class="table">
        <thead>
            <tr>
                <th>Vraag</th>
                <th>Antwoord</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <div id="resultaat"></div>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>
    <?php echo anchor('faqbeheer/toevoegen/', 'Nieuwe FAQ toevoegen', 'class="btn btn-default"'); ?> 

</div>


<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Routes</h4>
            </div>

            <div class="modal-body">                  
                
                <!-- formulier shit zooi -->
                
            </div>
            
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
            </div>
            
        </div>            
    </div>
</div>  
