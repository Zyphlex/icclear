<div class="row">
    <div class="col-md-12">
        <h1>Sprekers tijdens de conferentie</h1>
    </div>
</div>

<div class="row"> 
    <?php foreach ($sprekers as $p) { ?>    
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-sm-5 col-xs-12">                            
                            <h4><?php echo$p->spreker->voornaam . ' ' . $p->spreker->familienaam ?></h4> 
                            <?php if ($p->spreker->foto == 'spreker' . $p->spreker->id . '.jpg') { ?>
                            <img src="<?php echo base_url() . 'application/upload/fotos/sprekers/' . $p->spreker->foto; ?>" 
                                 alt="<?php echo$p->spreker->familienaam . ' ' . $spreker->voornaam; ?>" 
                                 title="<?php echo$p->spreker->familienaam . ' ' . $spreker->voornaam; ?>"
                                 height="110">
                            <?php } else { ?>
                            <img src="<?php echo base_url() . 'application/upload/fotos/sprekers/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" height="110">
                            <?php } ?>
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
    <?php } ?>
</div>
