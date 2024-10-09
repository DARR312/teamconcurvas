<?php 
$diasInforme = $_GET['diasInforme'];
global $wpdb;
// Array para llevar la cuenta de todas las referencias vendidas en los últimos 5 días
$referencias_totales_vendidas = [];

// Obtener la fecha actual en la zona horaria correcta
$timezone = new DateTimeZone('America/Bogota');
$fechados = wp_date('Y-m-d H:i:s', null, $timezone);

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

                // Obtener información de la referencia
                // $referencia_info = $wpdb->get_row("
                //     SELECT nombre, color, talla 
                //     FROM con_t_resumen 
                //     WHERE referencia_id = $referencia_id", ARRAY_A);

               
                // Formato: "Nombre Color Talla"
                // $referencia_nombre = $referencia_info['nombre'] . " " . $referencia_info['color'] . " " . $referencia_info['talla'];

                // Sumar la cantidad vendida a la referencia correspondiente (por día)
                if (!isset($referencias_vendidas[$referencia_id])) {
                    $referencias_vendidas[$referencia_id] = 0;
                }
                $referencias_vendidas[$referencia_id] += $cantidad_vendida;

                // Sumar la cantidad vendida al conteo total (últimos 5 días)
                if (!isset($referencias_totales_vendidas[$referencia_id])) {
                    $referencias_totales_vendidas[$referencia_id] = 0;
                }
                $referencias_totales_vendidas[$referencia_id] += $cantidad_vendida;
                
            }
        }
    }

}

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

    print_r($a);
    print_r($b);
// Ordenar las referencias vendidas en los últimos 5 días de mayor a menor
arsort($referencias_totales_vendidas);

// Mostrar el recuento total de las referencias vendidas en los últimos 5 días
echo "<h1>En los últimos ".$diasInforme." días se han vendido las siguientes referencias:</h1>";
foreach ($referencias_totales_vendidas as $referencia => $cantidad) {
    echo "<p>$referencia vendidas: $cantidad</p>";
}



?>