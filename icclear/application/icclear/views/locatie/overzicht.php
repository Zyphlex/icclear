
<h2>Conferentiegebouwen</h2>
<div class="row">  
    <?php
    foreach ($gebouwen as $gebouw) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-default">';
        echo '<div class = "panel-heading">';
        echo '<h3 class = "panel-title">' . $gebouw->naam . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';        
        echo '<p>' . $gebouw->straat . ' ' . $gebouw->nummer . ' </p>';
        echo '<p>' . $gebouw->postcode . ' ' . $gebouw->gemeente . ' </p>';
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>
  
