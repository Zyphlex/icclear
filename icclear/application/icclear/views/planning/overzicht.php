<?php
$id = 0;
foreach ($sessies as $dag) {
    if($dag->conferentiedagId != $id){
        echo '<h1>Dag ' . $dag->conferentiedagId  . '</h1>';
    }    
    $id = $dag->conferentiedagId;
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
            <?php                
        $teller = 1;
        foreach ($sessies as $sessie) {
            if($dag->conferentiedagId == $sessie->conferentiedagId){                            
            echo '<tr>';
            echo '<td>' . $teller . '</td>';
            echo '<td>' . $sessie->onderwerp . '</td>';
            echo '<td>' . $sessie->omschrijving . '</td>';
            echo '<td>' . $sessie->planning->beginUur . '</td>';
            echo '<td>' . $sessie->planning->eindUur . '</td>';
            echo '<td>' . $sessie->zaal->naam . '</td>';
            echo '<td>' . $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam . '</td>';
            echo '</tr>';
        $teller++;
        }
        }
        ?>
      </tbody>
    </table>
        <?php
}
?>
