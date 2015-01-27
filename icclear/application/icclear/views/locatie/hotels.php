
<h2>Hotels</h2>
<div class="row">  
    <?php
    foreach ($hotels as $hotel) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-default">';
        echo '<div class = "panel-heading">';
        echo '<h3 class = "panel-title">' . $hotel->naam   . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<p>' . $hotel->straat . ' ' . $hotel->nummer . ' </p>';   
        echo '<p>' . $hotel->postcode . ' ' . $hotel->gemeente . ' </p>';   
        echo '<p>' . anchor($hotel->website,$hotel->website) . ' </p>';   
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>
