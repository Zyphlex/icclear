<div class="col-md-10">       
    <h1>Conferentie <?php echo $conferentie->naam ?> beheren</h1>         
    <?php echo anchor('email/', 'Emails', 'class="btn btn-default"'); ?>          
</div>
<div class="col-md-10">    
    <h4>Conferentie <span class="glyphicon glyphicon-pushpin"></span></h4>
    <h5>Naam: <?php echo $conferentie->naam ?></h5>
    <p>Periode: <?php echo $conferentie->beginDatum; ?> tot <?php echo $conferentie->eindDatum; ?></p>    
    <p>Stad: <?php echo $conferentie->stad; ?></p>
    <p>Maximum aantal inschrijvingen: <?php echo $conferentie->maxInschrijvingen; ?></p>
    <p>Status: <?php echo $status->status; ?></p>
    <br>
    <h4>Statistieken <span class="glyphicon glyphicon-stats"></span></h4>
    <p>Aantal inschrijvingen: <?php echo $aantalInschrijvingen; ?></p>
    <p>Aantal gekeurde sessies: <?php echo $gekeurdeSessies; ?></p> 
    <p>Aantal ongekeurde sessies: <?php echo $ongekeurdeSessies; ?></p>     
    <p>Aantal activiteiten: <?php echo $activiteiten; ?></p>
</div>