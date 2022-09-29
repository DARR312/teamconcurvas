<?php 	
$valor=$_GET['valor'];
global $wpdb;
$referenciasArray = $wpdb->get_results( "SELECT referencia_id FROM con_t_resumen WHERE nombre = '".$valor."'", ARRAY_A);//133
//print_r($referenciasArray);
$descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[0]['referencia_id']."", ARRAY_A);
$fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En Producción')", ARRAY_A); 
$bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);   
$plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
$satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
$separados = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventaitem WHERE (prenda_id = ".$referenciasArray[0]['referencia_id'].") AND (estado_id = 1)", ARRAY_A);//133
$restantes = intval($fabrica[0]['COUNT(*)'])+intval($bodega[0]['COUNT(*)'])+intval($plaza[0]['COUNT(*)'])+intval($satel[0]['COUNT(*)'])-intval($separados[0]['COUNT(*)']);
$html = "<div id='listadoResumen'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos' id='primerCodigo'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']." Fábrica".$fabrica[0]['COUNT(*)']." Bodega: ".$bodega[0]['COUNT(*)']." Plaza: ".$plaza[0]['COUNT(*)']." Satélite: ".$satel[0]['COUNT(*)']." Separados: ".$separados[0]['COUNT(*)']." Restantes: ".$restantes."</p></div></div>";
for($j=1;$j<sizeof($referenciasArray);$j++){
    $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[$j]['referencia_id']."", ARRAY_A);
    $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En Producción')", ARRAY_A);  
    $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);  
    $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
    $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
    $separados = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventaitem WHERE (prenda_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado_id = 1)", ARRAY_A);//133
    $restantes = intval($fabrica[0]['COUNT(*)'])+intval($bodega[0]['COUNT(*)'])+intval($plaza[0]['COUNT(*)'])+intval($satel[0]['COUNT(*)'])-intval($separados[0]['COUNT(*)']);
    $html = $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']." Fábrica: ".$fabrica[0]['COUNT(*)']." Bodega: ".$bodega[0]['COUNT(*)']." Plaza: ".$plaza[0]['COUNT(*)']." Satélite: ".$satel[0]['COUNT(*)']." Separados: ".$separados[0]['COUNT(*)']." Restantes: ".$restantes."</p></div></div>";
}
echo $html;
$referencias = $wpdb->get_results( "SELECT referencia_id FROM con_t_resumen WHERE nombre = '".$valor."'", ARRAY_A);//133
$sql = "SELECT codigo,descripcion,estado,cual FROM con_t_trprendas WHERE referencia_id IN(".$referencias[0]['referencia_id']."";
for($i=1;$i<sizeof($referencias);$i++){
    $sql = $sql.",".$referencias[$i]['referencia_id']."";
}
$sql = $sql.")";
$listado = $wpdb->get_results( $sql, ARRAY_A);//133
for($i=0;$i<sizeof($listado);$i++){
    echo $listado[$i]['codigo']."  ".$listado[$i]['descripcion']."  ".$listado[$i]['estado']."  ".$listado[$i]['cual']."  "."<br>";
}
?>