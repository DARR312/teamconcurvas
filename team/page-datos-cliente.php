<?php 
$valor=$_GET['valor'];
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT cliente_id FROM con_t_ventas WHERE (venta_id = ".$valor.")", ARRAY_A);
$obtenidos = $wpdb->get_results( "SELECT nombre,telefono,direccion_1,complemento_1,ciudad_1 FROM con_t_clientes WHERE (cliente_id = ".$obtenidosArray[0][cliente_id].")", ARRAY_A);
print_r($obtenidos);