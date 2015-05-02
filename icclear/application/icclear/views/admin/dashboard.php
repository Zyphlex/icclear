<div class="col-sm-10">       
    <h1>Conferentie <?php echo $conferentie->naam ?> beheren</h1>         
    
    <p>
        <?php if ($conferentie->statusId == 1) { ?>
                  <button disabled>Deze conferentie is al afgelopen</button>
            <?php } else if ($actieveconf->id != $conferentie->id) {
                  echo anchor('admin/wijzigStatus', 'Deze conferentie actief maken', 'class="btn btn-warning col-xs-6"'); 
                  } else { ?>
                  <button disabled>Deze conferentie is al actief</button>
            <?php }
        ?>
        
        <p class="help-block">Als u dit doet, wordt de vorige actieve conferentie veranderd in <span class="italic">"afgelopen"</span></p>
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