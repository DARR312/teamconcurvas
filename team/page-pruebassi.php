<?php 	
// $timezone = new DateTimeZone( 'America/Bogota' );
// $fecha = wp_date('Y-m-d', strtotime('+1 day'), $timezone );
// global $wpdb;
// $permisos = $wpdb->get_results( "SELECT DISTINCT cual FROM con_t_trprendas WHERE estado = 'Venta mayorista' ORDER BY cual", ARRAY_A  );
// $vm = array();
// for ($i=0; $i <sizeof($permisos) ; $i++) { 
//     $vmarray = explode('-', $permisos[$i] ["cual"] );
//     array_push($vm, $vmarray[1]);
// }
// for ($j=0; $j < (sizeof($vm)); $j++) { 
//     $contador = sizeof($vm)-$j-1;
//     for ($i=0; $i <  $contador; $i++) { 
//         if(intval($vm[$i]) > intval($vm[$i+1])){
//             $valoranterior = $vm[$i];
//             $vm[$i] = $vm[$i+1];
//             $vm[$i+1] = $valoranterior;
//         }
//     }
// }
// for ($j=0; $j < (sizeof($vm)); $j++) { 
//     $prendas = $wpdb->get_results( "SELECT codigo,descripcion,referencia_id FROM con_t_trprendas WHERE cual = 'VM-".$vm[$j]."'", ARRAY_A  );
//     $jsonprendas = json_encode($prendas);
//     $precio = 0;
//     for ($i=0; $i < sizeof($prendas); $i++) { 
//         $precioprenda = $wpdb->get_results( "SELECT precio_mayorista FROM con_t_resumen WHERE referencia_id = '".$prendas[$i]["referencia_id"]."'", ARRAY_A  );
//         $precio = $precio + intval($precioprenda[0]["precio_mayorista"]);
//     }
//     $decodeprendas = json_decode($jsonprendas);
//     echo $vm[$j];
//     echo "</br>";
//     echo $jsonprendas;
//     echo "</br>";
//     echo $precio;
//     echo "</br>";
//     $datos = "INSERT INTO con_t_mayorista ( VM_tr_mayoristas,valor_mercancia,resumen_mercancia) VALUES (".$vm[$j].",".$precio.",'".$jsonprendas."')";
//     echo $datos;
//     $wpdb->query($datos);
//     echo "</br>";
//     echo "</br>";
// }
// global $wpdb;
// $dia = 10;
// $mes = 11;

// for ($i=1; $i < 23; $i++) { 
//     $fecha = "2022-".$mes."-".$i;
//     $fechamenor = $fecha." 00:00:00";
//     $fechamayor = $fecha." 23:00:00";
//     $ventas = $wpdb->get_results( "SELECT * FROM `con_t_ventasplaza` WHERE `fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."'", ARRAY_A  );
//     echo "SELECT * FROM `con_t_ventasplaza` WHERE `fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."'";
//     print_r($ventas);
//     echo "</br>";
//     $valor_mercancia = 0;
//     $metodospago = array( "Efectivo" =>0, "Datafono" => 0, "Nequi" => 0, "Daviplata" => 0);
//     for ($j=0; $j < sizeof($ventas); $j++) { 
//         $valor_mercancia = $valor_mercancia + intval($ventas[$j]["valor_total"]);
//         $jsonmetodos_pago = json_decode($ventas[$j]["metodos_pago"], true);
//         $efectivo = 0;
//         $datafono = 0;
//         $nequi = 0;
//         $daviplata = 0;
//         $Payu = 0;
//         $Bancolombia = 0;
//         for ($k=0; $k < sizeof($jsonmetodos_pago); $k++) { 
//             $metodo = "";
//             if($jsonmetodos_pago[$k]["metodo"] == "1"){$efectivo = $efectivo + intval($jsonmetodos_pago[$k]["valor"]);}
//             if($jsonmetodos_pago[$k]["metodo"] == "2"){$datafono = $datafono + intval($jsonmetodos_pago[$k]["valor"]);}
//             if($jsonmetodos_pago[$k]["metodo"] == "3"){$nequi = $nequi + intval($jsonmetodos_pago[$k]["valor"]);}
//             if($jsonmetodos_pago[$k]["metodo"] == "4"){$daviplata = $daviplata + intval($jsonmetodos_pago[$k]["valor"]);}
//             if($jsonmetodos_pago[$k]["metodo"] == "5"){$Payu = $Payu + intval($jsonmetodos_pago[$k]["valor"]);}
//             if($jsonmetodos_pago[$k]["metodo"] == "6"){$Bancolombia = $Bancolombia + intval($jsonmetodos_pago[$k]["valor"]);}
//         } 
//         $metodospago["Efectivo"] = intval($metodospago["Efectivo"])+ $efectivo;
//         $metodospago["Datafono"] = intval($metodospago["Datafono"])+ $datafono;
//         $metodospago["Nequi"] = intval($metodospago["Nequi"])+ $nequi;
//         $metodospago["Daviplata"] = intval($metodospago["Daviplata"])+ $daviplata;
//         $metodospago["PayU"] = intval($metodospago["PayU"])+ $Payu;
//         $metodospago["Bancolombia"] = intval($metodospago["Bancolombia"])+ $Bancolombia;
//     }
//     echo $fecha;
//     echo " -----> ";
//     echo $valor_mercancia;
//     echo " -----> ";
//     $metodojs = json_encode($metodospago);
//     echo $metodojs;
//     $datos = "INSERT INTO con_t_resumenplaza ( fecha,valor_mercancia,metodos_pago ) VALUES ('".$fecha."',".$valor_mercancia.",'".$metodojs."')";
//     echo " -----> ";
//     echo $datos;
//     $wpdb->query($datos);
//     echo "</br>";
//     echo "</br>";
//     echo "Siguiente";
//     echo "</br>";
// }
// $referencias = $wpdb->get_results( "SELECT referencia_id ,nombre,color,talla FROM con_t_resumen WHERE 1", ARRAY_A  );
// for ($i=0; $i < sizeof($referencias); $i++) { 
//    $ref = $referencias[$i]['nombre']." ".$referencias[$i]['color']." ".$referencias[$i]['talla'];
//    echo $ref."</br>";
//    $pedidos = $wpdb->get_results( "SELECT pedido,venta_id,pedido_item FROM con_t_ventas WHERE pedido LIKE '%".$ref."%'", ARRAY_A  );
//    for ($j=0; $j < sizeof($pedidos) ; $j++) { 
//         // $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => " "), array( 'venta_id' => $pedidos[$j]['venta_id'] ) );
//         if ($pedidos[$j]['pedido_item']) {
//             $jsonPedido =  json_decode($pedidos[$j]['pedido_item']);
//             echo $jsonPedido[0];
//             echo $pedidos[$j]['pedido_item']."</br>";
//             echo $pedidos[$j]['venta_id']."</br>";
            
//         }else{
//             $pedido_itemarray = array($referencias[$i]['referencia_id']);
//             $jsonPedido =  json_encode($pedido_itemarray);
//             echo $jsonPedido;
//             //$updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $jsonPedido), array( 'venta_id' => $pedidos[$j]['venta_id'] ) );
//         }
//    }
//    //print_r($pedidos);
//    echo "</br>";
// }
// $pedidos = $wpdb->get_results( "SELECT venta_id FROM con_t_ventas WHERE 1", ARRAY_A  );//1
// for ($i=0; $i < sizeof($pedidos); $i++) { 
//     echo $pedidos[$i]['venta_id'];
//     echo "</br>";
//     $pedido_itemarray = array(0);
//     $jsonPedido =  json_encode($pedido_itemarray);
//     $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $jsonPedido), array( 'venta_id' => $pedidos[$i]['venta_id'] ) );
// }//1


// $items = $wpdb->get_results( "SELECT venta_id,prenda_id FROM con_t_ventaitem WHERE 1", ARRAY_A  );//2
// for ($i=0; $i < sizeof($items) ; $i++) { 
//     echo $items[$i]['venta_id'];
//     $pedidoitems = $wpdb->get_results( "SELECT venta_id,pedido_item FROM con_t_ventas WHERE venta_id = ".$items[$i]['venta_id']."", ARRAY_A  );
//     $jsonPedidon =  json_decode($pedidoitems[0]['pedido_item']);
//     array_push($jsonPedidon, $items[$i]['prenda_id']);
//     print_r($jsonPedidon);
//     $jsonPedido =  json_encode($jsonPedidon);
//     echo $jsonPedido;
//     $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $jsonPedido), array( 'venta_id' => $items[$i]['venta_id'] ) );
//     echo "</br>";
// }//2

?>