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
        foreach ($sessies as $sessie) {
            echo '<tr>';
            echo '<td>' . $sessie->onderwerp . '</td>';
            echo '<td>' . $sessie->omschrijving . '</td>';
            echo '<td>' . $sessie->planning->beginUur . '</td>';
            echo '<td>' . $sessie->planning->eindUur . '</td>'; 
            echo '<td>' . $sessie->zaal->naam .'</td>';
            echo '</tr>';
        }
        ?>
        <tr>
            <td>1</td>
            <td>Social Media</td>
            <td>Berlijn</td>
            <td>2014-12-24</td>
            <td><a href="https://subversion.khk.be/projecten/TI1415project23/icclear/icclear.php/admin/dashboard/2">Beheren</a><a class="btn btn-default">Beheren</a></td>
        </tr>                                  
    </tbody>
</table>