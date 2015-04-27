<div class="row">
    <div class="col-md-12">
        <h1>Conferentie - <?php echo $conferentie->naam ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h2>Wat is IC Clear?</h2>
        <p><?php echo $algemeneinfo->omschrijving ?></p>
    </div> 
    
    <div class="col-md-4">
        <div class="thumbnail">
            <img src="<?php echo base_url() . APPPATH; ?>img/default/home.jpg" alt="ICclear clarity" title="Home Afbeelding">
        </div>
    </div>
</div>

<br/><br/>

<div class="row">
    <?php foreach ($aankondigingen as $aankondiging){ ?>
        <div class="col-md-4">
                <h1><?php echo $aankondiging->titel; ?></h1>

                <p><?php echo $aankondiging->inhoud; ?></p>
        </div>
    <?php } ?>
</div>
