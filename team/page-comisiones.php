<?php 	
$valor=$_GET['valor'];
global $wpdb;
//$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),`fecha_creada` FROM con_t_ventas WHERE (`vendedor_id` = ".$valor.") GROUP BY `fecha_creada`", ARRAY_A);
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),cast(fecha_creada as date) FROM con_t_ventas WHERE (`vendedor_id` = ".$valor.") GROUP BY cast(fecha_creada as date)", ARRAY_A);
//print_r($obtenidosArray);
$comision=0;
$sintecho = 0;
for($j=0;$j<sizeof($obtenidosArray);$j++){
    
    $fecha_start = $obtenidosArray[$j]['cast(fecha_creada as date)']." 00:00:00";
    $fecha_end = $obtenidosArray[$j]['cast(fecha_creada as date)']." 23:00:00";
    $idfechaArray = $wpdb->get_results( "SELECT venta_id FROM con_t_ventas WHERE (`vendedor_id` = ".$valor.") AND (fecha_entrega  BETWEEN  '".$fecha_start."' AND '".$fecha_end."')", ARRAY_A);
    $multiplicador = 1000;
    if($obtenidosArray[$j]['COUNT(*)']<30){$multiplicador = 500;}
    for ($i=0; $i <sizeof($idfechaArray) ; $i++) { 
        $ventasEfectivas = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_ventaitem WHERE (`venta_id` = ".$idfechaArray[$i]['venta_id'].") AND (estado_id = 'Entregado')", ARRAY_A);
        $comision = $comision+($ventasEfectivas[0]['COUNT(*)']*$multiplicador);
        $sintecho = $sintecho+($ventasEfectivas[0]['COUNT(*)']*1000);
    }
}
echo "<p class='letra18pt-pc'>Comisión con techo: ".$comision."--- Sin techo: ".$sintecho."</p>";;

?>