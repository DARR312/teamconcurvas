<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("proyectos");
?>

    <div id='cuerpo' class="container-fluid pc tablet" >        
        <div id="nuevoProyecto"  class="funcionamiento oculto">
            <div id='referenciaTallaDiv' >
                <div id='divReferencia' class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Referencia </label>
                    <select class='form-control' type='select' id='referenciaParaProyecto' name='referenciaParaProyecto' form='formNuevaFactura' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Confirma las tallas, combinaciones y cantidades que se van a incluir en el proyecto.
                    </p>
                </div>
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmaTallasCombinaciones'>
                    Siguiente
                </button>
            </div>

            <div id='confirmacionesInsumosCantidadesDiv' class='oculto'>
            
                <h1 class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                    Por favor, confirma la solicitud de los siguientes insumos para llevar a cabo la producción del proyecto.
                </h1>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='contenidoAconfirmarTallasCombinaciones'> </div>
            
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverAreferenciaTallaDiv'>
                    Volver
                </button>
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmaNotificacionesTallasCombinaciones'>
                    Siguiente
                </button>
            </div>


            <div id='espaciosTrabajadoresDiv' class='oculto'>
                <div id='espaciosDiv' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Selecciona un espacio que sea indispensable para llevar a cabo el proyecto. 
                        Esto implica que no pueden haber dos proyectos simultáneamente en dicho espacio.
                    </p>
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                        <label for="espacio" class="control-label letra18pt-pc">
                            Espacio
                        </label>
                        <select class='form-control espaciosProyecto' type='select' id='espacio1' name='1' form='formNuevaFactura' required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label letra18pt-pc" for="minutosEspacio1">Duración en minutos del uso del espacio.</label>
                        <input type="number" id="minutosEspacio1" class="form-control" />
                    </div>
                </div>

                <div id='trabajadoresDiv' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Selecciona un trabajador fundamental para la ejecución del proyecto. 
                        Esto significa que no puede haber dos proyectos en curso con el mismo trabajador al mismo tiempo.
                    </p>
                    <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                        <label for="trabajador1" class="control-label letra18pt-pc">
                            Trabajador
                        </label>
                        <select class='form-control trabajadoresProyecto' type='select' id='trabajador1' name='1' form='formNuevaFactura' required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label letra18pt-pc" for="minutosTrabajador1">Duración en minutos de trabajo del trabajador.</label>
                        <input type="number" id="minutosTrabajador1" class="form-control" />
                    </div>            
                </div>            
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverAconfirmacionesInsumosFaltantes'>
                    Atras
                </button>          
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmaEspaciosTrabajadores'>
                    Siguiente
                </button>
            </div>
           
            <div id='fechaFinalaldelProyectoDiv' class='oculto'>
                
                <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio del proyecto</label>
                    <input type="text" id="datetimepickerInicioProyecto" class="form-control" />
                </div>  
                <div id='fechaFinalTiempoReal' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Hora y fecha final
                    </p>
                </div>       
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverAespaciosTrabajadoresDiv'>
                    Atras
                </button>          
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='irAresumen'>
                    Siguiente
                </button>

            </div>
        </div>
        
        <p id='proyectoCreadoOk' class='oculto avisoOk'>Proyecto Creado</p>
           
        <div id="nuevoEspacio"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <p id='proyectoCreadoOk' class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'>
                    Agrega un espacio de trabajo para poder medir el tiempo que se va a utlizar, para esto tienes que relacionarlo con un estado en 
                    el proceso de producción y así poder saber cuándo se va a utilizar y cuándo va a estar disponible, también agrega el horario en 
                    el que el espacio se va  a utilizar (esto lo puedes cambiar en el apartado "Ver espacios").
                </p>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label for="nombreEspacio" class="control-label letra18pt-pc">Nombre del espacio</label>
                    <input class="form-control" type="text" id="nombreEspacio" required=""><span class="pmd-textfield-focused"></span>
    			</div> 
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6 pmd-textfield-floating-label-completed'>
                    <label for="estadoRelacionado" class="control-label letra18pt-pc"> Estado relacionado </label>
                    <select class='form-control' type='select' id='estadoRelacionado' name='estadoRelacionado'  required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>

                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio lunes</label>
                        <input type="text" id="datetimepicker-inicio-lunes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin lunes</label>
                        <input type="text" id="datetimepicker-fin-lunes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio martes</label>
                        <input type="text" id="datetimepicker-inicio-martes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin martes</label>
                        <input type="text" id="datetimepicker-fin-martes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio miercoles</label>
                        <input type="text" id="datetimepicker-inicio-miercoles" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin miercoles</label>
                        <input type="text" id="datetimepicker-fin-miercoles" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio jueves</label>
                        <input type="text" id="datetimepicker-inicio-jueves" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin jueves</label>
                        <input type="text" id="datetimepicker-fin-jueves" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio viernes</label>
                        <input type="text" id="datetimepicker-inicio-viernes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin viernes</label>
                        <input type="text" id="datetimepicker-fin-viernes" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio sábado</label>
                        <input type="text" id="datetimepicker-inicio-sabado" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin sábado</label>
                        <input type="text" id="datetimepicker-fin-sabado" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio domingo</label>
                        <input type="text" id="datetimepicker-inicio-domingo" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de fin domingo</label>
                        <input type="text" id="datetimepicker-fin-domingo" class="form-control datetimepickerHoras" />
                    </div>
                </div>
                
            </div>
            
            
            <button class='botonmodal' type='button' id='agregarNuevoEspacio'>Agregar nuevo espacio</button>
        </div>
        <p id='espacioCreadoOk' class='oculto avisoOk'>Proyecto Creado</p>
        
        <div id="verEspaciosDiv"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed'>
                    <label for="espaciosDeTrabajo" class="control-label letra18pt-pc"> Espacios </label>
                    <select class='form-control' type='select' id='espaciosDeTrabajo' name='espaciosDeTrabajo' form='formNuevaFactura' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                
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
                        <label id='tituloHorarios' for="nombre" class="control-label letra18pt-pc ">Selecciona hora de inicio y fin para el </label>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-horariode-entrada">Horario de inicio</label>
                            <input type="text" id="datetimepicker-horariode-entrada" class="form-control datetimepickerHoras" />
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                            <label class="control-label letra18pt-pc" for="datetimepicker-horariode-salida">Horario de salida</label>
                            <input type="text" id="datetimepicker-horariode-salida" class="form-control datetimepickerHoras" />
                        </div>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                            <button class='botonmodal' type='button' id='cambiarHorario'>Cambiar horario</button>
                        </div>    
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
	   get_footer("proyectos"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>