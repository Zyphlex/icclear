<?php foreach ($routes as $route) { ?>
<div class="row">
    <div class="col-md-7">
    <h3><?php echo $route->vertrekPunt ?></h3>
    <p><?php echo $route->beschrijving ?></p>
    </div>
    <div class="col-md-5">
            <iframe 
                src="<?php echo $route->url ?>"
                width="600" height="450" frameborder="0" style="border:0">
            </iframe>
    </div>
    <hr/>
</div>
<?php } ?>