    
    <table class="table table-beheer">
        <thead>
            <tr>
                <th>Activiteit</th>
                <th>Personen</th>      
            </tr>
        </thead>
        <tbody>
            <?php foreach ($act as $a) { ?>
                <tr>
                    <td><?php echo $a->naam ?></td>
                    <td><?php echo $a->aantalPersonen ?> (<span class="italic"><?php echo $a->prijs ?></span>pp)</td>
                    <td>&euro; <?php echo ($a->prijs * $a->aantalPersonen) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>  