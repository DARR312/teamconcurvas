<?php 
$diasInforme = $_GET['diasInforme'];
global $wpdb;
// Array para llevar la cuenta de todas las referencias vendidas en los últimos 5 días
$referencias_totales_vendidas = [];
$referencias_totales_separadas = [];

// Obtener la fecha actual en la zona horaria correcta
$timezone = new DateTimeZone('America/Bogota');
$fechados = wp_date('Y-m-d H:i:s', null, $timezone);

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

// Recorremos los últimos diasInforme días (incluyendo hoy)
for ($dia = 0; $dia < $diasInforme; $dia++) {
    // Calcular la fecha de inicio y fin para el día actual en el bucle
    $fecha_inicio = wp_date('Y-m-d 00:00:00', strtotime("-$dia day"), $timezone);
    $fecha_fin = wp_date('Y-m-d 23:59:59', strtotime("-$dia day"), $timezone);

    // Obtener todas las ventas del día
    $ventas = $wpdb->get_results("
        SELECT pedido_item 
        FROM con_t_ventas 
        WHERE fecha_creada BETWEEN '$fecha_inicio' AND '$fecha_fin'", ARRAY_A);

    // Array para llevar la cuenta de las referencias vendidas por día
    $referencias_vendidas = [];

    // Recorremos cada venta para extraer las referencias y cantidades
    foreach ($ventas as $venta) {
        $pedido_items = json_decode($venta['pedido_item'], true);

        // Recorremos cada item en el pedido
        foreach ($pedido_items as $item) {
            if (isset($item['referencia'])) {
                $referencia_id = $item['referencia'];
                $cantidad_vendida = isset($item['cantidad']) ? $item['cantidad'] : 1;

                // Sumar la cantidad vendida al conteo total 
                if (!isset($referencias_totales_vendidas[$referencia_id])) {
                    $referencias_totales_vendidas[$referencia_id] = 0;
                }
                $referencias_totales_vendidas[$referencia_id] += $cantidad_vendida;
                
            }
        }
    }

}



// Ordenar las referencias vendidas en los últimos 5 días de mayor a menor
arsort($referencias_totales_vendidas);

// Mostrar el recuento total de las referencias vendidas en los últimos 5 días
echo "<h1>En los últimos ".$diasInforme." días:</h1>";
foreach ($referencias_totales_vendidas as $referencia => $cantidad) {
      
    $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referencia."", ARRAY_A);
    $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referencia.") AND ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A); 
    $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referencia.") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);   
    $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referencia.") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
    $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referencia.") AND (estado = 'En satélite')", ARRAY_A);  
    $separados = $a[$referencia];//133
    $separadosCambios = $b[$referencia];//133
    $restantes = intval($fabrica[0]['COUNT(*)'])+intval($bodega[0]['COUNT(*)'])+intval($plaza[0]['COUNT(*)'])+intval($satel[0]['COUNT(*)'])-$separados-$separadosCambios;

    // Obtener información de la referencia
    $referencia_info = $wpdb->get_row("
        SELECT nombre, color, talla 
        FROM con_t_resumen 
        WHERE referencia_id = $referencia", ARRAY_A);

    $faltantes = $restantes - $cantidad; 
    
    // Formato: "Nombre Color Talla"
    $referencia_nombre = $referencia_info['nombre'] . " " . $referencia_info['color'] . " " . $referencia_info['talla'];


    echo "<p>$referencia_nombre se vendieron: $cantidad y hay disponibles: $restantes, vendias menos restantes: $faltantes </p>";
}



?>