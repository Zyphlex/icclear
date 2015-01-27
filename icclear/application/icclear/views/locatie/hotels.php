
        <h2>Hotels</h2>
        <div class="row">  
            <?php
            foreach ($hotels as $hotel) {
                echo '<div class="col-md-4">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-body">';
                echo '<h4>' . $hotel->naam . ' </h4>';
                echo '   <p>Extra text</p> ';
                echo '</div>';
                echo '</div>  ';
                echo '</div>';
            }
            ?>
        </div>
    