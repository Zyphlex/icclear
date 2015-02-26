<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Routes</h4>
</div>

<div class="modal-body">    
    <?php foreach ($routes as $route) { ?>
        <h3><?php echo $route->vertrekPunt ?></h3>
        <p><?php echo $route->beschrijving ?></p>
    <?php } ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
</div>