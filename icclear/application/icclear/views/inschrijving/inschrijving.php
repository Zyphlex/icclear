<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php
        $attributes = array('name' => 'myform');
        echo form_open('inschrijven/inschrijven', $attributes);
        ?>        
        
        <h1>Inschrijven conferentie</h1>
        <p>Door dit formulier in te vullen schrijft u zichzelf in voor de volgende conferentie en de geselecteerde opties.</p>
        <p>U gaat akkoord met de voorwaarden en prijzen.</p>
        
        <h3>Selecteer formule</h3>
        
        <h3>Extra activiteiten</h3>
        
        <h3>Betaling</h3>
        
        <a href="<?php echo base_url() . APPPATH;?>/home">Annuleren</a>
        <input type="submit" value="Bevestigen en betalen"/>
    </body>
</html>
