<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Gebruiker Verwijderen</h4>
                </div>
            
                <div class="modal-body">
                    <p>Deze gebruiker wordt verwijderd.</p>
                    <p>Ben je zeker?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleer</button>
                    <a href="#" class="btn btn-danger danger">Verwijder</a>
                </div>
            </div>
        </div>
    </div>

    <a data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete" href="#">Delete record #23</a><br>
    <a data-href="delete.php?id=54" data-toggle="modal" data-target="#confirm-delete" href="#">Delete record #54</a>


    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
        })
    </script>

<div class="col-md-10">

    <h1>Gebruikers beheren</h1>  
    <table class="table">
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

                    <td><?php echo anchor('gebruiker/wijzig/' . $gebruiker->id, 'Wijzigen', 'class="btn btn-default"'); ?>
                        <?php echo anchor('gebruiker/verwijder/' . $gebruiker->id, 'Verwijderen', 'class="btn btn-default"', 'data-toggle="modal"', 'data-target="#confirm-delete"'); ?></td>
                
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?> 
    <?php echo anchor('gebruiker/nieuw', 'Nieuwe gebruiker toevoegen', 'class="btn btn-default"'); ?> 

</div>
