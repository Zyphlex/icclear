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
    </body>
</html>
