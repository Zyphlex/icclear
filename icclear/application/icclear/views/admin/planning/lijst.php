<?php foreach ($conferentiedagen as $dag) { ?>
<h2><?php echo toDDMMYYYY($dag->datum) ?></h2>
<p><?php echo $dag->id ?></p> 
<?php } ?>
   