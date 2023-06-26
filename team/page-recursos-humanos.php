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
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='divFechaContratacion'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="datetimepicker-fecha-contratacion">Fecha de contratación</label>
                        <input type="text" id="datetimepicker-fecha-contratacion" class="form-control" />
                    </div>
                </div>                   
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="direccion" class="control-label letra18pt-pc"> Dirección </label>
                    <input class="form-control" type="text" id="direccion" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>             
            </div>
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
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
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="correo" class="control-label letra18pt-pc"> Correo electrónico </label>
                    <input class="form-control" type="text" id="correo" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="telefono" class="control-label letra18pt-pc"> Teléfono </label>
                    <input class="form-control" type="number" id="telefono" name="" required=""><span class="pmd-textfield-focused"></span>
                </div>
            </div>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 esconder' ><button class='botonmodal' type='button' id='guardarNuevoEmpleado'>Guardar</button></div>    
        </div>       
        <p id='empleadoCreadoOk' class='oculto avisoOk'>Empleado Creado</p>
        <div id="verEmpleadosDiv"  class="funcionamiento oculto">
            <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed' id='empelDiv'>
                <label for="empleadoSelect" class="control-label letra18pt-pc"> Empleado </label>
                <select class='form-control' type='select' id='empleadoSelect' name='' form='' required=''>
                    
                </select><span class='pmd-textfield-focused'></span>
            </div>
        </div>      
    </div>

    
    <!-- modal de Bootstrap Horarios -->
    <div class="modal" tabindex="-1" id="modalHorarios">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloHorarios' for="nombre" class="control-label letra18pt-pc ">Selecciona hora de entrada y salida para el </label>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-horariode-entrada">Horario de entrada</label>
                            <input type="text" id="datetimepicker-horariode-entrada" class="form-control" />
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-horariode-salida">Horario de salida</label>
                            <input type="text" id="datetimepicker-horariode-salida" class="form-control" />
                        </div>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                            <button class='botonmodal' type='button' id='cambiarHorario'>Cambiar horario</button>
                        </div>    
                    </div>
                </div>                
            </div>
        </div>
    </div>
    
    
    <!-- modal de Bootstrap Permisos -->
    <div class="modal" tabindex="-1" id="modalPermisos">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <p id='tituloPermisos' for="nombre" class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>Selecciona fecha y hora de inicio y fin de la ausencia, junto con su tipo y motivos </p>
                    
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed' id='empelDiv'>
                        <label for="tipoAusenciaSelect" class="control-label letra18pt-pc"> Tipo de ausencia </label>
                        <select class='form-control' type='select' id='tipoAusenciaSelect' name='' form='' required=''>
                            <option value='selecciona'>Selecciona</option>
                            <option value='Vacaciones'>Vacaciones</option>
                            <option value='Día libre por enfermedad'>Día libre por enfermedad</option>
                            <option value='Permiso por maternidad'>Permiso por maternidad</option>
                            <option value='Permiso por paternidad'>Permiso por paternidad</option>
                            <option value='Permiso por adopción'>Permiso por adopción</option>
                            <option value='Licencia por enfermedad grave de un familiar cercano'>Licencia por enfermedad grave de un familiar cercano</option>
                            <option value='Permiso por fallecimiento de un familiar cercano'>Permiso por fallecimiento de un familiar cercano</option>
                            <option value='Licencia por enfermedad personal'>Licencia por enfermedad personal</option>
                            <option value='Permiso por cita médica'>Permiso por cita médica</option>
                            <option value='Licencia por accidente o lesión'>Licencia por accidente o lesión</option>
                            <option value='Permiso por asuntos familiares'>Permiso por asuntos familiares</option>
                            <option value='Permiso por estudio o formación'>Permiso por estudio o formación</option>
                            <option value='Licencia por duelo'>Licencia por duelo</option>
                            <option value='Permiso por traslado de residencia'>Permiso por traslado de residencia</option>
                            <option value='Permiso por matrimonio'>Permiso por matrimonio</option>
                            <option value='Licencia por donación de sangre o médula ósea'>Licencia por donación de sangre o médula ósea</option>
                            <option value='Permiso por servicio militar'>Permiso por servicio militar</option>
                            <option value='Licencia por adopción de mascota'>Licencia por adopción de mascota</option>
                            <option value='Permiso por enfermedad de un hijo/a'>Permiso por enfermedad de un hijo/a</option>
                            <option value='Licencia por embarazo de riesgo'>Licencia por embarazo de riesgo</option>                           
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="motivoAusencia" class="control-label letra18pt-pc"> Motivo de ausencia </label>
                        <input class="form-control" type="text" id="motivoAusencia" name="" required=""><span class="pmd-textfield-focused"></span>
                    </div>   

                    <div  class='col-lg-6 col-md-6 col-sm-6 col-xs-6' >                        
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-ausencia-inicio">Inicio ausencia</label>
                            <input type="text" id="datetimepicker-ausencia-inicio" class="form-control" />
                        </div>
                    </div>
                    <div  class='col-lg-6 col-md-6 col-sm-6 col-xs-6' >
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-ausencia-fin">Fin ausencia</label>
                            <input type="text" id="datetimepicker-ausencia-fin" class="form-control" />
                        </div>
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='ingresarAusencia'>Ingrersar ausencia</button>
                    </div>    
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
	   get_footer("recursos-humanos"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>