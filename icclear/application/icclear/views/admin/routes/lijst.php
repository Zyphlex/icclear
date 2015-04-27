<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
    
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
                    <button class="wijzigItem glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $route->id ?>"></button>
                    <button class="verwijderItem glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $route->id ?>"></button>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>