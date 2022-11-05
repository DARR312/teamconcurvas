<?php get_template_part('generalfooter'); ?>
    //<script>
    var html = "";
    var permisoVentas = permisosVentas();
    var items = permisoVentas.split(',');
    var pedidoUpdate = "";
    var usuarioUpdate = "";
    var fechaUpdate = "";
    var notasUpdate = "";
    var verPedidos = 0;
    var botonrevisar ="";
    for(var k = (items.length-1); k>0;k--){
        if(items[k]==5){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal' type='button' id='agregarCambio'>+ Agregar cambio </button></div>");
            botonrevisar = "botonrevisar";
        }
        if(items[k]==6){
            pedidoUpdate = "pedidoUpdate"; 
        }
        if(items[k]==7){
            fechaUpdate = "fechaUpdate"; 
            notasUpdate = "notasUpdate";
        }
        if(items[k]==26){
            usuarioUpdate = "usuarioUpdate"; 
        }
        if(items[k]==9){
           verPedidos = 1;
        }
    }
    var usuarioCell = $('#usuarioCell').attr("name");
    var identifi = usuarioCell.split(",");
    var level = identifi[0];
    var empacar = obtenerData("level","con_t_rolespermisos","rowVarios","permiso_id",10);
    var levelCheck = empacar.split("%");
    for(var i = 0;i<(levelCheck.length-1);i++){
        var levelSi = levelCheck[i].split("°");
        if(level == levelSi[1]){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accionEmpaques'><button class='botonmodal' type='button' id='imprimirEmpaques'>Imprimir</button></div>");
            botonrevisar = "botonrevisar";
            i= levelCheck.length-1;
        }
    }
    if(verPedidos == 1){//<option value='Sin empacar'>Sin empacar</option>
        var usuarioCell = $('#usuarioCell').attr("name");
        var identifi = usuarioCell.split(",");
        var level = identifi[0];
        var checkPago = obtenerData("level","con_t_rolespermisos","rowVarios","permiso_id",27);
        var levelCheck = checkPago.split("%");
        for(var i = 0;i<(levelCheck.length-1);i++){
            var levelSi = levelCheck[i].split("°");
            if(level == levelSi[1]){
                botonrevisar = "revisarPago";
            }
        }
        var nombresEstados = obtenerData("estado","con_t_estadoventa","unico");
        var arrayEstados = nombresEstados.split(',');
        var estadoFiltro = $('#estadoFiltro');
        var htmll = "";
        for(i=0;i<arrayEstados.length;i++){
            htmll = htmll + "<option value='"+arrayEstados[i]+"'>"+arrayEstados[i]+"</option>"
        }
        estadoFiltro.append(htmll);
        var idsTrans = $('#lTransport').attr("name");
        var arrayidsTrans = idsTrans.split(',');
        var transportador = $('#transportador');
        var htmlll = "<option value=''></option>";
        for(i=0;i<arrayidsTrans.length;i++){
            var user = obtenerData("display_name","con_users","row","ID",arrayidsTrans[i]);
            htmlll = htmlll + "<option value='"+arrayidsTrans[i]+"'>"+user+"</option>"
        }
        transportador.append(htmlll);
        $('#filtroFE').attr("name",pedidoUpdate+","+fechaUpdate+","+notasUpdate+","+usuarioUpdate+","+botonrevisar);
        var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        console.log(html);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
    }
    cambios();
	$('#bscar').on('change',function(){
	    $('.removerCambios').remove();
	    var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        console.log(html);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
    	cambios();
	});
	
	
	$('#estadoFiltro').on('change',function(){
	    $('.removerCambios').remove();
        var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        console.log(html);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
    	cambios();
	});
	
	
	$('#transportador').on('change',function(){
	    // $('.removerVentas').remove();
	    // var ordenesVenta = ordenescambio($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        // var arrayOrdenes = ordenesVenta.split('&');
        // var primeraFila = $('#primeraFila');
        // var html = imprimirCambios(arrayOrdenes,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	// primeraFila.after(html);
    	// cambios();
	});

    $('#tipoenvio').on('change',function(){
	    // $('.removerVentas').remove();
        // var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        // var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        // console.log(html);
        // var primeraFila = $('#primeraFila');
        // primeraFila.after(html);
    	// cambios();
	});

    $('#agregarCambio').on('click', function(){         
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());    
        return false;     
    });      
    $('#close').on('click', function(){         
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        return false;     
    });
    $('#agregarCliente').on('click', function(){ 
        $('#popup').fadeOut('slow');         
        $('#popup2').fadeIn('slow'); 
        var html = "";
        var ciuddes = ciudades();
        var items = ciuddes.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option value='"+items[i]+"'>"+items[i]+"</option>";
        }
        var ciudad1 = $('#ciudad1');
        ciudad1.append(html);
        return false;     
    });      
    $('#close2').on('click', function(){         
        $('#popup2').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        return false;     
    });
    $('#clienteGuardado').on('click', function(){ 
        if($('#nombre').val()){
            if($('#telefono').val()){
                if($('#dir1').val()){
                    var direccion = $('#dir1').val().replace('#', 'No');
                    var complemento = $('#comp1').val().replace('#', 'No');
                    var id = guardarCliente( $('#nombre').val(),$('#telefono').val(),direccion,complemento,$('#ciudad1').val(),"-",0);
                    $('#popup2').fadeOut('slow');      
                    $('#popup').fadeIn('slow');
                    $('#nombreVenta').val($('#nombre').val());
                    $('#dirVenta').val($('#dir1').val());
                    $('#telVenta').val($('#telefono').val());
                    $('#idCliente').val(id);
                    $('#complementoCliente').val($('#comp1').val());
                    $('#ciudadCliente').val($('#ciudad1').val());
                }else{alert("Ingresa la dirección del cliente :)");}
            }else{alert("Ingresa el teléfono del cliente :)");}
        }else{alert("Ingresa el nombre del cliente :)");}
        return false;     
    });
    $('#ventaBuscarId').on('click', function(){
        $('.remover').remove();
        var venta = obtenerDatajson("cliente_ok,datos_cliente","con_t_ventas","valoresconcondicion","venta_id",$('#ventaIdentificacion').val());
        var jsonVentaCliente = JSON.parse(venta); 
        console.log(jsonVentaCliente);
        var prendav = obtenerDatajson("cual,estado,codigo","con_t_trprendas","valoresconcondicion","cual","V"+$('#ventaIdentificacion').val());
        var jsonprendav = JSON.parse(prendav); 
        if(jsonprendav.length>0){
            alert("El cliente todavía tiene prendas no se puede agendar el cambio");
            return false;
        }
        var cambiosantiguos = obtenerDatajson("excedente,cambio_id","con_t_cambios","valoresconcondicion","venta_id",$('#ventaIdentificacion').val());
        var jsoncambiosantiguos = JSON.parse(cambiosantiguos); 
        if(jsoncambiosantiguos.length>0){
            for (let i = 0; i < jsoncambiosantiguos.length; i++) {
                var cambiosantiguosprendas = obtenerDatajson("cual,estado,codigo","con_t_trprendas","valoresconcondicion","cual","C"+jsoncambiosantiguos[i].cambio_id);
                var jsoncambiosantiguosprendas = JSON.parse(cambiosantiguosprendas);  
                if(jsoncambiosantiguosprendas.length>0){
                    alert("El cliente todavía tiene prendas no se puede agendar el cambio");
                    return false;
                }              
            }            
        }
        var html = "<h1  style='display: none;' class='remover' id='datoscliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonVentaCliente[0].datos_cliente+"</h1>";
        html = html + "<h1  style='display: none;' class='remover' id='clienteok' name='"+$('#ventaIdentificacion').val()+"'>"+jsonVentaCliente[0].cliente_ok+"</h1>";
        $('#popup').fadeOut('slow');         
        $('#popup3').fadeIn('slow'); 
        html = html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><button class='botonmodal remover botoncargar' id='botonCargacambios' >Cargar</button></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 remover'><label for='cantidad6' class='control-label letra18pt-pc'> Valor de envío a pagar por el cliente</label><input class='form-control' type='number' id='costosEnvio' name='costosEnvio' min='1'><span class='pmd-textfield-focused'></span></div>";
        $("#formularioPedido").after(html);
        html = "<option value='NA'>NA</option>";
        var disponibl = disponibles();
        var items = disponibl.split(',');
        for(i=0;i<(items.length-1);i++){
            var item = items[i].split('!');
            html=html+"<option value='"+item[0]+"%"+item[1]+"%"+item[2]+"'>"+item[1]+"</option>";
        }
        var disp = $('.disponibles');
        disp.append(html);
        cambios();
        //prendasEncontradas.append(html);
        // var flag = 0; 
        // var html = "";
        // var ventaItems = obtenerData("complemento_estado,descripcion","con_t_trprendas","rowVarios","cual","V"+$('#ventaIdentificacion').val());
        // //°Diego 1°137°Londres Rosa Bebé SM%°Diego 1°138°Londres Rosa Bebé SM%
        // var ventaCliente = obtenerDatajson("datos_cliente","con_t_ventas","valoresconcondicion","venta_id",$('#ventaIdentificacion').val());
        // var jsonVentaCliente = JSON.parse(ventaCliente); 
        // var jsonDatosCliente = JSON.parse(jsonVentaCliente[0].datos_cliente); 
        // console.log(jsonDatosCliente);
        // var ventaItemsArray = ventaItems.split("%");
        // if(ventaItemsArray.length==0){
        //     alert("El pedido no tiene prendas asociadas para ser cambiadas");
        // }else{
        //     var html = "<h1  style='display: none;' class='remover' id='nombreCliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonDatosCliente.nombre+"</h1>";
        //     html =html+ "<h1  style='display: none;' class='remover' id='telefonoCliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonDatosCliente.telefono+"</h1>";
        //     html =html+ "<h1  style='display: none;' class='remover' id='direccionCliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonDatosCliente.direccion+"</h1>";
        //     html =html+ "<h1  style='display: none;' class='remover' id='complementoCliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonDatosCliente.complemento+"</h1>";
        //     html =html+ "<h1  style='display: none;' class='remover' id='ciudadCliente' name='"+$('#ventaIdentificacion').val()+"'>"+jsonDatosCliente.ciudad+"</h1>";
        //     for(var k = 0;k<(ventaItemsArray.length-1);k++){
        //         var splt = ventaItemsArray[k].split("°");
        //         var itemId = splt[2];
        //         var datosVenta = obtenerData("ordenitem_id,prenda_id,valor,descuento_id,estado_id","con_t_ventaitem","rowVarios","ordenitem_id",itemId);
        //         //°137°113°140000°0°En ruta%
        //         var datosArray = datosVenta.split("°");
        //         var estado = datosArray[5].replace('%', '');
        //         var precio = datosArray[3];
        //         var prendaItemId = datosArray[2];
        //         if(estado == "Entregado"){
        //             flag = 1;
        //             html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc' name='"+precio+"'>"+splt[3]+"</p></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6'><label for='prenda1' class='control-label letra18pt-pc'> Prenda </label><select class='form-control disponibles' type='select' id='"+itemId+"' name='"+prendaItemId+"' form='formularioCliente'></select><span class='pmd-textfield-focused'></span></div></div>";
        //         }
        //     }
        //     if(flag == 1){
        //         $('#popup').fadeOut('slow');         
        //         $('#popup3').fadeIn('slow'); 
        //         html = html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><button class='botonmodal remover botoncargar' id='botonCargacambios' >Cargar</button></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 remover'><label for='cantidad6' class='control-label letra18pt-pc'> Valor de envío a pagar por el cliente</label><input class='form-control' type='number' id='costosEnvio' name='costosEnvio' min='1'><span class='pmd-textfield-focused'></span></div>";
        //         $("#prendasEncontradas").append(html);
        //         html = "<option value='NA'>NA</option>";
        //         var disponibl = disponibles();
        //         var items = disponibl.split(',');
        //         for(i=0;i<(items.length-1);i++){
        //             var item = items[i].split('!');
        //             html=html+"<option value='"+item[0]+"%"+item[1]+"%"+item[2]+"'>"+item[1]+"</option>";
        //         }
        //         var disp = $('.disponibles');
        //         disp.append(html);
        //         cambios();
        //     }
        // }
        return false;     
    }); 
     $('#close3').on('click', function(){   
        $('#popup3').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.cliente').remove();
        return false;     
    });
    $('#agregarPrenda').on('click', function(){ 
        $('#popup').fadeOut('slow');         
        $('#popup4').fadeIn('slow'); 
        $('.reinicia').remove();
        var html = "<option value='NA'>NA</option>";
        var disponibl = disponibles();
        var items = disponibl.split(',');
        for(i=0;i<(items.length-1);i++){
            var item = items[i].split('!');
            html=html+"<option value='"+item[0]+"%"+item[1]+"%"+item[2]+"'>"+item[1]+"</option>";
        }
        var disp = $('.disponibles');
        disp.append(html);
        return false;     
    }); 
    $('#close4').on('click', function(){   
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        return false;     
    });
    $('#agregarPedido').on('click', function(){  
        var notas= $('#notas').val().replace('#', 'No');
        var fecha_entrega = $('#datetimepicker-entrega').val();
        var idUsuario = $('#usuario').attr("name");
        var venta_id = $('#tpedido').attr("name");
        if(!venta_id){
            alert("No se han agregado cambios");
            return false;
        }
        if(!fecha_entrega){
            alert("Por favor agrega una fecha de entrega :)");
            return false;
        }
        var datos_cliente =  new Object();
        datos_cliente.nombre = $('#clienteNombre').text();
        datos_cliente.telefono  = $('#clienteTelefono').text();
        datos_cliente.direccion = $('#clienteDireccion').text();
        datos_cliente.complemento = $('#clienteComplemento').text();
        datos_cliente.ciudad = $('#clienteCiudad').text();
        console.log(datos_cliente);
        var clienteString= JSON.stringify(datos_cliente);
        var pedido = $("#pedido").text();
        var pedidoitems = $("#pedido").attr("name");
        var excedente = $('#diferencia').attr("name");
        var cliente1 = clienteString.replaceAll("<","");  
        var cliente2 = cliente1.replaceAll(">","");
        var cliente3 = cliente2.replaceAll("{","<");  
        clienteString = cliente3.replaceAll("}",">");   
        console.log(excedente);
        var idCambio = agregarcambio(venta_id,clienteString,pedido,"-",notas,excedente,fecha_entrega,idUsuario,idUsuario);
        var pedidoitemsArray = pedidoitems.split(",");
        console.log(pedidoitemsArray);
        for(var i = 0;i<(pedidoitemsArray.length-1);i++){            
            var prendasIDSArray = pedidoitemsArray[i].split("/");
            console.log(prendasIDSArray);
            for (let k = 0; k < prendasIDSArray[0]; k++) { 
            //    cambioitem(prendasIDSArray[1],0,idCambio,venta_id);               
            }
        }
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove();
        $('.removeCambio').remove();
        var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        console.log(html);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        return false;         
    });
    
    $('#imprimirEmpaques').on('click', function() {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#impresionParaempacar').html()));
        e.preventDefault();
    });
       /*°34°5°89900°0°1%°35°7°130000°0°1%°36°8°89900°0°1%°37°11°89900°0°1%°38°34°130000°0°1%°39°34°130000°0°1%
        var idsArray = ids.split("%");
        var clienteDatos = obtenerData("nombre,telefono,direccion_1,complemento_1,ciudad_1","con_t_clientes","rowVarios","cliente_id",idsArray[0]);
        var ciuddes = ciudades();
        var items = ciuddes.split(',');
        var clienteArray = clienteDatos.split('°');
        var ciudadActual = clienteArray[5].split('%');
        html = "<option value='"+ciudadActual[0]+"'>"+ciudadActual[0]+"</option>";
        for(i=1;i<items.length;i++){
            html=html+"<option value='"+items[i]+"'>"+items[i]+"</option>";
        }
        var ciudad1Update = $('#ciudad1Update');
        ciudad1Update.append(html);
        $('#nombreUpdate').val(clienteArray[1]);
        $('#telefonoUpdate').val(clienteArray[2]);
        $('#dir1Update').val(clienteArray[3]);
        $('#comp1Update').val(clienteArray[4]);
        $('#idClienteUpdate').text(ids);
        $('#popup5').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());  */    
    
   /* for(i=1;i<items.length;i++){°Andrés°3229261615°Cll San martín°°Bogotá%
        if(i==5){
           html =html+ "<a href='https://concurvas.com/team/usuarios'><div class='accesos'><img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/usuarios.png' alt='Avatar'></div></a>";
       }
    }
    var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12' id='filtro'><select name='fecha' onchange='location = this.value;' id='fiktroFecha'><option value='0'>  Hoy  </option></select></div>"; 
    var bscador = $('#bscdor');
    bscador.after(html);*/
})
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<script>
	// Default date and time picker
	$('#datetimepicker-creadacambios').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-entrega').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-entregacambios').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-update').datetimepicker({
		format: 'L'
	});
</script>
</body>
</html>