<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<table class="table table-responsive table-beheer">
    <thead>
        <tr>
            <th>Familienaam</th>
            <th>Voornaam</th>
            <th>Email</th>
            <th>Type</th>
            <th>Beheer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gebruikers as $gebruiker) { ?>
            <tr>
                <td><?php echo $gebruiker->familienaam ?></td>
                <td><?php echo $gebruiker->voornaam ?></td>
                <td><?php echo $gebruiker->emailadres ?></td>
                <?php if ($gebruiker->typeId == 1) { ?>
                    <td>Bezoeker</td>
                <?php } else { ?>
                    <td>Spreker</td>
                <?php } ?>
                <td>
                    <p>                                        
                        <button class="wijzigGebruiker glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $gebruiker->id ?>"></button>
                        <button class="verwijderGebruiker glyphicon glyphicon-trash btn btn-danger" data-id="<?php echo $gebruiker->id ?>"></button> 
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>      