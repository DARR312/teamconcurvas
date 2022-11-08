<?php
	if(is_user_logged_in()){
	    get_header("reglas");
?>
    <div id='popup' style='display: none;' class="pc tablet">
        <div class='content-popup'>
            <div class='close'><a href='#' id='close'>
                <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/close.png'/></a>
            </div>
            <div>
                <h2 class="letra18pt-pc" id="ventaNuevaTitulo" name="2020-09-14">Regla nueva</h2>     
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="documento" class="control-label letra18pt-pc">Nombre de la nueva regla</label>
                            <input class="form-control" type="text" id="nombre_regla" name="nombre_regla" required=""><span class="pmd-textfield-focused"></span>
                        </div>
                    </div> 
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="documento" class="control-label letra18pt-pc">Descripción de la nueva regla</label>
                            <input class="form-control" type="text" id="descripcion_regla" name="descripcion_regla" required=""><span class="pmd-textfield-focused"></span>
                        </div>
                    </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class='botonmodal letra18pt-pc' type='button' id='agregarReglaNueva'> Confirmar </button>
                    </div>            
                </div>                   
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="tiporegla">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label letra18pt-pc" for="regular1">Tipo regla</label>
                            <select class="form-control letra18pt-pc" type="select" id="tipor" name="origen" form="formularioCliente" onchange="seleccionTiporegla()">

                            </select><span class="pmd-textfield-focused"></span>
                        </div>
                    </div> 
                    <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8'>
                        <p class='letra18pt-pc negrillaUno' id='descripcionregla'>Descripción</p>
                    </div>             
                </div>        
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">     
                    <div class='reiniciaregla' id='por_numero'>                                
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="documento" class="control-label letra18pt-pc"># Prendas condición </label>
                                <input class="form-control" type="number" id="prendas_condicion" name="prendas_condicion" required=""><span class="pmd-textfield-focused"></span>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="documento" class="control-label letra18pt-porcentaje_descuento">Porcentaje de descuento </label>
                                <input class="form-control" type="number" id="porcentaje_descuento" name="porcentaje_descuento" required=""><span class="pmd-textfield-focused"></span>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="documento" class="control-label letra18pt-pc"># Prendas con descuento </label>
                                <input class="form-control" type="number" id="prendas_descuento" name="prendas_descuento" required=""><span class="pmd-textfield-focused"></span>
                            </div>
                        </div>    
                    </div>           
                    <div class='reiniciaregla' id='todas' style='display: none;'>            
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="documento" class="control-label letra18pt-pc">Porcentaje de descuento </label>
                                <input class="form-control" type="number" id="todas_porcentaje" name="todas_porcentaje" required=""><span class="pmd-textfield-focused"></span>
                            </div>
                        </div> 
                    </div>             
                    <div class='reiniciaregla' id='referencia' style='display: none;'>            
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id="refere1">
                            <div class="form-group pmd-textfield pmd-textfield-floating-label" >
                                <label class="control-label letra18pt-pc" for="referencias">Referencias</label>
                                <select class="form-control letra18pt-pc referenciaselect" type="select" id="referencias1" name="referencias" form="referencias" onchange="seleccionRefere(1)">

                                </select><span class="pmd-textfield-focused"></span>
                            </div>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="documento" class="control-label letra18pt-pc">Porcentaje de descuento </label>
                                <input class="form-control" type="number" id="referencia_porcentaje" name="referencia_porcentaje" required=""><span class="pmd-textfield-focused"></span>
                            </div>
                        </div> 
                    </div>           
                </div>       
            </div>
        </div>
    </div>    
    <div class='popup-overlay pc tablet'></div>
    <div class="container-fluid pc tablet" id="bloquePrincipal">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraFila'>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                <p class='letra18pt-pc negrillaUno'>Descripción</p>
            </div> 
            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                <p class='letra18pt-pc negrillaUno'># Prendas en venta</p>
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                <p class='letra18pt-pc negrillaUno'>Prendas con descuento</p>
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                <p class='letra18pt-pc negrillaUno'>% Descuento</p>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                <p class='letra18pt-pc negrillaUno'>Activar desactivar</p>
            </div>
        </div>	       
    </div>
<?php
	   get_footer("reglas"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>