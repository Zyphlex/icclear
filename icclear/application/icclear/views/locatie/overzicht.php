<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Conferentiegebouwen</h2>
        <div class="row">  
            <?php
            foreach ($gebouwen as $gebouw) {
                echo '<div class="col-md-6">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-body">';
                echo '<h4>' . $gebouw->naam . ' </h4>';
                echo '   <p>Extra text</p> ';
                echo '</div>';
                echo '</div>  ';
                echo '</div>';
            }
            ?>
        </div>
        <h2>Routes</h2>
        <div class="row">  
            <?php
            foreach ($routes as $route) {
                echo '<div class="col-md-6">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-body">';
                echo '<h4>' . $route->beschrijving . ' </h4>';
                echo '   <p>Extra text</p> ';
                echo '</div>';
                echo '</div>  ';
                echo '</div>';
            }
            ?>
        </div>  
    </body>
</html>
