<img src="https://media.licdn.com/mpr/mpr/shrink_200_200/p/1/000/08f/3a5/1fde5b0.jpg"/>
<table class="table">
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
            echo '<tr>';
            echo '<td>' . $teller . '</td>';
            echo '<td>' . $sessie->onderwerp . '</td>';
            echo '<td>' . $sessie->omschrijving . '</td>';
            echo '<td>' . $sessie->planning->beginUur . '</td>';
            echo '<td>' . $sessie->planning->eindUur . '</td>'; 
            echo '<td>' . $sessie->zaal->naam .'</td>';
            echo '<td>' . $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam  .'</td>';
            echo '</tr>';
            $teller++;
        }
        ?>                                         
    </tbody>
</table>