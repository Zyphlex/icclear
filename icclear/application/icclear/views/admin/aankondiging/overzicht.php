<div class="col-md-10">               
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
                        echo '<td>' . $aankondiging->poster->voornaam . ' ' . $aankondiging->poster->familienaam . '</td>' . "\n";
                        echo '</tr>' . "\n";
                        $teller++;                    
                }
                ?>
            </tbody>
        </table>
    <p>
        <?php echo anchor('aankondiging/toevoegen', 'Nieuwe aankondiging', 'class="btn btn-default"'); ?>
    </p>
</div>

