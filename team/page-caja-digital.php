<?php
	if(is_user_logged_in()){
	    get_header("caja-digital");
?>
<div class="container-fluid pc tablet" id="bloquePrincipal">
	<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='primeraFila'>
		<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
			<p class='letra18pt-pc negrillaUno'>Fecha de cierre desde creación</p>
		</div> 
		<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
			<p class='letra18pt-pc negrillaUno'>Ingreso local</p>
		</div>
		<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
			<p class='letra18pt-pc negrillaUno'>Ingreso nacional</p>
		</div>
		<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
			<p class='letra18pt-pc negrillaUno'>Cuentas por cobrar</p>
		</div>
		<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
			<p class='letra18pt-pc negrillaUno'></p>
		</div>		
	</div>	
</div>
<?php
	   get_footer("caja-digital"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>