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
    var segundo = $('#segundo');
    for(var k = (items.length-1); k>0;k--){
        if(items[k]==5){
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal' type='button' id='agregarVenta'>+ Agregar venta </button></div>");
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
    segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accionGuias'><button class='botonmodal' type='button' id='subirGuias'>Actualizar guias</button></div>");
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
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        console.log(jsonVenta);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    }
    ventas();

	$('#bscar').on('change',function(){
	    $('.removerVentas').remove();
	    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        console.log(jsonVenta);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});
	
	$('#buscadortelefono').on('change',function(){
	    $('.removerVentas').remove();
	    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        console.log(ordenesVenta);
        var jsonVentaCambio = JSON.parse(ordenesVenta); 
        console.log(jsonVentaCambio);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasCambiosjson(jsonVentaCambio,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});

	$('#estadoFiltro').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        console.log(jsonVenta);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});

	$('#transportador').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        console.log(jsonVenta);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});	

	$('#tipoenvio').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        console.log(jsonVenta);
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});
	
	
    $('#agregarVenta').on('click', function(){         
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
                    var telef = $('#telefono').val().replace(' ', '');
                    var id = guardarCliente( $('#nombre').val(),telef,direccion,complemento,$('#ciudad1').val(),"-",0);
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
    $('#clienteBuscar').on('click', function(){ 
        $('#popup').fadeOut('slow');         
        $('#popup3').fadeIn('slow'); 
        var html = "";
        var clientes = clientesBuscar($('#tele').val());
        if(clientes == "NA"){
            html = "<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
        }else{
            var items = clientes.split('$');
            for(i=1;i<items.length;i++){
                var datos = items[i].split('%');
                html=html+"<p id='nombre"+i+"' class='col-lg-4 col-md-4 col-sm-4 col-xs-4 remover'>"+datos[0]+"</p><p id='direccion"+i+"' class='col-lg-5 col-md-5 col-sm-5 col-xs-5 remover'>"+datos[1]+"</p><p class='off remover' id='clienteid"+i+"' >"+datos[2]+"</p><p class='off remover' id='complemento"+i+"' >"+datos[3]+"</p><p class='off remover' id='clienteCiudad"+i+"' >"+datos[4]+"</p><button class='botonmodal remover' id='cliente"+i+"' onclick='seleccionCliente("+i+")'>Cargar</button>";
            }
        }
        var clientesEncontrados = $('#clientesEncontrados');
        clientesEncontrados.append(html);
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
    $('#prendasGuardadas').on('click', function(){ 
        if($('#prenda1').val() != "NA"){
            if($('#cantidad1').val() > 0){
                if($('#prenda2').val() != "NA"){
                    if($('#cantidad2').val() > 0){
                        if($('#prenda3').val() != "NA"){
                            if($('#cantidad3').val() > 0){
                                if($('#prenda4').val() != "NA"){
                                    if($('#cantidad4').val() > 0){
                                        if($('#prenda5').val() != "NA"){
                                            if($('#cantidad5').val() > 0){
                                                if($('#prenda6').val() != "NA"){
                                                    if($('#cantidad6').val() > 0){
                                                        $('#popup4').fadeOut('slow');      
                                                        $('#popup').fadeIn('slow');
                                                        var datos = $('#prenda1').val();
                                                        var items = datos.split('%');
                                                        var datos = $('#prenda2').val();
                                                        var items2 = datos.split('%');
                                                        var datos = $('#prenda3').val();
                                                        var items3 = datos.split('%');
                                                        var datos = $('#prenda4').val();
                                                        var items4 = datos.split('%');
                                                        var datos = $('#prenda5').val();
                                                        var items5 = datos.split('%');
                                                        var datos = $('#prenda6').val();
                                                        var items6 = datos.split('%');
                                                        var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                                                        var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV2'>"+$('#cantidad2').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe2'>"+items2[1]+"</p><p class='reinicia' style='display: none;' id='idref2'>"+items2[0]+"</p><p class='reinicia' style='display: none;' id='precio2'>"+items2[2]+"</p>";
                                                        var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV3'>"+$('#cantidad3').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe3'>"+items3[1]+"</p><p class='reinicia' style='display: none;' id='idref3'>"+items3[0]+"</p><p class='reinicia' style='display: none;' id='precio3'>"+items3[2]+"</p>";
                                                        var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV4'>"+$('#cantidad4').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe4'>"+items4[1]+"</p><p class='reinicia' style='display: none;' id='idref4'>"+items4[0]+"</p><p class='reinicia' style='display: none;' id='precio4'>"+items4[2]+"</p>";
                                                        var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV5'>"+$('#cantidad5').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe5'>"+items5[1]+"</p><p class='reinicia' style='display: none;' id='idref5'>"+items5[0]+"</p><p class='reinicia' style='display: none;' id='precio5'>"+items5[2]+"</p>";
                                                        var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV6'>"+$('#cantidad6').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe6'>"+items6[1]+"</p><p class='reinicia' style='display: none;' id='idref6'>"+items6[0]+"</p><p class='reinicia' style='display: none;' id='precio6'>"+items6[2]+"</p>";
                                                        var pedido = $('#pedido');
                                                        var arraItems = [items[0],items2[0],items3[0],items4[0],items5[0],items6[0]];
                                                        revisarfechasatelite(arraItems);
                                                        pedido.append(html);
                                                    }else{alert("Ingresa la cantidad para la referencia 6");}
                                                }else{
                                                    $('#popup4').fadeOut('slow');      
                                                    $('#popup').fadeIn('slow');
                                                    var datos = $('#prenda1').val();
                                                    var items = datos.split('%');
                                                    var datos = $('#prenda2').val();
                                                    var items2 = datos.split('%');
                                                    var datos = $('#prenda3').val();
                                                    var items3 = datos.split('%');
                                                    var datos = $('#prenda4').val();
                                                    var items4 = datos.split('%');
                                                    var datos = $('#prenda5').val();
                                                    var items5 = datos.split('%');
                                                    var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV2'>"+$('#cantidad2').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe2'>"+items2[1]+"</p><p class='reinicia' style='display: none;' id='idref2'>"+items2[0]+"</p><p class='reinicia' style='display: none;' id='precio2'>"+items2[2]+"</p>";
                                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV3'>"+$('#cantidad3').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe3'>"+items3[1]+"</p><p class='reinicia' style='display: none;' id='idref3'>"+items3[0]+"</p><p class='reinicia' style='display: none;' id='precio3'>"+items3[2]+"</p>";
                                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV4'>"+$('#cantidad4').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe4'>"+items4[1]+"</p><p class='reinicia' style='display: none;' id='idref4'>"+items4[0]+"</p><p class='reinicia' style='display: none;' id='precio4'>"+items4[2]+"</p>";
                                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV5'>"+$('#cantidad5').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe5'>"+items5[1]+"</p><p class='reinicia' style='display: none;' id='idref5'>"+items5[0]+"</p><p class='reinicia' style='display: none;' id='precio5'>"+items5[2]+"</p>";
                                                    var pedido = $('#pedido');
                                                        var arraItems = [items[0],items2[0],items3[0],items4[0],items5[0]];
                                                        revisarfechasatelite(arraItems);
                                                    pedido.append(html);
                                                }
                                            }else{alert("Ingresa la cantidad para la referencia 5");}
                                        }else{
                                            $('#popup4').fadeOut('slow');      
                                            $('#popup').fadeIn('slow');
                                            var datos = $('#prenda1').val();
                                            var items = datos.split('%');
                                            var datos = $('#prenda2').val();
                                            var items2 = datos.split('%');
                                            var datos = $('#prenda3').val();
                                            var items3 = datos.split('%');
                                            var datos = $('#prenda4').val();
                                            var items4 = datos.split('%');
                                            var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                                            var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV2'>"+$('#cantidad2').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe2'>"+items2[1]+"</p><p class='reinicia' style='display: none;' id='idref2'>"+items2[0]+"</p><p class='reinicia' style='display: none;' id='precio2'>"+items2[2]+"</p>";
                                            var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV3'>"+$('#cantidad3').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe3'>"+items3[1]+"</p><p class='reinicia' style='display: none;' id='idref3'>"+items3[0]+"</p><p class='reinicia' style='display: none;' id='precio3'>"+items3[2]+"</p>";
                                            var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV4'>"+$('#cantidad4').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe4'>"+items4[1]+"</p><p class='reinicia' style='display: none;' id='idref4'>"+items4[0]+"</p><p class='reinicia' style='display: none;' id='precio4'>"+items4[2]+"</p>";
                                            var pedido = $('#pedido');
                                                        var arraItems = [items[0],items2[0],items3[0],items4[0]];
                                                        revisarfechasatelite(arraItems);
                                            pedido.append(html);
                                        }
                                    }else{alert("Ingresa la cantidad para la referencia 4");}
                                }else{
                                    $('#popup4').fadeOut('slow');      
                                    $('#popup').fadeIn('slow');
                                    var datos = $('#prenda1').val();
                                    var items = datos.split('%');
                                    var datos = $('#prenda2').val();
                                    var items2 = datos.split('%');
                                    var datos = $('#prenda3').val();
                                    var items3 = datos.split('%');
                                    var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV2'>"+$('#cantidad2').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe2'>"+items2[1]+"</p><p class='reinicia' style='display: none;' id='idref2'>"+items2[0]+"</p><p class='reinicia' style='display: none;' id='precio2'>"+items2[2]+"</p>";
                                    var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV3'>"+$('#cantidad3').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe3'>"+items3[1]+"</p><p class='reinicia' style='display: none;' id='idref3'>"+items3[0]+"</p><p class='reinicia' style='display: none;' id='precio3'>"+items3[2]+"</p>";
                                    var pedido = $('#pedido');
                                                        var arraItems = [items[0],items2[0],items3[0]];
                                                        revisarfechasatelite(arraItems);
                                    pedido.append(html);
                                }
                            }else{alert("Ingresa la cantidad para la referencia 3");}
                        }else{
                            $('#popup4').fadeOut('slow');      
                            $('#popup').fadeIn('slow');
                            var datos = $('#prenda1').val();
                            var items = datos.split('%');
                            var datos = $('#prenda2').val();
                            var items2 = datos.split('%');
                            var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                            var html = html+"<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV2'>"+$('#cantidad2').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe2'>"+items2[1]+"</p><p class='reinicia' style='display: none;' id='idref2'>"+items2[0]+"</p><p class='reinicia' style='display: none;' id='precio2'>"+items2[2]+"</p>";
                            var pedido = $('#pedido');
                                                        var arraItems = [items[0],items2[0]];
                                                        revisarfechasatelite(arraItems);
                            pedido.append(html);
                        }
                    }else{alert("Ingresa la cantidad para la referencia 2");}
                }else{
                    $('#popup4').fadeOut('slow');      
                    $('#popup').fadeIn('slow');
                    var datos = $('#prenda1').val();
                    var items = datos.split('%');
                    var html = "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV1'>"+$('#cantidad1').val()+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe1'>"+items[1]+"</p><p class='reinicia' style='display: none;' id='idref1'>"+items[0]+"</p><p class='reinicia' style='display: none;' id='precio1'>"+items[2]+"</p>";
                    var pedido = $('#pedido');
                                                        var arraItems = [items[0]];
                                                        revisarfechasatelite(arraItems);
                    pedido.append(html);
                }
            }else{alert("Ingresa la cantidad para la referencia 1");}
        }else{alert("Ingresa al menos una referencia para el pedido");}
        return false;     
    });
    $('#close4').on('click', function(){   
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        return false;     
    });
    $('#agregarPedido').on('click', function(){  
        var idCliente= $('#idCliente').val();
        var nombreVenta= $('#nombreVenta').val();
        var dirVenta= $('#dirVenta').val().replace('#', 'No');
        var telVenta= $('#telVenta').val();
        var ciudadCliente= $('#ciudadCliente').val();
        var complementoCliente= $('#complementoCliente').val().replace('#', 'No');
        var not= $('#notas').val().replace('#', 'No');
        var notas = not.replace('%', 'porciento');
        var origen= $('#origen').val();
        var cantidad1 = $('#cantidadV1').text();
        var id1 = $('#idref1').text();
        var refe1 = $('#refe1').text();
        var precio1 = $('#precio1').text();
        var cantidad2 = $('#cantidadV2').text();
        var id2 = $('#idref2').text();
        var refe2 = $('#refe2').text();
        var precio2 = $('#precio2').text();
        var cantidad3 = $('#cantidadV3').text();
        var id3 = $('#idref3').text();
        var refe3 = $('#refe3').text();
        var precio3 = $('#precio3').text();
        var cantidad4 = $('#cantidadV4').text();
        var id4 = $('#idref4').text();
        var refe4 = $('#refe4').text();
        var precio4 = $('#precio4').text();
        var cantidad5 = $('#cantidadV5').text();
        var id5 = $('#idref5').text();
        var refe5 = $('#refe5').text();
        var precio5 = $('#precio5').text();
        var cantidad6 = $('#cantidadV6').text();
        var id6 = $('#idref6').text();
        var refe6 = $('#refe6').text();
        var precio6 = $('#precio6').text();
        var fecha = $('#datetimepicker-entrega').val();
        var idUsuario = $('#usuario').attr("name");
        if(idCliente){
            if(fecha){
                if(id1){
                    if(id2){
                        if(id3){
                            if(id4){
                                if(id5){
                                    if(id6){
                                        $('#popup').fadeOut('slow');         
                                        $('.popup-overlay').fadeOut('slow');      
                                        $('.reinicia').remove(); 
                                        var pedido = cantidad1+" "+refe1+" "+cantidad2+" "+refe2+" "+cantidad3+" "+refe3+" "+cantidad4+" "+refe4+" "+cantidad5+" "+refe5+" "+cantidad6+" "+refe6;
                                        var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                                        var precio = (cantidad1 * parseInt(precio1))+ (cantidad2 * parseInt(precio2))+ (cantidad3 * parseInt(precio3))+ (cantidad4 * parseInt(precio4))+ (cantidad5 * parseInt(precio5))+ (cantidad6 * parseInt(precio6));
                                        var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);
                                        var itemVenta = cantidad1+"/"+id1+","+cantidad2+"/"+id2+","+cantidad3+"/"+id3+","+cantidad4+"/"+id4+","+cantidad5+"/"+id5+","+cantidad6+"/"+id6;
                                        ventaitem(idVenta,itemVenta);
                                        $('.removerVentas').remove();
                                        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                                        var jsonVenta = JSON.parse(ordenesVenta); 
                                        console.log(jsonVenta);
                                        var primeraFila = $('#primeraFila');
                                        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                                    	primeraFila.after(html);
                                    	ventas();
                                    }else{
                                        $('#popup').fadeOut('slow');         
                                        $('.popup-overlay').fadeOut('slow');      
                                        $('.reinicia').remove();
                                        var pedido = cantidad1+" "+refe1+" "+cantidad2+" "+refe2+" "+cantidad3+" "+refe3+" "+cantidad4+" "+refe4+" "+cantidad5+" "+refe5;
                                        var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                                        var precio = (cantidad1 * parseInt(precio1))+ (cantidad2 * parseInt(precio2))+ (cantidad3 * parseInt(precio3))+ (cantidad4 * parseInt(precio4))+ (cantidad5 * parseInt(precio5));
                                        var idVenta = agregarventa(idCliente,datosCliente,pedido,notas,origen,fecha,idUsuario,idUsuario);
                                        var itemVenta = cantidad1+"/"+id1+","+cantidad2+"/"+id2+","+cantidad3+"/"+id3+","+cantidad4+"/"+id4+","+cantidad5+"/"+id5;
                                        ventaitem(idVenta,itemVenta);
                                        $('.removerVentas').remove();
                                	    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                                        var jsonVenta = JSON.parse(ordenesVenta); 
                                        console.log(jsonVenta);
                                        var primeraFila = $('#primeraFila');
                                        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                                    	primeraFila.after(html);
                                    	ventas();
                                    }
                                }else{
                                    $('#popup').fadeOut('slow');         
                                    $('.popup-overlay').fadeOut('slow');      
                                    $('.reinicia').remove();
                                    var pedido = cantidad1+" "+refe1+" "+cantidad2+" "+refe2+" "+cantidad3+" "+refe3+" "+cantidad4+" "+refe4;
                                    var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                                    var precio = (cantidad1 * parseInt(precio1))+ (cantidad2 * parseInt(precio2))+ (cantidad3 * parseInt(precio3))+ (cantidad4 * parseInt(precio4));
                                    var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);
                                    var itemVenta = cantidad1+"/"+id1+","+cantidad2+"/"+id2+","+cantidad3+"/"+id3+","+cantidad4+"/"+id4;
                                    ventaitem(idVenta,itemVenta);
                                    $('.removerVentas').remove();
                                    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                                    var jsonVenta = JSON.parse(ordenesVenta); 
                                    console.log(jsonVenta);
                                    var primeraFila = $('#primeraFila');
                                    var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                                	primeraFila.after(html);
                                	ventas();
                                }
                            }else{
                                $('#popup').fadeOut('slow');         
                                $('.popup-overlay').fadeOut('slow');      
                                $('.reinicia').remove();
                                var pedido = cantidad1+" "+refe1+" "+cantidad2+" "+refe2+" "+cantidad3+" "+refe3;
                                var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                                var precio = (cantidad1 * parseInt(precio1))+ (cantidad2 * parseInt(precio2))+ (cantidad3 * parseInt(precio3));
                                var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);
                                var itemVenta = cantidad1+"/"+id1+","+cantidad2+"/"+id2+","+cantidad3+"/"+id3;
                                ventaitem(idVenta,itemVenta);
                                $('.removerVentas').remove();
                                var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                                var jsonVenta = JSON.parse(ordenesVenta); 
                                console.log(jsonVenta);
                                var primeraFila = $('#primeraFila');
                                var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                            	primeraFila.after(html);
                            	ventas();
                            }
                        }else{
                            $('#popup').fadeOut('slow');         
                            $('.popup-overlay').fadeOut('slow');      
                            $('.reinicia').remove();
                            var pedido = cantidad1+" "+refe1+" "+cantidad2+" "+refe2;
                            var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                            var precio = (cantidad1 * parseInt(precio1))+ (cantidad2 * parseInt(precio2));
                            var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);
                            var itemVenta = cantidad1+"/"+id1+","+cantidad2+"/"+id2;
                            ventaitem(idVenta,itemVenta);
                            $('.removerVentas').remove();
                            var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                            var jsonVenta = JSON.parse(ordenesVenta); 
                            console.log(jsonVenta);
                            var primeraFila = $('#primeraFila');
                            var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                        	primeraFila.after(html);
                        	ventas();
                        }
                    }else{
                        $('#popup').fadeOut('slow');         
                        $('.popup-overlay').fadeOut('slow');      
                        $('.reinicia').remove();
                        var pedido = cantidad1+" "+refe1;
                        var datosCliente = "°"+nombreVenta+"°"+telVenta+"°"+dirVenta+"°"+complementoCliente+"°"+ciudadCliente+"%";
                        var precio = (cantidad1 * parseInt(precio1));
                        var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);
                        var itemVenta = cantidad1+"/"+id1;
                        ventaitem(idVenta,itemVenta);
                        $('.removerVentas').remove();
                        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
                        var jsonVenta = JSON.parse(ordenesVenta); 
                        console.log(jsonVenta);
                        var primeraFila = $('#primeraFila');
                        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
                    	primeraFila.after(html);
                    	ventas();
                    }
                }else{alert("Ingresa referencias al pedido")}
            }else{alert("Ingresa una fecha de entrega");}
        }else{alert("Por favor ingresa un cliente");}
        return false;         
    });
    
    $('#imprimirEmpaques').on('click', function() {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#impresionParaempacar').html()));
        e.preventDefault();
    });
    $('#accionGuias').on('click', function(){         
        $('#popup10').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());         
        return false;     
    });      
    $('#close10').on('click', function(){         
        $('#popup10').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        return false;     
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
<script>
function seleccionCliente(id) {
        $('#nombreVenta').val($('#nombre'+id).text());
        $('#dirVenta').val($('#direccion'+id).text());
        $('#telVenta').val($('#tele').val());
        $('#idCliente').val($('#clienteid'+id).text());
        $('#complementoCliente').val($('#complemento'+id).text());
        $('#ciudadCliente').val($('#clienteCiudad'+id).text());
        $('#popup3').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.cliente').remove();
        $('.remover').remove();
        return false;  
    }
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<script>
	// Default date and time picker
	$('#datetimepicker-default').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-defaultFiltro').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-update').datetimepicker({
		format: 'L'
	});
</script>
</body>
</html>