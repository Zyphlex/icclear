<div class="row">
    <div class="col-md-12">
        <h1>Aanbevolen hotels</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($hotels as $hotel) { ?>        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-3">
                            <?php if ($hotel->foto == 'hotel' . $hotel->id . '.jpg') { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/hotels/' . $hotel->foto; ?>" 
                                 alt="Foto <?php echo $hotel->naam; ?>" 
                                 title="Foto <?php echo $hotel->naam; ?>"
                                 data-placement="bottom">
                            <?php } else { ?>
                                <img class="img-responsive center-block" src="<?php echo base_url() . 'application/upload/fotos/hotels/default.jpg'; ?>" 
                                 alt="Foto niet beschikbaar" title="Foto niet beschikbaar" data-placement="bottom">
                            <?php } ?>
                        </div>
                        <div class="col-md-9">
                            <h4><?php echo $hotel->hotel->naam ?></h4>        

                            <p><?php echo $hotel->hotel->straat . ' ' . $hotel->hotel->nummer ?></p>   
                            <p><?php echo $hotel->hotel->postcode . ' ' . $hotel->hotel->gemeente ?></p>   
                            <p><?php echo anchor($hotel->hotel->website, 'Naar de website', array('target' => '_blank')) ?></p>  
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
    <?php } ?>
</div>
