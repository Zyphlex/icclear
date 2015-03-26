<?php foreach ($dagen as $dag) { ?>
    <h2><?php echo toDDMMYYYY($dag->datum) ?></h2>
    <?php foreach ($dag->planning as $dag2) { ?>
        <p><?php echo $dag2->beginUur . " " . $dag2->eindUur . " " . $dag2->sessie->onderwerp ?></p>
    <?php } ?> 
<?php } ?> 