<table class="table">
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
                        <?php echo anchor('Wijzig', 'class="wijzigFag btn btn-default"', 'data-toggle="modal"', 'data-target="#"', 'data-id="' . $vraag->id . '"'); ?>
                        <?php echo anchor('faqbeheer/verwijder/' . $vraag->id, 'Verwijder', 'class="btn btn-default"'); ?>   
                    </p>                                 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>