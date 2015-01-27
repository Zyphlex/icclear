       
        <?php 
        foreach ($sessies as $sessie){
            echo '<p>' . $sessie->omschrijving . '</p>';
            echo '<p>Van ' . $sessie->planning->beginUur . ' tot ' .  $sessie->planning->eindUur . '</p>';            
        }
        ?>
