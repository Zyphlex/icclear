    
<table class="table table-responsive table-beheer">
    <thead>
        <tr>                                
            <th>Vertrekpunt</th>   
            <th>Bestemming</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($routes as $route) { ?>
            <tr>
                <td><?php echo $route->vertrekPunt ?></td>
                <td><?php echo $route->gebouw->naam ?></td>
                <td>
                    <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen" class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $route->id ?>"></button>
                    <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $route->id ?>"></button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>