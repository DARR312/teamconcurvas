<?php 	
$timezone = new DateTimeZone( 'America/Bogota' );
$fecha = wp_date('Y-m-d', strtotime('+1 day'), $timezone );
echo $fecha;
$valor=$_GET['valor'];
global $wpdb;
/*echo "hola";
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas GROUP BY codigo", ARRAY_A);//133
print_r($obtenidosArray);*/
/*******************************NO EMPACADO*******************************************************/
$obtenidosArray = $wpdb->get_results( "SELECT venta_id,estado,fecha_entrega FROM con_t_ventas WHERE (estado = 'Sin empacar') AND (fecha_entrega < '".$fecha."')", ARRAY_A);
print_r($obtenidosArray);
if($obtenidosArray){
    for($i = 0;$i<sizeof($obtenidosArray);$i++){
        echo " Pedido: ".$obtenidosArray[$i]['venta_id'];
        $updated = $wpdb->update( "con_t_ventas", array('estado' => "No empacado"), array( 'venta_id' => $obtenidosArray[$i]['venta_id'] ) );
        $datos = array("venta_id" => $obtenidosArray[$i]['venta_id'] , "cambio" => 'No empacado' , "usuario_id" => 1 , "fecha_hora" => $fecha , "campo_cambio" => "estado");
        $wpdb->insert("con_t_ventastr", $datos);
    }
}
$obtenidosCambios = $wpdb->get_results( "SELECT cambio_id,estado,fecha_entrega FROM con_t_cambios WHERE (estado = 'Sin empacar') AND (fecha_entrega < '".$fecha."')", ARRAY_A);
print_r($obtenidosCambios);
if($obtenidosCambios){
    for($i = 0;$i<sizeof($obtenidosCambios);$i++){
        echo " Pedido: ".$obtenidosCambios[$i]['cambio_id'];
        $updated = $wpdb->update( "con_t_cambios", array('estado' => "No empacado"), array( 'cambio_id' => $obtenidosCambios[$i]['cambio_id'] ) );
        $datos = array("cambio_id" => $obtenidosCambios[$i]['cambio_id'] , "cambio" => 'No empacado' , "usuario_id" => 1 , "fecha_hora" => $fecha , "campo_cambio" => "estado");
        $wpdb->insert("con_t_cambiostr", $datos);
    }
}
/*******************************NO EMPACADO*******************************************************/
/*$obtenidosArray = $wpdb->get_results( "SELECT estado,referencia_id,COUNT(*) FROM con_t_trprendas GROUP BY estado,referencia_id ORDER BY con_t_trprendas.referencia_id DESC", ARRAY_A);//133
//print_r($obtenidosArray);
$obtenidosArray = $wpdb->get_results( "SELECT descripcion,codigo  FROM con_t_trprendas WHERE (estado = 'En satélite')", ARRAY_A);//133
$imprimir = "<div id='marquillas'><table border='1'><tr><th>Codigo</th><th>Descripción</th></tr>";
for($i=0;$i<sizeof($obtenidosArray);$i++){
    $imprimir = $imprimir."<tr><td>".$obtenidosArray[$i][descripcion]."</td><td>".$obtenidosArray[$i][codigo]."</td></tr>";
}
$imprimir=$imprimir."</table></div>";
echo $imprimir;*/
/******************************* ACTUALIZAR INVENTARIO *******************************************************/
    $referenciasArray = $wpdb->get_results( "SELECT DISTINCT referencia_id FROM con_t_trprendas ORDER BY referencia_id ASC", ARRAY_A);
    $estadosArray = $wpdb->get_results( "SELECT DISTINCT estado FROM con_t_trprendas ORDER BY estado ASC", ARRAY_A);
    $lastId = $wpdb->get_results( "SELECT MAX(referencia_id) as id FROM con_t_resumen");
    $a = array_fill(1, $lastId[0]->id, 0);
    $pedidos = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (estado = 'Sin empacar') OR (estado = 'No empacado')", ARRAY_A);//133
    for ($i=0; $i < sizeof($pedidos) ; $i++) { 
        $jsonPedidon =  json_decode($pedidos[$i]['pedido_item']);
        for ($j=1; $j < sizeof($jsonPedidon); $j++) { 
            $jsonPedido =  (array)$jsonPedidon[$j];
            $cantidadantigua = $a[$jsonPedido['referencia']];
            $a[$jsonPedido['referencia']] = $cantidadantigua+1;
        }
    }
    $lastId = $wpdb->get_results( "SELECT MAX(referencia_id) as id FROM con_t_resumen");
    $b = array_fill(1, $lastId[0]->id, 0);
    $pedidos = $wpdb->get_results( "SELECT pedido_item FROM con_t_cambios WHERE (estado = 'Sin empacar') OR (estado = 'No empacado')", ARRAY_A);//133
    for ($i=0; $i < sizeof($pedidos) ; $i++) { 
        $jsonPedidon =  json_decode($pedidos[$i]['pedido_item']);
        for ($j=1; $j < sizeof($jsonPedidon); $j++) { 
            $jsonPedido =  (array)$jsonPedidon[$j];
            $cantidadantigua = $b[$jsonPedido['referencia']];
            $b[$jsonPedido['referencia']] = $cantidadantigua+1;
        }
    }
  for($j = 0; $j<sizeof($referenciasArray);$j++){    
    echo "</br></br>";
    print_r($referenciasArray[$j]);
    $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A);  
    $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);  
    $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
    $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
    $separados = $a[$referenciasArray[$j]['referencia_id']];//133
    $separadosCambios = $b[$referenciasArray[$j]['referencia_id']];//133
    $cantidad = $fabrica[0]['COUNT(*)'] + $bodega[0]['COUNT(*)'] + $plaza[0]['COUNT(*)'] + $satel[0]['COUNT(*)'] - $separados- $separadosCambios;
    echo "</br>Fábrica: ".$fabrica[0]['COUNT(*)']." Bodega: ".$bodega[0]['COUNT(*)']." Plaza: ".$plaza[0]['COUNT(*)']." Satélite: ".$satel[0]['COUNT(*)']." Separados: ".$separados." Separados Cambios: ".$separadosCambios;
    $updated = $wpdb->update( "con_t_resumen", array('cantidad' => $cantidad), array( 'referencia_id' => $referenciasArray[$j]['referencia_id']));
  }
/*******************************NO EMPACADO*******************************************************/
/*$vendedoras = $wpdb->get_results( "SELECT DISTINCT vendedor_id FROM con_t_ventas ORDER BY vendedor_id ASC", ARRAY_A);
print_r($vendedoras);
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = '".$estadosArray[$i]['estado']."')", ARRAY_A);//133*/
?>