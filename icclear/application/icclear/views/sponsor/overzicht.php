<div class="row">
    <div class="col-md-12">
        <h1>Onze sponsors</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($sponsors as $sponsor) { ?>        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/110x110/d4c1d4/ffffff&text=PLACEHOLDER" alt="placeholder image" title="placeholder">
                        </div>
                        <div class="col-md-9">
                            <h4><?php echo $sponsor->naam ?></h4>        
 
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
    <?php } ?>
</div>
