<div class="col-md-10">
    <?php
    echo "ID: $conferentieId";    
        ?>            
        <table class = "table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titel</th>
                    <th>Inhoud</th>
                    <th>Gepost door</th>                    
                </tr>
            </thead>  
            <tbody>                              
                <?php
                $teller = 1;
                foreach ($aankondigingen as $aankondiging) {                    
                        echo '<tr>' . "\n";
                        echo '<td>' . $teller . '</td>' . "\n";
                        echo '<td>' . $aankondiging->titel . '</td>' . "\n";
                        echo '<td>' . $aankondiging->inhoud . '</td>' . "\n";
                        echo '<td>' . $aankondiging->gepostDoor . '</td>' . "\n";                                                
                        echo '<td>' . $aankondiging->poster->voornaam . ' ' . $aankondiging->poster->familienaam . '</td>' . "\n";
                        echo '</tr>' . "\n";
                        $teller++;                    
                }
                ?>
            </tbody>
        </table>                   
</div>

