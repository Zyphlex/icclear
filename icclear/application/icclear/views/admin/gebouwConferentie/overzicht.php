
<div class="row">
        <div class="col-md-10"> 
            <?php foreach ($dagen as $dag) { ?>
                <h3><?php echo toDDMMYYYY($dag->datum) ?></h3>

                <table class="table table-responsive table-beheer">
                    <thead>
                        <tr>

                            <th>Naam</th>
                            <th>Gemeente</th>                
                            <th>Postcode</th>
                            <th>Land</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dag->planning as $planning) { ?>
                            <tr>
                                <td><?php echo $planning->gebouw->naam ?></td>
                                <td><?php echo $planning->gebouw->gemeente ?></td>
                                <td><?php echo $planning->gebouw->postcode ?></td>
                                <td><?php echo $planning->land->naam ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
        <?php } ?> 
            </div>
</div>
