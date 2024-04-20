<?php
 global $wpdb;
   $datoss=$wpdb->get_results( "SELECT * FROM `con_t_clientes` WHERE `cliente_id`=953", ARRAY_A);
    print_r( $datoss);
    $objetocliente->nombre = $datoss[0]['nombre'];
    $objetocliente->telefono = $datoss[0]['telefono'];
    $objetocliente->direccion = $datoss[0]['direccion_1'];
    $objetocliente->complemento = $datoss[0]['complemento_1'];
    $objetocliente->ciudad = $datoss[0]['ciudad_1'];
    $jsonCliente= json_encode($objetocliente,JSON_UNESCAPED_UNICODE);
    //$updated = $wpdb->update( "con_t_ventas", array('cliente_data ' => $jsonCliente), array( 'venta_id ' => $ventas[$i]['venta_id'] ) );
    $datos="UPDATE con_t_ventas SET  datos_cliente = '".$jsonCliente."' WHERE venta_id = 903";
    echo $datos;
    $wpdb->query($datos);
//  $ventas = $wpdb->get_results( "SELECT * FROM con_t_ventas", ARRAY_A);
//  //print_r($ventas);
//  for ($i=0; $i < sizeof($ventas); $i++) { //°Diego Rodríguez°3229261615°Cll 33 No 6 - 9°Apto 1005°Bogotá
//     // $datoss=$wpdb->get_results( "SELECT * FROM `con_t_clientes` WHERE `cliente_id`=".$ventas[$i]['cliente_id']."", ARRAY_A);
//     // print_r( $datoss);
//     // $objetocliente->nombre = $datoss[0]['nombre'];
//     // $objetocliente->telefono = $datoss[0]['telefono'];
//     // $objetocliente->direccion = $datoss[0]['direccion_1'];
//     // $objetocliente->complemento = $datoss[0]['complemento_1'];
//     // $objetocliente->ciudad = $datoss[0]['ciudad_1'];
//     // $jsonCliente= json_encode($objetocliente,JSON_UNESCAPED_UNICODE);
//     // //$updated = $wpdb->update( "con_t_ventas", array('cliente_data ' => $jsonCliente), array( 'venta_id ' => $ventas[$i]['venta_id'] ) );
//     // $datos="UPDATE con_t_ventas SET  datos_cliente = '".$jsonCliente."' WHERE venta_id = ".$ventas[$i]['venta_id']."";
//     // $wpdb->query($datos);
//   //1 America Negro LXL 1 Ibiza Beige SM%260000
//     //var_dump(json_decode($ventas[$i]['pedido']));
//     //print_r($ventas[$i]['pedido']);
// //   $cadena = $ventas[$i]['pedido'];
// //     $cadenan = substr($cadena, 12, -16);
// //     $arraypedido = json_decode($cadenan);
// //     $objetopedido->prendas = $arraypedido->prendas;
// //     $objetopedido->precio = $arraypedido->precio;
// //     $jsonPedido= json_encode($objetopedido,JSON_UNESCAPED_UNICODE);
// //     $datos="UPDATE con_t_ventas SET  pedido = '".$jsonPedido."' WHERE venta_id = ".$ventas[$i]['venta_id']."";
// //     $wpdb->query($datos);
//  }
?>