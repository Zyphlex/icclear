<script type="text/javascript">
    function haaloverzicht ( faqId ) {
        $.ajax({type : "GET",
                url : site_url + "/faqbeheer/overzichtRoutes",
                data : { faqId : faqId },
                success : function(result){
                    $("#resultaat").html(result);
                }
        });
    }
    
    $(document).ready(function() {
        $( ".wijzigFaq" ).click(function() {
            haaloverzicht( $(this).data("id") );
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
            <?php foreach ($vragen as $vraag) { ?>
                <tr>
                    <td><?php echo $vraag->vraag ?></td>
                    <td><?php echo $vraag->antwoord ?></td>
                    <td>
                        <p>                                        
                            <?php echo anchor('Wijzig', 'class="wijzigFag btn btn-default"', 'data-toggle="modal"' , 'data-target="#"', 'data-id="' . $vraag->id . '"'); ?>
                            <?php echo anchor('faqbeheer/verwijder/' . $vraag->id, 'Verwijder', 'class="btn btn-default"'); ?>   
                        </p>                                 
                    </td>
                </tr>
            <?php } ?>
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
