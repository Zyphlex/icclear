<div class="row">
    <div class="col-md-12">
        <h1>Sprekers tijdens de conferentie</h1>
    </div>
</div>

<div class="row"> 
    <?php foreach ($sprekers as $spreker) { ?>   
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-5">
                            <img src="<?php echo base_url() . 'application/upload/' . $spreker->foto; ?>" alt="" title="">
                        </div>
                        <div class="col-md-7">
                            <h4><?php echo$spreker->voornaam . ' ' . $spreker->familienaam ?></h4> 
                            <p class="italic">Sessies:</p>
                            <p><?php echo $spreker->sessie->onderwerp ?></p>
                        </div>
                    </div>      
                </div> 
            </div>  
        </div>
    <?php } ?>
</div>
