<?php foreach ($routes as $route) { ?>
<div class="row">
    <div class="col-md-7">
    <h3><?php echo $route->vertrekPunt ?></h3>
    <p><?php echo $route->beschrijving ?></p>
    </div>
    <div class="col-md-5">
            <?php echo $route->url ?>
    </div>
    <hr/>
</div>
<?php } ?>