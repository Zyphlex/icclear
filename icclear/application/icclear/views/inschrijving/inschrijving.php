<script type='text/javascript'>      
$(document).ready(function() {
    $(".aantalPersonen").change(function() {
        if ($(this).val().length == 0) {
            $("input[id='aanwezig'][value='" + $(this).attr('name') + "']").prop('checked',false);
        } else {
            $("input[id='aanwezig'][value='" + $(this).attr('name') + "']").prop('checked',true);
        }
    });
    
    $(".aanwezig").change(function() {
        if ($(this).prop('checked') == false) {
            $("input[id='aantalPersonen'][name='" + $(this).attr('value') + "']").prop('required',false);
            $("input[id='aantalPersonen'][name='" + $(this).attr('value') + "']").val('');
        } else {
            $("input[id='aantalPersonen'][name='" + $(this).attr('value') + "']").prop('required',true);
            $("input[id='aantalPersonen'][name='" + $(this).attr('value') + "']").val('1');
        }
    });
});
</script>


<?php if ($conferentie->beginDatum <= date('Y-m-d',strtotime('-1 month'))) {  ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="center-block underline">Het inschrijven voor de conferentie is helaas afgelopen!</h1>
    </div>
</div>

<?php } else { ?>

<div class="row">
    <div class="underline-full col-sm-12">
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

        <div class=" table-responsive">
        <table class="space-bottom table">
            <thead>
            <tr>
                <th class="w50">Formule</th>
                <th class="w15">Prijs</th>
                <th class="w25">Early-bird korting</th>
                <th class="success">Selecteer</th>
            </tr>
            </thead>
            
            <tbody>
            <?php foreach ($onderdelen as $ond) { ?>                   
                <tr>
                    <td><?php echo $ond->omschrijving ?></td>
                    <td>&euro; <?php echo $ond->prijs ?></td>
                    <td><?php echo $ond->korting ?> &percnt;</td>
                    <td class="success">
                        <?php echo form_radio(array('required'=>'required','id'=>'conferentieOnderdeelId'.$ond->id,'name'=>'conferentieOnderdeelId','value'=>$ond->id))?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
        </div>

        <h3>Extra activiteiten</h3>
        <p class="help-block">Activiteiten zijn extra en dus niet verplicht</p>
        <div class=" table-responsive">
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
                                    <?php echo form_input(array('class' => 'aanwezig checkact', 'type' => 'checkbox', 'name' => 'aanwezig[]', 'id' => 'aanwezig', 'value' => $activiteit->id)); ?>
                                </span>
                                <?php echo form_input(array('type' => 'number', 'class' => 'aantalPersonen form-control', 'name' => $activiteit->id, 'id' => 'aantalPersonen', 'placeholder' => 'Aantal personen', 'max' => '10','min'=>'0')) ?>
                            </div>                    
                        </td>
                    </tr>
                <?php }
            }
            ?>
            </tbody>

        </table>
        </div>

        <h3>Betaling</h3>

        <div class="checkbox space-bottom">
            <?php echo form_checkbox(array('id'=>'factuur','name'=>'factuur','value'=>'factuur')) ?>
            <?php echo form_label('Ja, ik wil een factuur ontvangen.','factuur') ?>
        </div>

        <?php foreach ($betaaltypes as $type) { ?>    
            <div class="radio"><?php echo form_label(form_radio(array('required'=>'required','id'=>'methode'.$type->id,'name'=>'methode','value'=>$type->id)) . " " . $type->omschrijving);?></div>   
        <?php } ?>
        <div id="overschr"></div>

        <div class="col-sm-12 btn-group">
            <a href="<?php echo base_url(); ?>icclear.php/home/" class="col-sm-3 btn btn-default">Annuleren</a>
            <?php if ($user == null) { ?>
                <?php echo form_submit('mysubmit', 'Aanmelden en betalen', 'class="col-sm-6 btn btn-primary"'); ?>
            <?php } else { ?>
                <?php echo form_submit('mysubmit', 'Inschrijven en betalen', 'class="col-sm-6 btn btn-primary"'); ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php } ?>