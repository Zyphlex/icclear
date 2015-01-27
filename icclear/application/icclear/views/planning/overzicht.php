<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Onderwerp</th>
            <th>Omschrijving</th>
            <th>Begin datum</th>
            <th>Eind datum</th>
            <th>Zaal</th>
            <th>Spreker</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $teller = 1;
        foreach ($sessies as $sessie) {
            echo '<tr>';
            echo '<td>' . $teller . '</td>';
            echo '<td>' . $sessie->onderwerp . '</td>';
            echo '<td>' . $sessie->omschrijving . '</td>';
            echo '<td>' . $sessie->planning->beginUur . '</td>';
            echo '<td>' . $sessie->planning->eindUur . '</td>'; 
            echo '<td>' . $sessie->zaal->naam .'</td>';
            echo '</tr>';
            $teller++;
        }
        ?>                                         
    </tbody>
</table>