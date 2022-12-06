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
    $idfechaArray = $wpdb->get_results( "SELECT venta_id,pedido_item FROM con_t_ventas WHERE (`vendedor_id` = ".$valor.") AND (fecha_creada  BETWEEN  '".$fecha_start."' AND '".$fecha_end."')", ARRAY_A);
    $multiplicador = 1000;
    if($obtenidosArray[$j]['COUNT(*)']<30){$multiplicador = 500;}
    $comi = 0;
    $sin = 0;
    for ($i=0; $i <sizeof($idfechaArray) ; $i++) { 
        $jsonPedidon =  json_decode($idfechaArray[$i]['pedido_item']);
        $vant = (array)$jsonPedidon[0];
        $comi = $comi+($vant['cantidad']*$multiplicador);
        $sin = $sin+($vant['cantidad']*1000);
    }
    $comision=$comision+$comi;
    $sintecho = $sintecho+$sin;
    $html = $html."<p class='letra18pt-pc'>".$obtenidosArray[$j]['cast(fecha_creada as date)'].": ".$obtenidosArray[$j]['COUNT(*)']." Con techo: ".$comi."--- Sin techo: ".$sin."</p>";
}
echo "<p class='letra18pt-pc'>Con techo: ".$comision."--- Sin techo: ".$sintecho."</p>";
echo $html;
?>