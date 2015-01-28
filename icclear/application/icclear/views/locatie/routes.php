<div class='row'>
    <div class='col-md-12'>
        <h1>Routes</h1>
    </div>
</div>

<div class="row">  
    <div class="col-md-12">
        <?php foreach ($routes as $route) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class = "panel-heading">
                        <h3><?php $route->vertrekPunt ?></h3>
                    </div>
                    <div class="panel-body">
                        <p><?php $route->beschrijving ?></p>        
                    </div>
                </div>  
            </div>
        <?php } ?>
    </div>
</div>
