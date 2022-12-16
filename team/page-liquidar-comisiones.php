<?php 	
$valor=$_GET['valor'];
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),cast(fecha_creada as date) FROM con_t_ventas WHERE (`vendedor_id` = ".$valor.") GROUP BY cast(fecha_creada as date)", ARRAY_A);
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
            if($vant['comision']=="0"){
                $comi = $comi+(intval($vant['cantidad'])*$multiplicador);
                $sin = $sin+(intval($vant['cantidad'])*1000);
                $vant['comision'] = intval($vant['cantidad'])*$multiplicador;
                $jsonPedidon[0] = $vant;
                $pedidoitemupdate = json_encode($jsonPedidon);                
                $valoru = str_replace("\\","",$pedidoitemupdate);
                $valord = str_replace("<","{",$valoru);
                $pedidoitemupdate = str_replace(">","}",$valord);
                $datos = "UPDATE con_t_ventas SET pedido_item = '".$pedidoitemupdate."'   WHERE venta_id = ".$idfechaArray[$i]['venta_id']."";
                $wpdb->query($datos);
            }
        
    }
    $comision=$comision+$comi;
    $sintecho = $sintecho+$sin;
    $html = $html."<p class='letra18pt-pc'>".$obtenidosArray[$j]['cast(fecha_creada as date)'].": ".$obtenidosArray[$j]['COUNT(*)']." Con techo: ".$comi."--- Sin techo: ".$sin."</p>";
}
echo "<p class='letra18pt-pc'>Comisión página -> Con techo: ".$comision."--- Sin techo: ".$sintecho."</p>";
echo $html;
$valor=$_GET['valor'];
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),cast(fecha_creada as date),valor_total FROM con_t_ventasplaza WHERE (`vendedor_id` = ".$valor.") GROUP BY cast(fecha_creada as date)", ARRAY_A);
$tam =  sizeof($obtenidosArray);
$totalventa=0;
for($j=0;$j<$tam;$j++){     
    $fecha_start = $obtenidosArray[$j]['cast(fecha_creada as date)']." 00:00:00";
    $fecha_end = $obtenidosArray[$j]['cast(fecha_creada as date)']." 23:00:00";
    $ventassincomisionpaga = $wpdb->get_results( "SELECT ID,valor_total FROM con_t_ventasplaza WHERE (`vendedor_id` = ".$valor.") AND (`comision_paga` = 'No') AND (fecha_creada  BETWEEN  '".$fecha_start."' AND '".$fecha_end."') ", ARRAY_A);
    $tama =  sizeof($ventassincomisionpaga);
    for ($i=0; $i < $tama; $i++) { 
        $totalventa = $totalventa + intval($ventassincomisionpaga[$i]['valor_total']);
        $comisiondia = intval($ventassincomisionpaga[$i]['valor_total'])/100;
        $htmll = $htmll."<p class='letra18pt-pc'>".$obtenidosArray[$j]['cast(fecha_creada as date)']."-> Total ventas: ".$obtenidosArray[$j]['COUNT(*)']." Total comisiones sin pagar: ".$comisiondia."</p>";
        $datos = "UPDATE con_t_ventasplaza SET comision_paga = 'Si'   WHERE ID = ".$ventassincomisionpaga[$i]['ID']."";
        $wpdb->query($datos);
    }   
}
$comision = $totalventa/100;
echo "<p class='letra18pt-pc'>Comisión local -> ".$comision."</p>";
echo $htmll;
?>