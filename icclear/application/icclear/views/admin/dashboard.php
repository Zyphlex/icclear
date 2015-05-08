<div class="col-sm-10">       
    <h1>Conferentie <?php echo $conferentie->naam ?> beheren</h1>         
    
    <p>
        <?php if ($conferentie->statusId == 1) { ?>
                  <button class="btn btn-primary disabled col-xs-8" disabled>Deze conferentie is al afgelopen</button>
            <?php } else if ($actieveconf->id != $conferentie->id) {
                  echo anchor('admin/wijzigStatus', 'Deze conferentie actief maken', 'class="btn btn-warning col-xs-8"'); 
                  } else { ?>
                  <button class="btn btn-primary disabled col-xs-8" disabled>Deze conferentie is al actief</button>
            <?php }
        ?>
    </p>
    
    <p>
    <div class="btn-group btn-block margin-top">
        <?php if ($conferentie->isPlanningZichtbaar == 1) { ?>
            <button class="btn btn-primary disabled col-sm-4" disabled>Het programma is al zichtbaar</button>
            <?php echo anchor('admin/toonProgramma/0', 'Het programma verbergen', 'class="btn btn-warning col-sm-4"'); ?>
        <?php } else {
            echo anchor('admin/toonProgramma/1', 'Het programma zichtbaar maken', 'class="btn btn-warning col-sm-4"');
            ?>
            <button class="btn btn-primary disabled col-sm-4" disabled>Het programma is verborgen</button>
        <?php } ?>
    </div>
    </p>    
</div>

<div class="col-sm-10">    
    <h4><span class="glyphicon glyphicon-pushpin"></span> Conferentie </h4>
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

<div class="row">
    
    <div class="col-sm-6">
        <div class="equalizer panel panel-primary text-center">
            <div class="panel-heading">
                <h2 class="panel-title bold"><span class="pull-left white glyphicon glyphicon-stats"></span>Aantal inschrijvingen</h2>
            </div>
            <div class="panel-body">
                <h1 class="bold"><?php echo anchor('inschrijvenbeheer/opvolgen',$aantalInschrijvingen); ?></h1> <span class="italic inline">inschrijvingen</span>
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-6">
        <div class="equalizer panel panel-primary text-center">
            <div class="panel-heading">
                <h2 class="panel-title bold"><span class="pull-left white glyphicon glyphicon-stats"></span>Aantal sessies</h2>
            </div>
            <div class="panel-body">
                <h1 class="bold"><?php echo anchor('sessies',$gekeurdeSessies); ?></h1><span class="italic inline">sessies</span> 
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-4">
        <div class="equalizer panel panel-primary text-center">
            <div class="panel-heading">
                <h2 class="panel-title bold"><span class="pull-left white glyphicon glyphicon-stats"></span>Aantal ongekeurde sessies</h2>
            </div>
            <div class="panel-body">
                <h1 class="bold"><?php echo anchor('sessies/keuren',$ongekeurdeSessies); ?></h1> <span class="italic inline">nog te keuren</span>
            </div>
        </div>
    </div>
    

    <div class="col-sm-4">
        <div class="equalizer panel panel-primary text-center">
            <div class="panel-heading">
                <h2 class="panel-title bold"><span class="pull-left white glyphicon glyphicon-stats"></span>Aantal sprekers</h2>
            </div>
            <div class="panel-body stats">
                <h1 class="bold"><?php echo count($sprekers); ?></h1> <span class="italic inline">met ingeplande sessie</span>
            </div>
        </div>
    </div>
    

    <div class="col-sm-4">
        <div class="equalizer panel panel-primary text-center">
            <div class="panel-heading">
                <h2 class="panel-title bold"><span class="pull-left white glyphicon glyphicon-stats"></span>Aantal Activiteiten</h2>
            </div>
            <div class="panel-body stats">
                <h1 class="bold"><?php echo $activiteiten; ?></h1> <span class="italic inline">activiteien</span>
            </div>
        </div>
    </div>
</div>
