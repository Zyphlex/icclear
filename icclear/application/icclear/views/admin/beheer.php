

    <div class="col-md-10">        
        <h1>Admin dashboard</h1>  
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naam</th>
                                <th>Stad</th>
                                <th>Begin datum</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $teller = 1; foreach($conferenties as $gebruiker) {?>
                            <tr>
                                <td><?php echo $teller ?></td>
                                <td><?php echo $gebruiker->naam ?></td>
                                <td><?php echo $gebruiker->stad ?></td>
                                <td><?php echo toDDMMYYYY($gebruiker->beginDatum) ?></td>
                                <td><?php echo anchor('admin/dashboard/' . $gebruiker->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                            </tr>
                            <?php $teller++; } ?>
                        </tbody>
                    </table>
        
        
        <?php echo anchor('conferentie/toevoegen', 'Nieuwe conferentie toevoegen','class="btn btn-default"'); ?>  
        
        
    </div>
