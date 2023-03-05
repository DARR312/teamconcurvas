<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("insumos");
?>
    <div id='cuerpo' class="container-fluid pc tablet" >        
        <div id="referenciaNueva"  style='display: none;' class="funcionamiento">
            
        </div>
        <div id="nuevoInsumo"  style='display: none;' class="funcionamiento">
            <form action='' method='get'  autocomplete='off' class='col-lg-12 col-md-12 col-sm-12 col-xs-12 esconder' id='formNuevoInsumo'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Grupo </label>
                    <select class='form-control' type='select' id='grupo' name='grupo' form='formNuevoInsumo' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
    				<label for="cantidad" class="control-label letra18pt-pc"> Nuevo grupo </label>
    				<input class="form-control" type="text" id="nuevogrupo" name="nuevogrupo" required=""><span class="pmd-textfield-focused"></span>
    			</div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Complemento </label>
                    <select class='form-control' type='select' id='complemento' name='complemento' form='formNuevoInsumo' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
    				<label for="cantidad" class="control-label letra18pt-pc"> Nuevo Complemento </label>
    				<input class="form-control" type="text" id="nuevocomplemento" name="nuevocomplemento" required=""><span class="pmd-textfield-focused"></span>
    			</div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Carácteristica </label>
                    <select class='form-control' type='select' id='caracteristica' name='caracteristica' form='formNuevoInsumo' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
    				<label for="cantidad" class="control-label letra18pt-pc"> Nueva caráctaristica </label>
    				<input class="form-control" type="text" id="nuevacaracteristica" name="nuevacaracteristica" required=""><span class="pmd-textfield-focused"></span>
    			</div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc">Complemento Carácteristica </label>
                    <select class='form-control' type='select' id='Complementocaracteristica' name='Complementocaracteristica' form='formNuevoInsumo' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
    				<label for="cantidad" class="control-label letra18pt-pc">Complemento Nueva caráctaristica </label>
    				<input class="form-control" type="text" id="Complementonuevacaracteristica" name="Complementonuevacaracteristica" required=""><span class="pmd-textfield-focused"></span>
    			</div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Presentación </label>
                    <select class='form-control' type='select' id='presentacion' name='presentacion' form='formNuevoInsumo' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
    				<label for="cantidad" class="control-label letra18pt-pc"> Nueva Presentación </label>
    				<input class="form-control" type="text" id="nuevapresentacion" name="nuevapresentacion" required=""><span class="pmd-textfield-focused"></span>
    			</div>
            </form>
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 esconder' id='guardarInsumoDiv'><button class='botonmodal' type='button' id='guardarInsumo'>Guardar Insumo</button></div>
        </div>
        <p id='insumoAgregadoOk' class='oculto avisoOk'>Insumo Agregado</p>
        <div id="facturaNueva"  style='display: none;' class="funcionamiento">
            <form action='' method='get'  autocomplete='off' class='col-lg-12 col-md-12 col-sm-12 col-xs-12 esconder' id='formNuevaFactura'>
                <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                        <label for="nombreReferencia" class="control-label letra18pt-pc"> Proveedor </label>
                        <select class='form-control' type='select' id='proveedor' name='proveedor' form='formNuevaFactura' required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <label for="cantidad" class="control-label letra18pt-pc"> Nuevo proveedor </label>
                        <input class="form-control" type="text" id="nuevoproveedor" name="nuevoproveedor" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                </div>
                <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6 pmd-textfield-floating-label-completed'>
                        <label for="nombreReferencia" class="control-label letra18pt-pc"> Insumo </label>
                        <select class='form-control insumosselec' type='select' id='insumo1' name='1' form='formNuevaFactura' required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <label for="cantidad" class="control-label letra18pt-pc"> Valor </label>
                        <input class="form-control" type="number" id="valor1" name="1" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                        <input class="form-control" type="number" id="cantidad1" name="1" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                </div>
            </form>
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 esconder' id='guardarInsumoDiv'><button class='botonmodal' type='button' id='pasoFinalFactura'>Continuar</button></div>
        </div>
        <p id='facturaAgregadaOk' class='oculto avisoOk'>Factura Agregada</p>
    </div>
    <!-- modal de Bootstrap -->
    <div class="modal" tabindex="-1" id="modalContable">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cierreModal"></button>
                </div>
                <div class="modal-body">
                    <div id="col1" class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='titulo'>
                            <label id="titulo" for="nombre" class="control-label letra18pt-pc ">Información factura</label>
                            <label for="nombre" class="control-label letra18pt-pc">Buscar por teléfono del cliente</label>
                            <input class="form-control" type="text" id='BuscarTelefono2' name="BuscarTelefono" required=""><span class="pmd-textfield-focused"></span>
                        </div>
                        <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' id='accion'>
                            <button class='botonmodal' type='button' id='buscarClienteCambio'> Buscar cliente </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	   get_footer("insumos"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>