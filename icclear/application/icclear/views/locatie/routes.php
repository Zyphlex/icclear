
<h2>Routes</h2>
<div class="row">  
    <?php
    foreach ($routes as $route) {
        echo '<div class="col-md-6">';
        echo '<div class="panel panel-default">';
        echo '<div class = "panel-heading">';
        echo '<h3 class = "panel-title">' . $route->vertrekPunt . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<p>' . $route->beschrijving . ' </p>';        
        echo '</div>';
        echo '</div>  ';
        echo '</div>';
    }
    ?>
</div>