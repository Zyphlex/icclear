
    <div class="col-md-10">       
        
        <h1>Conferentie <?php echo $conferentie->naam ?> beheren.</h1>     
        
        <h4>DASHBOARD</h4>
        <?php echo $conferentie->id ?>
        <?php echo $conferentie->naam ?>
        
        <form action="">
            <input type="button" value="Emails" class="btn btn-default"/>
            <input type="button" value="Aankondigingen" class="btn btn-default"/>
        </form>
    </div>