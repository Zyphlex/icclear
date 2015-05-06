<?php foreach ($routes as $route) { ?>
<div class="row">
    <div class="col-sm-12">
    <h3><?php echo $route->vertrekPunt ?></h3>
    <p><?php echo $route->beschrijving ?></p>
    </div>
    <div class="col-sm-12">
            <iframe class="img-responsive"
                src="<?php echo $route->url ?>"
                frameborder="0" style="border:0">
            </iframe>
    </div>
    <hr/>
</div>
<?php } ?>