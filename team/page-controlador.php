<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
$funcion=$_GET['funcion']; 
$valor=$_GET['valor'];
$valor2=$_GET['valor2'];
$valor3=$_GET['valor3'];
$valor4=$_GET['valor4'];
$valor5=$_GET['valor5'];
$valor6=$_GET['valor6'];
$valor7=$_GET['valor7'];
$valor8=$_GET['valor8'];
$valor9=$_GET['valor9'];
$valor10=$_GET['valor10'];
$valor11=$_GET['valor11'];
$id=$_GET['id'];
$nombre=$_GET['nombre'];
$telefono=$_GET['telefono'];
$dir1=$_GET['dir1'];
$comp1=$_GET['comp1'];
$ciudad1=$_GET['ciudad1'];
$color=$_GET['color'];
$talla=$_GET['talla'];
$link=$_GET['link'];
$detal=$_GET['detal'];
$mayor=$_GET['mayor'];
$categoria=$_GET['categoria'];
$columna=$_GET['columna'];
$tabla=$_GET['tabla'];
$tipo=$_GET['tipo'];
$condicion=$_GET['condicion'];
function permisosPrincipales(){
    $user_info = wp_get_current_user();
    $user_level = $user_info->user_level;
    $permi = "";
    global $wpdb;
    $permisos = $wpdb->get_results( "SELECT permiso_id FROM con_t_rolespermisos WHERE level = ".$user_level."", ARRAY_A  );
    print_r($permisos);
    foreach ($permisos as $v1) {
        foreach ($v1 as $v2) {
            if($v2 == 1 || $v2 == 2 || $v2 == 3 || $v2 == 4 || $v2 == 37 || $v2 == 38 || $v2 == 46 || $v2 == 47){
                $permi = $permi.",".$v2;
            }
        }
    }
    echo $permi;     
}

function permisosVentas(){
    $user_info = wp_get_current_user();
    $user_level = $user_info->user_level;
    $permi = "";
    global $wpdb;
    $permisos = $wpdb->get_results( "SELECT permiso_id FROM con_t_rolespermisos WHERE level = ".$user_level."", ARRAY_A  );
    foreach ($permisos as $v1) {
        foreach ($v1 as $v2) {
            if($v2 == 3 || $v2 == 5 || $v2 == 6 || $v2 == 7 || $v2 == 8 || $v2 == 9 || $v2 == 10 || $v2 == 11 || $v2 == 12 || $v2 == 13 || $v2 == 14 || $v2 == 15 || $v2 == 16 || $v2 == 26  || $v2 == 27 ){
                $permi = $permi.",".$v2;
            }
        }
    }  
    echo $permi;
}

function permisosCambios(){
    $user_info = wp_get_current_user();
    $user_level = $user_info->user_level;
    $permi = "";
    global $wpdb;
    $permisos = $wpdb->get_results( "SELECT permiso_id FROM con_t_rolespermisos WHERE level = ".$user_level."", ARRAY_A  );
    foreach ($permisos as $v1) {
        foreach ($v1 as $v2) {
            if($v2 == 3 || $v2 == 5 || $v2 == 6 || $v2 == 7 || $v2 == 8 || $v2 == 9 || $v2 == 10 || $v2 == 11 || $v2 == 12 || $v2 == 13 || $v2 == 14 || $v2 == 15 || $v2 == 16 || $v2 == 26){
                $permi = $permi.",".$v2;
            }
        }
    }
    echo $permi;
}

function ciudades(){
    global $wpdb;
    $todas = "";
    $ciudadesTodas= $wpdb->get_results( "SELECT ciudad FROM con_t_ciudades", ARRAY_A  );
    foreach ($ciudadesTodas as $v1) {
        foreach ($v1 as $v2) {
            $todas = $todas.",".$v2;
        }
    }
    echo $todas;     
}

function guardarCliente($nombre,$telefono,$dir1,$comp1,$ciudad1,$correo,$documento){
    $tele = intval($telefono);
    $valores = array("nombre" => $nombre , "telefono" => $tele , "direccion_1" => $dir1 , "complemento_1" => $comp1 , "ciudad_1" => $ciudad1 , "correo" => $correo , "documento" => $documento);
    global $wpdb;
    $wpdb->insert("con_t_clientes", $valores);
    $lastId = $wpdb->get_results( "SELECT MAX(cliente_id) as id FROM con_t_clientes");
    echo $lastId[0]->id;
}

function clientesEncontrados($telefono){
    global $wpdb;
    $todas = "";
    $clientesTodas= $wpdb->get_results( "SELECT nombre, direccion_1, complemento_1, ciudad_1, cliente_id FROM con_t_clientes  WHERE telefono = ".$telefono."", ARRAY_A  );
    if($clientesTodas){
        foreach ($clientesTodas as $v1) {
            $todas = $todas."$".$v1['nombre']."%".$v1['direccion_1']."%".$v1['cliente_id']."%".$v1['complemento_1']."%".$v1['ciudad_1'];
        }
    }else{
        $todas = "NA";
    }
    
    echo $todas;     
}

function permisosInventario(){
    $user_info = wp_get_current_user();
    $user_level = $user_info->user_level;
    $permi = "";
    global $wpdb;
    $permisos = $wpdb->get_results( "SELECT permiso_id FROM con_t_rolespermisos WHERE level = ".$user_level."", ARRAY_A  );
    foreach ($permisos as $v1) {
        foreach ($v1 as $v2) {
            if($v2 == 17 || $v2 == 18 || $v2 == 19 || $v2 == 20 || $v2 == 21 || $v2 == 22 || $v2 == 23 || $v2 == 24 || $v2 == 25 || $v2 == 28 || $v2 == 29 || $v2 == 30  || $v2 == 31  || $v2 == 32 || $v2 == 33 || $v2 == 34 || $v2 == 35 || $v2 == 36 || $v2 == 37 || $v2 == 38 || $v2 == 57){
                $permi = $permi.",".$v2;
            }
        }
    }
    echo $permi;     
}

function referenciaNueva($nombre,$color,$talla,$link,$detal,$mayor,$categoria){
    $detaloPrecio = intval($detal);
    $mayorPrecio = intval($mayor);
    $valores = array("nombre" => $nombre , "color" => $color , "talla" => $talla , "foto_link" => $link , "precio_detal" => $detaloPrecio, "precio_mayorista" => $mayorPrecio,  "categoria_id" => $categoria);
    global $wpdb;
    $rows = $wpdb->insert("con_t_resumen", $valores);

    echo $rows;
}

function obtenerDatajson($columna,$tabla,$tipo,$columnacondicion,$condicion){
    $obtenidos = "";
    global $wpdb;
    if($tipo == "valoresconcondicion"){
        $condicion =str_replace('\\', '', $condicion);
        // echo "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion." = ".$condicion."";
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion." = ".$condicion."", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE);
    }
    if($tipo == "variasfilasunicas"){
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla."", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE);
    }
    if($tipo=="filasunicas"){
        $obtenidosArray = $wpdb->get_results( "SELECT DISTINCT ".$columna." FROM ".$tabla." ORDER BY ".$columna." ASC", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE);
    }
    if($tipo == "variasfilasunicasAlfabetico"){
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." ORDER BY ".$columnacondicion." ASC", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE);
    }
    if($tipo=="Between"){
        $condicion =str_replace('\\', '', $condicion);
        //echo
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion." BETWEEN ".$condicion."", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE);       
    } 
    if($tipo=="Like"){
        // echo $condicion;
        $condicion =str_replace('\\', '', $condicion);
        // echo $condicion;
        // echo "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion." LIKE  '%".$condicion."%'"
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion." LIKE  '%".$condicion."%'", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE); 
    }
    if($tipo=="variasCondiciones"){
        $columnacondicion =str_replace('\\', '', $columnacondicion);
        // echo "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion."";
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$columnacondicion."", ARRAY_A);
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE); 
    }
    if($tipo=='ultimo'){
        $obtenidosArray = $wpdb->get_results( "SELECT MAX(".$columna.") as id FROM ".$tabla."");
        echo json_encode($obtenidosArray,JSON_UNESCAPED_UNICODE); 
    }
    
}

function obtenerData($columna,$tabla,$tipo,$valor,$valor2){
    $obtenidos = "";
    global $wpdb;
    if($tipo == "unico"){
        $obtenidosArray = $wpdb->get_results( "SELECT DISTINCT ".$columna." FROM ".$tabla." ORDER BY ".$columna." ASC", ARRAY_A);
        $controlador = 0;
        $contador = 0;
        while($controlador == 0){
            if($obtenidosArray[$contador][$columna]){
                $obtenidos = $obtenidos.",".$obtenidosArray[$contador][$columna];
                $contador++;
            }else{$controlador=1;}
        }
        echo $obtenidos;
    }
    if($tipo == "varios"){
        $componentes = explode(',', $columna);
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." ORDER BY ".$componentes[1]." ASC", ARRAY_A);
        $controlador = 0;
        $retorno = "";
        $contador = 0;
        $crear = 0;
        while($controlador == 0){
           if($obtenidosArray[$contador][$componentes[0]]){
                $retorno=$retorno.",".$obtenidosArray[$contador][$componentes[0]]."%".$obtenidosArray[$contador][$componentes[1]]."%".$obtenidosArray[$contador][$componentes[2]]."%".$obtenidosArray[$contador][$componentes[3]];
            }else{
                $controlador=1;
                $crear = 1;
            }
             $contador++;
        }
        echo $retorno;
    }
    if($tipo=="row"){
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$valor." = '".$valor2."'", ARRAY_A);
        echo $obtenidosArray[0][$columna];
    }
    if($tipo=="rowVarios"){
        global $wpdb;
        $obtenidosArray = $wpdb->get_results( "SELECT ".$columna." FROM ".$tabla." WHERE ".$valor." = '".$valor2."'", ARRAY_A);
        $datos = explode(",",$columna);
        $devolver="";
        for($j=0;$j<sizeof($obtenidosArray);$j++){
            for($i=0;$i<sizeof($datos);$i++){
                $devolver=$devolver."°".$obtenidosArray[$j][$datos[$i]];
            }
            $devolver = $devolver."%";
        }
        echo $devolver;
    }
    if($tipo=="ultimo"){
        global $wpdb;
        $obtenidos = $wpdb->get_results( "SELECT MAX(".$columna.") as id FROM ".$tabla."");
        echo $obtenidos[0]->id;
    }
    if($tipo=="todas"){
        global $wpdb;
        $obtenidos = $wpdb->get_results( "SELECT * FROM  ".$tabla." WHERE 1");
        echo json_encode($obtenidos);
    }
}

function nuevoCodigo($tipo,$valor){
    global $wpdb;
    if($tipo == "referencia"){
        $obtenidosArray = $wpdb->get_results( "SELECT nombre, codigo FROM con_t_codigosnombes", ARRAY_A);
        $controlador = 0;
        $contador = 0;
        $crear = 0;
        while($controlador == 0){
           if($obtenidosArray[$contador][nombre]){
                if($obtenidosArray[$contador][nombre] == $valor){
                    $controlador=1;
                }
            }else{
                $controlador=1;
                $crear = 1;
            }
             $contador++;
        }
        if($crear == 1){
            $codigo = "";
            $banderaverde = 0;
            $controlador = 0;
            $contador = 0;
            $primer = 0;
            $segundo = 1;
            $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
            while($controlador == 0){
                if($obtenidosArray[$contador][codigo]){
                    if($obtenidosArray[$contador][codigo] == $codigo){
                        $segundo++;
                        if($segundo == strlen($valor)){
                            $primer++;
                            $segundo = $primer + 1;
                            $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
                            $contador = 0;
                        }else{
                            $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
                            $contador = 0;
                        }
                    }else{$contador++;}
                }else{
                    $controlador=1;
                    $valores = array("nombre" => $valor , "codigo" => $codigo);
                    $rows = $wpdb->insert("con_t_codigosnombes", $valores);
                }
            }
        }
    }
    if($tipo == "color"){
        $obtenidosArray = $wpdb->get_results( "SELECT color, codigo FROM con_t_codigoscolores", ARRAY_A);
        $controlador = 0;
        $contador = 0;
        $crear = 0;
        while($controlador == 0){
           if($obtenidosArray[$contador][color]){
                if($obtenidosArray[$contador][color] == $valor){
                    $controlador=1;
                }
            }else{
                $controlador=1;
                $crear = 1;
            }
             $contador++;
        }
        if($crear == 1){
            $primer = 0;
            $segundo = 1;
            $codigo = "";
            $cambiar = 0;
            for($contemos = 0;$contemos < strlen($valor);$contemos++){
                //echo $valor[$contemos];
                if($valor[$contemos]==" "){
                    $primer = 0;
                    $segundo = $contemos+1;
                    $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
                    $cambiar = 1;
                }
            }
            if($cambiar == 0){
                $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
            }
            $banderaverde = 0;
            $controlador = 0;
            while($controlador == 0){
                if($obtenidosArray[$contador][codigo]){
                    if($obtenidosArray[$contador][codigo] == $codigo){
                        $segundo++;
                        if($segundo == strlen($valor)){
                            $primer++;
                            $segundo = $primer + 1;
                            $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
                            $contador = 0;
                        }else{
                            $codigo = strtoupper($valor[$primer]).strtoupper($valor[$segundo]);
                            $contador = 0;
                        }
                    }else{$contador++;}
                }else{
                    $controlador=1;
                    $valores = array("color" => $valor , "codigo" => $codigo);
                    $rows = $wpdb->insert("con_t_codigoscolores", $valores);
                }
            }
        }
    }
    
}

function nuevaMarquilla($valor){//,169°America°Canela°LXL°23,167°America°Negro°LXL°45,5°56
    global $wpdb;
    $componentes = explode(",",$valor);
    $long =  sizeof($componentes)-1;
    $corteSatelite = explode("°",$componentes[$long]);
    $corte = $corteSatelite[0];
    $satelite = $corteSatelite[1]; 
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    $unicos = explode("°",$componentes[1]);
    //print_r($unicos);
    $referenciaId = $unicos[0];
    $referenciaName = $unicos[1];
    $color = $unicos[2];
    $talla = $unicos[3];
    $cantidad = $unicos[4];
    $codigoColor = $wpdb->get_results( "SELECT codigo FROM con_t_codigoscolores WHERE color = '".$color."'", ARRAY_A);
    $colorCodigo = $codigoColor[0][codigo];
    $datos = "INSERT INTO con_t_trprendas ( codigo,codigoshow,referencia_id, estado, cual,fecha_cambio,descripcion) VALUES ('L".$corte.$colorCodigo."1D".$cantidad."S".$satelite."','L".$corte.$colorCodigo."1D".$cantidad."S".$satelite."','".$referenciaId."', 'En satélite', '".$satelite."','".$fecha."', '".$referenciaName." ".$color." ".$talla."')";
    $imprimir = "<div id='marquillas'><table border='1'><tr><th>Codigo</th><th>Descripción</th></tr><tr><td>L".$corte.$colorCodigo."1D".$cantidad."S".$satelite."</td><td>".$referenciaName." ".$color."</td></tr>";
    for($i=1;$i < $long;$i++){
        $unicos = explode("°",$componentes[$i]);
        $referenciaId = $unicos[0];
        $referencia = $unicos[1];
        $color = $unicos[2];
        $talla = $unicos[3];
        $cantidad = $unicos[4];
        $codigoColor = $wpdb->get_results( "SELECT codigo FROM con_t_codigoscolores WHERE color = '".$color."'", ARRAY_A);
        $colorCodigo = $codigoColor[0][codigo];
        $cantidadRefere = $wpdb->get_results( "SELECT cantidad FROM con_t_resumen WHERE referencia_id = '".$referenciaId."'", ARRAY_A);
        $cantidadNueva = $cantidadRefere[0][cantidad]+$cantidad;
        $updated = $wpdb->update( "con_t_resumen", array('cantidad' => $cantidadNueva), array( 'referencia_id' => $referenciaId ) );
        if($i==1){
           for($j=2;$j<=$cantidad;$j++){
                $datos = $datos.",('L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."','L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."','".$referenciaId."', 'En satélite', '".$satelite."','".$fecha."', '".$referenciaName." ".$color." ".$talla."')";
                $imprimir = $imprimir."<tr><td>L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."</td><td>".$referenciaName." ".$color."</td></tr>";
            } 
        }else{
            for($j=1;$j<=$cantidad;$j++){
                $datos = $datos.",('L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."','L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."','".$referenciaId."','En satélite', '".$satelite."','".$fecha."', '".$referenciaName." ".$color." ".$talla."')";
                $imprimir = $imprimir."<tr><td>L".$corte.$colorCodigo.$j."D".$cantidad."S".$satelite."</td><td>".$referenciaName." ".$color."</td></tr>";
            }
        }
        
    }
   $imprimir=$imprimir."</table></div>";

   $wpdb->query($datos);
   echo $imprimir;
}

function cambiarEstadoprendas($valor,$valor2,$nombre,$id){
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    global $wpdb;
    $obtenidosArray = $wpdb->get_results( "SELECT estado FROM con_t_estadoprendas WHERE ID = ".$valor2."", ARRAY_A);
    $datos="UPDATE con_t_trprendas SET  estado = '".$obtenidosArray[0]['estado']."', fecha_cambio = '".$fecha."', cual = '".$nombre."' WHERE codigo IN (";
    $datos2="SELECT ID FROM con_t_trprendas WHERE codigo IN (";
    $componentes = explode(",",$valor);
    $long =  sizeof($componentes)-2;
    for($i=0;$i < $long;$i++){
        if($i==0){ 
            $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
            $datos = $datos."'".$datosSinEspacio."'";
            $datos2 = $datos2."'".$componentes[$i]."'";
            //$referenciPrenda = $wpdb->get_results( "SELECT referencia_id FROM con_t_trprendas WHERE codigo = ".$componentes[$i]."", ARRAY_A);
        }
        else{ 
            $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
            $datos = $datos.",'".$datosSinEspacio."'"; 
            $datos2 = $datos2.",'".$componentes[$i]."'";
           /* if($valor2=="En Plaza de las américas"){
                $referenciPrenda = $wpdb->get_results( "SELECT referencia_id FROM con_t_trprendas WHERE codigo = ".$componentes[$i]."", ARRAY_A);
                $cantidad=$wpdb->get_results("SELECT cantidad FROM con_t_resumen WHERE referencia_id =".$referenciPrenda."", ARRAY_A);
                $cantidadNueva = $cantidad-1;
                $updated = $wpdb->update( "con_t_resumen", array('cantidad' => $cantidadNueva), array( 'referencia_id' => $item[1] ) );
            }*/
        }
    }
     $datos = $datos.")";
     $datos2 = $datos2.")";
     echo $datos;
     $wpdb->query($datos);
    $resultado = $wpdb->get_results( $datos2, ARRAY_A);
    $long =  sizeof($resultado);
    $datos3 = "INSERT INTO con_t_estadostr ( prenda_id, estado_cambio, cual_cambio, usuario_id, fecha_hora) VALUES (".$resultado[0]['ID'].",".$obtenidosArray[0]['estado'].", '".$nombre."', ".$id.",'".$fecha."')";
    for($i=1;$i < $long;$i++){
        $datos3 = $datos3.",(".$resultado[$i]['ID'].",".$obtenidosArray[0]['estado'].", '".$nombre."', ".$id.",'".$fecha."')";
    }
    $wpdb->query($datos3);
}

function cambiarEstadoprenda($valor,$valor2,$nombre,$id){
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    global $wpdb;
    $obtenidosArray = $wpdb->get_results( "SELECT estado FROM con_t_estadoprendas WHERE ID = ".$valor2."", ARRAY_A);
    $datos="UPDATE con_t_trprendas SET  estado = '".$obtenidosArray[0]['estado']."', fecha_cambio = '".$fecha."', cual = '".$nombre."', complemento_estado = '".$id."' WHERE codigo IN (";
    $datos2="SELECT ID FROM con_t_trprendas WHERE codigo IN (";
    $componentes = explode(",",$valor);
    $long =  sizeof($componentes);
    for($i=0;$i < $long;$i++){
        if($i==0){ 
            $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
            $datos = $datos."'".$datosSinEspacio."'"; 
            $datos2 = $datos2."'".$componentes[$i]."'";
        }
        else{ 
            $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
            $datos = $datos.",'".$datosSinEspacio."'"; 
            $datos2 = $datos2.",'".$componentes[$i]."'";
        }
    }
     $datos = $datos.")";
     $datos2 = $datos2.")";
     echo $datos;
     $wpdb->query($datos);
    $resultado = $wpdb->get_results( $datos2, ARRAY_A);
    $long =  sizeof($resultado);
    $datos3 = "INSERT INTO con_t_estadostr ( prenda_id, estado_cambio, cual_cambio, usuario_id, fecha_hora) VALUES (".$resultado[0]['ID'].",".$obtenidosArray[0]['estado'].", '".$nombre."', ".$id.",'".$fecha."')";
    for($i=1;$i < $long;$i++){
        $datos3 = $datos3.",(".$resultado[$i]['ID'].",".$obtenidosArray[0]['estado'].", '".$nombre."', ".$id.",'".$fecha."')";
    }
    $wpdb->query($datos3);
}

function restarInventario($valor){
    global $wpdb;
    $componentes = explode(",",$valor);
    $long =  sizeof($componentes);
    for($i=0;$i < ($long-1);$i++){
        $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
        $cantidadInicial = $wpdb->get_results( "SELECT cantidad FROM con_t_resumen WHERE referencia_id = ".$datosSinEspacio."", ARRAY_A);
        $cantidadNueva = --$cantidadInicial[0]['cantidad'];
        $cambio = $wpdb->query("UPDATE con_t_resumen SET cantidad = ".$cantidadNueva." WHERE referencia_id = ".$datosSinEspacio."");
        echo "UPDATE con_t_resumen SET cantidad = ".$cantidadNueva." WHERE referencia_id = ".$datosSinEspacio."";
        echo $cambio;
    }
}

function disponibles(){
    global $wpdb;
    $datos0 = "SELECT referencia_id, nombre, color, talla, precio_detal FROM con_t_resumen WHERE cantidad > 0 ORDER BY nombre ASC";
    $disponibles = $wpdb->get_results( $datos0, ARRAY_A);
    $long =  sizeof($disponibles);
    $datos="";
    for($i=0;$i < $long;$i++){
        $datos = $datos.$disponibles[$i]['referencia_id']."!".$disponibles[$i]['nombre']." ".$disponibles[$i]['color']." ".$disponibles[$i]['talla']."!".$disponibles[$i]['precio_detal'].",";
    }
    echo $datos;
}

function referenciasrodas(){
    global $wpdb;
    $datos0 = "SELECT referencia_id, nombre, color, talla, precio_detal FROM con_t_resumen ORDER BY nombre ASC";
    $disponibles = $wpdb->get_results( $datos0, ARRAY_A);
    $long =  sizeof($disponibles);
    $datos="<option class='remover' value='NA'>NA</option>";
    for($i=0;$i < $long;$i++){
        //<option class="remover" value="112%Londres Azul Cielo XS%140000">Londres Azul Cielo XS</option>
        $datos = $datos."<option class='remover' value='".$disponibles[$i]['referencia_id']."°".$disponibles[$i]['nombre']."°".$disponibles[$i]['color']."°".$disponibles[$i]['talla']."'>".$disponibles[$i]['nombre']." ".$disponibles[$i]['color']." ".$disponibles[$i]['talla']."</option>";
        //$datos = $datos.$disponibles[$i][referencia_id]."!".$disponibles[$i][nombre]." ".$disponibles[$i][color]." ".$disponibles[$i][talla]."!".$disponibles[$i][precio_detal].",";
    }
    echo $datos;
}

function agregarventa($idCliente,$datosCliente,$pedido,$precio,$notas,$origen,$fecha,$idUsuario,$itempedido){
    $vals = explode("¬",$valor);
    $fechaentregaarray = explode("/",$fecha);
    $fechaentrega = $fechaentregaarray[2]."-".$fechaentregaarray[0]."-".$fechaentregaarray[1]." 00:00:00";
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fechacreada = wp_date('Y-m-d H:i:s', null, $timezone );
    $pedir = $vals[7];
    $datosss = str_replace("\\","",$datosCliente);
    $datosssss = str_replace("<","{",$datosss);
    $datosCliente = str_replace(">","}",$datosssss);
    $datosss = str_replace("\\","",$pedido);
    $datosssss = str_replace("<","{",$datosss);
    $pedido = str_replace(">","}",$datosssss);
    $datosss = str_replace("\\","",$itempedido);
    $datosssss = str_replace("<","{",$datosss);
    $itempedido = str_replace(">","}",$datosssss);
    $valores = array("fecha_creada" => $fechacreada , "cliente_id" => $idCliente , "notas" => $notas , "origen" => $origen , "fecha_entrega" => $fechaentrega, "estado" => "Sin empacar", "vendedor_id" => $idUsuario, "usuario_id" => $idUsuario, "datos_cliente" => $datosCliente, "pedido" => $pedido, "pedido_item" => $itempedido);
    global $wpdb;
    $wpdb->insert("con_t_ventas", $valores);
    $lastId = $wpdb->get_results( "SELECT MAX(venta_id) as id FROM con_t_ventas");
    echo $lastId[0]->id;
}


function agregarcambio($venta_id,$datos_cliente,$prendasSalen,$pedidoitem,$notas,$excedente,$fecha_entrega,$idUsuario){// venta_id+"¬"+direccion+"¬"+pedido+"¬"+notas+"¬"+excedente+"¬"+fecha_entrega+"¬"+vendedor_id+"¬"+usuarioactual_id
    $fechaentregaarray = explode("/",$fecha_entrega);
    $fechaentrega = $fechaentregaarray[2]."-".$fechaentregaarray[0]."-".$fechaentregaarray[1]." 00:00:00";
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fechacreada = wp_date('Y-m-d H:i:s', null, $timezone );
    $datosss = str_replace("\\","",$datos_cliente);
    $datosssss = str_replace("<","{",$datosss);
    $datos_cliente = str_replace(">","}",$datosssss);
    
    $datosss = str_replace("\\","",$pedidoitem);
    $datosssss = str_replace("<","{",$datosss);
    $pedido_item = str_replace(">","}",$datosssss);
    global $wpdb;
    $datos = "INSERT INTO con_t_cambios (fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,pedido_item,cliente_ok,notas,excedente,fecha_entrega,estado,vendedor_id,usuarioactual_id) VALUES  ('".$fechacreada."','".$venta_id."','".$datos_cliente."','".$prendasSalen."','-','".$pedido_item."', '0',".$notas.",".$excedente.",'".$fechaentrega."','Sin empacar',".$idUsuario.",".$idUsuario.")";
    $wpdb->query($datos);
    $lastId = $wpdb->get_results( "SELECT MAX(cambio_id) as id FROM con_t_cambios");
    echo $lastId[0]->id;
}


function ordenesventa($valor,$valor2,$valor3,$valor4,$valor5){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE venta_id =".$valor." ", ARRAY_A  );
        //print_r($ventasTodas);
        if($ventasTodas){
            foreach ($ventasTodas as $v1) {
                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }else{ 
        if($valor4 != "0"){ 
            if($valor2 == "0"){
                if($valor3 == "0"){
                    $fechaventagaarray = explode("/",$valor4);
                    $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                    $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                    $todas = "";
                    $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."'", ARRAY_A  );
                    //print_r($ventasTodas);
                    if($ventasTodas){
                        foreach ($ventasTodas as $v1) {
                            $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                        }
                    }else{
                        $todas = "NA";
                    }
                    echo $todas;
                }else{
                    $fechaventagaarray = explode("/",$valor4);
                    $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                    $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                    $todas = "";
                    $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (usuario_id = '".$valor3."')  AND (fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                    //print_r($ventasTodas);
                    if($ventasTodas){
                        foreach ($ventasTodas as $v1) {
                            $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                        }
                    }else{
                        $todas = "NA";
                    }
                    echo $todas;
                }
            }else{ 
                if($valor3 == "0"){
                    $fechaventagaarray = explode("/",$valor4);
                    $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                    $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                    $todas = "";
                    $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (estado = '".$valor2."')  AND (fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                    //print_r($ventasTodas);
                    if($ventasTodas){
                        foreach ($ventasTodas as $v1) {
                            $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                        }
                    }else{
                        $todas = "NA";
                    }
                    echo $todas;
                }else{
                    $fechaventagaarray = explode("/",$valor4);
                    $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                    $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                    $todas = "";
                    $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (usuario_id = '".$valor3."')  AND (estado = '".$valor2."')  AND (fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                    //print_r($ventasTodas);
                    if($ventasTodas){
                        foreach ($ventasTodas as $v1) {
                            $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                        }
                    }else{
                        $todas = "NA";
                    }
                    echo $todas;
                }
            }
        }else{ 
            if($valor5){
                if($valor2 == "0"){ 
                    if($valor3 == "0"){
                        $fechaventagaarray = explode("/",$valor5);
                        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE fecha_entrega  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."'", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }else{
                        $fechaventagaarray = explode("/",$valor5);
                        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (usuario_id = '".$valor3."')  AND (fecha_entrega  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }
                }else{
                    if($valor3 == "0"){
                        $fechaventagaarray = explode("/",$valor5);
                        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (estado = '".$valor2."')  AND (fecha_entrega  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }else{
                        $fechaventagaarray = explode("/",$valor5);
                        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
                        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (usuario_id = '".$valor3."')  AND (estado = '".$valor2."')  AND (fecha_entrega  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }
                }
            }else{
                if($valor2 == "0"){
                    if($valor3 == "0"){
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE estado not IN ('Entregado','Cancelado') ", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }else{
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE usuario_id = '".$valor3."'", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }
                }else{ 
                    if($valor3 == "0"){
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE estado = '".$valor2."'", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }else{
                        $todas = "";
                        $ventasTodas = $wpdb->get_results( "SELECT venta_id, fecha_creada, datos_cliente, direccion, pedido, cliente_ok, notas, origen, fecha_entrega, estado, vendedor_id, usuario_id, cliente_id FROM con_t_ventas  WHERE (estado = '".$valor2."') AND (usuario_id = '".$valor3."')", ARRAY_A  );
                        //print_r($ventasTodas);
                        if($ventasTodas){
                            foreach ($ventasTodas as $v1) {
                                $todas = $todas.$v1['venta_id']."%".$v1['fecha_creada']."%".$v1['datos_cliente']."%".$v1['direccion']."%".$v1['pedido']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['origen']."%".$v1['fecha_entrega']."%".$v1['estado']."%".$v1['vendedor_id']."%".$v1['usuario_id']."%".$v1['cliente_id']."&";
                            }
                        }else{
                            $todas = "NA";
                        }
                        echo $todas;
                    }
                }
            }
        }
    }

}

function ordenescambio($valor,$valor2,$valor3,$valor4,$valor5){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $cambiosTodos = $wpdb->get_results( "SELECT cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios  WHERE cambio_id =".$valor."", ARRAY_A  );
        //print_r($ventasTodas);
        if($cambiosTodos){
            foreach ($cambiosTodos as $v1) {
                $todas = $todas.$v1['cambio_id']."%".$v1['fecha_creada']."%".$v1['venta_id']."%".$v1['datos_cliente']."%".$v1['pedido']."%".$v1['prendas_por_regresar']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['excedente']."%".$v1['fecha_entrega']."%".$v1['estado']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }else{ 
        //echo "41%2022-08-08 16:55:39%°Diego Rodríguez°3229261615°Cll 33 No 6 - 9°Apto 1005°Bogotá%%1%1 Alaska Negro XS%140000%0%%Facebook%2022-08-09%Empacado%1%1%20&42%2022-08-10 16:52:43%° maria fernanda diaz°°Calle 60 sur No 77 g 63 °casa barrio bosa estación°Amaime%%1%1 París Canela SM%130000%0%%Facebook%2022-09-01%Sin empacar%3%3%29&43%2022-08-10 16:55:12%°Luisa Rincón°3213339976°Carrera 19 65 47°cerca a la plaza del 7 de agosto,°Amaime%%1%1 París Negro SM%120000%0%%Facebook%2022-08-19%Sin empacar%3%3%30&44%2022-08-10 17:20:06%°jimena romero°3142451703°Calle 12 C No 4-69 °oficina 203°Bogotá%%1%1 París Canela SM 1 París rojo SM%250000%0%escoge 1 para entregar el lunes de 1 a 4 pm%Facebook%2022-08-20%Sin empacar%3%3%37&45%2022-08-10 17:27:00%°mayra quintero°3008655249°Carrera 70GNo101 - 16,°barrio santa rosa norte°Bogotá%%1%1 París Canela SM 1 Vaiana Negro SM 1 Kibo Verde Menta SM%390000%0%escoge dos. paris canel 130, vaiana negra 145, kibo verde menta 120%Whatsapp%2022-08-20%Sin empacar%3%3%40&46%2022-08-10 17:32:00%°Jorlley verdugo prada°3022932643°Calle 70 a 112 12°Apartamento 201°Bogotá%%1%1 París rojo SM%120000%0%%Facebook%2022-08-20%Empacado%3%3%43&47%2022-08-10 17:35:10%°valentina carrasco°3017914725°Cll 160 No73-47 °t2 apto 1404 Gratamira°Bogotá%%1%1 Vaiana Negro XS 1 Vaiana Negro SM 1 París Rosa Bebé SM %400000%0%escoge%Facebook%2022-09-26%Empacado%3%3%45&48%2022-08-10 17:42:30%°sandra cruz°3156341304°cr 78a número 56a -31sur°roma Kenedy 4 sector°Bogotá%%1%1 París Negro SM 1 París Rosa Bebé SM%240000%0%%Facebook%2022-08-20%Empacado%3%3%48&49%2022-08-11 08:35:16%°Maritza Flórez°3176393716°calle 17 D No103 B 14°Barrio fontibon centro°Bogotá%%1%1 París Verde Menta SM%130000%0%%Facebook%2022-08-12%Despachado%14%14%51&50%2022-08-11 08:36:07%°Maritza Flórez°3176393716°calle 17 D No103 B 14°Barrio fontibon centro°Bogotá%%1%1 París Verde Menta SM%130000%0%%Facebook%2022-08-12%Despachado%14%14%51&51%2022-08-11 09:29:09%°Jazmin Bernal°°Carrera 95 No 75c 19°piso 3°Bogotá%%1%1 París Negro SM%120000%0%%Whatsapp%2022-08-13%Empacado%14%14%53&52%2022-08-11 10:53:14%°Diana Moreno°°Cra 97b No 40a 21 Sur°casa°Bogotá%%1%1 París Negro LXL%120000%0%$123.500 5 porciento%Whatsapp%2022-08-12%Despachado%14%14%57&53%2022-08-11 10:59:35%°Andrea°3214028365°Carrera 37No 69 i 54 Sur °Arborizadora Alta Casa 3 piso°Bogotá%%1%1 París Negro LXL%120000%0%Sábado en la mañana%Facebook%2022-08-12%Sin empacar%14%14%58&54%2022-08-11 11:53:33%°Lorena Camargo°3166026746°Calle 34 a sur No 97 f - 41/65°casa 221 etapa 2 Conjunto quintas de tierra Buena etapa 1 y 2°Bogotá%%1%1 París Negro SM%120000%0%deja el dinero en portería%Facebook%2022-08-12%Despachado%14%14%60&55%2022-08-11 12:04:52%°Elizabeth Beltrán°3193169112°Diagonal 48 j sur No 5 d 90°int 2 apto 103 Conjunto portal de la hacienda Barrio Bochica sur°Bogotá%%1%1 Alaska Negro LXL%140000%0%%Whatsapp%2022-08-12%Sin empacar%1%1%55&56%2022-08-11 12:18:20%°Nancy Torres °3057754925°CLL 33 C N16 A 35°Conjunto santa María del Rincón Soacha Cundinamarca al lado del centro comercial Mercurio°Soacha%%1%1 París Verde Menta SM%120000%0%%Facebook%2022-08-13%Empacado%1%1%59&57%2022-08-11 12:25:14%°Gina Paola Vergara °3165349087°Calle 42 No 4-20°apt 501 edificio El rocio Cataluña Cerca a la parte de arriba de la javeriana°Bogotá%%1%1 Snow Verde Menta SM 1 Snow Canela SM 1 Nuan Canela SM%360000%0%Sábado en la mañana, escoge 1 $120 cada una%Instagram%2022-08-12%Despachado%14%14%62&58%2022-08-11 12:38:57%°Johandry Rojas°3224110218°Carrera 10 6-66°Mega outlet (allí es donde trabajo)°Zipaquirá%%1%1 París Negro SM%120000%0%entrega el lunes después de las 9am%Facebook%2022-08-13%Empacado%14%14%63&59%2022-08-11 13:18:39%°Nidia patiño Martinez °3116976182°diagonal 47 a No 52c31°piso uno bar tropical , barrio venecia localidad tunjuelito°Bogotá%%1%1 París Negro 3XL 1 París Rosa Bebé 3XL%240000%0%si escoge una 130%Facebook%2022-08-12%Despachado%14%14%64&60%2022-08-11 13:35:54%°Jineth Royero Díaz°3133333443°Carrera 22No9-68° torre 5 apto 533 Los sauces Apto°Zipaquirá%%1%1 París Canela LXL%120000%0%Para entregar el sabado 20 diazjineth%Instagram%2022-08-19%Empacado%3%3%65&61%2022-08-11 13:56:23%°Tania Carmona Aricapa°°Cra 10 B No 57 B 51°Barrio La Carola°Manizales%%1%1 París Negro SM 1 Violeta Vino Tinto SM 1 Lucca Verde Menta XS%380000%0%%Whatsapp%2022-08-12%Sin empacar%14%14%66&62%2022-08-11 14:10:24%°Cristian Fernando Builes hurtado°3117651237- 311 4388652°Carrera 6 No5-49°Barrio La palma°Caloto%%1%1 Blonda Negro SM 1 CALIFORNIA Verde Única%255000%0%verde menta%Whatsapp%2022-08-12%Sin empacar%14%14%67&63%2022-08-11 15:04:16%°claudia aguirre°3208024347°Calle 80 bis No94 75 sur°Apto 302 torre 11°Bogotá%%1%1 París rojo SM%120000%0%%Facebook%2022-08-20%Despachado%3%3%68&64%2022-08-11 15:06:12%°Maria Teresa Osorio°3148445115°Carrera 4 D No 48 D 70 barrio Bosques del norte manizales°Manizales°Manizales%%1%1 Londres Rosa Bebé LXL%150000%0%%Facebook%2022-08-17%Empacado%3%3%69&67%2022-08-11 15:34:41%°sindy sotelo°3004262490°Transversal 74 No 11 a 35°\" apto 401 torre 12 Barrio villa alsacia\"°Bogotá%%1%1 Vaiana Camel SM%140000%0%jsotelo_28%Instagram%2022-08-13%Empacado%3%3%73&65%2022-08-11 15:09:08%°Nancy Prieto°3192563088°Cra 78a No80-21 Sur°\" casa 148 Caminos de San diego Etapa 4\"°Bogotá%%1%1 París Negro 3XL%120000%0%%Whatsapp%2022-08-20%Empacado%3%3%70&66%2022-08-11 15:11:01%°Lina Cuadrado°3103176659°Cra. 10aNo2-17 sur°Casa Barrio policarpa (de 3 a 6 pm)°Bogotá%%1%1 París Negro LXL%120000%0%%Facebook%2022-08-12%Despachado%3%3%71&68%2022-08-11 15:36:24%°Ana milena alvarez°3209375159°Carrera 99 No 14 78°\"Torre 23 apto 202 Fontibón pueblo nuevo zona franca \"°Bogotá%%1%1 París Rosa Bebé SM%120000%0%%Facebook%2022-08-13%Empacado%3%3%74&69%2022-08-11 15:40:56%°jennifer olaya °3112835510°\" Cra 74a No68b-77\"°\" Boyacá real\"°Bogotá%%1%1 París Negro SM%120000%0%%Facebook%2022-08-12%Despachado%3%3%75&70%2022-08-11 15:44:36%°lisber medina°3202847051°Calle 94A No11A-93°local 1 barrio chico norte diagonal a l consulado de españa (Bogotá)°Manizales%%1%1 Vaiana Negro LXL 1 Snow Canela LXL%260000%0% $ 250,000 %Whatsapp%2022-08-12%Despachado%3%3%76&71%2022-08-11 15:53:18%°Paola Andrea loaiza gañan / loaizapaito°3175143546°Carrera 104 No131c16°Aures 1 Casa°Bogotá%%1%1 CALIFORNIA Negro Única%120000%0%%Instagram%2022-08-30%Empacado%14%14%78&72%2022-08-11 15:57:43%°Lauren Guerra°3245590974°Calle 48 sur No86 60°Las Margaritas Kennedy°Buenos Aires%%1%1 París Rosa Bebé SM%120000%0%%Whatsapp%2022-08-17%Empacado%14%14%79&73%2022-08-11 16:00:29%°Angelica caballero°°Auto norte via antigua tocancipa vereda verganzo conjunto residencial terranova torre 23 apto 303°°Tocancipá%%1%1 París Canela LXL%120000%0%$123.500 5 porciento -después de las 12%Facebook%2022-08-13%Empacado%14%14%80&74%2022-08-11 16:02:03%°Nataly Alvarez Gamez°3107585753°Carrera 24 D No11sur-80° conjunto residencial Campiñas del Restrepo Nueva Generacion Interior 11, apartamento 103. °Bogotá%%1%1 Nuan Canela SM%120000%0%%Whatsapp%2022-08-12%Despachado%14%14%81&75%2022-08-11 16:03:39%°Yury talia quintero°3226719512°Calle 152bNo87b-12°°Bogotá%%1%1 Skate Negro SM%150000%0%%Whatsapp%2022-08-12%Despachado%14%14%82&76%2022-08-11 16:16:46%°Alejandra Rivera°3115322399°Transversal 22 bis No 60 -47°°Bogotá%%1%1 París Negro 3XL%120000%0%$123.500 5%%Facebook%2022-08-30%Empacado%14%14%83&77%2022-08-11 16:18:30%°Sharon Julieth Martínez Pineda°3115075049°calle 2c No 5b - 20°barrio barandillas cerca a la estación de policía, casa°Zipaquirá%%1%1 París rojo 3XL%120000%0%%Facebook%2022-08-12%Despachado%14%14%84&78%2022-08-11 16:19:39%°Diana Patricia Torres Poveda°3203150073°: Carrera 8 g No 166-71°Apartamento 506 Apartamento 506°Bogotá%%1%1 París rojo SM%120000%0%Ya pagó%Whatsapp%2022-08-12%Despachado%14%14%85&79%2022-08-11 16:21:26%°\"Claudia Bibiana Moreno Amarillo/claudiavivi39 \"°3232397559°cra11No 6-98°barrio el rosal, casa , primer piso , el timbre es el de arriba para abajo°Chia%%1%1 Beisbolera Rosa Bebé L%99900%0%%Instagram%2022-08-16%Sin empacar%14%14%86&80%2022-08-11 16:30:03%°Mileidy Johanna Sanchez/miilep14°3207391593°calle 11 No16a-143 Casa primer piso al lado de la puerta negra de garaje barrio Dorado dos °°Santander de Quilichao%%1%1 Vaiana Negro XS%140000%0%SOLO PAGA $109.000 POR SALDO QUE LE QUEDA CON EL CAMBIO C2932%Instagram%2022-08-13%Empacado%14%14%87&81%2022-08-11 16:48:12%°Marcela Cufiño°3138328631°Carrefa 18 d No59-67 Sur°Edificio 5 piso°Bogotá%%1%1 París Negro SM%120000%0%%Facebook%2022-08-20%Sin empacar%3%3%88&82%2022-08-11 16:51:53%°Sonia torres°3103029664°Calle 75 73 03°\" apt 201. Barrio Santa María del Lago\"°Bogotá%%1%1 Vero Negro SM 1 Lucca Negro SM%280000%0%Luca 125/vero 145%Whatsapp%2022-08-12%Despachado%3%3%89&83%2022-08-11 16:56:14%°María Andrea Catalina Acosta°3125411997°Cra 22 n 12 03 etapa 2°\"Casa 37 prados de san andres\"°Funza%%1%1 París Negro SM%120000%0%%Whatsapp%2022-08-12%Despachado%3%3%90&84%2022-08-11 16:58:27%°valery vera°3157941549° kra 112 75-75,° villas de Granada°Bogotá%%1%1 París Negro SM%120000%0%%Whatsapp%2022-08-12%Despachado%3%3%91&85%2022-08-11 17:01:18%°francy ñungo°3114729883°Carrera 31 No11-22 casa A°Barrio: Villa María- Zipaquirá°Bogotá%%1%1 Alaska Canela XS 1 Vero Negro SM%275000%0%alaska 140, vero 145%Whatsapp%2022-08-12%Despachado%3%3%92&86%2022-08-11 17:03:31%°sandra gomez°3003975067°\"Cra 30 No 89 - 89 casa 94, °conjunto sierra verde Manizales, caldas\"°Manizales%%1%1 París Negro SM%120000%0%123.500%Whatsapp%2022-08-13%Empacado%3%3%93&87%2022-08-11 17:15:10%°yesica Hoyos°3229239224° calle92 a sur No 92 a 03 °casa°Bogotá%%1%1 París Rosa Bebé SM%120000%0%%Facebook%2022-09-02%Sin empacar%3%3%94&88%2022-08-11 17:16:19%°sandra Gomez°3003975067°\"Cra 30 No 89 - 89 casa 94, conjunto sierra verde Manizales, caldas\"°°Manizales%%1%1 París Negro SM%120000%0%123500%Whatsapp%2022-08-12%Empacado%3%3%95&89%2022-08-11 17:21:06%°Lizeth arias°3188230535°Cra 64 No 62 C 46 Sur barrio Isla del Sol°°Bogotá%%1%1 Abbie Camel LXL %140000%0%ES UNA PARIS NEGRA SM%Facebook%2022-08-20%Sin empacar%3%3%96&90%2022-08-11 17:33:10%°Angela giraldom°3148114679°calle 61 a No 24 a 42 local ELECCOM barrio estrella°Manizales°Manizales%%1%1 París Negro SM%120000%0%%Facebook%2022-08-12%Empacado%3%3%97&91%2022-08-11 18:24:27%°LEIDYLAURA CASTELLANOS PERNIA°3112965302°carrera 94C No40a sur-26 °LC 1 barrio dindalito frente al parque bella vista°Bogotá%%1%1 Alaska Palo Rosa XS 1 Alaska Palo Rosa LXL%280000%0%escoge%Whatsapp%2022-08-12%Despachado%3%3%98&92%2022-08-11 18:30:35%°Dorisney paz torres°3208390816°Carrera 22No12-47°conjunto los alamos torre 13apto 552 barrio la esperanza zipaquira cundinamarca°Mosquera%%1%1 Rone Vino Tinto XS%140000%0%para entregar el martes 16%Whatsapp%2022-08-13%Empacado%3%3%99&93%2022-08-11 19:16:26%°Andrea martinez°3115266460°Av Calle 23 No 17-34°°Zipaquirá%%1%1 París rojo SM 1 kioto Mora Leche SM 1 Rone Canela LXL%400000%0%escoge, kioto 125, paris rojo 130, rone 12990%Facebook%2022-08-13%Sin empacar%3%3%100&94%2022-08-11 19:31:56%°María bustos°3212870072°Calle 22j114a 46 altaualpa°°Mosquera%%1%1 Ely Canela SM%120000%0%%Facebook%2022-08-16%Sin empacar%3%3%102&95%2022-08-11 20:02:14%°sandra caceres°° calle 10 No 14a-85 sur apto 571 torre 18°, parque residencial sol creciente, Mosquera Cundinamarca°Mosquera%%1%1 Beisbolera Negro SM%89900%0%94500%Whatsapp%2022-08-18%Sin empacar%3%3%103&96%2022-08-11 20:36:21%°Alejandra muñoz°3203278248°Cra88cNo63-67 sur °conjunto bosa nueva etapa 1 torre 8 apto 202°Bogotá%%1%1 Berlin Negro LXL%99900%0%94500%Facebook%2022-08-12%Despachado%3%3%104&97%2022-08-12 11:34:20%°Jeniffer Chisco Cadavid°3138302401°Calle 11 No10-13 Barrio popular°Manizales°Manizales%%1%1 Berlin Rosa Bebé LXL%99900%0%%Facebook%2022-08-13%Empacado%3%3%111&98%2022-08-12 11:44:14%°Diana marcela diaz°3204824878°Cra 74 No 76-71° edificio Sago interior 3 apto 312 (BGTA)°Bogotá%%1%1 CALIFORNIA rojo Única%120000%0%%Whatsapp%2022-08-13%Empacado%3%3%112&99%2022-08-12 12:08:20%°Milena rodriguez°3046390971°Transversal 79c 80 98 apto 302 Robledo Medellín°°Medellin%%1%1 Aria Rosa Cobre LXL%140000%0%mile_ospinas%Instagram%2022-08-13%Empacado%3%3%113&100%2022-08-12 12:11:25%°Jennifer sanabria°3164111609°Calle 65No29-17 ° Localidad barrios unidos Barrio la paz°Bogotá%%1%1 París Rosa Bebé XS%130000%0%%Whatsapp%2022-08-16%Sin empacar%3%3%114&101%2022-08-12 12:53:43%°Nury Huepa°3112348425°Carrera 85 A No83-35°°Bogotá%%1%1 America Azul Cielo LXL 1 Alaska Palo Rosa LXL 1 Violeta Vino Tinto LXL%415000%0%375.000%Whatsapp%2022-08-15%Sin empacar%3%3%115&102%2022-08-12 13:42:48%°Julieth Estefanía Castrillón González °3105664713°carrera 79 c No 42 b 03 sur°Súper manzana 13°Bogotá%%1%1 Alaska Verde Militar LXL%140000%0%%Whatsapp%2022-08-13%Empacado%14%14%116&103%2022-08-12 14:14:37%°Normelys villeroel°3242452185°calle 68 A sur -45c-33°La candelaria nueva.Bogota°Bogotá%%1%1 Beisbolera Negro SM %99900%0%94500%Whatsapp%2022-08-16%Sin empacar%3%3%117&104%2022-08-12 15:03:21%°Sandra carvajal°3233049694°Carrera 21 No9-31°local 2082 San Vicente plaza bogota°Bogotá%%1%1 París Rosa Bebé XS%130000%0%123.500%Facebook%2022-08-16%Sin empacar";
        $cambiosTodos = $wpdb->get_results("SELECT cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios", ARRAY_A);
        //print_r($cambiosTodos);
        $todas = "";
        foreach ($cambiosTodos as $v1) {
            $todas = $todas.$v1['cambio_id']."%".$v1['fecha_creada']."%".$v1['venta_id']."%".$v1['datos_cliente']."%".$v1['pedido']."%".$v1['prendas_por_regresar']."%".$v1['cliente_ok']."%".$v1['notas']."%".$v1['excedente']."%".$v1['fecha_entrega']."%".$v1['estado']."&";
        }
        echo $todas;
    }
}

function ordenescambiojson($valor,$estadoFiltro,$transportador,$tipoenvio,$datetimepicker_default,$datetimepicker_defaultFiltro){
    global $wpdb;
    if($valor != "0"){ 
        $cambiosTodos = $wpdb->get_results( "SELECT cliente_id,origen,cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios  WHERE cambio_id =".$valor."", ARRAY_A  );
        echo json_encode($cambiosTodos);       
    }else{ 
        $where = "";
        $est="";
        $tra="";
        $tip="";
        $cre="";
        $ent="";
        if($estadoFiltro != "0" || $transportador != "0" || $tipoenvio != "0" || $datetimepicker_default != "0" || $datetimepicker_defaultFiltro != "0"){
            $where=" WHERE cambio_id > 10";
        }
        if($estadoFiltro != "0"){
            $est=" AND (estado = '".$estadoFiltro."')";
        }
        if($transportador != "0"){
            $tra="";
        }
        if($tipoenvio != "0"){
            $tip="";
        }
        if($datetimepicker_default != "0"){
            $fechaventagaarray = explode("/",$datetimepicker_default);
            $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
            $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";            
            $cre=" AND (fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')";
        }
        if($datetimepicker_defaultFiltro != "0"){
            $cre="";
            $fechaventagaarray = explode("/",$datetimepicker_defaultFiltro);
            $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
            $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";    
            $ent=" AND (fecha_entrega BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')";
        }
        //echo "SELECT cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios".$where.$est.$tra.$tip.$ent.$ent."";
        $cambiosTodos = $wpdb->get_results("SELECT cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios".$where.$est.$tra.$tip.$ent.$ent."", ARRAY_A);
        echo json_encode($cambiosTodos);
    }
}

function ordenesventajson($valor,$estadoFiltro,$tipoenvio,$datetimepicker_default,$datetimepicker_defaultFiltro,$telefono){
    global $wpdb;
    if($valor != "0"){ 
        $ventas = $wpdb->get_results( "SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas  WHERE venta_id =".$valor."", ARRAY_A  );
        echo json_encode($ventas);    
        return false;   
    }if($telefono != "0"){ 
        $ventascambios = [];
        $clienteId = $wpdb->get_results( "SELECT `cliente_id` FROM `con_t_clientes` WHERE `telefono`=".$telefono."", ARRAY_A  );
        //print_r($clienteId);
        $ventasTodos = $wpdb->get_results( "SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas  WHERE cliente_id =".$clienteId[0]['cliente_id']."", ARRAY_A  );
        //print_r($ventasTodos);
        $consultaCambio = "";
        if(sizeof($ventasTodos)>1){                
            foreach ($ventasTodos as $v1){
                $consultaCambio = $consultaCambio." OR ".$v1['venta_id'];
                $v1['datos_cliente'] = json_encode($v1['datos_cliente']);
                $v1['pedido'] = json_encode($v1['pedido']);
            }
        }
        $cambiosTodos = $wpdb->get_results( "SELECT cambio_id,fecha_creada,venta_id,datos_cliente,pedido,prendas_por_regresar,cliente_ok,notas,excedente,fecha_entrega,estado FROM con_t_cambios  WHERE venta_id = ".$ventasTodos[0]['venta_id']." ".$consultaCambio."", ARRAY_A  );
        //print_r($ventasTodos);
        $ventascambios['ventas'] = $ventasTodos;
        $ventascambios['cambios'] = $cambiosTodos;
        echo json_encode($ventascambios);    
        return false;   
    }
    $where = "";
    $est="";
    $tra="";
    $tip="";
    $cre="";
    $ent="";

    if($estadoFiltro != "0" || $transportador != "0" || $tipoenvio != "0" || $datetimepicker_default != "0" || $datetimepicker_defaultFiltro != "0"){
        $where=" WHERE venta_id > 40";
    }
    if($estadoFiltro != "0"){
        $est=" AND (estado = '".$estadoFiltro."')";
    }
    if($transportador != "0"){
        $tra="";
    }
    if($tipoenvio != "0"){
        $tip="";
    }
    if($datetimepicker_default != "0"){
        $fechaventagaarray = explode("/",$datetimepicker_default);
        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";            
        $cre=" AND (fecha_creada  BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')";
    }
    if($datetimepicker_defaultFiltro != "0"){
        $cre="";
        $fechaventagaarray = explode("/",$datetimepicker_defaultFiltro);
        $fechaventa = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 00:00:00";
        $fechaventaup = $fechaventagaarray[2]."-".$fechaventagaarray[0]."-".$fechaventagaarray[1]." 23:59:59";    
        $ent=" AND (fecha_entrega BETWEEN  '".$fechaventa."' AND '".$fechaventaup."')";
    }
    if($valor=='0' && $estadoFiltro=='0' && $tipoenvio=='0' && $datetimepicker_default=='0' && $datetimepicker_defaultFiltro=='0' && $telefono == '0'){
        $where=" WHERE venta_id > 6000 AND venta_id <= 7000";
        
        $consultafinal = "SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas".$where.$est.$tra.$tip.$ent.$ent." ORDER BY venta_id ASC";
        echo $consultafinal;
        $ventastodas = $wpdb->get_results($consultafinal, ARRAY_A);
        // print_r($ventastodas);
        for ($i=6; $i < 1000; $i++) { 
            $where=" WHERE venta_id > ".(1000+($i*1000))." AND venta_id <= ".(2000+($i*1000));
            
            $consultafinal = "SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas".$where.$est.$tra.$tip.$ent.$ent." ORDER BY venta_id ASC";
            
            $ventastodasProvisional = $wpdb->get_results($consultafinal, ARRAY_A); 
            if (!empty($ventastodasProvisional)) {
                $ventastodas = array_merge($ventastodas, $ventastodasProvisional);
            } else {
                $i=10000;
            }           
        }
        print_r($ventastodas);

        echo json_encode($ventastodas);
        return false;
    }
    
    $ventastodas = $wpdb->get_results("SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas".$where.$est.$tra.$tip.$cre.$ent." ORDER BY venta_id ASC", ARRAY_A);
    // echo "SELECT venta_id,fecha_creada,datos_cliente,pedido,cliente_ok,notas,fecha_entrega,estado,origen,cliente_id FROM con_t_ventas".$where.$est.$tra.$tip.$cre.$ent." ORDER BY venta_id ASC";
    echo json_encode($ventastodas);
}

function  actualizar($tabla,$columna,$valor,$valor2,$valor3){
    //10,Diego,1--venta_id	cambio	usuario_id	fecha_hora	campo_cambio
    $valores = explode(",",$valor2);
    $fecha = wp_date('Y-m-d H:i:s');
    global $wpdb;
    if($tabla == "con_t_clientes" ){
        $datos = explode("°",$columna);
        $updated = $wpdb->update( "con_t_clientes", array('nombre' => $datos[1], 'telefono' => $datos[2], 'direccion_1' => $datos[3], 'complemento_1' => $datos[4], 'ciudad_1' => $datos[5] ), array( 'cliente_id' => $valor ) );
    }
    if($tabla == "venta_cliente" ){
        $datosss = str_replace("\\","",$columna);
        $datosssss = str_replace("<","{",$datosss);
        $datosCliente = str_replace(">","}",$datosssss);
        $updated = $wpdb->update( "con_t_ventas", array('datos_cliente' => $datosCliente), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $datosCliente , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "datos_cliente");
        echo $datos;
        $wpdb->insert("con_t_ventastr", $datos);
    }
    if($tabla == "venta_pedido" ){
        $datosss = str_replace("\\","",$columna);
        $datosssss = str_replace("<","{",$datosss);
        $columna = str_replace(">","}",$datosssss);
        $updated = $wpdb->update( "con_t_ventas", array('pedido' => $columna), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "pedido");
        echo $datos;
        $wpdb->insert("con_t_ventastr", $datos);
    }
    if($tabla == "venta_fecha" ){
        $fechaentregaarray = explode("/",$columna);
        $fechaentrega = $fechaentregaarray[2]."-".$fechaentregaarray[0]."-".$fechaentregaarray[1]." 00:00:00";
        $updated = $wpdb->update( "con_t_ventas", array('fecha_entrega' => $fechaentrega), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $fechaentrega , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "fecha_entrega");
        echo $datos;
        $wpdb->insert("con_t_ventastr", $datos);
    }
    if($tabla == "venta_nota" ){
        $updated = $wpdb->update( "con_t_ventas", array('notas' => $columna), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "notas");
        echo $datos;
        $wpdb->insert("con_t_ventastr", $datos);
    }
    if($tabla == "venta_estado" ){
        $updated = $wpdb->update( "con_t_ventas", array('estado' => $columna), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "estado");
        $wpdb->insert("con_t_ventastr", $datos);
        if($columna=='Empacado'){
            $codigos = explode("°",$valor3);
            for ($i=1; $i < sizeof($codigos) ; $i++) {                     
                $datos = array("venta_id" => $valor , "cambio" => $codigos[$i] , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "empacado");
                $wpdb->insert("con_t_ventastr", $datos);                
            }
        }
        if($columna=='Despachado'){
            $codigos = explode("°",$valor3);
            for ($i=1; $i < sizeof($codigos) ; $i++) {                     
                $datos = array("venta_id" => $valor , "cambio" => $codigos[$i] , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "despachado");
                $wpdb->insert("con_t_ventastr", $datos);                
            }
        }
    }
    if($tabla == "venta_clienteok" ){
        $updated = $wpdb->update( "con_t_ventas", array('cliente_ok' => $columna), array( 'venta_id' => $valor ) );
        $datos = array("venta_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "cliente_ok");
        $wpdb->insert("con_t_ventastr", $datos);
    }
    if($tabla == "cambio_cliente" ){
        $datosss = str_replace("\\","",$columna);
        $datosssss = str_replace("<","{",$datosss);
        $datosCliente = str_replace(">","}",$datosssss);
        $updated = $wpdb->update( "con_t_cambios", array('datos_cliente' => $datosCliente), array( 'cambio_id' => $valor ) );
        $datos = array("cambio_id" => $valor , "cambio" => $datosCliente , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "datos_cliente");
        echo $datos;
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "cambio_pedido"){
        $updated = $wpdb->update( "con_t_cambios", array('pedido' => $valor, 'prendas_por_regresar' => "--", 'excedente' => $valor2), array( 'cambio_id' => $columna ) );
        $datos = array("cambio_id" => $columna , "cambio" => $valor." ".$valor2 , "usuario_id" => $valore3 , "fecha_hora" => $fecha , "campo_cambio" => "pedido");
        echo $datos;
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "estado_prenda"){
        $datos = "UPDATE con_t_trprendas SET estado='".$valor."' WHERE ".$valor2."  = '".$columna."'";
        echo $datos;
        $wpdb->query($datos);
    }
    if($tabla == "cambio_fecha" ){
        $fechaentregaarray = explode("/",$columna);
        $fechaentrega = $fechaentregaarray[2]."-".$fechaentregaarray[0]."-".$fechaentregaarray[1]." 00:00:00";
        $updated = $wpdb->update( "con_t_cambios", array('fecha_entrega' => $fechaentrega), array( 'cambio_id' => $valor ) );
        $datos = array("cambio_id" => $valor , "cambio" => $fechaentrega , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "fecha_entrega");
        echo $datos;
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "cambio_nota" ){
        $updated = $wpdb->update( "con_t_cambios", array('notas' => $columna), array( 'cambio_id' => $valor ) );
        $datos = array("cambio_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "notas");
        echo $datos;
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "cambio_estado" ){
        $updated = $wpdb->update( "con_t_cambios", array('estado' => $columna), array( 'cambio_id' => $valor ) );
        $datos = array("cambio_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "estado");
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "cambio_clienteok" ){
        $updated = $wpdb->update( "con_t_cambios", array('cliente_ok' => $columna), array( 'cambio_id' => $valor ) );
        $datos = array("cambio_id" => $valor , "cambio" => $columna , "usuario_id" => $valores[2] , "fecha_hora" => $fecha , "campo_cambio" => "cliente_ok");
        $wpdb->insert("con_t_cambiostr", $datos);
    }
    if($tabla == "dinero_madrugon" ){
        $updated = $wpdb->update( "con_t_madrugon", array('valor_dinero' => $columna), array( 'ID' =>$valor ));
    }
    if($tabla == "dinero_madrugonCambio" ){
        $updated = $wpdb->update( "con_t_madrugon", array('valor_cambios' => $columna), array( 'ID' =>$valor ));
    }
    if($tabla == "fechalotes" ){
        $fecharray = explode("/",$columna);
        $fecha = $fecharray[2]."-".$fecharray[0]."-".$fecharray[1]; 
        echo "con_t_lotes".",array('fecha_terminada' => '".$fecha."'), array( 'ID' =>".$valor." )";
        $updated = $wpdb->update( "con_t_lotes", array('fecha_terminada' => $fecha), array( 'ID' =>$valor ));
        echo $updated;
    }    
    if($tabla == "actualizar_satelite" ){        
        $datos="UPDATE `con_t_trprendas` SET `fecha_cambio`='".$fecha."' WHERE (`estado`='En satélite') AND (`cual` = ".$columna.")";
        $wpdb->query($datos);
    }          
    if($tabla == "con_t_prendasplaza" ){        
        $datos="UPDATE `con_t_prendasplaza` SET `agregada`=1 WHERE (`codigo`='".$valor."')";
        $wpdb->query($datos);
    }  

}

function  sumarinventario($valor){
    global $wpdb;
    $componentes = explode(",",$valor);
    $long =  sizeof($componentes);
    for($i=0;$i < ($long-1);$i++){
        $datosSinEspacio =str_replace(' ', '', $componentes[$i]); 
        $cantidadInicial = $wpdb->get_results( "SELECT cantidad FROM con_t_resumen WHERE referencia_id = ".$datosSinEspacio."", ARRAY_A);
        $cantidadNueva = ++$cantidadInicial[0]['cantidad'];
        $cambio = $wpdb->query("UPDATE con_t_resumen SET cantidad = ".$cantidadNueva." WHERE referencia_id = ".$datosSinEspacio."");
        echo "UPDATE con_t_resumen SET cantidad = ".$cantidadNueva." WHERE referencia_id = ".$datosSinEspacio."";
        echo $cambio;
    }
}

function permisos($valor){
    $user_info = wp_get_current_user();
    $user_level = $user_info->user_level;
    $permi = 0;
    global $wpdb;
    $permisos = $wpdb->get_results( "SELECT level FROM con_t_rolespermisos WHERE permiso_id = ".$valor."", ARRAY_A  );
    for($i = 0;$i <sizeof($permisos);$i++){
        if($user_info == $permisos[$i]){
            $permi = 1;
        }
    }
    echo $permi;     
}


function codigosprendas($valor,$valor2,$valor3,$valor4){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, referencia_id FROM con_t_trprendas  WHERE codigo =".$valor." ", ARRAY_A  );
        //print_r($ventasTodas);
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1[codigo]."%".$v1[estado]."%".$v1[cual]."%".$v1[complemento_estado]."%".$v1[fecha_cambio]."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }else{ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE 1", ARRAY_A  );
        //print_r($ventasTodas);
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1[codigo]."%".$v1[estado]."%".$v1[cual]."%".$v1[complemento_estado]."%".$v1[fecha_cambio]."%".$v1[descripcion]."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }
}

function codigosprendasjson($valor,$valor2,$valor3,$valor4){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas  WHERE codigo ='".$valor."'", ARRAY_A  );
        echo json_encode($codigos);
        return false;
    }
    if($valor4 != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas  WHERE descripcion ='".$valor4."'", ARRAY_A  );
        echo json_encode($codigos);
        return false;
    }
    if($valor3 != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas  WHERE cual ='".$valor3."'", ARRAY_A  );
        echo json_encode($codigos);
        return false;
    } 
    $todas = "";
    $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE estado <> 'Entregado'", ARRAY_A  );
    echo json_encode($codigos);
    
}

function resumenprendas($valor,$valor2,$valor3,$valor4){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results("SELECT nombre, color, talla, cantidad, precio_detal FROM con_t_resumen  WHERE nombre =".$valor." ", ARRAY_A  );
        //print_r($ventasTodas);
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1['nombre']."%".$v1['color']."%".$v1['talla']."%".$v1['cantidad']."%".$v1['precio_detal']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }else{ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT nombre, color, talla, cantidad, precio_detal FROM con_t_resumen  WHERE 1", ARRAY_A  );
       // print_r($codigos);
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1['nombre']."%".$v1['color']."%".$v1['talla']."%".$v1['cantidad']."%".$v1['precio_detal']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }
}

function empezarnuevaauditoria($valor){
    $fechaarray = explode("/",$valor);
    $fecha = $fechaarray[2]."-".$fechaarray[0]."-".$fechaarray[1]." 00:00:00";
    $valores = array("fecha" => $fecha);
    global $wpdb;
    $wpdb->insert("con_t_auditoriasinventario", $valores);
    $lastId = $wpdb->get_results( "SELECT MAX(ID) as id FROM con_t_auditoriasinventario");
    echo $lastId[0]->id;
}

function auditprendas($valor,$valor2,$valor3,$valor4){
    global $wpdb;
    if($valor != "0"){ 
        $todas = "";
        $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas  WHERE codigo =".$valor." ", ARRAY_A  );
        //print_r($ventasTodas);
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1['codigo']."%".$v1['estado']."%".$v1['cual']."%".$v1['complemento_estado']."%".$v1['fecha_cambio']."%".$v1['descripcion']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }else{ 
        $todas = "";
        $last = $wpdb->get_results( "SELECT MAX(ID) as id FROM con_t_auditoriasinventario");
        $obtenidosArray = $wpdb->get_results( "SELECT fecha FROM con_t_auditoriasinventario WHERE ID = ".$last[0]->id."", ARRAY_A);
        if($valor4 == "Empacado" || $valor4 == "Despachado"){
            $timezone = new DateTimeZone( 'America/Bogota' );
            $fecha = wp_date('Y-m-d H:i:s', strtotime('-1 week'), $timezone );
            $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE (fecha_cambio < '".$fecha."') AND (estado = '".$valor4."') ", ARRAY_A  );           
            echo "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE (fecha_cambio < '".$fecha."') AND (estado = '".$valor4."') ";
        }else{
            if($valor2 == 10){
                $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE (fecha_cambio < '".$obtenidosArray[0]['fecha']." ') AND (estado != 'En satélite')  AND (estado != 'Madrugón')  AND (estado != 'Entregado')  AND (estado != 'Venta local')  AND (estado != 'Venta mayorista')    ORDER BY cual ASC", ARRAY_A  );
            }else{
                $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE (fecha_cambio < '".$obtenidosArray[0]['fecha']."') AND (cual = '".$valor3."')  AND (estado != 'En satélite')  AND (estado != 'Venta mayorista')  AND (estado != 'Madrugón')  AND (estado != 'Venta madrugón') ", ARRAY_A  );
            }        
        }  
        
        if($valor4 == "Satelite"){
            $timezone = new DateTimeZone( 'America/Bogota' );
            $fecha = wp_date('Y-m-d H:i:s', strtotime('-2 week'), $timezone );
            $codigos = $wpdb->get_results( "SELECT codigo, estado, cual, complemento_estado, fecha_cambio, descripcion FROM con_t_trprendas WHERE (fecha_cambio < '".$fecha."') AND (estado = 'En satélite') ", ARRAY_A  );           
        }     
        if($codigos){
            foreach ($codigos as $v1) {
                $todas = $todas.$v1['codigo']."%".$v1['estado']."%".$v1['cual']."%".$v1['complemento_estado']."%".$v1['fecha_cambio']."%".$v1['descripcion']."&";
            }
        }else{
            $todas = "NA";
        }
        echo $todas; 
    }
}

function actualizarPrendas($valor,$valor2,$valor3,$valor4){////valor = "Empacado" valor2 = 29
    $usuario = explode(",",$valor);
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    $usuarioActual = $usuario[1]." ".$usuario[2];
    global $wpdb;
    $updated = $wpdb->update( "con_t_trprendas", array('estado' => $valor2,'cual' => $valor3,'complemento_estado' => $usuarioActual, 'fecha_cambio' => $fecha), array( 'codigo' => $valor4) );
    $datos = array("id_prenda" => $valor4 , "cambio" => $valor2." ".$valor3, "id_usuario" => $usuario[2] , "fecha_hora" => $fecha , "campo_cambio" => "estado");
    $wpdb->insert("con_t_historialprendas", $datos);//con_t_historialprendas - id_prenda	cambio	id_usuario	fecha_hora	campo_cambio
}

function inicialcaja($valor){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $usuario = explode("°",$valor);
    for($j=0;$j<(sizeof($usuario)-1);$j++){
        $check = $wpdb->get_results( "SELECT ID FROM con_t_invinicial WHERE codigo = '".$usuario[$j]."'", ARRAY_A  );
        if(sizeof($check)==0){
            //$valores = array("fecha_creada" => $fechacreada , "cliente_id" => $vals[0] , "notas" => $vals[1] , "origen" => $vals[2] , "fecha_entrega" => $fechaentrega, "estado" => "Sin empacar", "vendedor_id" => $vals[4], "usuario_id" => $vals[5], "datos_cliente" => $vals[6], "pedido" => $pedir);
            $insertado = $wpdb->insert("con_t_invinicial", array("codigo" => $usuario[$j]));
            echo $insertado;
        }
    }
}

function nuevocodigoinicial($valor,$valor2,$valor3){//valor: C1145RB6D13S64 valor2: 192°Abbie°Camel°SM valor3: 10,Diego,1
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    global $wpdb;
    $usuario = explode(",",$valor3);
    $obtenidosArray = $wpdb->get_results( "SELECT estado FROM con_t_estadoprendas WHERE ID = ".$usuario[0]."", ARRAY_A);
    $referencia = explode("°",$valor2);
    $ref = $referencia[0];
    $descripcion = $referencia[1]." ".$referencia[2]." ".$referencia[3];
    $updated = $wpdb->update( "con_t_invinicial", array('ok' => 1), array( 'codigo' => $valor) );
    $datos = array("referencia_id" => $ref , "descripcion" => $descripcion, "codigo" =>$valor, "estado" => $obtenidosArray[0][estado] , "cual" => $usuario[1],"complemento_estado" => $usuario[2],"fecha_cambio" => $fecha);
    $wpdb->insert("con_t_trprendas", $datos);//referencia_id,descripcion,codigo,estado,cual,complemento_estado,fecha_cambio*/
    $cantidadRefere = $wpdb->get_results( "SELECT cantidad FROM con_t_resumen WHERE referencia_id = '".$ref."'", ARRAY_A);
    $cantidadNueva = $cantidadRefere[0][cantidad]+1;
    $updated = $wpdb->update( "con_t_resumen", array('cantidad' => $cantidadNueva), array( 'referencia_id' => $ref));
}

function nuevolote(){
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    $valores = array("fecha_creada" => $fecha);
    global $wpdb;
    $wpdb->insert("con_t_lotes", $valores);
}

function imprimirResumen(){
    global $wpdb;
    $referenciasArray = $wpdb->get_results( "SELECT DISTINCT referencia_id FROM con_t_trprendas ORDER BY referencia_id ASC", ARRAY_A);
    $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[1]['referencia_id']."", ARRAY_A);
    $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A); 
    $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);   
    $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
    $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
    $html = "<div id='listadoResumen'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos' id='primerCodigo'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']."</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$fabrica[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$bodega[0]['COUNT(*)']."</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$plaza[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$satel[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$descripcion[0]['precio_detal']."</p></div></div>";
    for($j=2;$j<sizeof($referenciasArray);$j++){
        $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[$j]['referencia_id']."", ARRAY_A);
        $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A);  
        $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);  
        $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
        $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
        $html = $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']."</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$fabrica[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$bodega[0]['COUNT(*)']."</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$plaza[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$satel[0]['COUNT(*)']."</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>".$descripcion[0]['precio_detal']."</p></div></div>";
    }
    echo $html;
}

function imprimirResumenCell(){
    global $wpdb;
    $referenciasArray = $wpdb->get_results( "SELECT DISTINCT referencia_id FROM con_t_trprendas ORDER BY referencia_id ASC", ARRAY_A);
    $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[1]['referencia_id']."", ARRAY_A);
    $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A); 
    $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);   
    $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
    $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[0]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
    $html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos fila' id='primerCodigoCell'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Fábrica</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$fabrica[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Bodega</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$bodega[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Plaza</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$plaza[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Satélite</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$satel[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Precio</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$descripcion[0]['precio_detal']."</p></div></div>";
    for($j=2;$j<sizeof($referenciasArray);$j++){
        $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[$j]['referencia_id']."", ARRAY_A);
        $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A);  
        $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);  
        $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
        $satel = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$j]['referencia_id'].") AND (estado = 'En satélite')", ARRAY_A);  
        $html = $html."<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos fila' id='primerCodigoCell'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc'>".$descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Fábrica</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$fabrica[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Bodega</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$bodega[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Plaza</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$plaza[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Satélite</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$satel[0]['COUNT(*)']."</p></div><div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><p class='letra18pt-pc'>Precio</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>".$descripcion[0]['precio_detal']."</p></div></div>";
    }
    echo $html;
}

function liberarpaquete($valor){
    global $wpdb;
    if($valor[0] == "C" || $valor[0] == "c"){
        $descripcion = $wpdb->get_results( "SELECT estado,codigo FROM con_t_trprendas WHERE cual = '".$valor."'", ARRAY_A);
        if($descripcion[0]['codigo']){
            echo "No se puede liberar porque la prenda ".$descripcion[0]['codigo']." está ".$descripcion[0]['estado']." en este pedido";
        }else{
            $timezone = new DateTimeZone( 'America/Bogota' );
            $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
            $updated = $wpdb->update( "con_t_cambios", array('estado' => "Sin empacar"), array( 'cambio_id' => substr($valor,1) ) );
            $datos = array("cambio_id" =>substr($valor,1) , "cambio" => "Sin empacar" , "fecha_hora" => $fecha , "campo_cambio" => "estado");
            $wpdb->insert("con_t_cambiostr", $datos);          
            echo "Empaque ".$valor." liberado";
        }
    }else{
        $descripcion = $wpdb->get_results( "SELECT estado,codigo FROM con_t_trprendas WHERE cual = 'V".$valor."'", ARRAY_A);
        if($descripcion[0]['codigo']){
            echo "No se puede liberar porque la prenda ".$descripcion[0]['codigo']." está ".$descripcion[0]['estado']." en este pedido";
        }else{
            $timezone = new DateTimeZone( 'America/Bogota' );
            $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
            $updated = $wpdb->update( "con_t_ventas", array('estado' => "Sin empacar"), array( 'venta_id' => $valor ) );
            $datos = array("venta_id" => $valor , "cambio" => "Sin empacar","fecha_hora" => $fecha , "campo_cambio" => "estado");
            $wpdb->insert("con_t_ventastr", $datos);
            echo "Empaque ".$valor." liberado";
        }
    }
}

function madrugones(){
    global $wpdb;
    $madrugones = $wpdb->get_results( "SELECT  `ID`, `fecha`, `valor_mercancia`, `valor_dinero`, `madrugon_ok`, `valor_cambios` FROM con_t_madrugon WHERE 1 ORDER BY fecha DESC", ARRAY_A  );
    echo json_encode($madrugones);
}

function prendasMadrugon($valor){
    global $wpdb;
    $datos = $wpdb->get_results( "SELECT `fecha`, `valor_dinero`,madrugon_ok,valor_cambios FROM `con_t_madrugon` WHERE `ID`=".$valor."", ARRAY_A  );
    $fechainicio = $datos[0]['fecha']." 00:00:00";
    $fechafin= $datos[0]['fecha']." 23:00:00";
    if( $datos[0]['madrugon_ok'] == "No"){
        $prendas = $wpdb->get_results("SELECT `referencia_id` FROM `con_t_trprendas` WHERE (`estado`='Madrugón') AND (`fecha_cambio` BETWEEN '".$fechainicio."' AND '".$fechafin."')",ARRAY_N);
        $ids = array();
        for($j=0;$j<sizeof($prendas);$j++){
            array_push($ids, $prendas[$j][0]);
        }
        $vals = array_count_values($ids);
        $valortotal = 0;
        foreach ($vals as $key => $value){
            $ref = $wpdb->get_results( "SELECT precio_mayorista FROM con_t_resumen WHERE referencia_id = ".$key."", ARRAY_A);
            $valortotal = $valortotal + ($ref[0]['precio_mayorista']*$value);
        }
        $updated = $wpdb->update( "con_t_madrugon", array('valor_mercancia' => $valortotal), array( 'ID' =>$valor ));
        if(($datos[0]['valor_dinero']+$datos[0]['valor_cambios']) == $valortotal){
            $updated = $wpdb->update( "con_t_madrugon", array('madrugon_ok' => "Si"), array( 'ID' =>$valor ));
            $datos="UPDATE `con_t_trprendas` SET `estado`='Venta madrugón' WHERE (`estado`='Madrugón') AND (`fecha_cambio` BETWEEN '".$fechainicio."' AND '".$fechafin."')";
            $wpdb->query($datos);
            $prendas = $wpdb->get_results("SELECT  `referencia_id`, `descripcion`, `codigo`, `estado`, `cual`, `complemento_estado`, `fecha_cambio` FROM `con_t_trprendas` WHERE (`estado`='Venta madrugón') AND (`fecha_cambio` BETWEEN '".$fechainicio."' AND '".$fechafin."')",ARRAY_A);
            echo json_encode($prendas);
        }else{
            $prendas = $wpdb->get_results("SELECT  `referencia_id`, `descripcion`, `codigo`, `estado`, `cual`, `complemento_estado`, `fecha_cambio` FROM `con_t_trprendas` WHERE (`estado`='Madrugón') AND (`fecha_cambio` BETWEEN '".$fechainicio."' AND '".$fechafin."')",ARRAY_A);
            echo json_encode($prendas);
        }
    }else{
        $prendas = $wpdb->get_results("SELECT  `referencia_id`, `descripcion`, `codigo`, `estado`, `cual`, `complemento_estado`, `fecha_cambio` FROM `con_t_trprendas` WHERE (`estado`='Venta madrugón') AND (`fecha_cambio` BETWEEN '".$fechainicio."' AND '".$fechafin."')",ARRAY_A);
        echo json_encode($prendas);
    }
    
}

function revisarfechasatelite($valor){
    global $wpdb;
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
    $referenciasArray = explode("°",$valor);
    $html = "";
    $verificadas = array();
    for($i=1;$i<(sizeof($referenciasArray));$i++){
        $descripcion = $wpdb->get_results( "SELECT nombre,color,talla,precio_detal FROM con_t_resumen WHERE referencia_id = ".$referenciasArray[$i]."", ARRAY_A);
        $fabrica = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$i].") AND  ((estado = 'En Producción')  || (estado = 'En Bodega'))", ARRAY_A);  
        $bodega = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$i].") AND ((estado = 'En Operaciones') || (estado = 'En Empaques'))", ARRAY_A);  
        $plaza = $wpdb->get_results( "SELECT COUNT(*) FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$i].") AND (estado = 'En Plaza de las américas')", ARRAY_A);  
        $separados = $a[$referenciasArray[$i]];//133
        $cantidad = $fabrica[0]['COUNT(*)']+$bodega[0]['COUNT(*)']+$plaza[0]['COUNT(*)']-$separados;
        if($cantidad<=0){
            $fechaDescripcion = array();
            $satel = $wpdb->get_results( "SELECT codigo FROM con_t_trprendas WHERE (referencia_id = ".$referenciasArray[$i].") AND (estado = 'En satélite')", ARRAY_A);  
            $lote = "";
            for($j=1;$j<50;$j++){
                if(($satel[0]['codigo'][$j] == "0")||($satel[0]['codigo'][$j] == "1")||($satel[0]['codigo'][$j] == "2")||($satel[0]['codigo'][$j] == "3")||($satel[0]['codigo'][$j] == "4")||($satel[0]['codigo'][$j] == "5")||($satel[0]['codigo'][$j] == "6")||($satel[0]['codigo'][$j] == "7")||($satel[0]['codigo'][$j] == "8")||($satel[0]['codigo'][$j] == "9")){
                    $lote=$lote.$satel[0]['codigo'][$j];
                }else{$j=51;}
            }//array_push($ids, $prendas[$j][0]);
            $fecha = $wpdb->get_results( "SELECT fecha_terminada FROM con_t_lotes WHERE ID = ".$lote."", ARRAY_A);//133
            $descr = $descripcion[0]['nombre']." ".$descripcion[0]['color']." ".$descripcion[0]['talla'];
            $fechaDescripcion['descripcion']= $descr;
            $fechaDescripcion['fecha'] = $fecha;
            array_push($verificadas, $fechaDescripcion);
        }        
    }
    echo json_encode($verificadas);
}


function enviarparaventamayorista($valor){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $prendas = explode("°",$valor);
    for($j=0;$j<(sizeof($prendas)-1);$j++){     
        $ref = $wpdb->get_results( "SELECT referencia_id,descripcion FROM con_t_trprendas WHERE codigo = '".$prendas[$j]."'", ARRAY_A  );
        $valor = $wpdb->get_results( "SELECT precio_mayorista FROM con_t_resumen WHERE referencia_id = ".$ref[0]['referencia_id']."", ARRAY_A  );
        $insertado = $wpdb->insert("con_t_prendasmayorista", array("codigo" => $prendas[$j], "descripcion" => $ref[0]['descripcion'],  'valor' => $valor[0]['precio_mayorista']));
        echo $insertado;
    }
}

function enviarparaventa($valor){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $prendas = explode("°",$valor);
    for($j=1;$j<(sizeof($prendas));$j++){     
        $ref = $wpdb->get_results( "SELECT referencia_id,descripcion FROM con_t_trprendas WHERE codigo = '".$prendas[$j]."'", ARRAY_A  );
        $valor = $wpdb->get_results( "SELECT precio_detal FROM con_t_resumen WHERE referencia_id = ".$ref[0]['referencia_id']."", ARRAY_A  );
        $insertado = $wpdb->insert("con_t_prendasplaza", array("codigo" => $prendas[$j], "descripcion" => $ref[0]['descripcion'],  'valor' => $valor[0]['precio_detal']));
        echo $insertado;
    }
}

function imprimirprendasparavender(){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $agregagos = $wpdb->get_results( "SELECT `ID`, `codigo`, `valor`, `descripcion` FROM con_t_prendasmayorista WHERE agregada = 0", ARRAY_A);//133
    echo json_encode($agregagos);
}

function imprimirprendasparavenderdetal(){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $agregagos = $wpdb->get_results( "SELECT `ID`, `codigo`, `valor`, `descripcion` FROM con_t_prendasplaza WHERE agregada = 0", ARRAY_A);//133
    echo json_encode($agregagos);
}


function clientesBuscarjson($telefono){
    global $wpdb;
    $clientesTodas= $wpdb->get_results( "SELECT * FROM con_t_clientes  WHERE telefono = ".$telefono."", ARRAY_A  );
    echo json_encode($clientesTodas);
}


function consultarsatelite($valor){////C1145RB7D13S64°C1145RB4D13S64°
    global $wpdb;
    $obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),`descripcion` FROM con_t_trprendas WHERE (`estado` = 'En satélite') AND (`cual` = ".$valor.") GROUP BY `descripcion`", ARRAY_A);
    //print_r($obtenidosArray);
    $html="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removersatelite' id='bloquesatelite'>";
    for($j=0;$j<sizeof($obtenidosArray);$j++){
        $html = $html."
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removersatelite'>
            <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                <p class='letra18pt-pc' id='ok".$j."' name='no'>".$obtenidosArray[$j]['descripcion']."</p>
            </div>
            <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7'>    
                <div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>
                    <label class='control-label letra18pt-pc' for='regular1'>Calcula y pon el número de prendas de esta referencia que tiene el satélite</label>
                    <input type='number' class='form-control cantidad' name='".$obtenidosArray[$j]['COUNT(*)']."' id='".$j."'/>
                    <span class='pmd-textfield-focused'></span>
                </div>    
            </div>
        </div>
       ";
    }
    echo $html."<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 removersatelite'> 
    <button class='botonmodal botonenmodal letra18pt-pc' type='button' id='confirmarsatelite'> Confirmar prendas </button>
    </div>
    </div>";
}

function nuevaventatiendas($cliente_id,$clienteString,$codigos_prendas,$notas,$origen,$valor_total,$metodospagoString,$vendedor_id){
    //echo $cliente_id."---------------".$clienteString."---------------".$codigos_prendas."---------------".$notas."---------------".$origen."---------------".$valor_total."---------------".$metodospagoString."---------------".$vendedor_id;
    global $wpdb;
    $timezone = new DateTimeZone( 'America/Bogota' );
    $fecha = wp_date('Y-m-d H:i:s', null, $timezone );
    $clientest= json_decode($clienteString);
    $datoss = "INSERT INTO con_t_ventasplaza ( fecha_creada,cliente_id,datos_cliente,codigos_prendas,notas,origen,valor_total,metodos_pago,vendedor_id) VALUES ('".$fecha."','".$cliente_id."', '".$clienteString."', '".$codigos_prendas."','".$notas."', '".$origen."','".$valor_total."','".$metodospagoString."',".$vendedor_id.")";
    $datosss = str_replace("\\","",$datoss);
    $datosssss = str_replace("<","{",$datosss);
    $datos = str_replace(">","}",$datosssss);
    $wpdb->query($datos);
    $lastId = $wpdb->get_results( "SELECT MAX(ID) as id FROM con_t_ventasplaza");
    echo json_encode($lastId);
}

function borrarfilas($tabla,$condicion,$valor_condicion){
    global $wpdb;
    $wpdb->delete( $tabla, [ $condicion => $valor_condicion ]);
}

function insertarfila($tabla,$valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11){
    // echo $tabla."--".$valor."--".$valor2."--".$valor3."--".$valor4."--".$valor5."--".$valor6."--".$valor7."--".$valor8."--".$valor9."--".$valor10."--".$valor11;
    global $wpdb;
    if($valor != "0"){
        $valoru = str_replace("\\","",$valor);
        $valord = str_replace("<","{",$valoru);
        $valor = str_replace(">","}",$valord);
        $valorjson = json_decode($valor,JSON_UNESCAPED_UNICODE);
        $valorarray = convertidor($valorjson["tipo"],$valorjson["valor"],$valorjson["columna"]);
    }else{$valorarray = array( "valor" => "", "columna" => "");}
    /// OK
    $finalcolumna = $valorarray["columna"];
    $finalvalor = $valorarray["valor"];
    $valores = array( "valor2" => $valor2,"valor3" => $valor3,"valor4" => $valor4,"valor5" => $valor5,"valor6" => $valor6,"valor7" => $valor7,"valor8" => $valor8,"valor9" => $valor9,"valor10" => $valor10,"valor11" => $valor11);
    // print_r($valores);
    // echo '</br>';
    // echo '</br>';
    // echo '</br>';
    // echo '</br>';
    foreach($valores as $x => $val) {    
        if($val != "0"){
            $valoru = str_replace("\\","",$val);
            $valord = str_replace("<","{",$valoru);
            $valor = str_replace(">","}",$valord);
            $valorjson = json_decode($valor,JSON_UNESCAPED_UNICODE);
            $valorarray2 = convertidor($valorjson["tipo"],$valorjson["valor"],$valorjson["columna"]);
            // echo 'Valor convertido: ';
            // print_r($valorarray2);
            // echo '</br>';

            $valorarray2["valor"] = ",".$valorarray2["valor"];
            $valorarray2["columna"] = ",".$valorarray2["columna"];
        }else{$valorarray2 = array( "valor" => "", "columna" => "");}
        $finalcolumna =$finalcolumna.$valorarray2["columna"];
        $finalvalor = $finalvalor.$valorarray2["valor"];        
    }
    
    $datos = "INSERT INTO ".$tabla." ( ".$finalcolumna.") VALUES (".$finalvalor.")";
    // echo '</br>';
    // echo '</br>';
    // echo '</br>';
    // echo $datos;
    $wpdb->query($datos);
    $lastId = $wpdb->get_results( "SELECT MAX(ID) as id FROM ".$tabla."");
    echo json_encode($lastId);
    //echo $tabla."--".$valor."--".$valor2."--".$valor3."--".$valor4."--".$valor5."--".$valor6."--".$valor7."--".$valor8."--".$valor9."--".$valor10."--".$valor11;
}

function convertidor($tipo,$valor,$columna){
    
    if($tipo == 'string'){
        $vuno = "'".$valor."'";
        $cuno = $columna;
    }
    if($tipo == 'int'){
        $vuno = intval($valor);
        $cuno = $columna;
    }        
    if($tipo == 'json'){
        $vunojson = json_encode($valor,JSON_UNESCAPED_UNICODE);
        $vuno = "'".$vunojson."'";
        $cuno = $columna;
    }       
    if($tipo == 'date'){
        $fecha = explode("/",$valor);
        $vuno = "'".$fecha[0]."-".$fecha[1]."-".$fecha[2]." 00:00:00"."'";
        $cuno = $columna;
    }      
    if($tipo == 'date_sinhora'){
        $fecha = explode("/",$valor);
        // print_r($fecha);
        $vuno = "'".$fecha[2]."-".$fecha[0]."-".$fecha[1]."'";
        $cuno = $columna;
    }
    if($tipo == 'float'){
        $vuno = floatval($valor);
        $cuno = $columna;
    }  
    
    $objeto = array( "valor" => $vuno, "columna" => $cuno);
    return($objeto);
}

function actualizarregistros($tabla,$condicion,$valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11){
    global $wpdb;
    if($valor != "0"){
        $valoru = str_replace("\\","",$valor);
        $valord = str_replace("<","{",$valoru);
        $valor = str_replace(">","}",$valord);
        $valorjson = json_decode($valor);
        $valorarray = convertidor($valorjson -> tipo,$valorjson -> valor,$valorjson -> columna);
        $valorarray["columna"] = $valorarray["columna"]."=";
    }else{$valorarray = array( "valor" => "", "columna" => "");}
    /// OK
    $final = $valorarray["columna"].$valorarray["valor"];
    $valores = array( "valor2" => $valor2,"valor3" => $valor3,"valor4" => $valor4,"valor5" => $valor5,"valor6" => $valor6,"valor7" => $valor7,"valor8" => $valor8,"valor9" => $valor9,"valor10" => $valor10,"valor11" => $valor11);
    foreach($valores as $x => $val) {   
        if($val != "0"){
            $valoru = str_replace("\\","",$val);
            $valord = str_replace("<","{",$valoru);
            $valor = str_replace(">","}",$valord);
            $valorjson = json_decode($valor);
            $valorarray2 = convertidor($valorjson -> tipo,$valorjson -> valor,$valorjson -> columna);
            $valorarray2["columna"] = ",".$valorarray2["columna"]."=";
        }else{$valorarray2 = array( "valor" => "", "columna" => "");}
        $final = $final.$valorarray2["columna"].$valorarray2["valor"];      
    }
    $valoru = str_replace("\\","",$condicion);
    $valord = str_replace("<","{",$valoru);
    $valor = str_replace(">","}",$valord);
    $condicionjson = json_decode($valor);
    $datos = "UPDATE ".$tabla." SET ".$final." WHERE ".$condicionjson -> columna." = ".$condicionjson -> valor."";
    echo $datos;
    $wpdb->query($datos);

}

function cajasemanal($id){
    global $wpdb;
    $rango = $wpdb->get_results("SELECT `fecha_menor`,`fecha_mayor` FROM `con_t_cierredigital` WHERE  ID = '".$id."'",ARRAY_A);
    $fechamenor = $rango[0]['fecha_menor']." 00:00:00";
    $fechamayor = $rango[0]['fecha_mayor']." 23:00:000";    
    $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  (((`estado`<>'Entregado') AND (`estado`<>'Cancelado')) OR (`cliente_ok`=0)) AND (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
    $auditados = array();
    $nacional = 0;
    $local = 0 ; 
    for ($i=0; $i < sizeof($ventas) ; $i++) { 
        $jsonclientedatos =  json_decode($ventas[$i]['datos_cliente']);
        $vant = (array)$jsonclientedatos;
        $lon = "";        
        if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){
            $local = $local + intval($ventas[$i]['cliente_ok']);
            $lon="Local";
        }else{
            $nacional = $nacional + intval($ventas[$i]['cliente_ok']);
            $lon="Nacional";}  
        $prendasventa = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventas[$i]['venta_id']."'",ARRAY_A);
        $auditados[$ventas[$i]['venta_id']] = array("venta_id"=>$ventas[$i]['venta_id'],"prendas"=>sizeof($prendasventa),"estado"=>$ventas[$i]['estado'],"dinero"=>$ventas[$i]['cliente_ok'],"lon" => $lon);
    }
    $ventastodas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE (`estado`<>'Cancelado') AND (`fecha_creada` BETWEEN '".$fechamenor."' AND '".$fechamayor."')",ARRAY_A);
    for ($i=0; $i < sizeof($ventastodas) ; $i++) {  
        $jsonclientedatos =  json_decode($ventastodas[$i]['datos_cliente']);
        $vant = (array)$jsonclientedatos;
        $lon = "";
        if($vant['ciudad'] == 'Bogotá' || $vant['ciudad'] == 'Cajicá' || $vant['ciudad'] == 'Chia' || $vant['ciudad'] == 'Cota' || $vant['ciudad'] == 'Funza' || $vant['ciudad'] == 'Mosquera' || $vant['ciudad'] == 'Soacha' || $vant['ciudad'] == 'Usaquen' || $vant['ciudad'] == 'Usme'){            
            $local = $local + intval($ventastodas[$i]['cliente_ok']);
            $lon="Local";
        }else{
            $nacional = $nacional + intval($ventastodas[$i]['cliente_ok']);
            $lon="Nacional";
        }  
        $prendasventastodas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$ventastodas[$i]['venta_id']."'",ARRAY_A);
        if(sizeof($prendasventastodas) == 0){
                if(!$auditados[$ventastodas[$i]['venta_id']]){
                    $ventas = $wpdb->get_results("SELECT * FROM `con_t_ventas` WHERE  `venta_id` = ".$ventastodas[$i]['venta_id']."",ARRAY_A);
                    $auditados[$ventastodas[$i]['venta_id']] = array("venta_id"=>$ventastodas[$i]['venta_id'],"prendas"=>0,"estado"=>$ventas[0]['estado'],"dinero"=>$ventas[0]['cliente_ok'],"lon" => $lon);
                }
        }
    }
    $arrayventas = array();
    $cuentasporcobrar = 0;
    foreach ($auditados as $key => $value){
        array_push($arrayventas, $value);
        $prendas = $wpdb->get_results("SELECT * FROM `con_t_trprendas` WHERE  `cual` = 'V".$key."'",ARRAY_A);        
        for ($i=0; $i < sizeof($prendas) ; $i++) { 
            $referencia = $wpdb->get_results("SELECT `precio_detal` FROM `con_t_resumen` WHERE  `referencia_id` = ".$prendas[$i]['referencia_id']."",ARRAY_A);
            $cuentasporcobrar = $cuentasporcobrar + intval($referencia[0]['precio_detal']) - intval($value['dinero']);
        }
    }
    echo json_encode($arrayventas);
    $cambio = $wpdb->query("UPDATE con_t_cierredigital SET `local`=".$local.",`nacional`=".$nacional.",`cuentas_cobrar`=".$cuentasporcobrar." WHERE ID = ".$id."");
}

if($funcion == "permisosPrincipales"){
    permisosPrincipales();
}if($funcion == "permisosVentas"){
    permisosVentas();
}if($funcion == "ciudades"){
    ciudades();
}if($funcion == "guardarCliente"){
    guardarCliente($nombre,$telefono,$dir1,$comp1,$ciudad1,$valor,$valor2);
}if($funcion == "clientesEncontrados"){
    clientesEncontrados($telefono);
}if($funcion == "permisosInventario"){
    permisosInventario();
}if($funcion == "referenciaNueva"){
    referenciaNueva($nombre,$color,$talla,$link,$detal,$mayor,$categoria);
}if($funcion == "obtenerData"){
    obtenerData($columna,$tabla,$tipo,$valor,$valor2);
}if($funcion == "obtenerDatajson"){
    obtenerDatajson($columna,$tabla,$tipo,$valor,$valor2);
}if($funcion == "nuevocodigo"){
    nuevoCodigo($tipo,$valor);
}if($funcion == "nuevaMarquilla"){
    nuevaMarquilla($valor);
}if($funcion == "cambiarEstadoprendas"){
    cambiarEstadoprendas($valor,$valor2,$nombre,$id);
}if($funcion == "cambiarEstadoprenda"){
    cambiarEstadoprenda($valor,$valor2,$nombre,$id);
}if($funcion == "disponibles"){
    disponibles();
}if($funcion == "agregarventa"){
    agregarventa($valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9);
}if($funcion == "ventaitem"){
   ventaitem($valor,$valor2);
}if($funcion == "ordenesventa"){
   ordenesventa($valor,$valor2,$valor3,$valor4,$valor5);
}if($funcion == "ordenesventajson"){
    ordenesventajson($valor,$valor2,$valor3,$valor4,$valor5,$valor6);
 }if($funcion == "actualizar"){
   actualizar($tabla,$columna,$valor,$valor2,$valor3);
}if($funcion == "sumarinventario"){
    sumarinventario($id);
}if($funcion == "permisos"){
    permisos($valor);
}if($funcion == "codigosprendas"){
    codigosprendas($valor,$valor2,$valor3,$valor4);
}if($funcion == "codigosprendasjson"){
    codigosprendasjson($valor,$valor2,$valor3,$valor4);
}if($funcion == "resumenprendas"){
    resumenprendas($valor,$valor2,$valor3,$valor4);
}if($funcion == "empezarnuevaauditoria"){
    empezarnuevaauditoria($valor);
}if($funcion == "auditprendas"){
    auditprendas($valor,$valor2,$valor3,$valor4);
}if($funcion == "agregarcambio"){
    agregarcambio($valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8);
}if($funcion == "enviarEmpacados"){
    enviarEmpacados($valor,$valor2,$valor3,$valor4);
}if($funcion == "actualizarVentaitem"){
    actualizarVentaitem($valor,$valor2);
}if($funcion == "actualizarPrendas"){
    actualizarPrendas($valor,$valor2,$valor3,$valor4);
}if($funcion == "inicialcaja"){
    inicialcaja($valor);
}if($funcion == "referenciasrodas"){
    referenciasrodas();
}if($funcion == "nuevocodigoinicial"){
    nuevocodigoinicial($valor,$valor2,$valor3);
}if($funcion == "nuevolote"){
    nuevolote();
}if($funcion == "cambioitem"){
    cambioitem($valor,$valor2,$valor3,$valor4);
}if($funcion == "ordenescambio"){
   ordenescambio($valor,$valor2,$valor3,$valor4,$valor5,$valor6);
}if($funcion == "ordenescambiojson"){
    ordenescambiojson($valor,$valor2,$valor3,$valor4,$valor5,$valor6);
 }if($funcion == "cantidadesinventario"){
    cantidadesinventario();
}if($funcion == "restarInventario"){
    restarInventario($valor);
}if($funcion == "imprimirResumen"){
    imprimirResumen();
}if($funcion == "imprimirResumenCell"){
    imprimirResumenCell();
}if($funcion == "liberarpaquete"){
    liberarpaquete($valor);
}if($funcion == "madrugones"){
    madrugones();
}if($funcion == "prendasMadrugon"){
    prendasMadrugon($valor);
}if($funcion == "revisarfechasatelite"){
    revisarfechasatelite($valor);
}if($funcion == "enviarparaventamayorista"){
    enviarparaventamayorista($valor);
}if($funcion == "imprimirprendasparavender"){
    imprimirprendasparavender();
}if($funcion == "imprimirprendasparavenderdetal"){
    imprimirprendasparavenderdetal();
}if($funcion == "enviarparaventa"){
    enviarparaventa($valor);
}if($funcion == "consultarsatelite"){
    consultarsatelite($valor);
}if($funcion == "clientesBuscarjson"){
    clientesBuscarjson($telefono);
}if($funcion == "nuevaventatiendas"){
    nuevaventatiendas($valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8);
}if($funcion == "borrarfilas"){
    borrarfilas($tabla,$valor,$valor2);
}if($funcion == "insertarfila"){
    insertarfila($tabla,$valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11);
}if($funcion == "actualizarregistros"){
    actualizarregistros($tabla,$condicion,$valor,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11);
}if($funcion == "cajasemanal"){
    cajasemanal($valor);
}
?>