<?php
/************************TIPOS DE USUARIOS******************
function xx__update_custom_roles() {
    if ( get_option( 'custom_roles_version' ) < 1 ) {
        add_role( 'custom_role', 'Jefe Producción', array( 'read' => true, 'level_0' => true ) );
        update_option( 'custom_roles_version', 1 );
    }
}
add_action( 'init', 'xx__update_custom_roles' );
/************************TIPOS DE USUARIOS******************
add_role( 'disenador', 'Diseñador', array(  'level_6' => true ));
/*remove_role( 'cliente' ); 
add_role( 'joperaciones', 'Jefe Operaciones', array(  'level_7' => true ));
add_role( 'transportador', 'Transportador', array(  'level_0' => true ));
add_role( 'vendedor', 'Vendedor', array(  'level_1' => true ));
add_role( 'vendedor_plaza', 'Vendedor PA', array(  'level_1' => true ));
add_role( 'despachador', 'Despachador', array(  'level_3' => true ));
add_role( 'cortador', 'Cortador', array(  'level_4' => true ));
add_role( 'broches', 'Broches', array(  'level_5' => true ));
add_role( 'disenador', 'Diseñador', array(  'level_6' => true ));
add_role( 'joperaciones', 'Jefe Operaciones', array(  'level_7' => true ));
add_role( 'jproduccion', 'Jefe Producción', array(  'level_8' => true ));
add_role( 'contable', 'Contable', array(  'level_9' => true ));
/*global $wpdb;
$wpdb->insert(" con_t_permisos", array(
   "nombre" => "Area de ventas"
));*/
?>