<?php 	
$valor=$_GET['valor'];
global $wpdb;
print_r(array('estado' => 'Cancelado'));
print_r(array( 'venta_id' => $valor));
$updated = $wpdb->update( "con_t_ventas", array('estado' => 'Cancelado'), array( 'venta_id' => $valor ) );
$updated1 = $wpdb->update( "con_t_ventaitem", array('estado_id' => 'Cancelado'), array( 'venta_id' => $valor ) );
echo $updated;
echo "-".$updated1;
?>