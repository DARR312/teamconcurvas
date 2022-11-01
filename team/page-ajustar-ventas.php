<?php
 global $wpdb;
//  $ventas = $wpdb->get_results( "SELECT * FROM con_t_ventas WHERE venta_id = 903", ARRAY_A);
//  $datosarray =  explode("°",$ventas[0]['datos_cliente']);
// $objetocliente->nombre = $datosarray[1];
// $objetocliente->telefono = $datosarray[2];
// $objetocliente->direccion = $datosarray[3];
// $objetocliente->complemento = $datosarray[4];
// $objetocliente->ciudad = str_replace("%","",$datosarray[5]);
// $jsonCliente= json_encode($objetocliente,JSON_UNESCAPED_UNICODE);
// echo $jsonCliente;
// //$updated = $wpdb->update( "con_t_ventas", array('cliente_data ' => $jsonCliente), array( 'venta_id ' => $ventas[$i]['venta_id'] ) );
// $datos="UPDATE con_t_ventas SET  datos_cliente = '".$jsonCliente."' WHERE venta_id = ".$ventas[0]['venta_id']."";
// echo $datos;
// $wpdb->query($datos);
 $ventas = $wpdb->get_results( "SELECT * FROM con_t_ventas", ARRAY_A);
 for ($i=0; $i < sizeof($ventas); $i++) { //°Diego Rodríguez°3229261615°Cll 33 No 6 - 9°Apto 1005°Bogotá
    $datosarray =  explode("°",$ventas[$i]['datos_cliente']);
    $objetocliente->nombre = $datosarray[1];
    $objetocliente->telefono = $datosarray[2];
    $objetocliente->direccion = $datosarray[3];
    $objetocliente->complemento = $datosarray[4];
    $objetocliente->ciudad = str_replace("%","",$datosarray[5]);
    $jsonCliente= json_encode($objetocliente,JSON_UNESCAPED_UNICODE);
    //$updated = $wpdb->update( "con_t_ventas", array('cliente_data ' => $jsonCliente), array( 'venta_id ' => $ventas[$i]['venta_id'] ) );
    $datos="UPDATE con_t_ventas SET  datos_cliente = '".$jsonCliente."' WHERE venta_id = ".$ventas[$i]['venta_id']."";
    $wpdb->query($datos);
    $ventas[$i]['pedido'];//1 America Negro LXL 1 Ibiza Beige SM%260000
    $datosarray =  explode("%",$ventas[$i]['pedido']);
    $objetopedido->prendas = $datosarray[0];
    $objetopedido->precio = $datosarray[1];
    $jsonPedido= json_encode($objetopedido,JSON_UNESCAPED_UNICODE);
    $datos="UPDATE con_t_ventas SET  pedido = '".$jsonPedido."' WHERE venta_id = ".$ventas[$i]['venta_id']."";
    $wpdb->query($datos);
 }
?>