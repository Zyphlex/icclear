<script type="text/javascript">
    function haaloverzicht ( gebouwId ) {
        $.ajax({type : "GET",
                url : site_url + "/locatie/overzichtRoutes",
                data : { gebouwId : gebouwId },
                success : function(result){
                    $("#resultaat").html(result);
                }
        });
    }
    
    $(document).ready(function() {
        $( ".zoekRoutes" ).click(function() {
            haaloverzicht( $(this).data("id") );
//            if ( $(this).html() == "Toon routes" )
//            {                
//                $( "#resultaat" ).slideDown(400);
//                $(this).html("Verberg routes");
//            }
//            else
//            {                
//                $( "#resultaat" ).slideUp(400);
//                $(this).html("Toon routes");
//            }
        });
        
    });
</script>

<div class='row'>
    <div class='col-md-12'>
        <h1>Conferentie gebouwen</h1>
    </div>
</div>
    
<div class='row'>
        <?php $teller = 1; foreach ($gebouwen as $gebouw) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class = "panel-heading">                        
                        <h3>Dag <?php echo $teller .  '  ' . $gebouw->gebouw->naam?></h3>
                    </div>
                    <div class = "panel-body">  
                            <div class="thumbnail">
                                <?php if ($gebouw->gebouw->foto == 'gebouw' . $gebouw->gebouw->id . '.jpg') { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/gebouwen/' . $gebouw->gebouw->foto; ?>" 
                                 alt="Foto <?php echo $gebouw->gebouw->naam; ?>" 
                                 title="Foto <?php echo $gebouw->gebouw->naam; ?>"
                                 data-placement="bottom">
                            <?php } else { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/gebouwen/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" data-placement="bottom">
                            <?php } ?>
                            </div>
                        <p><?php echo $gebouw->gebouw->gemeente ?> (<?php echo $gebouw->gebouw->postcode ?>)</p>
                        <p><?php echo $gebouw->gebouw->straat ?> <?php echo $gebouw->gebouw->nummer ?></p>
                    
                        <button data-id="<?php echo $gebouw->gebouw->id ?>" class="col-sm-12 zoekRoutes btn btn-primary" data-toggle="modal" data-target="#routesModal">Toon routes</button>
                    </div>
                </div>  
            </div>
        <?php $teller++; } ?>    
</div>

<div class="modal fade" id="routesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Routes</h4>
            </div>

            <div class="modal-body">                  
                <div id="resultaat"></div>
            </div>
            
             <div class="modal-footer">
                <button type="button" class="col-sm-12 btn btn-primary" data-dismiss="modal">Sluiten</button>
            </div>
            
        </div>            
    </div>
</div>  
