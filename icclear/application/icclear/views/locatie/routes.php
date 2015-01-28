<div class='row'>
    <div class='col-md-12'>
        <h1>Routes</h1>
    </div>
</div>

<div class="row">  
    <?php foreach ($routes as $route) { ?>
        <div class="col-md-6">
            <div class="row">
                <div class="panel panel-default">
                    <div class="col-md-7">
                        <div class = "panel-heading">
                            <h3><?php echo $route->vertrekPunt ?></h3>
                        </div>
                        <div class="panel-body">
                            <p><?php echo $route->beschrijving ?></p>        
                        </div>
                    </div>  
                    <div class="col-md-5">
                        <div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2502.135651564536!2d4.9664933999999885!3d51.16128850000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c14c00ecab0a95%3A0x804150638f80ce7d!2sKleinhoefstraat%2C+2440+Geel!5e0!3m2!1snl!2sbe!4v1422358483331" width="450" height="295" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
