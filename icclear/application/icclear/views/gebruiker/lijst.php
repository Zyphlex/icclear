    
    <table class="table table-beheer">
        <thead>
            <tr>
                <th>Tijdstip</th>
                <th>Sessie</th>      
            </tr>
        </thead>
        <tbody>
            <?php foreach ($act as $a) { ?>
            <?php foreach ($a->activiteit as $item) { ?>
                <tr>
                    <td><?php echo $a->naam . " tot " . $planning->eindUur ?></td>
                    <td><?php echo $planning->sessie->onderwerp ?></td>
                </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>  