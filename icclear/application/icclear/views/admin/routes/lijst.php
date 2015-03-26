<script type="text/javascript" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
        
<table class="table table-beheer">
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
                    <button class="wijzigItem btn btn-primary" data-id="<?php echo $route->id ?>">Wijzigen</button>
                    <button class="verwijderItem btn btn-danger" data-id="<?php echo $route->id ?>">Verwijderen</button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>