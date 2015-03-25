<div class="col-md-10">       
    <h1>Conferentie <?php echo $conferentie ?> beheren</h1>     

    <h4>DASHBOARD<span class="glyphicon glyphicon-th-large"></span></h4>    
    <h5>Naam: <?php echo $conferentie ?></h5>                 
    <?php echo anchor('email/', 'Emails', 'class="btn btn-default"'); ?>
    <?php echo anchor('aankondiging/', 'Aankondigingen', 'class="btn btn-default"'); ?>
    <?php echo anchor('inschrijven/opvolgen', 'Betalingen Opvolgen', 'class="btn btn-default"'); ?>            
</div>
<div class="col-md-10">    
    <h4>Conferentie <span class="glyphicon glyphicon-pushpin"></span></h4>
    <p>Periode: <?php echo $dataConferentie->beginDatum; ?> tot <?php echo $dataConferentie->eindDatum; ?></p>    
    <p>Stad: <?php echo $dataConferentie->stad; ?></p>
    <p>Maximum aantal inschrijvingen: <?php echo $dataConferentie->maxInschrijvingen; ?></p>
    <p>Status: <?php echo $status->status; ?></p>
    <br>
    <h4>Statistieken <span class="glyphicon glyphicon-stats"></span></h4>
    <p>Aantal inschrijvingen: <?php echo $aantalInschrijvingen; ?></p>
    <p>Aantal gekeurde sessies: <?php echo $gekeurdeSessies; ?></p> 
    <p>Aantal ongekeurde sessies: <?php echo $ongekeurdeSessies; ?></p>     
    <p>Aantal activiteiten: <?php echo $activiteiten; ?></p>
</div>