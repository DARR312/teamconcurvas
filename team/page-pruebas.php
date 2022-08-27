<?php 	
$fecha = wp_date('Y-m-d');
$valor=$_GET['valor'];
global $wpdb;

/*echo "hola";
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas GROUP BY codigo", ARRAY_A);//133
print_r($obtenidosArray);*/
/*******************************NO EMPACADO*******************************************************
$obtenidosArray = $wpdb->get_results( "SELECT venta_id,estado,fecha_entrega FROM con_t_ventas WHERE (estado = 'Sin empacar') AND (fecha_entrega < '".$fecha."')", ARRAY_A);
print_r($obtenidosArray);
if($obtenidosArray){
    for($i = 0;$i<sizeof($obtenidosArray);$i++){
        echo " Pedido: ".$obtenidosArray[$i][venta_id];
        $updated = $wpdb->update( "con_t_ventas", array('estado' => "No empacado"), array( 'venta_id' => $obtenidosArray[$i][venta_id] ) );
        $datos = array("venta_id" => $obtenidosArray[$i][venta_id] , "cambio" => 'No empacado' , "usuario_id" => 1 , "fecha_hora" => $fecha , "campo_cambio" => "estado");
        $wpdb->insert("con_t_ventastr", $datos);
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

$referenciasArray = $wpdb->get_results( "SELECT DISTINCT referencia_id FROM con_t_trprendas ORDER BY referencia_id ASC", ARRAY_A);
$estadosArray = $wpdb->get_results( "SELECT DISTINCT estado FROM con_t_trprendas ORDER BY estado ASC", ARRAY_A);
  //print_r($estadosArray); 
  for($j = 0; $j<sizeof($referenciasArray);$j++){    
    $cantidad = 0;
    for($i = 0; $i<sizeof($estadosArray);$i++){
        $obtenidosArray = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = '".$estadosArray[$i]['estado']."')", ARRAY_A);//133
        //echo $estadosArray[$i][estado].": ".$obtenidosArray[0]['COUNT(*)']." ";
        if(($estadosArray[$i]['estado'] == "En Administración") || ($estadosArray[$i]['estado'] == "En Empaques") || ($estadosArray[$i]['estado'] == "En Operaciones") || ($estadosArray[$i]['estado'] == "En Plaza de las américas") || ($estadosArray[$i]['estado'] == "En satélite")){
            $cantidad = $cantidad +  $obtenidosArray[0]['COUNT(*)'];
        }
    }
    $separados = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventaitem WHERE (prenda_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado_id = 1)", ARRAY_A);//133
    $cantidad = $cantidad - $separados[0]['COUNT(*)'];
    //$separadosCambios = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_cambioitem WHERE (prenda_idsale = ".$referenciasArray[$j]['referencia_id'].") AND (estado_id = 'Sin empacar')", ARRAY_A);//133
    //$cantidad = $cantidad - $separados[0]['COUNT(*)']- $separadosCambios[0]['COUNT(*)'];
    //echo $referenciasArray[$j]['referencia_id'].": ".$cantidad."--";
    $updated = $wpdb->update( "con_t_resumen", array('cantidad' => $cantidad), array( 'referencia_id' => $referenciasArray[$j]['referencia_id']));
  }
  


?>