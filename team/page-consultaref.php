<?php 	
$valor=$_GET['valor'];
global $wpdb;
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