<?php foreach ($routes as $route) { ?>
<div class="row">
    <div class="col-md-7">
    <h3><?php echo $route->vertrekPunt ?></h3>
    <p><?php echo $route->beschrijving ?></p>
    </div>
    <div class="col-md-5">
            <iframe
                width="200"
                height="200"
                frameborder="0" style="border:0"
                src="<?php echo $route->url ?>">
            </iframe>
    </div>
    <hr/>
</div>
<?php } ?>