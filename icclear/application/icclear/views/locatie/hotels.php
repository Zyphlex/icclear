
<h2>Hotels</h2>
<div class="row">  
    <?php
    foreach ($hotels as $hotel) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-info">';
        echo '<div class = "panel-heading">';
        echo '<h3 class = "panel-title">' . $hotel->naam   . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<h2>' . $hotel->straat . ' ' . $hotel->nummer . ' </h2>';        
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>
