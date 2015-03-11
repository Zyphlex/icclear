<table class = "table table-beheer">
        <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Land</th>
                <th>Postcode</th>
                <th>Gemeente</th>                    
                <th>Straat</th>                    
                <th>Nummer</th>       
                <th>Beheer</th>
            </tr>
        </thead>  
        <tbody>                              
            <?php
            foreach ($sponsors as $sponsor) {
                if ($sponsor->type == 'Sponsor') {
                    echo '<tr>' . "\n";
                    echo '<td>' . $sponsor->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->land->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->postcode . '</td>' . "\n";
                    echo '<td>' . $sponsor->gemeente . '</td>' . "\n";
                    echo '<td>' . $sponsor->straat . '</td>' . "\n";
                    echo '<td>' . $sponsor->nummer . '</td>' . "\n";?>
        <td>
            <p>
                <button class="wijzigSponsor btn btn-primary" data-id="<?php echo $sponsor->id ?>">Wijzigen</button>
                <button class="verwijderSponsor btn btn-danger" data-id="<?php echo $sponsor->id ?>">Verwijderen</button>
            </p>
        </td>
                    <?php echo '</tr>' . "\n";
                }
            }
            ?>
        </tbody>
    </table>