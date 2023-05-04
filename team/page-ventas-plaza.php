<?php
	if(is_user_logged_in()){
	    get_header("ventas");
?>
	<div style='display: none;' class="contenedor_loader">
		<div class="loader"></div>
	</div>
	
    <div id='popup' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc" id="ventaNuevaTitulo" name="2020-09-14">Venta nueva</h2>
            	<div action="https://concurvas.com/team/controlador/" method="get"  autocomplete="off" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="buscarCliente">
        		    <div class="form-group pmd-textfield pmd-textfield-floating-label">
        		        <label for="tele" class="control-label letra18pt-pc"> Teléfono</label>
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
                    <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="guardarVenta">
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="nombreVenta" name="nombreVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="telVenta" name="telVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="correov" name="correov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="documentov" name="documentov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            	        <input class="off" type="number" id="idCliente" name="idCliente" required="" type="hidden">
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
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group pmd-textfield pmd-textfield-floating-label" id="notasdiv">
					<label class="control-label letra18pt-pc" for="regular1">Notas</label>
            		<input class="form-control" type="text" id="notas" name="notas" required=""><span class="pmd-textfield-focused"></span>
            	</div>						
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group pmd-textfield pmd-textfield-floating-label" id="vendedordiv">
					<label class="control-label letra18pt-pc" for="vendedorselect">Vendedor</label>
            		<select class="form-control letra18pt-pc" type="select" id="vendedorselect" name="vendedorselect" form="formularioCliente" required="">
            		    <option value='6'>Francisco Arrieta</option>
					</select><span class="pmd-textfield-focused"></span>
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
						<label for="telefono" class="control-label letra18pt-pc"> Correo electrónico </label>
						<input class="form-control" type="text" id="correo" name="correo" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="correo" class="control-label letra18pt-pc"> Documento </label>
						<input class="form-control" type="number" id="documento" name="documento" required=""><span class="pmd-textfield-focused"></span>
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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<button class='botonmodal letra18pt-pc' type='button' id='agregarprendaspedido'> Agregar prendas </button>
				</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="primeraPrendas">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Valor </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Agregar </p>
					</div>
				</div>
            </div>
        </div>
    </div>
		<!-- APARTADOS -->
	<div id='popup5' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close5'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <!-- <h2 class="letra18pt-pc" id="apartadoNuevaTitulo" name="2020-09-14">Apartado nuevo</h2> -->
            	<div action="https://concurvas.com/team/controlador/" method="get"  autocomplete="off" class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="buscarCliente">
        		    <div class="form-group pmd-textfield pmd-textfield-floating-label">
        		        <label for="teleapartado" class="control-label letra18pt-pc"> Teléfono</label>
        			    <input class="form-control" type="number" id="teleapartado" name="tele" required=""><span class="pmd-textfield-focused"></span>
        		    </div>
            	 </div>
            	 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            	    <button type="submit" class="botonmodal letra18pt-pc" id="clienteBuscarapartado"> Buscar cliente </button>
            	</div>
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            	    <button class='botonmodal botonenmodal letra18pt-pc' type='button' id='agregarClienteapartado'> Agregar cliente </button>
            	</div>
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="datosClienteapartado">       	
                    <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="guardarVentaapartado">
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="nombreVentaapartado" name="nombreVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="telVentaapartado" name="telVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="correovapartado" name="correov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="documentovapartado" name="documentov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            	        <input class="off" type="number" id="idClienteapartado" name="idClienteapartado" required="" type="hidden">
            		</div>
            	</div> 
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datosPrendasapartado">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                	    <h2 class="letra18pt-pc">Prendas del pedido</h2>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                	    <button class='botonmodal botonenmodal letra18pt-pc' type='button' id='agregarPrendaapartado'> Agregar prendas </button>
                	</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 letra3pt-mv letra16pt-pc" id="pedidoapartado">
                        
                    </div> 
            	</div>				
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-group pmd-textfield pmd-textfield-floating-label" id="notasdivapartado">
					<label class="control-label letra18pt-pc" for="regular1">Notas</label>
            		<input class="form-control" type="text" id="notasapartado" name="notas" required=""><span class="pmd-textfield-focused"></span>
            	</div>						
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-group pmd-textfield pmd-textfield-floating-label" id="vendedordivapartado">
					<label class="control-label letra18pt-pc" for="vendedorselect">Vendedor</label>
            		<select class="form-control letra18pt-pc" type="select" id="vendedorselectapartado" name="vendedorselect" form="formularioCliente" required="">
            		    <option value='6'>Francisco Arrieta</option>
					</select><span class="pmd-textfield-focused"></span>
            	</div>
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            	    <button class='botonmodal letra18pt-pc' type='button' id='agregarPedidoApartado'> Agregar pedido </button>
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
                <h2 class="letra18pt-pc">Cliente nuevo</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioClienteapartado">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="nombreapartado" class="control-label letra18pt-pc"> Nombre</label>
						<input class="form-control" type="text" id="nombreapartado" name="nombre" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="documento" class="control-label letra18pt-pc"> Teléfono </label>
						<input class="form-control" type="text" id="telefonoapartado" name="telefono" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="telefono" class="control-label letra18pt-pc"> Correo electrónico </label>
						<input class="form-control" type="text" id="correoapartado" name="correo" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="correo" class="control-label letra18pt-pc"> Documento </label>
						<input class="form-control" type="number" id="documentoapartado" name="documento" required=""><span class="pmd-textfield-focused"></span>
					</div>	
					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="clienteGuardadoApartado"> Guardar cliente </button>
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
            <div id="clientesEncontradosapartado">
            
            </div>
        </div>
       
    </div>
    <div id='popup8' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close8'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2>Pedido</h2>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<button class='botonmodal letra18pt-pc' type='button' id='agregarprendaspedidoapartado'> Agregar prendas </button>
				</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="primeraPrendasapartados">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Valor </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Agregar </p>
					</div>
				</div>
            </div>
        </div>
    </div>
    <div id='popup9' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close9'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div id="agregarabonodiv">
				<h2 class="letra18pt-pc">Abono nuevo</h2>
				<div class="form-group pmd-textfield pmd-textfield-floating-label">
					<label for="documento" class="control-label letra18pt-pc"> Valor </label>
					<input class="form-control" type="text" id="abonovalor" name="abonovalor" required=""><span class="pmd-textfield-focused"></span>					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="abonoguardado"> Guardar abono </button>
            </div>
        </div>       
    </div>
    
	
    <div class='popup-overlay pc tablet'></div>
		<!-- modal de Bootstrap -->
		<div class="modal" tabindex="-1" id="ventana-modal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div id="headerModal">
						<button id="closeModalPrincipal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="containerContenido" class="form-group pmd-textfield pmd-textfield-floating-label">
							<div id="col1" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
								<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='buscadorContainer'>
									<label id="titulo" for="BuscarTelefono" class="control-label letra18pt-pc ">Cambio del local</label>
									<label for="BuscarTelefono" class="control-label letra18pt-pc">Buscar por teléfono del cliente</label>
									<input class="form-control" type="text" id='BuscarTelefono2' name="BuscarTelefono" required=""><span class="pmd-textfield-focused"></span>
								</div>
								<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' id='accion'>
									<button class='botonmodal' type='button' id='buscarClienteCambio'> Buscar cliente </button>
								</div>
							</div>
							<div id="col2" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<div id="TituloDatosCliente" class="control-label letra18pt-pc letra ">Datos del cliente</div>
								</div>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='DatosClientesConatiner'>
								</div>
							</div>
							<div id="" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<div id="Tituloprendas" class="control-label letra18pt-pc letra ">Prendas</div>
								</div>
								
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='PrendasConatiner'>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-left: -28px; margin-top: 10px;">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
											<button style="margin-top: 5px;" class='botonmodal botones' type='button' id='cargarPrenda'> Cargar prenda </button>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="listaPrendasCargadas">
										
									</div>
								</div>
							</div>
							<div id="col3" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
								<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
									<div class="letra18pt-pc letra col-lg-6 col-md-6 col-sm-6 col-xs-6"> <p id="diferenciaCliente">DIFERENCIA</p> </div>
									<div class="letra18pt-pc letra col-lg-6 col-md-6 col-sm-6 col-xs-6" > <p id="ValorTotal">$ 0</p></div>
									<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10' >
										<button style="margin-top: 5px;" class='botonmodal' type='button' id='Guardar' > Guardar </button>
									</div>
								</div>
								<div class='col-lg-8 col-md-8 col-sm-8 col-xs-8' id='continerMetodos'>
									
								</div>
							</div>
							
    					</div>
					</div>
				
				</div>
			</div>
		</div>

	
		<!-- modal de Alertas -->
		<div class="modal" tabindex="-1" id="modalAgregarPrendas">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div id="headerModal">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cierreSegundoModal"></button>
					</div>
					<div class="modal-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-left: 15px; margin-top: 10px;">
							<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' >
								<button style="margin-top: 5px;" class='botonmodal botones' type='button' id='cargarPrenda2'> Cargar prenda </button>
							</div>
						</div>
						<div id="containerContenido" class="form-group pmd-textfield pmd-textfield-floating-label" style="margin-top: 69px;">
							<div id="prendasAgregar" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	    <div class="container-fluid pc tablet" id="bloquePrincipal">
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza' id='primeraFila'>
			<div class="container mt-3">
  				<div class="table-responsive" style="width: 110%; margin-left: -7%; margin-top: -7%;height: 823px;">
  				  <table class="table table-bordered tablaResumen">
  				    <thead>
  				      <tr id="titulosTabla">
  				        
  				       <!-- <th><p class='letra18pt-pc negrillaUno'>Efectivo</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Datafono</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Nequi</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Daviplata</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>PayU</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Bancolombia</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Fecha</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Mercancía</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Efectivo</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Datafono</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Nequi</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Daviplata</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>PayU</p></th>
  				        <th><p class='letra18pt-pc negrillaUno'>Bancolombia</p></th> -->
  				      </tr>
  				    </thead>
  				    <tbody id="bodyTabla">
  				    </tbody>
  				  </table>
  				</div>
			</div>	
			</div>	
				<!-- modal de Fase final cambios -->
		<div class="modal" tabindex="-1" id="modalFinalCambios">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div id="headerModal">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cierreSegundoModal"></button>
					</div>
					<div class="modal-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<p class=''>Para confirmar el cambio revisa las prendas que va a devolver el cliente, escanealas y dale click en "Confirmar"</p>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-left: 15px; margin-top: 10px;">
							<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' >
								<button style="margin-top: 5px;" class='botonmodal botones' type='button' id='confirmarCambio'> Confirmar </button>
							</div>
						</div>
						<div id="containerContenidoFinalCambio" class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
						</div>
					</div>
				</div>
			</div>
		</div>		
		   <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza primeraFilaDia'style='display: none;' id='primeraFila' >
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>PA</p>
    	       </div>
    	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
    	           <p class='letra18pt-pc negrillaUno'>Cliente</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Teléfono</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Fecha</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Compra</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Valor y método de pago</p>
    	       </div>
    	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
    	           <p class='letra18pt-pc negrillaUno'>Notas</p>
    	       </div>
	       </div>	       
	   </div>
	  

	   
	<div id='cuerpoCell' class="container-fluid celular">
		<div id='botonesEscaner' >
			<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion01'><button class='botonmodal' type='button' id='empezarEscaner'>Iniciar escaner</button></div>
			<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion02'><button class='botonmodal' type='button' id='agregarVentaCell'>Agregar venta</button></div>
        </div>
		<div style="width: 100%" id="inicialReader"></div>
			<div id='inicialEscaner' style='display: none;'>
				<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarParaventa' ><button class='botonmodal letra18pt-pc' type='button'>Enviar para venta</button></div>
				<div id='escaneados' style='display: none;' ></div>
			</div>
		</div>
		<!-- ----------------------------------Parte para agendar desde el celular ----------------------------->
		<div id='pop' style='display: none;' class="celular">
        <div class='content-pop'>
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc" id="ventaNuevaTitulo" name="2020-09-14">Venta nueva</h2>
            	<div action="https://concurvas.com/team/controlador/" method="get"  autocomplete="off" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="buscarCliente">
        		    <div class="form-group pmd-textfield pmd-textfield-floating-label">
        		        <label for="tele" class="control-label letra18pt-pc"> Teléfono</label>
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
            				<input class="form-control" type="number" id="telVenta" name="telVenta" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="text" id="correov" name="correov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            			<div class="form-group pmd-textfield pmd-textfield-floating-label">
            				<input class="form-control" type="number" id="documentov" name="documentov" required="" disabled="disabled"><span class="pmd-textfield-focused"></span>
            			</div>
            	        <input class="off" type="number" id="idCliente" name="idCliente" required="" type="hidden">
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
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group pmd-textfield pmd-textfield-floating-label" id="notasdiv">
					<label class="control-label letra18pt-pc" for="regular1">Notas</label>
            		<input class="form-control" type="text" id="notas" name="notas" required=""><span class="pmd-textfield-focused"></span>
            	</div>						
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group pmd-textfield pmd-textfield-floating-label" id="vendedordiv">
					<label class="control-label letra18pt-pc" for="vendedorselect">Vendedor</label>
            		<select class="form-control letra18pt-pc" type="select" id="vendedorselect" name="vendedorselect" form="formularioCliente" required="">
            		    <option value='6'>Francisco Arrieta</option>
					</select><span class="pmd-textfield-focused"></span>
            	</div>
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	    <button class='botonmodal letra18pt-pc' type='button' id='agregarPedido'> Agregar pedido </button>
            	</div>
            </div>
        </div>
    </div>
    <div id='pop2' style='display: none;' class="celular">
          <div class='content-pop'>
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
						<label for="telefono" class="control-label letra18pt-pc"> Correo electrónico </label>
						<input class="form-control" type="text" id="correo" name="correo" required=""><span class="pmd-textfield-focused"></span>
						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="correo" class="control-label letra18pt-pc"> Documento </label>
						<input class="form-control" type="number" id="documento" name="documento" required=""><span class="pmd-textfield-focused"></span>
					</div>	
					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="clienteGuardado"> Guardar cliente </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>
    <div id='pop3' style='display: none;' class="celular">
        <div class='content-pop'>
            <div class='close'><a href='#' id='close3'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div id="clientesEncontrados">
            
            </div>
        </div>
       
    </div>
    <div id='pop4' style='display: none;' class="celular">
        <div class='content-pop'>
            <div class='close'><a href='#' id='close4'>
               <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div> 
            <div>
                <h2>Pedido</h2>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<button class='botonmodal letra18pt-pc' type='button' id='agregarprendaspedido'> Agregar prendas </button>
				</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="primeraPrendas">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Prenda </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc">Descripción</p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Valor </p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p type="submit" class="letra18pt-pc" > Agregar </p>
					</div>
				</div>
            </div>
        </div>
    </div>
	
		

	</div>
<?php
	   get_footer("ventas-plaza"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>