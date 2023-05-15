<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("proyectos");
?>

    <div id='cuerpo' class="container-fluid pc tablet" >        
        <div id="nuevoProyecto"  class="funcionamiento oculto">
            
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Referencia </label>
                    <select class='form-control' type='select' id='referenciaParaProyecto' name='referenciaParaProyecto' form='formNuevaFactura' required=''>
                        
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' id='divFechaInicio'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio</label>
                        <input type="text" id="datetimepicker-inicio-proyecto" class="form-control" />
                    </div>
                </div>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 esconder' ><button class='botonmodal' type='button' id='agregarOtraTalla'>Otra talla</button></div>    
            </div>
            
            
            <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 esconder' id='divisionBotonAgregarNuevoProyecto'><button class='botonmodal' type='button' id='agregarNuevoPoryecto'>Agregar nuevo proyecto</button></div>
        </div>
        
        <p id='proyectoCreadoOk' class='oculto avisoOk'>Proyecto Creado</p>
        
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