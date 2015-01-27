
        <div class="row"> 
            <?php
            foreach ($sprekers as $spreker) {                
                echo '<div class="col-md-4">' . "\n";
                echo '<div class="panel panel-default">' . "\n";
                echo '<div class="panel-body">' . "\n";
                echo '<h4>' . $spreker->voornaam . ' ' . $spreker->familienaam .  '</h4>' . "\n";
                echo '   <p>' . $spreker->biografie.  '</p> ' . "\n";
                echo '</div>' . "\n";
                echo '</div>  ' . "\n";
                echo '</div>' . "\n";
            }
            ?>
        </div>
