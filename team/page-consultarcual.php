<?php 	
$valor=$_GET['valor'];
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),`estado` FROM con_t_trprendas WHERE (`cual` = '".$valor."') GROUP BY `estado`", ARRAY_A);
//print_r($obtenidosArray);
$html="";
for($j=0;$j<sizeof($obtenidosArray);$j++){
    $html = $html."<p class='letra18pt-pc'>".$obtenidosArray[$j]['estado']." ".$obtenidosArray[$j]['COUNT(*)']."</p>";
}
echo $html;

?>