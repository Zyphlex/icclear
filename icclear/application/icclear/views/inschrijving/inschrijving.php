<?php if ($conferentie->beginDatum <= date('Y-m-d',strtotime('-1 month'))) {  ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="center-block underline">Het inschrijven voor de conferentie is helaas afgelopen!</h1>
    </div>
</div>

<?php } else { ?>

<div class="row">
    <div class="underline col-sm-12">
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
    <div class="col-sm-12">
        <input type="hidden" name="conferentieId" value="<?php $conferentie->id ?>" />

        <h3>Selecteer formule</h3>

        <table class="space-bottom table table-responsive">
            <thead>
            <tr>
                <th class="w50">Formule</th>
                <th class="w15">Prijs</th>
                <th class="w25">Early-bird korting</th>
                <th class="success">Selecteer</th>
            </tr>
            </thead>
            
            <tbody>
            <?php foreach ($conferentieOnderdelen as $conferentieOnderdeel) { ?>
                <?php if ($conferentieOnderdeel->conferentie->statusId == '2') { ?>                    
                <tr>
                    <td> <?php echo $conferentieOnderdeel->omschrijving ?></td>
                    <td>&euro; <?php echo $conferentieOnderdeel->prijs ?></td>
                    <td><?php echo $conferentieOnderdeel->korting ?> &percnt;</td>
                    <td class="success"><input type="radio" name="conferentieOnderdeelId" value="<?php echo $conferentieOnderdeel->id ?>"/></td></tr>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>

        </table>

        <h3>Extra activiteiten</h3>
        <p class="help-block">Activiteiten zijn extra en dus niet verplicht</p>
        <table class="space-bottom table table-responsive">
            <thead>
            <tr>
                <th class="w50">Activiteit</th>
                <th class="w15">Prijs per persoon</th>
                <th class="w35 success">Selecteer</th>
            </tr>
            </thead>
            
            <tbody>
            <?php foreach ($activiteiten as $activiteit) { ?>
                <?php if ($activiteit->conferentie->statusId == '2') { ?>
                    <tr>
                        <td><?php echo $activiteit->naam ?></td>
                        <td>&euro; <?php echo $activiteit->prijs ?></td>
                    
                        <td class="success">
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
            </tbody>

        </table>

        <h3>Betaling</h3>

        <div class="checkbox space-bottom">
            <?php echo form_checkbox(array('id'=>'factuur','name'=>'factuur','value'=>'factuur')) ?>
            <?php echo form_label('Ja, ik wil een factuur ontvangen.','factuur') ?>
        </div>

        <?php foreach ($betaaltypes as $type) { ?>
        
        <p>
            <?php echo form_radio(array('id'=>'methode'.$type->id,'name'=>'methode','value'=>$type->id));?>        
            <?php echo form_label($type->omschrijving, 'methode');?>
        </p>
    
        <p class="radio"><?php echo form_label(form_radio(array('id'=>'methode'.$type->id,'name'=>'methode','value'=>$type->id)) . " " . $type->omschrijving);?></p>
            
            
        <?php } ?>
        
        <input type="radio" name="methode" value="1"/> <label> VISA</label>
        <input type="radio" name="methode" value="2"/> <label> Mastercard</label>
        <input type="radio" name="methode" value="3"/> <label> PayPal</label>
        <input type="radio" name="methode" value="4"/> <label> Overschrijving</label>

        <div class="btn-group">
        <a href="<?php echo base_url(); ?>icclear.php/home" class="btn btn-default">Annuleren</a>

        <?php if ($user == null) { ?>
            <?php echo form_submit('mysubmit', 'Aanmelden en betalen', 'class="btn btn-primary"'); ?>
        <?php } else { ?>
            <?php echo form_submit('mysubmit', 'Inschrijven en betalen', 'class="btn btn-primary"'); ?>
        <?php } ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php } ?>