<h2>Sponsors</h2>
<table class = "table table-beheer">
    <thead>
        <tr>
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
                ?>
                <tr>
                    <td> <?php echo $sponsor->naam; ?></td>
                    <td> <?php echo $sponsor->land->naam; ?> </td>
                    <td> <?php echo $sponsor->postcode; ?> </td>
                    <td> <?php echo $sponsor->gemeente; ?> </td>
                    <td> <?php echo $sponsor->straat; ?> </td>
                    <td> <?php echo $sponsor->nummer; ?> </td>
                    <td>
                        <p>
                            <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigSponsor glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $sponsor->id ?>"></button>
                            <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderSponsor glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $sponsor->id ?>"></button>
                        </p>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<h2>Partners</h2>
<table class = "table table-beheer">
    <thead>
        <tr>
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
            if ($sponsor->type == 'Partner') {
                ?>
                <tr>
                    <td> <?php echo $sponsor->naam; ?></td>
                    <td> <?php echo $sponsor->land->naam; ?> </td>
                    <td> <?php echo $sponsor->postcode; ?> </td>
                    <td> <?php echo $sponsor->gemeente; ?> </td>
                    <td> <?php echo $sponsor->straat; ?> </td>
                    <td> <?php echo $sponsor->nummer; ?> </td>
                    <td>
                        <p>
                            <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigSponsor glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $sponsor->id ?>"></button>
                            <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderSponsor glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $sponsor->id ?>"></button>
                        </p>
                    </td>
                </tr>
                <?php
            }
    }
    ?>
</tbody>
</table>