<div class='row'>
    <div class='col-md-12'>
        <h1>Programma overzicht - <?php echo $actieveId->naam ?></h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Curabitur finibus tortor at erat sodales ornare. 
            Donec eget tellus sit amet purus blandit varius ac a dui. Sed lobortis laoreet eleifend. 
            Morbi tristique velit non tristique ultrices. In posuere libero malesuada porta blandit. 
            Etiam vestibulum, velit nec consequat faucibus, nisi lectus tincidunt mi, in mattis eros mauris lobortis felis. 
            Sed nec tincidunt tortor, ac fermentum sem. 
            Aliquam dignissim, tellus id tincidunt facilisis, massa lectus tincidunt lacus, in pellentesque nulla magna vel neque.
        </p>
    </div>
</div>

<div class='row'>
    <div class='col-md-12'>
        <h3>Sessies</h3>        
        <div class="panel panel-default">
            <div class="panel-body">
        <?php
        $id = 0;
        $counter = 1;
        foreach ($planningen as $dag) {
            if ($dag->conferentiedag->id != $id && $dag->conferentiedag->conferentieId == $actieveId->id)  {
                echo "\n" . '<h4>Dag ' . $counter . '</h4>' . "\n";
                $counter++;
                ?>
                <table class = "table">
                    <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-time"></span> Tijdstip</th>
                            <th><span class="glyphicon glyphicon-paperclip"></span> Onderwerp</th>                                                                                                                
                            <th><span class="glyphicon glyphicon-bullhorn"></span> Spreker</th>
                        </tr>
                    </thead>  
                    <tbody>            
                        <?php $id = $dag->conferentiedag->id; ?>                
                        <?php                        
                        foreach ($planningen as $planning) {
                            if ($dag->conferentiedag->id == $planning->conferentiedag->id && $planning->conferentiedag->conferentieId == $actieveId->id) { ?>
                                <tr>
                                    <td><?php echo $planning->beginUur . ' - ' . $planning->eindUur ?></td>                                    
                                    <td><?php echo $planning->sessie->onderwerp ?></td>                                    
                                    <td><?php echo $planning->spreker->voornaam . ' ' . $planning->spreker->familienaam ?></td>
                                </tr>
                               <?php 
                            }
                        }
                        ?>
                    </tbody>
                </table>   
                <br/>
                <?php
            }
        }
        ?>
            </div>
        </div>
    </div>    
</div>

<div class='row'>
    <div class='col-md-12'>
        <h3>Activiteiten</h3>        
        <div class="panel panel-default">
            <div class="panel-body">                
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>  
                    <tbody>            
                        <?php
                        foreach ($activiteiten as $activiteit) { ?>
                                <tr>
                                    <td><?php echo $activiteit->naam ?></td>
                                    <td><?php echo $activiteit->omschrijving ?></td>
                                    <td><?php echo toKomma($activiteit->prijs) ?> EUR</td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>         
                
            </div>
        </div>

    </div>    
</div>