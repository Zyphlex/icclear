<div class="row">
    <div class="col-md-12">
        <h1>Sprekers tijdens de conferentie</h1>
    </div>
</div>

<div class="row"> 
    <?php foreach ($sprekers as $p) { ?>    
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="equalizer panel panel-default">
                    <div class="panel-body">      
                            <h4 class="text-center"><?php echo$p->spreker->voornaam . ' ' . $p->spreker->familienaam ?></h4> 
                            <?php if ($p->spreker->foto == 'spreker' . $p->spreker->id . '.jpg') { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $p->spreker->foto; ?>" 
                                 alt="Foto <?php echo$p->spreker->familienaam . ' ' . $p->spreker->voornaam; ?>" 
                                 title="Foto <?php echo$p->spreker->familienaam . ' ' . $p->spreker->voornaam; ?>"
                                 data-placement="bottom">
                            <?php } else { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" data-placement="bottom">
                            <?php } ?>
                        </div> 
            </div>  
        </div>
    <?php } ?>
</div>
