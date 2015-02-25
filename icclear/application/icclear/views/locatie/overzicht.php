<script type="text/javascript">
    function haaloverzicht ( gebouwId ) {
        $.ajax({type : "GET",
                url : site_url + "/locatie/overzichtRoutes",
                data : { gebouwId : gebouwId },
                success : function(result){
                    alert(result);
                    $("#resultaat").html(result);
                }
        });
    }
    
    $(document).ready(function() {
        $( "#zoekRoutes" ).click(function() {
            alert("klik");
            haaloverzicht("1");
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
                        <h3>Dag <?php echo $teller .  '  ' . $gebouw->gebouw->naam ?></h3>
                    </div>
                    <div class = "panel-body">  
                            <div class="thumbnail">
                                <img src="http://placehold.it/350x150" alt="placeholder image" title="placeholder">
                            </div>
                        <p><?php echo $gebouw->gebouw->gemeente ?> (<?php echo $gebouw->gebouw->postcode ?>)</p>
                        <p><?php echo $gebouw->gebouw->straat ?> <?php echo $gebouw->gebouw->nummer ?></p>
                    
                        <button id="zoekRoutes" class="btn btn-primary" data-toggle="modal" data-target="#routesModal">Toon routes</button>
                    </div>
                </div>  
            </div>
        <?php $teller++; } ?>
    
</div>

<div class="row">    
    <div id="resultaat"></div>
</div> 
