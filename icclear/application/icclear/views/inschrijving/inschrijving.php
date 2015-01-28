<?php
$attributes = array('name' => 'myform');
echo form_open('inschrijven/inschrijven', $attributes);
?>        
<div class="row">
    <div class="col-md-12">
        <h1>Inschrijven conferentie</h1>

        <?php if ($user == null) { ?>            
            <div class="alert alert-danger" role="alert">Opgelet! U moet aangemeld zijn om dit formulier in te dienen.</div>
        <?php } ?>

        <p>Door dit formulier in te vullen schrijft u zichzelf in voor de volgende conferentie en de geselecteerde opties.</p>
        <p> 
            De conferentie vindt plaats van <span class="bold"><?php echo toDDMMYYYY($conferentie->beginDatum); ?></span>
            tot en met <span class="bold"><?php echo toDDMMYYYY($conferentie->eindDatum); ?></span>.
        </p>
        <p>U gaat akkoord met de voorwaarden en prijzen.</p>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <form action="inschrijven">
        <h3>Selecteer formule</h3>

        <table class="table">
            <tr>
                <th>Formule</th>
                <th>Prijs</th>
                <th>Early-bird korting</th>
                <td></td>
            </tr>
            <?php
            foreach ($conferentieOnderdelen as $conferentieOnderdeel) {
                if ($conferentieOnderdeel->conferentie->statusId == '2') {
                    echo '<tr><td>' . $conferentieOnderdeel->omschrijving . '</td>';
                    echo '<td>' . $conferentieOnderdeel->prijs . '</td>';
                    echo '<td>' . $conferentieOnderdeel->korting . ' %</td>';
                    echo '<td><input type="radio" name="formule" value="' . $conferentieOnderdeel->id . '"/></td></tr>';
                }
            }
            ?>

        </table>

        <h3>Extra activiteiten</h3>

        <table class="table">
            <tr>
                <th>Activiteit</th>
                <th>Prijs per persoon</th>
                <th></th>
                <th>Aantal Personen (max. 10)</th>
            </tr>
            <?php
            foreach ($activiteiten as $activiteit) {
                if ($activiteit->conferentie->statusId == '2') {
                    echo '<tr><td>' . $activiteit->naam . '</td>';
                    echo '<td>' . $activiteit->prijs . '</td>';
                    ?>
                    <td><input type="checkbox" name="aanwezig<?php echo $activiteit->id; ?>" id="aanwezig<?php echo $activiteit->id; ?>" value ="<?php echo $activiteit->id; ?>"/></td>
                    <td><input type="number" name="aantalPersonen" id="aantalPersonen" max="10"/></td>
                    <?php
                }
            }
            ?>

        </table>

        <h3>Betaling</h3>

        <input type="checkbox" name="factuur" id="factuur"/>
        <label>Ja, ik wil een factuur ontvangen.</label>

        <br/>
        <br/>

        <input type="radio" name="methode" value="VISA"/><label>VISA</label><br/>
        <input type="radio" name="methode" value="Mastercard"/><label>Mastercard</label><br/>
        <input type="radio" name="methode" value="PayPal"/><label>PayPal</label><br/>
        <input type="radio" name="methode" value="Overschrijving"/><label>Overschrijving</label><br/>

        <a href="<?php echo base_url(); ?>icclear.php/home" class="btn btn-default">Annuleren</a>

        <?php if ($user == null) { ?>
            <input type="button" value="Bevestigen en betalen" class="btn btn-default disabled"/>
        <?php } else { ?>
            <input type="submit" value="Bevestigen en betalen" class="btn btn-default"/>
        <?php } ?>
        </form>
    </div>
</div>
