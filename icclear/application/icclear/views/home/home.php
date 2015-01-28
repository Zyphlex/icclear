<div class="row">
    <div class="col-md-7">
        <p>
            <?php echo $algemeneinfo->omschrijving ?>
        </p>
    </div> 
    
    <div class="col-md-5">
        <div class="thumbnail">
            <img src="http://placehold.it/350x150" alt="placeholder image" title="placeholder">
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($aankondigingen as $aankondiging){ ?>
        <div class="col-md-4">
            <h1><?php echo $aankondiging->titel; ?></h1>
            <div class="panel">

                <div id="body">
                    <?php echo $aankondiging->inhoud; ?>
                </div>

            </div>
        </div>
    <?php } ?>
</div>

