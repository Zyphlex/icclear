<div class="row">
    <div class="col-md-12">
        <h1>Sprekers tijdens de conferentie</h1>
    </div>
</div>

<div class="row"> 
    <?php foreach ($sprekers as $p) { ?>    
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="equalizer panel panel-default">
                    <div class="panel-body">      
                            <h4 class="text-center"><?php echo$p->spreker->voornaam . ' ' . $p->spreker->familienaam ?></h4> 
                            <?php if ($p->spreker->foto == 'spreker' . $p->spreker->id . '.jpg') { ?>
                                <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $p->spreker->foto; ?>" 
                                 alt="Foto <?php echo$p->spreker->familienaam . ' ' . $p->spreker->voornaam; ?>" 
                                 title="Foto <?php echo$p->spreker->familienaam . ' ' . $p->spreker->voornaam; ?>"
                                 height="150" width="auto" data-placement="bottom">
                            <?php } else { ?>
                                <img class="center-block" src="<?php echo base_url() . 'application/upload/fotos/sprekers/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" height="150" width="auto" data-placement="bottom">
                            <?php } ?>
                        </div> 
            </div>  
        </div>
    <?php } ?>
</div>
