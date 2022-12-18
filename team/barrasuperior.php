<div id="barrasuperior" class="pc tablet">
    <div class="container-fluid fijo" style="width: 84%;">
        <figure class="logo_pc"><img src="https://concurvas.com/wp-content/themes/mainteam_Concurvas/imagenes/iconos/LOGO.png" alt="Logo Concurvas"></figure>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bscdor">
                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <!-- <div id='BuscarVentasPlaza' class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='buscadorContainer'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar <?php wp_title(''); ?></label>
            			<input class="form-control" type="text" id="bscar" name="bscar" required=""><span class="pmd-textfield-focused"></span>
    			    </div> -->
    			</div>
                
                <?php if(get_the_title() == "Ventas plaza"){ ?> 
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div  class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='buscadorContainer'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar por Etiqueta</label>
            			<input class="form-control" type="text" id='BuscarEtiqueta' name="BuscarEtiqueta" required=""><span class="pmd-textfield-focused"></span>
    			    </div>
    			</div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div  class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='buscadorContainer'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar por teléfono del cliente</label>
            			<input class="form-control" type="text" id='BuscarTelefono' name="BuscarTelefono" required=""><span class="pmd-textfield-focused"></span>
    			    </div>
    			</div>
                 <?php } ?>
                <?php if(get_the_title() == "Inventario"){ ?> 
                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' id='buscadordescripcion'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar por descripcion</label>
            			<input class="form-control" type="text" id="bscardescripcion" name="bscar" required=""><span class="pmd-textfield-focused"></span>
    			    </div>
    			</div> 
                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='buscadorcual'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar por cual</label>
            			<input class="form-control" type="text" id="bscarcual" name="bscar" required=""><span class="pmd-textfield-focused"></span>
    			    </div>
    			</div> 
                 <?php } ?>
    			 <?php if(get_the_title() == "Ventas" || get_the_title() == "Cambios" || get_the_title() == "Ventas mayorista"){ 
    			    $user_info = get_users( array( 'role__in' => array( 'transportador') ) );
                    $transport = $user_info[0]->ID;
                    for($i = 1;$i < sizeof($user_info);$i++){
                         $transport = $transport.",".$user_info[$i]->ID;
                    }
    			 ?>                 
                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='buscadortelefono'>
            			<label for="nombre" class="control-label letra18pt-pc">Buscar por teléfono</label>
            			<input class="form-control" type="text" id="bscartelefono" name="bscar" required=""><span class="pmd-textfield-focused"></span>
    			    </div>
    			</div>
    			<div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                        <label class="control-label letra18pt-pc" for="estadoFiltro">Estado</label>
            			<select class="form-control letra18pt-pc" type="select" id="estadoFiltro" name="estadoFiltro" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
                    </div>
    			</div>
    			<!-- <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                        <label class="control-label letra18pt-pc" for="transportador" name="<?php echo $transport ?>" id="lTransport">Transportador</label>
            			<select class="form-control letra18pt-pc" type="select" id="transportador" name="transportador" form="formularioCliente" required="">
						</select><span class="pmd-textfield-focused"></span>
                    </div>
    			</div> -->
    			<div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
                        <label class="control-label letra18pt-pc" for="tipoenvio" name="<?php echo $transport ?>" id="lTransport">Tipo de envío</label>
            			<select class="form-control letra18pt-pc" type="select" id="tipoenvio" name="tipoenvio" form="formularioCliente" required="">
            			    <option value=''></option>
            			    <option value='nacional'>Nacional</option>
            			    <option value='local'>Local</option>
						</select><span class="pmd-textfield-focused"></span>
                    </div>
    			</div>
    			<?php } ?>
    		
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="segundo">
            <?php if(get_the_title() == "Ventas"){ ?>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='filtroFV'>
               <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                	<label class="control-label letra18pt-pc" for="regular1">Filtra por fecha de creación</label>
                	<input type="text" id="datetimepicker-default" class="form-control" />
                </div>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='filtroFE'>
               <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                	<label class="control-label letra18pt-pc" for="regular1">Filtra por fecha de entrega</label>
                	<input type="text" id="datetimepicker-defaultFiltro" class="form-control" />
                </div>
            </div>
            <?php } ?>
            <?php if(get_the_title() == "Cambios"){ ?>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='filtroFV'>
               <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                	<label class="control-label letra18pt-pc" for="regular1">Filtra por fecha de creación</label>
                	<input type="text" id="datetimepicker-creadacambios" class="form-control" />
                </div>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='filtroFE'>
               <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed">
                	<label class="control-label letra18pt-pc" for="regular1">Filtra por fecha de entrega</label>
                	<input type="text" id="datetimepicker-entregacambios" class="form-control" />
                </div>
            </div>
            <?php } ?>
        </div> 
      </div>   
</div>