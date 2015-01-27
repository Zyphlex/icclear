<?php
$id = 0;
foreach ($sessies as $dag) {
    if($dag->conferentiedagId != $id){
        echo "\n" . '<h1>Dag ' . $dag->conferentiedagId  . '</h1>' . "\n";
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
        
    $id = $dag->conferentiedagId;
    ?>                
            <?php                
        $teller = 1;
        foreach ($sessies as $sessie) {
            if($dag->conferentiedagId == $sessie->conferentiedagId){                            
            echo '<tr>' . "\n";
            echo '<td>' . $teller . '</td>'. "\n";
            echo '<td>' . $sessie->onderwerp . '</td>'. "\n";
            echo '<td>' . $sessie->omschrijving . '</td>'. "\n";
            echo '<td>' . $sessie->planning->beginUur . '</td>'. "\n";
            echo '<td>' . $sessie->planning->eindUur . '</td>'. "\n";
            echo '<td>' . $sessie->zaal->naam . '</td>'. "\n";
            echo '<td>' . $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam . '</td>'. "\n";
            echo '</tr>';
        $teller++;
        }        
        }}
        ?> 
        </tbody>
     
        <?php
}
?>

</table>  