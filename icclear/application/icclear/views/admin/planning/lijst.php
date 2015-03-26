<?php foreach ($dagen as $dag) { ?>
<h2><?php echo toDDMMYYYY($dag->datum) ?></h2>
<p><?php echo $dag->planning->beginUur . " " . $dag->planning->eindUur ?></p>
<?php } ?> 