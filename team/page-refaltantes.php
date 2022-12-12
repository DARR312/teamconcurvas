<!doctype html>
<html lang="es" class="js csstransitions">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <title>Inicio</title>
    <!-------------------ICONS---------------->
	<link href="<?php echo get_template_directory_uri(); ?>/imagenes/iconos/concurvas.ico" rel="shortcut icon" type="image/x-icon">
	<!-------------------ICONS---------------->
    <!-------------------FUENTES---------------->
    <?php get_template_part('fuentes'); ?>
    <link href="<?php echo get_template_directory_uri(); ?>/fuentes/fuentes.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/letra.css" rel="stylesheet">
    <!-------------------FUENTES---------------->
    <!-------------------BOOTSTRAP---------------->
	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" async>
	<!-------------------BOOTSTRAP---------------->	
	<!-------------------barraMenu---------------->
	<link href="<?php echo get_template_directory_uri(); ?>/css/barramenu.css" rel="stylesheet" async>
	<link href="<?php echo get_template_directory_uri(); ?>/css/barrasuperior.css" rel="stylesheet" async>
	<!-------------------barraMenu---------------->	
	<!-------------------logo---------------->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/logo.css" async>
	<!-------------------logo---------------->
	<!-------------------botones---------------->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/botones.css" async>
	<!-------------------botones---------------->
	<!-------------------form---------------->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/form.css" async>
	<!-------------------form---------------->
	<style type="text/css">
		/*----------------------ON/OFF ------------------------------*/		
			@media only screen and  (min-width:992px){.tablet, .celular{display:none;}.pc{display: block;}}
			@media only screen and (max-width:991px) and  (min-width:768px){.pc, .celular{display:none;}.tablet{display: block;}}
			@media only screen and (max-width:767px) {.pc, .tablet{display:none;}.celular{display: block;}}
			.off{display:none !important;}
		/*----------------------ON/OFF------------------------------*/
		/*----------------------POSICIÓN------------------------------*/
			@media only screen and  (min-width:992px){
			.pc-izquierda-grande{margin-left: 5% !important;width: 50% !important;}.pc-izquierda-mediano{margin-left: 5% !important;width: 40% !important;}.pc-centrado-extraGrande{margin-left: 8% !important;width: 84% !important;}.pc-centrado-superGrande{margin-left: 15% !important;width: 70% !important;}.pc-centrado-grande{margin-left: 25% !important;width: 50% !important;}.pc-centrado-mediano{margin-left: 30% !important;width: 40% !important;}.pc-derecha-grande{margin-left: 45% !important;width: 50% !important;}.pc-derecha-mediano{margin-left: 55% !important;width: 40% !important;}.pc-centrado-mediano2{margin-left: 20% !important;width: 60% !important;}}
			
			@media only screen and  (max-width:991px) and  (min-width:768px){
			.tb-izquierda-grande{margin-left: 5% !important;width: 50% !important;}.tb-izquierda-mediano{margin-left: 5% !important;width: 40% !important;}.tb-centrado-superGrande{margin-left: 10% !important;width: 80% !important;}.tb-centrado-grande{margin-left: 20% !important;width: 60% !important;}.tb-centrado-mediano{margin-left: 30% !important;width: 40% !important;}.tb-derecha-grande{margin-left: 45% !important;width: 50% !important;}.tb-derecha-mediano{margin-left: 55% !important;width: 40% !important;}}
			@media only screen and  (max-width:767px){
			.mv-izquierda-grande{margin-left: 5% !important;width: 50% !important;}.mv-izquierda-mediano{margin-left: 5% !important;width: 40% !important;}.mv-centrado-superGrande{margin-left: 10% !important;width: 80% !important;}.mv-centrado-grande{margin-left: 20% !important;width: 60% !important;}.mv-centrado-mediano{margin-left: 30% !important;width: 40% !important;}.mv-derecha-grande{margin-left: 45% !important;width: 50% !important;}.mv-derecha-mediano{margin-left: 55% !important;width: 40% !important;}.mv-centrado-super-grande{margin-left: 5% !important;width: 90% !important;}.mv-centrado-grande2 {margin-left: 10% !important;width: 80% !important;}
			}
		/*----------------------POSICIÓN------------------------------*/
		</style>
        </head>
        <div class="container-fluid fijo" style="width: 84%;">

<?php 	
$timezone = new DateTimeZone( 'America/Bogota' );
$fechactual = wp_date('Y-m-d', null, $timezone );
$dia1 = wp_date('Y-m-d', strtotime('+1 day'), $timezone );
$dia2 = wp_date('Y-m-d', strtotime('+2 day'), $timezone );
$dia3 = wp_date('Y-m-d', strtotime('+3 day'), $timezone );
$dia4 = wp_date('Y-m-d', strtotime('+4 day'), $timezone );
$dia5 = wp_date('Y-m-d', strtotime('+5 day'), $timezone );
$dia6 = wp_date('Y-m-d', strtotime('+6 day'), $timezone );
$dia7 = wp_date('Y-m-d', strtotime('+7 day'), $timezone );
$dia8 = wp_date('Y-m-d', strtotime('+8 day'), $timezone );
$dia9 = wp_date('Y-m-d', strtotime('+9 day'), $timezone );
$dia10 = wp_date('Y-m-d', strtotime('+10 day'), $timezone );
global $wpdb;
$venta0 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega <= '".$fechactual."') AND ((estado = 'Sin empacar') OR (estado = 'No empacado'))", ARRAY_A);
$venta1 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia1."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta2 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia2."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta3 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia3."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta4 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia4."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta5 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia5."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta6 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia6."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta7 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia7."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta8 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia8."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta9 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia9."') AND ((estado = 'Sin empacar'))", ARRAY_A);
$venta10 = $wpdb->get_results( "SELECT pedido_item FROM con_t_ventas WHERE (fecha_entrega = '".$dia10."') AND ((estado = 'Sin empacar'))", ARRAY_A);

$ids = array();
for($i=0;$i<sizeof($venta0);$i++){
    $jsonPedido =  json_decode($venta0[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids, $jsonPedidon['referencia']);
    }    
}
$vals = array_count_values($ids);
$html= "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar hasta la fecha: </p></div>";
foreach ($vals as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}

$ids1 = array();
for($i=0;$i<sizeof($venta1);$i++){
    $jsonPedido =  json_decode($venta1[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia1."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta2);$i++){
    $jsonPedido =  json_decode($venta2[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia2."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta3);$i++){
    $jsonPedido =  json_decode($venta3[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia3."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta4);$i++){
    $jsonPedido =  json_decode($venta4[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia4."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta5);$i++){
    $jsonPedido =  json_decode($venta5[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia5."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta6);$i++){
    $jsonPedido =  json_decode($venta6[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia6."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta7);$i++){
    $jsonPedido =  json_decode($venta7[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia7."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta8);$i++){
    $jsonPedido =  json_decode($venta8[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia8."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta9);$i++){
    $jsonPedido =  json_decode($venta9[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia9."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
$ids1 = array();
for($i=0;$i<sizeof($venta10);$i++){
    $jsonPedido =  json_decode($venta10[$i]['pedido_item']);
    for ($j=1; $j < sizeof($jsonPedido) ; $j++) { 
        $jsonPedidon =  (array)$jsonPedido[$j];;
        array_push($ids1, $jsonPedidon['referencia']);
    } 
}
$vals1 = array_count_values($ids1);
$html= $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'> Prendas sin empacar para la fecha: ".$dia10."</p></div>";
foreach ($vals1 as $key => $value){
    $ref = $wpdb->get_results( "SELECT nombre,color,talla FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
    $html = $html."<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$ref[0]['nombre']." ".$ref[0]['color']." ".$ref[0]['talla']." : ".$value."</p></div>";
}
echo $html;
?>
</body>
</html>