       
        <?php 
        foreach ($sessies as $sessie){
            echo '<p>Van ' . $sessie->planning->beginUur . ' tot ' .  $sessie->planning->eindUur . '</p>';
            echo '<p>' . $sessie->omschrijving . '</p>';
        }
        ?>
