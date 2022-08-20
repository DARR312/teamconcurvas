<?php 
$valor=$_GET['valor'];
global $wpdb;
  //$obtenidosArray = $wpdb->get_results( "SELECT datos_cliente,cliente_id FROM con_t_ventas WHERE venta_id = '".$valor."'", ARRAY_A);
  //echo $obtenidosArray[0][datos_cliente];
  //echo $obtenidosArray[0][cliente_id];
  $fecha = wp_date('Y-m-d')." 00:00:00";
  $fechados =wp_date('Y-m-d')." 23:00:00";
  $obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventas WHERE fecha_creada BETWEEN '".$fecha."' AND '".$fechados."'", ARRAY_A);
  echo "Hoy se han vendido: ".$obtenidosArray[0]['COUNT(*)'];
?>