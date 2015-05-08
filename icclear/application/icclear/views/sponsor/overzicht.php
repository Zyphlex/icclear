<div class="row">
    <div class="col-md-12">
        <h1>Onze sponsors</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($sponsors as $sponsor) { 
        if ($sponsor->type == 'Sponsor'){?>        
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-5">
                            <?php if ($sponsor->logo == 'sponsor' . $sponsor->id . '.jpg') { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sponsors/' . $sponsor->logo; ?>" 
                                 alt="Logo <?php echo $sponsor->naam; ?>" 
                                 title="Logo <?php echo $sponsor->naam; ?>"
                                 data-placement="bottom">
                            <?php } else { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sponsors/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" data-placement="bottom">
                            <?php } ?>
                        </div>
                        <div class="col-md-7">
                            <h3><?php echo $sponsor->naam ?></h3>        
 
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
        <?php }} ?>
</div>

<div class="row">
    <div class="col-md-12">
        <h1>Onze partners</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($sponsors as $sponsor) { 
        if ($sponsor->type == 'Partner'){?>        
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-5">
                            <?php if ($sponsor->logo == 'sponsor' . $sponsor->id . '.jpg') { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sponsors/' . $sponsor->logo; ?>" 
                                 alt="Logo <?php echo $sponsor->naam; ?>" 
                                 title="Logo <?php echo $sponsor->naam; ?>"
                                 data-placement="bottom">
                            <?php } else { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sponsors/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" data-placement="bottom">
                            <?php } ?>
                        </div>
                        <div class="col-md-7">
                            <h3><?php echo $sponsor->naam ?></h3>        
 
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
        <?php }} ?>
</div>
