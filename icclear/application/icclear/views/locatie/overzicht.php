
<h2>Conferentiegebouwen</h2>
<div class="row">  
    <?php
    foreach ($gebouwen as $gebouw) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-default">';
        echo '<div class = "panel-heading">';
        echo '</div>';
        echo '<div class="panel-body">';        
        echo '<p>' . $gebouw->zaal->naam . ' ' . '</p>';
        echo '<p>' . $gebouw->onderwerp . '</p>';
        echo '<p>' . $gebouw->gebouw->naam . '</p>';
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>
  
