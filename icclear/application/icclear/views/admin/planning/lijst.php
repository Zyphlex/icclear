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
<style>
    .ui-accordion .ui-accordion-header {
	display: block;
	cursor: pointer;
	position: relative;
	margin: 2px 0 0 0;
	padding: .5em .5em .5em .7em;
	min-height: 0; /* support: IE7 */
	font-size: 100%;
}
.ui-accordion .ui-accordion-icons {
	padding-left: 2.2em;
}
.ui-accordion .ui-accordion-icons .ui-accordion-icons {
	padding-left: 2.2em;
}
.ui-accordion .ui-accordion-header .ui-accordion-header-icon {
	position: absolute;
	left: .5em;
	top: 50%;
	margin-top: -8px;
}
.ui-accordion .ui-accordion-content {
	padding: 1em 2.2em;
	border-top: 0;
	overflow: auto;
}
</style>
   
<?php 

echo '<div id="accordion">';

foreach ($conferentiedagen as $dag) {
    echo '<h3><a href="#">' . toDDMMYYYY($dag->datum) . "</a></h3>\n"; 
    echo "<div><p>\n";
    
    echo "<p>Hallo boer het werkt</p>";
//    foreach ($soort->producten as $product) {
//        echo divAnchor('product/detail/' . $product->id, $product->naam) . "\n";
//    }  
    echo "</p></div>\n";
}

echo '</div>';
    
?>