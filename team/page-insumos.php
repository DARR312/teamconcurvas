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
                        <input class="form-control fv" type="text" id="nuevoproveedor" name="nuevoproveedor" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                </div>
                <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6 pmd-textfield-floating-label-completed'>
                        <label for="nombreReferencia" class="control-label letra18pt-pc"> Insumo </label>
                        <select class='form-control fv insumosselec' type='select' id='insumo1' name='1' form='formNuevaFactura' required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <label for="cantidad" class="control-label letra18pt-pc"> Valor </label>
                        <input class="form-control fv" type="number" id="valor1" name="1" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                        <input class="form-control fv" type="number" id="cantidad1" name="1" required=""><span class="pmd-textfield-focused"></span>
                    </div>
                </div>
            </form>
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 esconder' id='guardarInsumoDiv'><button class='botonmodal' type='button' id='pasoFinalFactura'>Continuar</button></div>
        </div>
        <p id='facturaAgregadaOk' class='oculto avisoOk'>Factura Agregada</p>
        <div id="resumenInvInsumos"  style='display: none;' class="funcionamiento">
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cabecerasResumen'>
                <div class=' col-lg-8 col-md-8 col-sm-8 col-xs-8'>
                    <p  class="letra18pt-pc">Descripción</p>
                </div>
                <div class=' col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <p  class="letra18pt-pc">Cantidad</p>
                </div>
            </div>
        </div>
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
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='titulo'>
                            <label id='tituloFactura' for="nombre" class="control-label letra18pt-pc ">Información factura</label>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <label id='valorCosto' for="nombre" class="control-label letra18pt-pc">Costo: $0</label>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label class="control-label letra18pt-pc"> # Factura proveedor </label>
                            <input class="form-control" type="text" id="identificador" required=""><span class="pmd-textfield-focused"></span>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                            <label class="control-label letra18pt-pc"> IVA </label>
                            <select class='form-control' type='select' id='iva' name='1' required=''>
                                <option  value='No'>No</option>
                                <option  value='Si'>Sí</option>
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valorIva'> Valor </label>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                            <label class="control-label letra18pt-pc"> Retención 1 </label>
                            <select class='form-control retenciones' type='select' id='retencion1' name='1' required=''>
                                
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valRetencio1'> Valor </label>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                            <label class="control-label letra18pt-pc"> Retención 2 </label>
                            <select class='form-control retenciones' type='select' id='retencion2' name='2' required=''>
                                
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valRetencio2'> Valor </label>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                            <label class="control-label letra18pt-pc"> Retención 3 </label>
                            <select class='form-control retenciones' type='select' id='retencion3' name='3' required=''>
                                
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valRetencio3'> Valor </label>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valor_total'> Valor total de la factura</label>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="cantidad" class="control-label letra18pt-pc"> Valor pagado </label>
                            <input class="form-control" type="number" id="valor_pagado" required=""><span class="pmd-textfield-focused"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label class="letra18pt-pc" id='valor_porpagar'> Valor por pagar </label>
                        </div>
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='guardarFactura'> Guardar factura </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal de Bootstrap Resumen -->
    <div class="modal" tabindex="-1" id="modalResumen">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloResumenFactura' for="nombre" class="control-label letra18pt-pc ">Resumen factura</label>
                    </div>
                    <div id='resumenInsumosFactura'>
                        <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                            <div class=' col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                                <label class="control-label letra18pt-pc"> Concepto </label>
                            </div>
                            <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                                <label class="control-label letra18pt-pc"> Cantidad </label>
                            </div>                          
                            <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                                <label class="control-label letra18pt-pc"> Valor unitario </label>
                            </div>                 
                            <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                                <label class="control-label letra18pt-pc"> Valor total </label>
                            </div>  
                        </div>
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc"> Valor neto </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valCosto'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc"> IVA </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valIva'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc" id='retencionConcept1'> Retención 1 </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valRete1'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc" id='retencionConcept2'> Retención 2 </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valRete2'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc" id='retencionConcept3'> Retención 3 </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valRete3'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc"> Valor total </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valTotal'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc"> Valor pagado </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valPagado'> $ 0 </label>
                        </div>                        
                    </div>
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class=' col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                            <label class="control-label letra18pt-pc"> Valor a pagar </label>
                        </div>
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="letra18pt-pc" id='valPagar'> $ 0 </label>
                        </div>                        
                    </div>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='confirmarFactura'> Confirmar </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal de Bootstrap Resumen -->
    <div class="modal" tabindex="-1" id="modalCrédito">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloResumenFacturaCredito' for="nombre" class="control-label letra18pt-pc "></label>
                    </div>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="cantidad" class="control-label letra18pt-pc"> Días de crédito</label>
                    <input class="form-control" type="number" id="dias_credito" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='confirmarFacturaCredito'> Confirmar </button>
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