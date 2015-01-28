<div class='row'>
    <div class='col-md-12'>
        <h1>Conferentie gebouwen</h1>
    </div>
</div>
    
<div class='row'>
        <?php foreach ($gebouwen as $gebouw) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class = "panel-heading">
                        
                    </div>
                    <div class = "panel-body">
                            <div class="thumbnail">
                                <img src="http://placehold.it/350x150" alt="placeholder image" title="placeholder">
                            </div>
                        <h3><?php echo $gebouw->gebouw->naam ?></h3>
                        <p><?php echo $gebouw->gebouw->gemeente ?> (<?php echo $gebouw->gebouw->postcode ?>)</p>
                        <p><?php echo $gebouw->gebouw->straat ?> <?php echo $gebouw->gebouw->nummer ?></p>
                    </div>
                </div>  
            </div>
        <?php } ?>
</div>
  
