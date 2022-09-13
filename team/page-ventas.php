<?php
	if(is_user_logged_in()){
	    get_header("ventas");
?>
    <div id='popup' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc" id="ventaNuevaTitulo" name="2025-09-14">Venta nueva</h2>
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
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosCliente">
            	<h2 class="letra18pt-pc">Datos Cliente</h2>            	
                    <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="guardarVenta">
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="nombreVenta" name="nombreVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="dirVenta" name="dirVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="telVenta" name="telVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            	        <input class="off" type="number" id="idCliente" name="idCliente" required="" type="hidden">
            	        <input class="off" type="text" id="ciudadCliente" name="ciudadCliente" required="" type="hidden">
            	        <input class="off" type="text" id="complementoCliente" name="complementoCliente" required="" type="hidden">
            		</div>
            	</div> 
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosPrendas">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                	    <h2 class="letra18pt-pc">Prendas del pedido</h2>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                	    <button class='botonmodal botonenmodal letra18pt-pc' type='button' id='agregarPrenda'> Agregar prendas </button>
                	</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 letra3pt-mv letra16pt-pc" id="pedido">
                        
                    </div> 
            	</div>
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                    	<label class="control-label letra18pt-pc" for="regular1">Fecha de entrega</label>
                    	<input type="text" id="datetimepicker-entrega" class="form-control" />
                    </div>
            	</div> 
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label">
            	        <label class="control-label letra18pt-pc" for="regular1">Notas</label>
            			<input class="form-control" type="text" id="notas" name="notas" required=""><span class="pmd-textfield-focused"></span>
            		</div>
            	</div>
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="fechaEntrega">
            	    <div class="form-group pmd-textfield pmd-textfield-floating-label">
            	        <label class="control-label letra18pt-pc" for="regular1">Origen</label>
            			<select class="form-control letra18pt-pc" type="select" id="origen" name="origen" form="formularioCliente" required="">
            			    <option value='Facebook'>Facebook</option>
            			    <option value='Instagram'>Instagram</option>
            			    <option value='Whatsapp'>Whatsapp</option>
						</select><span class="pmd-textfield-focused"></span>
            		</div>
            	</div> 
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	    <button class='botonmodal letra18pt-pc' type='button' id='agregarPedido'> Agregar pedido </button>
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
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioPedido">
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s1">
						<label for="cantidad1" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad1" name="cantidad1" min="1"><span class="pmd-textfield-focused"></span>
					</div> 
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s1">
						<label for="prenda1" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles " type="select" id="prenda1" name="prenda1" form="formularioCliente" onchange="minmax(this.id)" >
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s2" style='display: none;'>
						<label for="cantidad2" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad2" name="cantidad2" min="1"><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s2" style='display: none;'>
						<label for="prenda2" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles " type="select" id="prenda2" name="prenda2" form="formularioCliente" onchange="minmax(this.id)">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s3" style='display: none;'>
						<label for="cantida31" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad3" name="cantidad3" min="1"><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s3" style='display: none;'>
						<label for="prenda3" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles" type="select" id="prenda3" name="prenda3" form="formularioCliente" onchange="minmax(this.id)">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s4" style='display: none;'>
						<label for="cantidad4" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad4" name="cantidad4" min="1"><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s4" style='display: none;'>
						<label for="prenda4" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles" type="select" id="prenda4" name="prenda4" form="formularioCliente" onchange="minmax(this.id)">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s5" style='display: none;'>
						<label for="cantidad5" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad5" name="cantidad5" min="1"><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s5" style='display: none;'>
						<label for="prenda5" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles" type="select" id="prenda5" name="prenda5" form="formularioCliente" onchange="minmax(this.id)">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 s6" style='display: none;'>
						<label for="cantidad6" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control" type="number" id="cantidad6" name="cantidad6" min="1"><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-10 col-md-10 col-sm-10 col-xs-10 s6" style='display: none;'>
						<label for="prenda6" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponibles" type="select" id="prenda6" name="prenda6" form="formularioCliente" onchange="minmax(this.id)">
						</select><span class="pmd-textfield-focused"></span>
					</div>
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="prendasGuardadas"> Guardar prendas </button>
                <div style='float:left; width:100%;'>
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
                <h2>Cliente nuevo</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioCliente">
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="nombreUpdate" class="control-label letra18pt-pc"> Nombre</label>
						<input class="form-control" type="text" id="nombreUpdate" name="nombreUpdate" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="documentoUpdate" class="control-label letra18pt-pc"> Teléfono </label>
						<input class="form-control" type="text" id="telefonoUpdate" name="telefonoUpdate" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="dirUpdate" class="control-label letra18pt-pc"> Dirección 1 </label>
						<input class="form-control" type="text" id="dir1Update" name="dir1Update" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="correoUpdate" class="control-label letra18pt-pc"> Complemento 1 </label>
						<input class="form-control" type="text" id="comp1Update" name="comp1Update" required=""><span class="pmd-textfield-focused"></span>
						
					</div>	
					<div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
						<label for="ciudad1" class="control-label letra18pt-pc"> Ciudad 1 </label>
						<select class="form-control" type="select" id="ciudad1Update" name="ciudad1Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<input class="off" type="number" id="idClienteUpdate" name="idClienteUpdate" required="" type="hidden">
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="clienteUpdate"> Actualizar cliente </button>
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
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioPedido">
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantidad1Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad1Update" name="cantidad1Update" required=""><span class="pmd-textfield-focused"></span>
					</div> 
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda1Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate " type="select" id="prenda1Update" name="prenda1Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantidad2Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad2Update" name="cantidad2Update" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda2Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate " type="select" id="prenda2Update" name="prenda2Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantida31Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad3Update" name="cantidad3Update" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda3Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate" type="select" id="prenda3Update" name="prenda3Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantidad4Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad4Update" name="cantidad4Update" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda4Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate" type="select" id="prenda4Update" name="prenda4Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantidad5Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad5Update" name="cantidad5Update" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda5Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate" type="select" id="prenda5Update" name="prenda5Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed">
						<label for="cantidad6Update" class="control-label letra18pt-pc"> Cantidad</label>
						<input class="form-control removecero" type="number" id="cantidad6Update" name="cantidad6Update" required=""><span class="pmd-textfield-focused"></span>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<label for="prenda6Update" class="control-label letra18pt-pc"> Prenda </label>
						<select class="form-control disponiblesUpdate" type="select" id="prenda6Update" name="prenda6Update" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
					</div>
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="prendasGuardadasUpdate"> Guardar prendas </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>
    <div id='popup7' style='display: none;' class="pc tablet">
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
    </div>      
    <div class='popup-overlay pc tablet'></div>
	    <div class="container-fluid pc tablet" id="bloquePrincipal">
	       <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraFila'>
	           <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Estado</p>
    	       </div> 
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Orden</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Cliente</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Dirección</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Adición</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Ciudad</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Pedido</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Precio</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class="letra18pt-pc negrillaUno">Entrega</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Notas</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Origen</p>
    	       </div>
	       </div>
	       
	   </div>
<?php
	   get_footer("ventas"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>