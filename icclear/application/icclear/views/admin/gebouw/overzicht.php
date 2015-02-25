<div class="col-md-10">               
        <table class = "table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Postcode</th>
                    <th>Gemeente</th>                    
                    <th>Straat</th>                    
                    <th>Nummer</th>                    
                </tr>
            </thead>  
            <tbody>                              
                <?php
                $teller = 1;
                foreach ($gebouwen as $gebouw) {                    
                        echo '<tr>' . "\n";
                        echo '<td>' . $teller . '</td>' . "\n";
                        echo '<td>' . $gebouw->naam . '</td>' . "\n";
                        echo '<td>' . $gebouw->postcode . '</td>' . "\n";                                                                      
                        echo '<td>' . $gebouw->gemeente . '</td>' . "\n";
                        echo '<td>' . $gebouw->straat . '</td>' . "\n";
                        echo '<td>' . $gebouw->nummer . '</td>' . "\n";
                        echo '</tr>' . "\n";
                        $teller++;                    
                }
                ?>
            </tbody>
        </table>
    <p>
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>     
        <?php echo anchor('gebouw/toevoegen', 'Nieuw gebouw', 'class="btn btn-default"'); ?>
    </p>
</div>

