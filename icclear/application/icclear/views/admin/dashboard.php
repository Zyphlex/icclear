<div class="col-sm-10">       
    <h1>Conferentie <?php echo $conferentie->naam ?> beheren</h1>         
    
    
    <p>
        <?php
        $attributes = array('name' => 'myform');
        if ($user == null) {
            echo form_open('', $attributes);
        }
        ?>        

        <?php echo form_label('Status van conferentie:', 'status') ?>

        <?php
        $options = array();
        foreach ($statussen as $s) {
            $options[$s->id] = $s->status;
        }
        ?>
    <?php echo form_dropdown('status', $options, $status->id, 'id="status" class="form-control"'); ?></p>

    <?php echo form_submit('mysubmit', 'Status opslaan', 'class="btn btn-primary"'); ?>
    <?php echo form_close(); ?>
    </p>
    
</div>
<div class="col-sm-10">    
    <h4><span class="glyphicon glyphicon-pushpin"></span>Conferentie </h4>
    <h5>Naam: <?php echo $conferentie->naam ?></h5>
    <p>Periode: <?php echo $conferentie->beginDatum; ?> tot <?php echo $conferentie->eindDatum; ?></p>    
    <p>Stad: <?php echo $conferentie->stad; ?></p>
    <p>Maximum aantal inschrijvingen: <?php echo $conferentie->maxInschrijvingen; ?></p>
    <p>Status: <?php echo $status->status; ?></p>
    <br>
    <h4><span class="glyphicon glyphicon-stats"></span> Statistieken </h4>
    <p>Aantal inschrijvingen: <?php echo $aantalInschrijvingen; ?></p>
    <p>Aantal sessies: <?php echo $gekeurdeSessies; ?></p> 
    <p>Aantal ongekeurde sessies: <?php echo $ongekeurdeSessies; ?></p>     
    <p>Aantal activiteiten: <?php echo $activiteiten; ?></p>
</div>