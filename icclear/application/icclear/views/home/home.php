<!-- Announcement items allemaal dezelfde hoogte geven -->
<script type="text/javascript">
$( document ).ready(function() {
    var heights = $(".nieuws-item").map(function() {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    $(".nieuws-item").height(maxHeight);
});
</script>

<div class="row">
    <div class="col-sm-12">
        <h1 class="underline-full">Conferentie - <?php echo $conferentie->naam ?></h1>
    </div>
</div>

<div class="row space-bottom">
    <div class="col-sm-8">
        <h2>Wat is IC Clear?</h2>
        <p><?php echo $conferentie->beschrijving ?></p>
    </div> 
    
    <div class="col-sm-4 col-xs-12">
        <div class="thumbnail">
            <img src="<?php echo base_url() . APPPATH; ?>img/default/home.jpg" alt="ICClear clarity logo" title="Home Afbeelding">
        </div>
    </div>
</div>

<div class="row">   
    <div class="col-sm-4 col-xs-12">
        <div class="thumbnail">
            <img src="<?php echo base_url() . APPPATH; ?>img/default/home.jpg" alt="ICClear clarity logo" title="Home Afbeelding">
        </div>
    </div>
    
    <div class="col-sm-8">
        <h2>Wat is IC Clear?</h2>
        <p><?php echo $algemeneinfo->omschrijving ?></p>
    </div> 
</div>

<br/><br/>

<div class="row">
    <div class="col-xs-12">
        <h2 class="underline-full">Recent nieuws!</h2>
    </div>
    <?php foreach ($aankondigingen as $aankondiging){ ?>  
        <div class="col-sm-4 col-xs-12">    
            <div class="panel panel-default">    
            <div class="equalizer nieuws-item">
                <h1><?php echo $aankondiging->titel; ?></h1>
                <p><?php echo $aankondiging->inhoud; ?></p>
            </div>
            </div>
        </div>
    <?php } ?>
</div>
