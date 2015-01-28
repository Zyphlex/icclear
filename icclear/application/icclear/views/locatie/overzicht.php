<div class='row'>
    <div class='col-md-12'>
        <h1>Conferentie gebouwen</h1>
    </div>
</div>
    
<div class='row'>
    <div class="col-md-12">
        <?php foreach ($gebouwen as $gebouw) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class = "panel-heading">
                        <h3><?php echo $gebouw->gebouw->naam ?></h3>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $gebouw->gebouw->gemeente ?> (<?php echo $gebouw->gebouw->postcode ?>)</p>
                        <p><?php echo $gebouw->gebouw->straat ?> <?php echo $gebouw->gebouw->nummer ?></p>
                    </div>
                </div>  
            </div>
        <?php } ?>
    </div>
</div>
  
