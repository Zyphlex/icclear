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
                        <h3>Dag <?php echo $teller .  '   <span class="italic">(' . $gebouw->datum . ')</span>' ?></h3>
                    </div>
                    <div class = "panel-body">  
                        <h4><?php echo $gebouw->gebouw->naam ?></h4>
                            <div class="thumbnail">
                                <img src="http://placehold.it/350x150" alt="placeholder image" title="placeholder">
                            </div>
                        <p><?php echo $gebouw->gebouw->gemeente ?> (<?php echo $gebouw->gebouw->postcode ?>)</p>
                        <p><?php echo $gebouw->gebouw->straat ?> <?php echo $gebouw->gebouw->nummer ?></p>
                    </div>
                </div>  
            </div>
        <?php $teller++; } ?>
</div>
  
