<?php
	if(is_user_logged_in()){
	    get_header("ventas");
		$current_user = wp_get_current_user();
		$user = get_userdata( $current_user->ID );
		$user_roles = $user->roles;		
?>
     <div id='popup' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc" id="ventaNuevaTitulo" name="2020-09-14"></h2>
            	<div action="https://concurvas.com/team/controlador/" method="get"  autocomplete="off" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="buscarCliente">
        		    <div class="form-group pmd-textfield pmd-textfield-floating-label">
        		        <label for="nombre" class="control-label letra18pt-pc"> Teléfono</label>
        			    <input class="form-control" type="number" id="tele" name="tele" required=""><span class="pmd-textfield-focused"></span>
        		    </div>
            	 </div>
            	 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            	    <button type="submit" class="botonmodal letra18pt-pc" id="clienteBuscar"> Buscar cliente </button>
            	</div>
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            	    <button class='botonmodal botonenmodal letra18pt-pc' type='button' id='agregarCliente'> Agregar cliente </button>
            	</div>  	
                    <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="guardarVenta" >
            			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-12">
            				<input class="form-control" type="text" id="nombreVenta" name="nombreVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-12">
            				<input class="form-control" type="number" id="telVenta" name="telVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>							
            			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-12">
            				<input class="form-control" type="text" id="dirVenta" name="dirVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-12">
            				<input class="form-control" type="text" id="complementoCliente" name="complementoCliente" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>	
						<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<input  type="text" id="ciudadCliente" name="ciudadCliente" required="" disabled="disabled">
						</div>
						<input class="off" type="number" id="idCliente" name="idCliente" required="" type="hidden">
            		</div>
            	</div>             	
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	    <button class='botonmodal letra18pt-pc' type='button' id='actualizarCliente'> Actualizar cliente </button>
            	</div>
            </div>
        </div>
    </div>
   <div id='popup2' style='display: none;' class="pc tablet">
          <div class='content-popup'>
            <div class='close'><a href='#' id='close2'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc">Cliente nuevo</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioCliente">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="nombre" class="control-label letra18pt-pc"> Nombre</label>
						<input class="form-control" type="text" id="nombre" name="nombre" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="documento" class="control-label letra18pt-pc"> Teléfono </label>
						<input class="form-control" type="text" id="telefono" name="telefono" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="telefono" class="control-label letra18pt-pc"> Dirección 1 </label>
						<input class="form-control" type="text" id="dir1" name="dir1" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="correo" class="control-label letra18pt-pc"> Complemento 1 </label>
						<input class="form-control" type="text" id="comp1" name="comp1" required=""><span class="pmd-textfield-focused"></span>
						
					</div>	
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="correo" class="control-label letra18pt-pc"> Ciudad 1 </label>
						<select class="form-control" type="select" id="ciudad1" name="ciudad1" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="clienteGuardado"> Guardar cliente </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>
    <div id='popup3' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close3'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div id="clientesEncontrados">
            
            </div>
        </div>
       
    </div>
    <div id='popup4' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close4'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2>Pedido</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="primeraPrendas">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
				</div>
            </div>
        </div>
    </div>
    <div id='popup5' style='display: none;' class="pc tablet">
          <div class='content-popup'>
            <div class='close'><a href='#' id='close5'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 id="tituloconfirmarpago">Confirmar pago</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioCliente">
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="documentoUpdate" class="control-label letra18pt-pc"> Valor pago </label>
						<input class="form-control" type="text" id="valorpago" name="valorpago" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="confirmarpago"> Confirmar pago </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>
    <div id='popup6' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close6'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2>Pedido</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="primeraPrendasNuevas">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
				</div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div id='popup7' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close7'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2 id="tituloFecha">Cambiar fecha del pedido</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="fechaEntregaUpdate">
                	<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha de entrega nueva</label>
                        <input type="text" id="datetimepicker-update" class="form-control" />
                    </div>
                </div>
    			<button type="submit" class="botonmodal letra18pt-pc" id="fechaUpdate"> Cambiar Fecha </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>    
    <div id='popup8' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close8'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2 id="tituloNotas">Cambiar nota del pedido</h2>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label">
            	        <label class="control-label letra18pt-pc" for="notasUpdate">Notas</label>
            			<input class="form-control" type="text" id="notasUpdate" name="notasUpdate" required=""><span class="pmd-textfield-focused"></span>
            		</div>
            	</div>
    			<button type="submit" class="botonmodal letra18pt-pc" id="notaUpdate"> Cambiar Nota </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>     
    <div id='popup9' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close9'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2 id="tituloNotas">Confirmar pago</h2>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="itemsVentas">
            	</div>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label">
            	        <label class="control-label letra18pt-pc" for="notasUpdate">Valor confirmado</label>
            			<input class="form-control" type="number" id="valorConfirmado" name="valorConfirmado" required=""><span class="pmd-textfield-focused"></span>
            		</div>
            	</div>
    			<button type="submit" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 botonmodal letra18pt-pc" id="confirmarPago"> Confirmar </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>      
    <div id='popup10' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close10'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2 id="tituloNotas">Confirmar pago</h2>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="itemsVentas">
            	</div>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label">
            	        <label class="control-label letra18pt-pc" for="notasUpdate">Valor confirmado</label>
            			<input class="form-control" type="number" id="valorConfirmado" name="valorConfirmado" required=""><span class="pmd-textfield-focused"></span>
            		</div>
            	</div>
    			<button type="submit" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 botonmodal letra18pt-pc" id="confirmarPago"> Confirmar </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>       -->
    <div class='popup-overlay pc tablet'></div>
	    <div class="container-fluid pc tablet" id="bloquePrincipal">
	       <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraFila'>
	           <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>VM</p>
    	       </div> 
    	       <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>
    	           <p class='letra18pt-pc negrillaUno'>Cliente</p>
    	       </div>
    	       <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
    	           <p class='letra18pt-pc negrillaUno'>Valor mercancía</p>
    	       </div>
    	       <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
    	           <p class='letra18pt-pc negrillaUno'>Valor confirmado</p>
    	       </div>    	      
	       </div>
	       
	   </div>
	<div id='cuerpoCell' class="container-fluid celular" >
		<div id='botonesEscaner' >
			<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion01'><button class='botonmodal' type='button' id='empezarEscaner'>Iniciar escaner</button></div>
        </div>
		<div style="width: 100%" id="inicialReader"></div>
			<div id='inicialEscaner' style='display: none;'>
				<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarParaventa' ><button class='botonmodal letra18pt-pc' type='button'>Enviar para venta</button></div>
				<div id='escaneados' style='display: none;' ></div>
			</div>
		</div>
	</div>
<?php
	   get_footer("ventas-mayorista"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>