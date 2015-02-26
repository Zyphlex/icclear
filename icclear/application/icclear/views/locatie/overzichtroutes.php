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
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAiFkc15nXtE7Tx3TjKmPka06bDVVq1KOU
                &q=Gare+de+Charleroi-Sud">
            </iframe>
    </div>
    <hr/>
</div>
<?php } ?>