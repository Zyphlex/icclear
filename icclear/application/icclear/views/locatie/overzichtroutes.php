<div class="panel panel-default">
    <div class = "panel-body">  
        <?php foreach ($routes as $route) { ?>
            <h3><?php echo $route->vertrekPunt ?></h3>
            <p><?php echo $route->beschrijving ?></p>
        <?php } ?>
    </div>
</div>