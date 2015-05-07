    
    <table class="table table-beheer">
        <thead>
            <tr>
                <th class="w50">Activiteit</th>
                <th class="w30">Personen</th>   
                <th class="w20">Prijs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($act as $a) { ?>
                <tr>
                    <td><?php echo $a->naam ?></td>
                    <td><?php echo $a->aantalPersonen ?> (&euro; <span class="italic"><?php echo $a->prijs ?> pp)</span></td>
                    <td>&euro; <?php echo ($a->prijs * $a->aantalPersonen) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>  