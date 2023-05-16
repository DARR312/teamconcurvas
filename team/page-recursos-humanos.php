<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("recursos-humanos");
?>

    <div id='cuerpo' class="container-fluid pc tablet" >        
        <div id="nuevoEmpleado"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="nombreEmpleado" class="control-label letra18pt-pc"> Nombre completo </label>
                    <input class="form-control" type="text" id="nombreEmpleado" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4 pmd-textfield-floating-label-completed'>
                    <label for="cargoEmpleado" class="control-label letra18pt-pc"> Cargo </label>
                    <select class='form-control' type='select' id='cargoEmpleado' name='' form='' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="nuevoCargo" class="control-label letra18pt-pc"> Nuevo cargo </label>
                    <input class="form-control" type="text" id="nuevoCargo" required=""><span class="pmd-textfield-focused"></span>
                </div>
            </div>
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="datetimepicker-fecha-nacimiento">Fecha de nacimiento</label>
                        <input type="text" id="datetimepicker-fecha-nacimiento" class="form-control" />
                    </div>
                </div>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4 pmd-textfield-floating-label-completed'>
                    <label for="tipoId" class="control-label letra18pt-pc"> Tipo de identificación </label>
                    <select class='form-control' type='select' id='tipoId' name='' form='' required=''>
                        <option class='remover'  value='CC'>Cédula de ciudadanía</option>
                        <option class='remover'  value='CE'>Cédula de extranjería</option>
                        <option class='remover'  value='PP'>Pasaporte</option>
                        <option class='remover'  value='PP'>Pasaporte</option>
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="identificacion" class="control-label letra18pt-pc"> # Identificación </label>
                    <input class="form-control" type="text" id="identificacion" required=""><span class="pmd-textfield-focused"></span>
                </div>
            </div>
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="direccion" class="control-label letra18pt-pc"> Dirección </label>
                    <input class="form-control" type="text" id="direccion" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="correo" class="control-label letra18pt-pc"> Correo electrónico </label>
                    <input class="form-control" type="text" id="correo" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="telefono" class="control-label letra18pt-pc"> Teléfono </label>
                    <input class="form-control" type="number" id="telefono" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="datetimepicker-fecha-contratacion">Fecha de contratación</label>
                        <input type="text" id="datetimepicker-fecha-contratacion" class="form-control" />
                    </div>
                </div>
            </div>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 esconder' ><button class='botonmodal' type='button' id='guardarNuevoEmpleado'>Guardar</button></div>    
        </div>
        
        <p id='empleadoCreadoOk' class='oculto avisoOk'>Empleado Creado</p>
        
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
	   get_footer("recursos-humanos"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>