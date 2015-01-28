<div class="row">
    <div class="col-md-12">
        <h1>Zelf spreker worden</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">        
        <p>
            Nulla id finibus mauris. Cras maximus ultrices dictum. 
            Phasellus suscipit felis sed nibh euismod, vel varius velit porttitor. 
            Nullam vulputate imperdiet sem ornare porta. Nunc eget lectus a metus consectetur suscipit in in urna. 
            Quisque vestibulum erat in convallis faucibus. Aliquam sed placerat dolor.
        </p>
        <p><?php echo anchor('spreker', 'Voorstel indienen', 'class="btn btn-default"'); ?></p>
    </div>
</div>


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
                                <img src="http://dummyimage.com/110x110/d4c1d4/ffffff&text=PLACEHOLDER" alt="placeholder image" title="placeholder">
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
