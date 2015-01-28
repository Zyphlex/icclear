<div class='row'>
    <div class='col-md-12'>
        <h1>Programma overzicht</h1>
    </div>
</div>

<div class='row'>
    <div class='col-md-12'>
        <h3>Sessies</h3>
        
        <div class="panel panel-default">
            <div class="panel-body">
        <?php
        $id = 0;
        $counter = 1;
        foreach ($sessies as $dag) {
            if ($dag->conferentiedagId != $id) {
                echo "\n" . '<h4>Dag ' . $counter . '</h4>' . "\n";
                $counter++;
                ?>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Onderwerp</th>
                            <th>Omschrijving</th>
                            <th>Beginuur</th>
                            <th>Einduur</th>
                            <th>Zaal</th>
                            <th>Spreker</th>
                        </tr>
                    </thead>  
                    <tbody>
                        <?php $id = $dag->conferentiedagId;?>                
                        <?php
                        $teller = 1;
                        foreach ($sessies as $sessie) {
                            if ($dag->conferentiedagId == $sessie->conferentiedagId) { ?>
                                <tr>
                                <td><?php echo $teller ?></td>
                                <td><?php echo $sessie->onderwerp ?></td>
                                <td><?php echo $sessie->omschrijving ?></td>
                                <td><?php echo $sessie->planning->beginUur ?></td>
                                <td><?php echo $sessie->planning->eindUur ?></td>
                                <td><?php echo $sessie->zaal->naam ?></td>
                                <td><?php echo $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam ?></td>
                                </tr>
                                <?php $teller++;?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>                        
                <?php
            }
        }
        ?>
            </div>
        </div>

    </div>    
</div>
