
<h2>Hotels</h2>
<div class="row">  
    <?php
    foreach ($hotels as $hotel) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-default">';
        echo '<div class = "panel-heading">';
        echo '<h3 class = "panel-title">' . $hotel->hotel->naam   . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<p>' . $hotel->hotel->straat . ' ' . $hotel->hotel->nummer . ' </p>';   
        echo '<p>' . $hotel->hotel->postcode . ' ' . $hotel->hotel->gemeente . ' </p>';   
        echo '<p>' . anchor($hotel->hotel->website,$hotel->hotel->website) . ' </p>';   
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>
