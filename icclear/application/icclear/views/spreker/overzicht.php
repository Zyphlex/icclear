<script type="text/javascript" src="http://viralpatel.net/blogs/demo/jquery/jquery.shorten.1.0.js"></script>


<div class="row">
    <div class="col-md-12">
        <h1>Sprekers tijdens de conferentie</h1>
    </div>
</div>

<div class="row"> 
    <div class="col-md-12">
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
                                <div class="comment"><?php echo $spreker->biografie ?></div>  
                            </div>                        
                        </div>      
                    </div> 
                </div>  
            </div>
       <?php } ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){     
        $(".comment").shorten({
            "showChars" : 50,
            "moreText"  : "Meer",
            "lessText"  : "Minder",
        });
    );
</script>
