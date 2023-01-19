<?php
	if(current_user_can( 'manage_options' )){
	    get_header("gestion");
?>
 
    <div class='popup-overlay pc tablet'></div>
	    <div class="container-fluid pc tablet" id="bloquePrincipal">
	       <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='agregarmadrugon'>
                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12' id='fechamadrugon'>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                        <label class="control-label letra18pt-pc" for="regular1">Fecha de madrugón a agregar</label>
                        <input type="text" id="datetimepicker-madrugon" class="form-control" />
                    </div>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'>
                    <button class='botonmodal botonesbarrasuperior' type='button' id='cajamadrugon'>Agregar caja madrugón</button>
                </div>
	       </div>
	   </div>
<?php
	   get_footer("gestion"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>