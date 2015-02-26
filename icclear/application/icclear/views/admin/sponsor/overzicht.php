<div class="col-md-10">
    <p>
        <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>     
        <?php echo anchor('sponsor/toevoegen', 'Nieuwe sponsor of partner', 'class="btn btn-default"'); ?>
    </p>

    <h1>Sponsors</h1>

    <table class = "table">
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
            $teller = 1;
            foreach ($sponsors as $sponsor) {
                if ($sponsor->type == 'Sponsor') {
                    echo '<tr>' . "\n";
                    echo '<td>' . $teller . '</td>' . "\n";
                    echo '<td>' . $sponsor->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->land->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->postcode . '</td>' . "\n";
                    echo '<td>' . $sponsor->gemeente . '</td>' . "\n";
                    echo '<td>' . $sponsor->straat . '</td>' . "\n";
                    echo '<td>' . $sponsor->nummer . '</td>' . "\n";
                    echo '<td>' . anchor('sponsor/wijzigen/' . $sponsor->id, 'Wijzigen', 'class="btn btn-default"') . ' ' . anchor('sponsor/verwijderen/' . $sponsor->id, 'Verwijderen', 'class="btn btn-default"') . ' </td> ';
                    echo '</tr>' . "\n";
                    $teller++;
                }
            }
            ?>
        </tbody>
    </table>
    
    <h1>Partners</h1>

    <table class = "table">
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
            $teller = 1;
            foreach ($sponsors as $sponsor) {
                if ($sponsor->type == 'Partner') {
                    echo '<tr>' . "\n";
                    echo '<td>' . $teller . '</td>' . "\n";
                    echo '<td>' . $sponsor->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->land->naam . '</td>' . "\n";
                    echo '<td>' . $sponsor->postcode . '</td>' . "\n";
                    echo '<td>' . $sponsor->gemeente . '</td>' . "\n";
                    echo '<td>' . $sponsor->straat . '</td>' . "\n";
                    echo '<td>' . $sponsor->nummer . '</td>' . "\n";
                    echo '<td>' . anchor('sponsor/wijzigen/' . $sponsor->id, 'Wijzigen', 'class="btn btn-default"') . ' ' . anchor('sponsor/verwijderen/' . $sponsor->id, 'Verwijderen', 'class="btn btn-default"') . ' </td> ';
                    echo '</tr>' . "\n";
                    $teller++;
                }
            }
            ?>
        </tbody>
    </table>

</div>

