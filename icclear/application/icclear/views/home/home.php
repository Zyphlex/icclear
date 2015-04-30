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
        <h1>Conferentie - <?php echo $conferentie->naam ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <h2>Wat is IC Clear?</h2>
        <p><?php echo $algemeneinfo->omschrijving ?></p>
    </div> 
    
    <div class="col-sm-4 col-xs-12">
        <div class="thumbnail">
            <img src="<?php echo base_url() . APPPATH; ?>img/default/home.jpg" alt="ICclear clarity" title="Home Afbeelding">
        </div>
    </div>
</div>

<br/><br/>

<div class="row">
    <?php foreach ($aankondigingen as $aankondiging){ ?>  
        <div class="col-sm-4 col-xs-6 col-xs-12">    
            <div class="panel panel-default">    
            <div class="nieuws-item">
                <h1><?php echo $aankondiging->titel; ?></h1>
                <p><?php echo $aankondiging->inhoud; ?></p>
            </div>
            </div>
        </div>
    <?php } ?>
</div>
