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
                        <div class="col-md-4">
                            <img src="http://dummyimage.com/110x110/d4c1d4/ffffff&text=PLACEHOLDER" alt="placeholder image" title="placeholder">
                        </div>
                        <div class="col-md-8">
                            <h4><?php echo $hotel->hotel->naam ?></h4>        

                            <p><?php echo $hotel->hotel->straat . ' ' . $hotel->hotel->nummer ?></p>   
                            <p><?php echo $hotel->hotel->postcode . ' ' . $hotel->hotel->gemeente ?></p>   
                            <p><?php echo anchor($hotel->hotel->website, 'Naar de website') ?></p>  
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
    <?php } ?>
</div>
