<div class='row'>
    <div class='col-md-12'>
        <h1>Routes</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($routes as $route) { ?>
    <div class="col-md-6">
            <div class="panel panel-default">
                <div class = "panel-heading">
                    <h3><?php echo $route->route->vertrekPunt ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7">
                            <p><?php echo $route->route->beschrijving ?></p>        
                        </div>
                        <div class="col-md-5">
                            <div>
                                <iframe
                                    width="200"
                                    height="200"
                                    frameborder="0" style="border:0"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAiFkc15nXtE7Tx3TjKmPka06bDVVq1KOU
                                    &q=Gare+de+Charleroi-Sud">
                                </iframe>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    <?php } ?>
</div>
