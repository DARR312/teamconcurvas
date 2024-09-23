<?php 
$valor = $_GET['valor'];
global $wpdb;

// Obtener la fecha actual en la zona horaria correcta
$timezone = new DateTimeZone('America/Bogota');
$fechados = wp_date('Y-m-d H:i:s', null, $timezone);

// Obtener los vendedores
$vendedores = $wpdb->get_results("SELECT DISTINCT vendedor_id FROM con_t_ventas ORDER BY vendedor_id ASC", ARRAY_A);

// Recorremos los últimos 5 días (incluyendo hoy)
for ($dia = 0; $dia < 5; $dia++) {
    // Calcular la fecha de inicio y fin para el día actual en el bucle
    $fecha_inicio = wp_date('Y-m-d 00:00:00', strtotime("-$dia day"), $timezone);
    $fecha_fin = wp_date('Y-m-d 23:59:59', strtotime("-$dia day"), $timezone);

    // Mostrar el encabezado de ventas para el día
    echo "<h2>Ventas del día: " . wp_date('Y-m-d', strtotime("-$dia day"), $timezone) . "</h2>";

    // Recorremos cada vendedor
    for ($i = 0; $i < sizeof($vendedores); $i++) {
        // Obtener el nombre del vendedor
        $vendedornombre = $wpdb->get_results("SELECT display_name FROM con_users WHERE ID = " . $vendedores[$i]['vendedor_id'], ARRAY_A);
        echo $vendedornombre[0]['display_name'] . " ha vendido: ";

        // Contar las ventas del vendedor en el día específico
        $ventas = $wpdb->get_results("
            SELECT COUNT(*) AS total 
            FROM con_t_ventas 
            WHERE (fecha_creada BETWEEN '$fecha_inicio' AND '$fecha_fin') 
            AND vendedor_id = " . $vendedores[$i]['vendedor_id'], ARRAY_A);

        echo $ventas[0]['total'] . " ventas.<br>";
    }

    // Mostrar el total de ventas del día
    $total_ventas = $wpdb->get_results("
        SELECT COUNT(*) AS total 
        FROM con_t_ventas 
        WHERE fecha_creada BETWEEN '$fecha_inicio' AND '$fecha_fin'", ARRAY_A);

    echo "Total de ventas del día: " . $total_ventas[0]['total'] . "<br><br>";
}

?>