<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("inventario");
?>
    <div id='cuerpo' class="container-fluid pc tablet" >
        <div id="resultados"  style='display: none;'>
            <input type='button' id='btnExport' class='botonmodal' value=' Descargar excel de marquillas' style='display: none;'/>
            
        </div>
        <div id="referenciaNueva"  style='display: none;' class="funcionamiento">
            <form action='' method='get'  autocomplete='off' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='formularioReferencia'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Nombre de la referencia</label>
                    <input class="form-control" type="text" id="nombreReferencia" name="nombreReferencia" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="categoria" class="control-label letra18pt-pc"> Categoría</label>
                    <select class='form-control' type='select' id='categoria' name='categoria' form='formularioReferencia' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4" style='display: none;' id="categoriaDiv">
    				<label for="cantidad" class="control-label letra18pt-pc"> Cuál</label>
    				<input class="form-control" type="text" id="cualCategoria" name="cualCategoria" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12" id="detalDiv">
    				<label for="precioDetal" class="control-label letra18pt-pc"> Precio detal</label>
    				<input class="form-control" type="number" id="precioDetal" name="precioDetal" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mayorDiv">
    				<label for="precioMayor" class="control-label letra18pt-pc"> Precio mayor</label>
    				<input class="form-control" type="number" id="precioMayor" name="precioMayor" required=""><span class="pmd-textfield-focused"></span>
    			</div>
            </form>
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12' id='guardarRef'><button class='botonmodal' type='button' id='guardarReferencia'>Guardar Referencia</button></div>
        </div>
        <div id="codigosNuevos"  style='display: none;' class="funcionamiento">
            <form action='' method='get'  autocomplete='off' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='formularioCodigos'>
                <!--<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-5 col-md-5 col-sm-5 col-xs-5" id="numeroCorteDiv">
    				<label for="numeroCorte" class="control-label letra18pt-pc"> Número de corte</label>
    				<input class="form-control" type="number" id="numeroCorte" name="numeroCorte" required=""><span class="pmd-textfield-focused"></span>
    			</div>-->
    			<div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-5 col-md-5 col-sm-5 col-xs-5" id="numeroSateliteDiv">
    				<label for="numeroSatelite" class="control-label letra18pt-pc"> Número de satélite</label>
    				<input class="form-control" type="number" id="numeroSatelite" name="numeroSatelite" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="referencia1" class="control-label letra18pt-pc"> Referencia 1</label>
                    <select class='form-control referencia' type='select' id='referencia1' name='referencia1' form='formularioReferencia' required=''>
                       
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
    				<label for="cantidad1" class="control-label letra18pt-pc"> Cantidad 1</label>
    				<input class="form-control" type="number" id="cantidad1" name="cantidad1" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="referencia2" class="control-label letra18pt-pc"> Referencia 2</label>
                    <select class='form-control referencia' type='select' id='referencia2' name='referencia2' form='formularioReferencia' required=''>
                       
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
    				<label for="cantidad2" class="control-label letra18pt-pc"> Cantidad 2</label>
    				<input class="form-control" type="number" id="cantidad2" name="cantidad2" required=""><span class="pmd-textfield-focused"></span>
    			</div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="referencia3" class="control-label letra18pt-pc"> referencia 3</label>
                    <select class='form-control referencia' type='select' id='referencia3' name='referencia3' form='formularioReferencia' required=''>
                       
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
    				<label for="cantidad3" class="control-label letra18pt-pc"> Cantidad 3</label>
    				<input class="form-control" type="number" id="cantidad3" name="cantidad3" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="referencia4" class="control-label letra18pt-pc"> referencia 4</label>
                    <select class='form-control referencia' type='select' id='referencia4' name='referencia4' form='formularioReferencia' required=''>
                       
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2" >
    				<label for="cantidad4" class="control-label letra18pt-pc"> Cantidad 4</label>
    				<input class="form-control" type="number" id="cantidad4" name="cantidad4" required=""><span class="pmd-textfield-focused"></span>
    			</div>
    			<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8'>
    			    <label for="referencia5" class="control-label letra18pt-pc">Referencia 5</label>
                    <select class='form-control referencia' type='select' id='referencia5' name='referencia5' form='formularioReferencia' required=''>
                       
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
    				<label for="cantidad5" class="control-label letra18pt-pc"> Cantidad 5</label>
    				<input class="form-control" type="number" id="cantidad5" name="cantidad5" required=""><span class="pmd-textfield-focused"></span>
    			</div>
            </form>
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12' id='crearMarquillas'><button class='botonmodal' type='button' id='crearCodes'>Crear códigos +</button></div>
        </div>
        <div id="verCodigo"  style='display: none;' class="funcionamiento">
            <div id='tituloscodigos'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    	           <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Codigo</p>
        	       </div> 
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Descripción</p>
        	       </div> 
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Estado</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Cual</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Notas</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Última fecha</p>
        	       </div>
                </div>
	       </div>
        </div>
        <div id="verResumenprendas"  style='display: none;' class="funcionamiento">
            <div class="ochentaycinco fijo" id='primeraFilaResumen'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    	           <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
        	           <p class=' letra18pt-pc'>Referencia</p>
        	       </div> 
        	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
        	           <p class=' letra18pt-pc'>Fábrica</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Bodega plaza</p>
        	       </div>
        	       <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
        	           <p class=' letra18pt-pc'>En plaza</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>En satélite</p>
        	       </div>
        	       <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Precio</p>
        	       </div>
                </div>
	       </div>
        </div>
        <div id="auditoriaInventario"  style='display: none;'>
            <div class="ochentaycinco fijo" id='primeraAuditoria'>
          <?php  if( is_admin_user() ) { $last = $wpdb->get_results( "SELECT MAX(ID) as id FROM con_t_auditoriasinventario");?>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12 padding5' id='acc'>
                    <button class='botonmodal botonesInventario letra18pt-pc' type='button' id='empezarNueva'>Empezar nueva auditoria</button>
                </div>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12 padding5' id='filtroNuevoinv'>
                   <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                    	<label class="control-label letra18pt-pc" for="regular1">Fecha en la que empieza la auditoría</label>
                    	<input type="text" id="datetimepicker-filtroNuevoinv" class="form-control" />
                    </div>
                </div>
         <?php }?>         
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 padding5' id='fechaAudito' name='<?php echo $last[0]->id ?>'>
                
                </div>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Referencia</p>
        	        </div> 
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Descripción</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Estado</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Cual</p>
        	        </div>                    
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Complemento</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	            <p class=' letra18pt-pc'>Fecha</p>
        	        </div>
        	   </div>
            </div>
        </div>
        <div id="subirInformes"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cargarInformediv'>
                <input type="file" id="demo" accept=".xls,.xlsx" class='col-lg-6 col-md-6 col-sm-6 col-xs-12'/>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                   <button class='botonmodal botonesInventario' type='button' id='cargarInforme'>Cargar informe</button>
                </div>
            </div>
        </div>
        <div id="informeDinero"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cargarInformeDinero'>
                <input type="file" id="dinero" accept=".xls,.xlsx" class='col-lg-6 col-md-6 col-sm-6 col-xs-12'/>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                   <button class='botonmodal botonesInventario' type='button' id='cargarInformeDineroButton'>Cargar informe</button>
                </div>
            </div>
        </div>
        <div id="ventasVSinventario"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='informeAuditoriaz'>
                
            </div>
        </div>
        <div id="inventarioInicialPc"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='codigosInicalesPc'>
                
            </div>
        </div>        
        <div id="liberarEmpacados"  style='display: none;' class="funcionamiento">
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12" id="codigoEmpacado">
    			<label for="buscarempacado" class="control-label letra18pt-pc"> Código empacado </label>
    			<input class="form-control" type="text" id="buscarempacado" name="buscarempacado" required="" min='0'><span class="pmd-textfield-focused"></span>
    		</div>
            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                <button class='botonmodal botonesInventario' type='button' id='liberarEmpaque'>Liberar</button>
            </div>
        </div>        
        <div id="madrugonDiv"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraMadrugones'>
                <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                    <p class=' letra18pt-pc'>ID Madrugón</p>
                </div> 
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                    <p class=' letra18pt-pc'>Fecha</p>
                </div>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                    <p class=' letra18pt-pc'>Valor en mercancía</p>
                </div>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                    <p class=' letra18pt-pc'>Valor en dinero</p>
                </div>                      
                <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                    <p class=' letra18pt-pc'>Valor en cambios</p>
                </div>                 
                <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                    <p class=' letra18pt-pc'>Diferencia</p>
                </div>              
                <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>
                    <p class=' letra18pt-pc'>Madrugón ok</p>
                </div>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                    <p class=' letra18pt-pc'>Ver prendas de este madrugón</p>
                </div>
            </div>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='display: none;' id='primeraPrendasMadrugones'>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Referencia</p>
        	        </div> 
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Descripción</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Estado</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Cual</p>
        	        </div>                    
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	           <p class=' letra18pt-pc'>Complemento</p>
        	        </div>
        	        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
        	            <p class=' letra18pt-pc'>Fecha</p>
        	        </div>
        	   </div>
        </div>         
        <div id="fechaslotesdiv"  style='display: none;' class="funcionamiento">
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='prmra'>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                    <p class=' letra18pt-pc'># Lote</p>
                </div> 
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <p class=' letra18pt-pc'>Fecha</p>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                    <p class=' letra18pt-pc'>Nueva fecha</p>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                    <p class=' letra18pt-pc'>Cambiar</p>
                </div>
            </div>  
        </div> 
    </div>
    <div id='cuerpoCell' class="container-fluid celular" >
        <div id='botonesEscaner' >
        </div>
        <div style="width: 100%" id="inicialReader"></div>
        <div id='inicialEscaner' style='display: none;'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarInicialEscaneados' ><button class='botonmodal letra18pt-pc' type='button'>Enviar escaneados</button></div>
            <div id='escanerInvInicial' style='display: none;' ></div>
        </div>
        <div style="width: 100%" id="readerTerminados"></div>
        <div id='funcionesEscanerTerminados' style='display: none;'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarTerminados' ><button class='botonmodal letra18pt-pc' type='button'>Enviar escaneados</button></div>
            <div id='escanerTermin' style='display: none;' >
            </div>
        </div>
        <div style="width: 100%" id="reader"></div>
        <div id='funcionesEscaner' style='display: none;'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarEscaneados' ><button class='botonmodal letra18pt-pc' type='button'>Enviar escaneados</button></div>
            <div id='escanerInv' style='display: none;' >
            </div>
        </div>
        <div style="width: 100%" id="readerEmpacar"></div>
        <div id='funcionesEmpacar' style='display: none;'>
            <p id='escanerEmpaques' style='display: none;' >
            </p>
        </div>
        <div style="width: 100%" id="readerPrendaEmpacada" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarEmpacados' style='display: none;'><button class='botonmodal letra18pt-pc' type='button'>Empacar pedido</button></div>
        <div style="width: 100%" id="readerDespachar" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
        <div id='funcionesDespachar' style='display: none;'>
            <p id='escanerDespachos' style='display: none;' >
            </p>
        </div>
        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='confirmarDespacho' style='display: none;'><button class='botonmodal letra18pt-pc' type='button' id='confirmarDespachoButton'>Confirmar pedido</button></div>
        <div style="width: 100%" id="readerDan"></div>
        <div id='funcionesDan' style='display: none;'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarDan' ><button class='botonmodal letra18pt-pc' type='button'>Enviar a dañados</button></div>
            <div id='escanerDan' style='display: none;' >
          </div>
        </div>
        <div style="width: 100%" id="readerVentaplaza"></div>
        <div id='funcionesVentaplaza' style='display: none;'>
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12" id="paventa">
    			<label for="pavender" class="control-label letra18pt-pc"> PA- </label>
    			<input class="form-control" type="number" id="pavender" name="pavender" required="" min='0'><span class="pmd-textfield-focused"></span>
    		</div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='ventaEnviar' ><button class='botonmodal letra18pt-pc' type='button'>Enviar a venta</button></div>
            <div id='ventaPlazaenviar' style='display: none;' >
          </div>
        </div>
        <div style="width: 100%" id="readerMadrugon"></div>
        <div id='funcionesMadru' style='display: none;'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='enviarMadru' ><button class='botonmodal letra18pt-pc' type='button'>Enviar a madrugón</button></div>
            <div id='escanerMadru' style='display: none;' >
          </div>
        </div>
        <div style="width: 100%" id="readerVentamayorista"></div>
        <div id='funcionesVetamayorista' style='display: none;'>
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12" id="paventa">
    			<label for="vmvender" class="control-label letra18pt-pc"> VM- </label>
    			<input class="form-control" type="number" id="vmvender" name="vmvender" required="" min='0'><span class="pmd-textfield-focused"></span>
    		</div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='ventaEnviarMayorista' ><button class='botonmodal letra18pt-pc' type='button'>Enviar a venta</button></div>
            <div id='ventaMayoristaenviar' style='display: none;' >
          </div>
        </div>        
        <div id="verResumenprendasCell"  style='display: none;'>
            
        </div>
    </div>
    <div id='popup' style='display: none;' class="pc tablet">
        <div class='content-popup' id="editarValorVenta">
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc">Subir dinero</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioCliente">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="valorDinero" class="control-label letra18pt-pc"> Valor dinero</label>
						<input class="form-control" type="number" id="valorDinero" name="valorDinero" required=""><span class="pmd-textfield-focused"></span>
                    </div>					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="dineroGuardado"> Guardar dinero </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>
    <div id='popup1' style='display: none;' class="pc tablet">
        <div class='content-popup' id="editarValorCambios">
            <div class='close'><a href='#' id='close1'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc">Subir dinero</h2>
                <div action="" method="get" accept-charset="UTF-8" autocomplete="off" class="" id="formularioCliente">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="valorDineroCambio" class="control-label letra18pt-pc"> Valor dinero</label>
						<input class="form-control" type="number" id="valorDineroCambio" name="valorDineroCambio" required=""><span class="pmd-textfield-focused"></span>
                    </div>					
				</div>
				<button type="submit" class="botonmodal letra18pt-pc" id="dineroGuardadoCambios"> Guardar dinero </button>
                <div style='float:left; width:100%;'>
                </div>
            </div>
        </div>
    </div>

    <!-- modal de Bootstrap Alertas -->
    <div class="modal" tabindex="-1" id="modalAlertas">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloAlertas' for="nombre" class="control-label letra18pt-pc "></label>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    
<?php
	   get_footer("inventario"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>