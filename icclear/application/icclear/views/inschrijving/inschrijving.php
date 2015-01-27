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
        
        <p>
            De conferentie vindt plaats van <?php echo toDDMMYYYY($conferentie->beginDatum); ?> tot en met <?php echo toDDMMYYYY($conferentie->eindDatum); ?>.
        </p>
        
        <p>U gaat akkoord met de voorwaarden en prijzen.</p>
        
        <h3>Selecteer formule</h3>
        
        <table class="table">
            <tr>
                <th>Formule</th>
                <th>Prijs</th>
                <th>Early-bird korting</th>
                <td></td>
            </tr>
        <?php
            foreach ($conferentieOnderdelen as $conferentieOnderdeel)
            {
                if ($conferentieOnderdeel->conferentie->statusId == '2')
                {
                    ;echo '<tr><td>' . $conferentieOnderdeel->omschrijving . '</td>';
                    echo '<td>' . $conferentieOnderdeel->prijs . '</td>';
                    echo '<td>' . $conferentieOnderdeel->korting . ' %</td></tr>';
                    echo '<td><input type="radio" name="formule" value="' . $conferentieOnderdeel->id . '"/></td>';
                    
                }
            }
        ?>
            
        </table>
        
        <h3>Extra activiteiten</h3>
        
        <h3>Betaling</h3>
        
        <a href="<?php echo base_url();?>icclear.php/home">Annuleren</a>
        <input type="submit" value="Bevestigen en betalen"/>
    </body>
</html>
