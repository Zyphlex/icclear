<div class="col-md-10">
        
        <h1>FAQ beheren</h1>  
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vraag</th>
                                <th>Antwoord</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vragen as $vraag) {?>
                            <tr>
                                <td><?php echo $vraag->vraag ?></td>
                                <td><?php echo $vraag->antwoord ?></td>
                                <td>
                                    <p>                                        
                                        <?php echo anchor('faqbeheer/wijzig/' . $vraag->id, 'Wijzig','class="btn btn-default"'); ?>
                                        <?php echo anchor('faqbeheer/verwijder/' . $vraag->id, 'Verwijder','class="btn btn-default"'); ?>   
                                    </p>                                 
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
        
        <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>
        <?php echo anchor('faqbeheer/toevoegen/', 'Nieuwe FAQ toevoegen','class="btn btn-default"'); ?> 
        
    </div>
