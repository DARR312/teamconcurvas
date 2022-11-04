<?php
	if(is_user_logged_in()){
	    get_header();
?>
<?php 	
$valor=$_GET['valor'];
global $wpdb;
$obtenidosArray = $wpdb->get_results( "SELECT COUNT(*),`descripcion` FROM con_t_trprendas WHERE (`estado` = 'En satélite') AND (`cual` = ".$valor.") GROUP BY `descripcion`", ARRAY_A);
//print_r($obtenidosArray);
$html="";
for($j=0;$j<sizeof($obtenidosArray);$j++){
    $html = $html."<p class='letra18pt-pc'>".$obtenidosArray[$j]['descripcion']." ".$obtenidosArray[$j]['COUNT(*)']."</p>";
}
echo $html;
?>
<?php
	   get_footer("satelite"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>