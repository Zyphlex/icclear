<div class="row">
    <div class="col-md-12">
        <h1>Conferentie - <?php echo $conferentie->naam ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h2>Profielfoto en biografie</h2>
    </div> 
</div>

<div class="row">
    <div class="col-md-8">
        <label>Foto: </label>
        <input type="file" name="foto" size="20" />

        <br /><br />

        <input type="submit" value="Uploaden" class="btn btn-default" />
    </div>
    
    <div class="col-md-4">
        <label>Biografie: </label>
        <textarea name="biografie" rows="5"></textarea>
    </div>
</div>