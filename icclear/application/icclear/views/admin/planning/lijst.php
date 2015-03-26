<?php foreach ($conferentiedagen as $dag) { ?>
<h2><?php echo toDDMMYYYY($dag->datum) ?></h2>
<p><?php echo $dag->id ?></p> 
<?php } ?>
<script type="text/javascript">
	//------------------
	// jQuery UI bepalen
	//------------------
    
    $(function() {
        $( "#accordion" ).accordion({
                autoHeight: false,
                navigation: true
        });
    });
        
</script>
   
<?php 

echo '<div id="accordion">';

foreach ($conferentiedagen as $dag) {
    echo '<h3><a href="#">' . $dag->datum . "</a></h3>\n"; 
    echo "<div><p>\n";
    
    echo "<p>Hallo boer het werkt</p>";
//    foreach ($soort->producten as $product) {
//        echo divAnchor('product/detail/' . $product->id, $product->naam) . "\n";
//    }  
    echo "</p></div>\n";
}

echo '</div>';
    
?>