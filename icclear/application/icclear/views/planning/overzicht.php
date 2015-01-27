<?php
foreach ($sessies as $sessie) {
    echo '<h1>Dag ' . $sessie->conferentiedagId. '</h1>';
    echo '<table class = "table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>Onderwerp</th>';
    echo '<th>Omschrijving</th>';
    echo '<th>Beginuur</th>';
    echo '<th>Einduur</th>';
    echo '<th>Zaal</th>';
    echo '<th>Spreker</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $teller = 1;
    foreach ($sessies as $sessie) {
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
echo '</tbody>';
echo '</table>';
}
?>
