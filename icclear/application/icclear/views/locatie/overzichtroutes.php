<?php foreach ($routes as $route) { ?>
<div class="row underline">
    <div class="col-sm-12">
        <h3><?php echo $route->vertrekPunt ?></h3>
        <p><?php echo $route->beschrijving ?></p>
    </div>
    <div class="google-maps space-bottom15 col-sm-12">
            <iframe class="img-responsive"
                src="<?php echo $route->url ?>"
                width="100%" height="100%" frameborder="0" style="border:0">
            </iframe>
    </div>
    <hr/>
</div>
<?php } ?>