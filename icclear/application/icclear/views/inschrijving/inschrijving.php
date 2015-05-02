<div class="row">
    <div class="col-md-12">
        <h1>Inschrijven conferentie</h1>

        <p>Door dit formulier in te vullen schrijft u zichzelf in voor de volgende conferentie en de geselecteerde opties.</p>
        <p> 
            De conferentie vindt plaats van <span class="bold"><?php echo toDDMMYYYY($conferentie->beginDatum); ?></span>
            tot en met <span class="bold"><?php echo toDDMMYYYY($conferentie->eindDatum); ?></span>.
        </p>
        <p>U gaat akkoord met de voorwaarden en prijzen.</p>
    </div>
</div>

<?php
$attributes = array('name' => 'myform');
        if ($user == null) {
            echo form_open('inschrijven/aanmeldenEnVerzenden', $attributes);
        } else {
            echo form_open('inschrijven/verzenden', $attributes);
        }
?>        

<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="conferentieId" value="<?php $conferentie->id ?>" />

        <h3>Selecteer formule</h3>

        <table class="table table-responsive">
            <tr>
                <th class="w50">Formule</th>
                <th class="w15">Prijs</th>
                <th class="w25">Early-bird korting</th>
                <td></td>
            </tr>
            
            <?php foreach ($conferentieOnderdelen as $conferentieOnderdeel) { ?>
                <?php if ($conferentieOnderdeel->conferentie->statusId == '2') { ?>                    
                <tr>
                    <td> <?php echo $conferentieOnderdeel->omschrijving ?></td>
                    <td> <?php echo $conferentieOnderdeel->prijs ?></td>
                    <td> <?php echo $conferentieOnderdeel->korting ?></td>
                    <td><input type="radio" name="conferentieOnderdeelId" value="<?php echo $conferentieOnderdeel->id ?>"/></td></tr>
                </tr>
                <?php } ?>
            <?php } ?>

        </table>

        <h3>Extra activiteiten</h3>
        <table class="table table-responsive">
            <tr>
                <th class="w50">Activiteit</th>
                <th class="w15">Prijs per persoon</th>
                <th>Aantal Personen (max. 10)</th>
            </tr>
            <?php foreach ($activiteiten as $activiteit) { ?>
                <?php if ($activiteit->conferentie->statusId == '2') { ?>
                    <tr>
                        <td><?php echo $activiteit->naam ?></td>
                        <td>&euro; <?php echo $activiteit->prijs ?></td>
                    
                        <td>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo form_input(array('class' => 'checkact', 'type' => 'checkbox', 'name' => 'aanwezig[]', 'id' => 'aanwezig' . $activiteit->id, 'value' => $activiteit->id)); ?>
                                </span>
                                <?php echo form_input(array('type' => 'number', 'class' => 'form-control', 'name' => $activiteit->id, 'id' => 'aantalPersonen', 'placeholder' => 'Aantal personen', 'max' => '10')) ?>
                            </div>                    
                        </td>
                    </tr>
                <?php }
            }
            ?>

        </table>

        <h3>Betaling</h3>

        <input type="checkbox" name="factuur" id="factuur"/>
        <label> Ja, ik wil een factuur ontvangen.</label>

        <br/>
        <br/>

        <input type="radio" name="methode" value="1"/> <label> VISA</label><br/>
        <input type="radio" name="methode" value="2"/> <label> Mastercard</label><br/>
        <input type="radio" name="methode" value="3"/> <label> PayPal</label><br/>
        <input type="radio" name="methode" value="4"/> <label> Overschrijving</label><br/>
        <br/>

        <input type="hidden" name="datum" value="<?php date("Y-m-d") ?>" />

        <a href="<?php echo base_url(); ?>icclear.php/home" class="btn btn-default">Annuleren</a>

        <?php if ($user == null) { ?>
            <input type="submit" value="Aanmelden en betalen" class="btn btn-primary"/>
        <?php } else { ?>
            <input type="submit" value="Inschrijven en betalen" class="btn btn-primary"/>
        <?php } ?>
    </div>
</div>
<?php echo form_close(); ?>