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
    <div class="col-md-12">
        <h1>Conferentie - <?php echo $conferentie->naam ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-8">
        <h2>Wat is IC Clear?</h2>
        <p><?php echo $algemeneinfo->omschrijving ?></p>
    </div> 
    
    <div class="col-sm-4">
        <div class="thumbnail">
            <img src="<?php echo base_url() . APPPATH; ?>img/default/home.jpg" alt="ICclear clarity" title="Home Afbeelding">
        </div>
    </div>
</div>

<br/><br/>

<div class="row">
    <?php $teller = 3; ?>
    <?php foreach ($aankondigingen as $aankondiging){ ?>
        <?php if ($teller != 3) { ?>
        <div class="panel panel-default nieuws-item col-xs-4">            
            <span class="panel-body">
                <h1><?php echo $aankondiging->titel; ?></h1>
                <p><?php echo $aankondiging->inhoud; ?></p>
            </span>
        </div>
        <?php $teller++; ?>
        <?php } else { ?>
            <?php $teller = 0; ?>
            </div>
            <div class="row">
        <?php } ?>
    <?php } ?>
</div>
