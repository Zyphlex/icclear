<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-responsive table-beheer">
    <thead>
        <tr>
            <th>Vraag</th>
            <th>Antwoord</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vragen as $vraag) { ?>
            <tr>
                <td><?php echo $vraag->vraag ?></td>
                <td><?php echo $vraag->antwoord ?></td>
                <td>
                    <p>                                        
                        <button data-toggle="tooltip" data-placement="bottom" title="Wijzigen"  class="wijzigFaq glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $vraag->id ?>"></button>
                        <button data-toggle="tooltip" data-placement="bottom" title="Verwijderen" class="verwijderFaq glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $vraag->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      