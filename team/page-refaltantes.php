<?php 	
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),prenda_id FROM con_t_ventaitem WHERE estado_id = 1 GROUP BY prenda_id", ARRAY_A);
$html = "";
for($i=0;$i<sizeof($obtenidosArray);$i++){
  $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$obtenidosArray[$i]['prenda_id']."", ARRAY_A);
  $html = $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." Sin empacar: ".$obtenidosArray[$i]['COUNT(*)']."</p></div>";
}
echo $html;
?>