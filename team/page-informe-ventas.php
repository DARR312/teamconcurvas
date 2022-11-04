<?php 
$valor=$_GET['valor'];
global $wpdb;
  //$obtenidosArray = $wpdb->get_results( "SELECT datos_cliente,cliente_id FROM con_t_ventas WHERE venta_id = '".$valor."'", ARRAY_A);
  //echo $obtenidosArray[0][datos_cliente];
  //echo $obtenidosArray[0][cliente_id];
  $timezone = new DateTimeZone( 'America/Bogota' );
  $fechados = wp_date('Y-m-d H:i:s', null, $timezone );
  $date = strtotime($fechados);
  $fecha = wp_date('Y-m-d H:i:s', strtotime("-".date('H', $date)." hours"), $timezone );
  $vendedores = $wpdb->get_results( "SELECT DISTINCT vendedor_id FROM con_t_ventas ORDER BY vendedor_id ASC", ARRAY_A);
  for($i=0;$i<sizeof($vendedores);$i++){
      $vendedornombre = $wpdb->get_results( "SELECT display_name FROM con_users WHERE ID = ".$vendedores[$i]['vendedor_id']."", ARRAY_A);
      echo $vendedornombre[0]['display_name']." ha vendido: ";
      $ventas = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventas WHERE (fecha_creada BETWEEN '".$fecha."' AND '".$fechados."') AND vendedor_id = ".$vendedores[$i]['vendedor_id']."", ARRAY_A);
      echo $ventas[0]['COUNT(*)']." ";
  }
  $obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventas WHERE (fecha_creada BETWEEN '".$fecha."' AND '".$fechados."')", ARRAY_A);
  echo "Hoy se han vendido: ".$obtenidosArray[0]['COUNT(*)'];
?>