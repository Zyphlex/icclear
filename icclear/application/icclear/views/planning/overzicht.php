<div class='row'>
    <div class='col-md-12'>
        <h1>Programma overzicht - <?php echo $conferentie->naam ?></h1>
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
            if ($dag->conferentiedag->id != $id)  {
                echo "\n" . '<h4>Dag ' . $counter . '</h4>' . "\n";
                $counter++;
                ?>
                <table class = "table">
                    <thead>
                        <tr>
                            <th style="width:25px;">Tijdstip</th>
                            <th>Onderwerp</th>
                            <th>Omschrijving</th>                                                                                    
<!--                            <th><span class="glyphicon glyphicon-user"></span>Spreker</th>-->
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
                                    <td><?php echo $planning->sessie->omschrijving ?></td>                                                                        
<!--                                    <td><?php echo $sessie->spreker->voornaam . ' ' . $sessie->spreker->familienaam ?></td>-->
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
                            <th>#</th>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>  
                    <tbody>            
                        <?php
                        $teller = 1;
                        foreach ($activiteiten as $activiteit) { ?>
                                <tr>
                                    <td><?php echo $teller ?></td>
                                    <td><?php echo $activiteit->naam ?></td>
                                    <td><?php echo $activiteit->omschrijving ?></td>
                                    <td><?php echo toKomma($activiteit->prijs) ?> EUR</td>
                                </tr>
                                <?php $teller++;?>
                        <?php } ?>
                    </tbody>
                </table>         
                
            </div>
        </div>

    </div>    
</div>