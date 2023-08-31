<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("proyectos");
?>

    <div id='cuerpo' class="container-fluid pc tablet" >      
        <div id="verProyectosDiv"  class="funcionamiento oculto">  
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='titulosProyectosVer'> 
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc negrillaTres'>Nombre</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc negrillaTres'>Estado</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc negrillaTres'>Fecha inicio</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc negrillaTres'>Fecha fin</p>
            </div>
        </div>
        <div id="verProyectoDiv"  class="funcionamiento oculto">  
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='detallesProyectoSeleccionado'> 
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc negrillaTres'> 
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Presupuesto</p>
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Satélite</p>
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Terminados</p>
                </div>
            </div> 
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='tallasProyectoSeleccionado'> 
               
            </div>
            
        </div>

        <div id="confirmarCortadoDiv"  class="funcionamiento oculto">  

            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='isumosCortadosProyectoSeleccionado'> 
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc negrillaTres'>Insumo</p>
                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc negrillaTres'>Cantidad cortada</p>
                </div>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'> 
                <button class='botonmodal boton100 col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverVerproyecto'>
                    Volver a ver el proyecto
                </button>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'> 
                <button class='botonmodal boton100 col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmaInsumosCortados'>
                    Confirmar Corte
                </button>
            </div>
        </div>
        
        <div id="asignarSateliteDiv"  class="funcionamiento oculto">  

            <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed'>
                <label for="trabajador1" class="control-label letra18pt-pc">
                    Selecciona un satélite
                </label>
                <select class='form-control' type='select' id='sateliteSelect' name='1' required=''>
                    
                </select><span class='pmd-textfield-focused'></span>
            </div>
            <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmarSatelite'>
                    Confirmar satélite
            </button>
            <br><br>
            <br><br>
            <br><br>
            <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc negrillaTres' id='alertaImpresion'> 
                ¡ATENCIÓN! Al darle click en confirmar satélite estarás creando también todas las etiquetas para el proyecto actual, este proceso no se puede revertir.
            </p>
            <div id='marquillas'>
            </div>
        </div>
        
        <p id='proyectoActualizadoOk' class='oculto avisoOk'>Proyecto Actializado</p>

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
                
                      
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverAespaciosTrabajadoresDiv'>
                    Atras
                </button>          
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='irAresumen'>
                    Siguiente
                </button>

            </div>

            <div id='resumenFinalNuevoProyecto' class='oculto'>
                
                <div id='descripcionProyectoDiv' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc negrillaTres' id='nombreProyecto'> 
                    </p>

                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc' id='fechaInicioProyectoNuevo'> 
                    </p>

                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc' id='fechaFinProyectoNuevo'> 
                    </p>

                    
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='detallesProyectoDiv'> 
                        
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Talla</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Combinación</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Cantidad</p>

                    </div>
                </div>

                <div id='presupuestoProyectoDiv' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'>Presupuesto</p>

                    <p class='col-lg-9 col-md-9 col-sm-9 col-xs-9 letra18pt-pc negrillaTres' id='costoTotalProyectoNuevo'> $0'000.000 </p>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='resumenPresupuesto'> 
                        
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Insumo</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Cantidad</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>Costo</p>

                    </div>
                </div>

                <div id='insumosFaltantesProyectoDiv' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc negrillaTres'>Insumos Faltantes</p>
                    
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='resumenFaltantes'> 

                        <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'>Insumo</p>

                        <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'>Cantidad</p>

                    </div>
                </div>

                <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='espaciosUtilizadosProyectoDiv'> 
                        
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Espacio</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Fecha inicio</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Fecha fin</p>

                    </div>

                </div>

                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='trabajadoresUtilizadosProyectoDiv'> 
                        
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Trabajador</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Fecha inicio</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Fecha fin</p>

                    </div>
                    
                </div>

                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='volverAfechaFinalaldelProyectoDiv'>
                    Atras
                </button>          
                <button class='botonmodal col-lg-12 col-md-12 col-sm-12 col-xs-12' type='button' id='confirmarNuevoProyecto'>
                    Confirmar
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
        <p id='espacioCreadoOk' class='oculto avisoOk'>Espacio Creado</p>
        
        <div id="verEspaciosDiv"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed'>
                    <label for="espaciosDeTrabajo" class="control-label letra18pt-pc"> Espacios </label>
                    <select class='form-control' type='select' id='espaciosDeTrabajo' name='espaciosDeTrabajo' form='formNuevaFactura' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                
            </div>

        </div>

        <div id="nuevoSatelite"  class="funcionamiento oculto">
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="nombreSatelite" class="control-label letra18pt-pc">Nombre</label>
                <input class="form-control" type="text" id="nombreSatelite" required=""><span class="pmd-textfield-focused"></span>
            </div> 
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="direcSatelite" class="control-label letra18pt-pc">Dirección</label>
                <input class="form-control" type="text" id="direcSatelite" required=""><span class="pmd-textfield-focused"></span>
            </div> 
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="telefonoSatelite" class="control-label letra18pt-pc">Teléfono</label>
                <input class="form-control" type="text" id="telefonoSatelite" required=""><span class="pmd-textfield-focused"></span>
            </div> 

            <button class='botonmodal' type='button' id='agregarNuevoSatelite'>Agregar nuevo satelite</button>
        </div>

        <p id='sateliteCreadoOk' class='oculto avisoOk'>Satélite Creado</p>

        <div id="verSatelitesDiv"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12' id='tituloSatelites'>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'> Número satélite  </p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'> Nombre  </p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'> Dirección </p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'> Teléfono  </p>
                
            </div>

        </div>
    </div>
    
    <!-- modal de Bootstrap Confirmar sin terminados -->
    <div class="modal" tabindex="-1" id="asignarTerminadosModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div id='divReferencia' class='form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed'>
                        <label for="nombreReferencia" class="control-label letra18pt-pc"> Referencia </label>
                        <select class='form-control' type='select' id='terminadosProyecto' form='formNuevaFactura' required=''>
                            <option class='removerSatelites' value='1'>El proyecto requiere terminados</option>
                            <option class='removerSatelites' value='0'>El proyecto no requiere terminados</option>
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="insumosParaTerminados"></div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='asignarTerminadosBoton'>Confirmar</button>
                    </div> 
                </div>                
            </div>
        </div>
    </div>

    <!-- modal de Bootstrap Confirmar sin terminados -->
    <div class="modal" tabindex="-1" id="modalSinterminados">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloSinTerminados' for="nombre" class="control-label letra18pt-pc "></label>
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <button class='botonmodal' type='button' id='confirmarSinTerminados'>Confirmar</button>
                    </div> 
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
    
     <!-- modal de Bootstrap Confirmar Eliminación -->
     <div class="modal" tabindex="-1" id="modalEliminarProyecto">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="headerModal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12' >
                        <label id='tituloEliminarProyecto' for="nombre" class="control-label letra18pt-pc "></label>
                    </div>
                    <button class='botonmodal' type='button' id='eliminarProyectoConfirmado'>Confirmar eliminación</button>
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