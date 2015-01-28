<div class="row">
    <div class="col-md-8">
        <h1>Wat is IC Clear?</h1>
        <p><?php echo $algemeneinfo->omschrijving ?></p>
    </div> 
    
    <div class="col-md-4">
        <div class="thumbnail">
            <img src="http://placehold.it/350x150" alt="placeholder image" title="placeholder">
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($aankondigingen as $aankondiging){ ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                 <div class="panel-body">
                <h1><?php echo $aankondiging->titel; ?></h1>

                <p><?php echo $aankondiging->inhoud; ?></p>
                 </div>
            </div>
        </div>
    <?php } ?>
</div>

