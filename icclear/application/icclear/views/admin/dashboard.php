
<div class="col-md-10">       

    <h1>Conferentie <?php echo $conferentie ?> beheren</h1>     

    <h4>DASHBOARD</h4>    
    <h5>NAAM: <?php echo $conferentie ?></h5>                 
    <?php echo anchor('email/', 'Emails', 'class="btn btn-default"'); ?>
    <?php echo anchor('aankondiging/', 'Aankondigingen', 'class="btn btn-default"'); ?>
    <?php echo anchor('inschrijven/opvolgen', 'Betalingen Opvolgen', 'class="btn btn-default"'); ?>    
</div>