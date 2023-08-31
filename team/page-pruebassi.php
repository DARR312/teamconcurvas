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
//     $pedido_itemarra = array("comision"=>0,"cantidad"=>0);
//     $pedido_itemarray = array($pedido_itemarra);
//     $jsonPedido =  json_encode($pedido_itemarray);
//     $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $jsonPedido), array( 'venta_id' => $pedidos[$i]['venta_id'] ) );
// }//1


// $items = $wpdb->get_results( "SELECT venta_id,prenda_id,valor FROM con_t_ventaitem WHERE 1", ARRAY_A  );//2
// for ($i=0; $i < sizeof($items) ; $i++) { 
//     echo $items[$i]['venta_id'];
//     $pedidoitems = $wpdb->get_results( "SELECT venta_id,pedido_item FROM con_t_ventas WHERE venta_id = ".$items[$i]['venta_id']."", ARRAY_A  );
//     $jsonPedidon =  json_decode($pedidoitems[0]['pedido_item']);
//     $pedido_itemarray = array("referencia" => $items[$i]['prenda_id'], "valor"=>$items[$i]['valor']);
//     array_push($jsonPedidon, $pedido_itemarray);
//     $jsonPedido =  json_encode($jsonPedidon);
//     echo $jsonPedido;
//     $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $jsonPedido), array( 'venta_id' => $items[$i]['venta_id'] ) );
//     echo "</br>";
// }//2

// $pedidos = $wpdb->get_results( "SELECT venta_id,cliente_ok,pedido_item FROM con_t_ventas WHERE cliente_ok > 0", ARRAY_A  );//3
// for ($i=0; $i < sizeof($pedidos) ; $i++) {      
//     $jsonPedidon =  json_decode($pedidos[$i]['pedido_item']);
//     $jsonclienteok =  json_decode($pedidos[$i]['cliente_ok']);
//     $vant = (array)$jsonPedidon[0];
//     $prendas = 0;
//     for ($j=1; $j < sizeof($jsonPedidon); $j++) { 
//        $item = (array)$jsonPedidon[$j];
//        $jsonclienteok =  intval($jsonclienteok)-intval($item['valor']);
//        if($jsonclienteok>=0){
//             $prendas++;
//        }
//     }
//     echo $pedidos[$i]['venta_id']." ".$pedidos[$i]['cliente_ok']." prendas: ".$prendas; 
//     $vant['cantidad']=$prendas;
//     $jsonPedidon[0] = $vant;
//     $pedidos[$i]['pedido_item'] = json_encode($jsonPedidon);
//     echo "</br>";
//     echo "R ".$pedidos[$i]['venta_id']." ".$pedidos[$i]['cliente_ok']." ".$pedidos[$i]['pedido_item']; 
//     echo "</br>";
//     echo "</br>";
//     $updated = $wpdb->update( "con_t_ventas", array('pedido_item' => $pedidos[$i]['pedido_item']), array( 'venta_id' => $pedidos[$i]['venta_id'] ) );
// }//3

// $pedidos = $wpdb->get_results( "SELECT cambio_id FROM con_t_cambios WHERE 1", ARRAY_A  );//4
// for ($i=0; $i < sizeof($pedidos); $i++) { 
//     echo $pedidos[$i]['cambio_id'];
//     echo "</br>";
//     $pedido_itemarra = array("venta"=>0,"cantidad"=>0);
//     $pedido_itemarray = array($pedido_itemarra);
//     $jsonPedido =  json_encode($pedido_itemarray);
//     $updated = $wpdb->update( "con_t_cambios", array('pedido_item' => $jsonPedido), array( 'cambio_id' => $pedidos[$i]['cambio_id'] ) );
// }//4


// $items = $wpdb->get_results( "SELECT cambio_id,prenda_idsale,ventainicial_id FROM con_t_cambioitem WHERE 1", ARRAY_A  );//5
// for ($i=0; $i < sizeof($items) ; $i++) { 
//     echo $items[$i]['cambio_id'];
//     $pedidoitems = $wpdb->get_results( "SELECT cambio_id,pedido_item FROM con_t_cambios WHERE cambio_id = ".$items[$i]['cambio_id']."", ARRAY_A  );
//     $jsonPedidon =  json_decode($pedidoitems[0]['pedido_item']);
//     $pedido_itemarray = array("referencia" => $items[$i]['prenda_idsale'], "ventainicial_id"=>$items[$i]['ventainicial_id']);
//     array_push($jsonPedidon, $pedido_itemarray);
//     $jsonPedido =  json_encode($jsonPedidon);
//     echo $jsonPedido;
//     $updated = $wpdb->update( "con_t_cambios", array('pedido_item' => $jsonPedido), array( 'cambio_id' => $items[$i]['cambio_id'] ) );
//     echo "</br>";
// }//5
// $obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),vendedor_id FROM con_t_ventas WHERE cliente_ok > 0 GROUP BY vendedor_id", ARRAY_A);
// print_r($obtenidosArray);

/*************************** CIERRE DE CAJA DB ****************************/
// $mes = 8;
// for ($dia=8; $dia < 32; $dia=$dia+7) { 
//     $fechamenor = "2022-".$mes."-".$dia." 00:00:00";    
//     $fechame = "2022-".$mes."-".$dia;    
//     if($mes > 12){break;}
//     $suma = $dia;
//     if($dia+7 >31){
//         if (($mes % 2) == 0) {
//             $resta = 31 - $dia;
//         } else {
//             $resta = 30 - $dia;
//         }
//         $mes++;
//         $suma = -1*$resta;
//         $diamayor = $suma+6;      
//         $fechamayor = "2022-".$mes."-".$diamayor." 23:00:000";
//         $fechama = "2022-".$mes."-".$diamayor;
//         $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  ((`estado`<>'Entregado') OR (`cliente_ok`=0)) AND (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
//     $auditados = array();
//     for ($i=0; $i < sizeof($ventas) ; $i++) { 
//         $jsonclientedatos =  json_decode($ventas[$i]['datos_cliente']);
//         $vant = (array)$jsonclientedatos;
//         $lon = "";
//         if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){$lon="Local";
//         }else{$lon="Nacional";}
//         $prendasventa = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventas[$i]['venta_id']."'",ARRAY_A);
//         $auditados[$ventas[$i]['venta_id']] = array("prendas"=>sizeof($prendasventa),"estado"=>$ventas[$i]['estado'],"dinero"=>$ventas[$i]['cliente_ok'],"lon" => $lon);
//     }
//     $ventastodas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
//     $nacional = 0;
//     $local = 0;
//     for ($i=0; $i < sizeof($ventastodas) ; $i++) {  
//         $jsonclientedatos =  json_decode($ventastodas[$i]['datos_cliente']);
//         $vant = (array)$jsonclientedatos;
//         $lon = "";
//         if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){
//             $local = $local + intval($ventas[0]['cliente_ok']);
//             $lon="Local";
//         }else{
//             $nacional = $nacional + intval($ventas[0]['cliente_ok']);
//             $lon="Nacional";}  
//         $prendasventastodas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventastodas[$i]['venta_id']."'",ARRAY_A);
//         if(sizeof($prendasventastodas) == 0){
//                 if(!$auditados[$ventastodas[$i]['venta_id']]){
//                     $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  `venta_id` = ".$ventastodas[$i]['venta_id']."",ARRAY_A);
//                     $auditados[$ventastodas[$i]['venta_id']] = array("prendas"=>0,"estado"=>$ventas[0]['estado'],"dinero"=>$ventas[0]['cliente_ok'],"lon" => $lon);
//                 }
//         }
//     }
//     $rango = $fechame." al ".$fechama;    
//     $cuentasporcobrar = 0;
//     foreach ($auditados as $key => $value) {
//         $prendas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$key."'",ARRAY_A);        
//         for ($i=0; $i < sizeof($prendas) ; $i++) { 
//             $referencia = $wpdb->get_results("SELECT `precio_detal` FROM `con_t_resumen` WHERE  `referencia_id` = ".$prendas[$i]['referencia_id']."",ARRAY_A);
//             $cuentasporcobrar = $cuentasporcobrar + intval($referencia[0]['precio_detal']);
//         }
//     }
//     $datos = "INSERT INTO con_t_cierredigital (  `fecha_menor`, `fecha_mayor`,`rango`, `local`, `nacional`, `cuentas_cobrar`) VALUES ('".$fechame."','".$fechama."','".$rango."','".$local."', '".$nacional."', '".$cuentasporcobrar."')";
//     echo $datos."</br>" ;    
//     $wpdb->query($datos);
//         $dia = 7 - $resta;     
//         $fechamenor = "2022-".$mes."-".$dia." 00:00:00";    
//         $fechame = "2022-".$mes."-".$dia;   
//     }
//     $diamayor = $dia+6;      
//     $fechamayor = "2022-".$mes."-".$diamayor." 23:00:00";
//     $fechama = "2022-".$mes."-".$diamayor;
//     $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  ((`estado`<>'Entregado') OR (`cliente_ok`=0)) AND (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
//     $auditados = array();
//     for ($i=0; $i < sizeof($ventas) ; $i++) { 
//         $jsonclientedatos =  json_decode($ventas[$i]['datos_cliente']);
//         $vant = (array)$jsonclientedatos;
//         $lon = "";
//         if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){$lon="Local";
//         }else{$lon="Nacional";}
//         $prendasventa = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventas[$i]['venta_id']."'",ARRAY_A);
//         $auditados[$ventas[$i]['venta_id']] = array("prendas"=>sizeof($prendasventa),"estado"=>$ventas[$i]['estado'],"dinero"=>$ventas[$i]['cliente_ok'],"lon" => $lon);
//     }
//     $ventastodas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
//     $nacional = 0;
//     $local = 0;
//     for ($i=0; $i < sizeof($ventastodas) ; $i++) {  
//         $jsonclientedatos =  json_decode($ventastodas[$i]['datos_cliente']);
//         $vant = (array)$jsonclientedatos;
//         $lon = "";
//         if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){
//             $local = $local + intval($ventas[0]['cliente_ok']);
//             $lon="Local";
//         }else{
//             $nacional = $nacional + intval($ventas[0]['cliente_ok']);
//             $lon="Nacional";}  
//         $prendasventastodas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventastodas[$i]['venta_id']."'",ARRAY_A);
//         if(sizeof($prendasventastodas) == 0){
//                 if(!$auditados[$ventastodas[$i]['venta_id']]){
//                     $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  `venta_id` = ".$ventastodas[$i]['venta_id']."",ARRAY_A);
//                     $auditados[$ventastodas[$i]['venta_id']] = array("prendas"=>0,"estado"=>$ventas[0]['estado'],"dinero"=>$ventas[0]['cliente_ok'],"lon" => $lon);
//                 }
//         }
//     }
//     $rango = $fechame." al ".$fechama;    
//     $cuentasporcobrar = 0;
//     foreach ($auditados as $key => $value) {
//         $prendas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$key."'",ARRAY_A);        
//         for ($i=0; $i < sizeof($prendas) ; $i++) { 
//             $referencia = $wpdb->get_results("SELECT `precio_detal` FROM `con_t_resumen` WHERE  `referencia_id` = ".$prendas[$i]['referencia_id']."",ARRAY_A);
//             $cuentasporcobrar = $cuentasporcobrar + intval($referencia[0]['precio_detal']);
//         }
//     }
//     $datos = "INSERT INTO con_t_cierredigital (  `fecha_menor`, `fecha_mayor`,`rango`, `local`, `nacional`, `cuentas_cobrar`) VALUES ('".$fechame."','".$fechama."','".$rango."','".$local."', '".$nacional."', '".$cuentasporcobrar."')";
//     echo $datos."</br>";
//     $wpdb->query($datos);
// }
    /*************************** CIERRE DE CAJA DB ****************************/
    
    
    
    global $wpdb;
    $obtenidosArray = $wpdb->get_results( "SELECT DISTINCT nombre,categoria_id,precio_detal,precio_mayorista FROM con_t_resumen ", ARRAY_A);
   
    for ($i=0; $i < sizeof($obtenidosArray); $i++) { 
        $nombre = $obtenidosArray[$i]['nombre'];
        $id_categoria = $obtenidosArray[$i]['categoria_id'];
        $precio_detal = $obtenidosArray[$i]['precio_detal'];
        $precio_mayorista = $obtenidosArray[$i]['precio_mayorista'];
        $datos ="INSERT INTO con_t_referencias ( nombre,id_categoria,precio_detal,precio_mayorista) VALUES ( '".$nombre."',".$id_categoria.",".$precio_detal.",".$precio_mayorista.")";
        echo $datos;
        echo "<br><br><br><br>";
        $wpdb->query($datos);
        // [0] => Array ( [nombre] => Vero [categoria_id] => 1 [precio_detal] => 60000 [precio_mayorista] => 0
    }

    // $wpdb->query($datos);
?>