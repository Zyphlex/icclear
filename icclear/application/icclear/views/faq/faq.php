<div>
    
    <div class="row">
        <div class="col-md-12">
            <h1>F.A.Q.</h1>
            <div class="panel">
                <div id="body">
                    <?php 
                    foreach($vragen as $vraag){
                        echo '<h3>' . $vraag->vraag . '</h3>';
                        echo '<p>' . $vraag->antwoord . '</p>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>           
</div>
