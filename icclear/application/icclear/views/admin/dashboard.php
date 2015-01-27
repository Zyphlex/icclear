
<div class="col-md-10">       

    <h1>Conferentie <?php echo $conferentie->naam ?> beheren.</h1>     

    <h4>DASHBOARD</h4>
    <h5>ID: <?php echo $conferentie->id ?></h5>
    <h5>NAAM: <?php echo $conferentie->naam ?></h5>                 
    <?php echo anchor('admin/email/', 'Emails', 'class="btn btn-default"'); ?>
    <?php echo anchor('admin/aankondiging', 'Aankondigingen', 'class="btn btn-default"'); ?>
</div>