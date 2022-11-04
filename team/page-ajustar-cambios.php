<?php
 global $wpdb;
 $cambios = $wpdb->get_results( "SELECT * FROM con_t_cambios", ARRAY_A);
 for ($i=0; $i < sizeof($cambios); $i++) { //°Diego Rodríguez°3229261615°Cll 33 No 6 - 9°Apto 1005°Bogotá
    $datosarray =  explode("°",$cambios[$i]['datos_cliente']);
    $objetocliente->nombre = $datosarray[1];
    $objetocliente->telefono = $datosarray[2];
    $objetocliente->direccion = $datosarray[3];
    $objetocliente->complemento = $datosarray[4];
    $objetocliente->ciudad = str_replace("%","",$datosarray[5]);
    $jsonCliente= json_encode($objetocliente,JSON_UNESCAPED_UNICODE);
    //$updated = $wpdb->update( "con_t_ventas", array('cliente_data ' => $jsonCliente), array( 'venta_id ' => $ventas[$i]['venta_id'] ) );
    $datos="UPDATE con_t_cambios SET  datos_cliente = '".$jsonCliente."' WHERE cambio_id = ".$cambios[$i]['cambio_id']."";
    echo $datos;
    $wpdb->query($datos);
 }
?>