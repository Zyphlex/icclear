

<div class="col-md-10">
    
    <h1>Hotels beheren</h1>      

                <table class="table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Gemeente</th>
                            <th>Beheer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hotels as $hotel) { ?>
                            <tr>
                                <td><?php echo $hotel->naam ?></td>
                                <td><?php echo $hotel->gemeente ?></td>
                                <td>
                                    <?php echo anchor('hotels', 'Wijzigen','class="btn btn-default"'); ?>
                                    <?php echo anchor('hotels', 'Verwijderen','class="btn btn-default"'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
    
    <?php echo anchor('admin', 'Annuleren','class="btn btn-default"'); ?>      
    <?php echo anchor('hotels', 'Nieuwe gebruiker toevoegen','class="btn btn-default"'); ?>                      
    
    
</div>
