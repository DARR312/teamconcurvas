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
    var ventas = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total','con_t_ventasplaza','variasfilasunicas','0','0');
    var jsonVentas = JSON.parse(ventas);
    console.log(jsonVentas);
    var datoscliente = jsonVentas[jsonVentas.length-1].datos_cliente;
    var jsondatoscliente = JSON.parse(datoscliente);
    var codigos_prendas = jsonVentas[jsonVentas.length-1].codigos_prendas;
    var jsoncodigos_prendas = JSON.parse(codigos_prendas);
    var pedido = "";
    console.log(jsoncodigos_prendas);
    for (let j = 0; j < Object.keys(jsoncodigos_prendas).length; j++) {
        console.log(jsoncodigos_prendas[j]);
        pedido = pedido + " " + jsoncodigos_prendas[j].codigo+" "+jsoncodigos_prendas[j].descripcion;
    }
    var metodos_pago = jsonVentas[jsonVentas.length-1].metodos_pago;
    var jsonmetodos_pagos = JSON.parse(metodos_pago);
    var vmp = "";
    console.log(jsonmetodos_pagos);
    for (let j = 0; j < Object.keys(jsonmetodos_pagos).length; j++) {
        console.log(jsonmetodos_pagos[j]);
        vmp = vmp + " " + jsonmetodos_pagos[j].valor+" método "+jsonmetodos_pagos[j].metodo;
    }
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraventa'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[jsonVentas.length-1].ID+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.nombre+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.telefono+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.correo+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'> <p class='letra18pt-pc negrillaUno'>"+pedido+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[jsonVentas.length-1].valor_total+" "+vmp+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[jsonVentas.length-1].notas+"</p></div></div></div>";
    for (let i = (jsonVentas.length-2); i >=0; i--) {
        var datoscliente = jsonVentas[i].datos_cliente;
        var jsondatoscliente = JSON.parse(datoscliente);
        var codigos_prendas = jsonVentas[i].codigos_prendas;
        var jsoncodigos_prendas = JSON.parse(codigos_prendas);
        var pedido = "";
        console.log(jsoncodigos_prendas);
        for (let j = 0; j < Object.keys(jsoncodigos_prendas).length; j++) {
            pedido = pedido + " " + jsoncodigos_prendas[j].codigo+" "+jsoncodigos_prendas[j].descripcion;
        }
        var metodos_pago = jsonVentas[i].metodos_pago;
        var jsonmetodos_pagos = JSON.parse(metodos_pago);
        var vmp = "";
        console.log(jsoncodigos_prendas);
        for (let j = 0; j < Object.keys(jsonmetodos_pagos).length; j++) {
            vmp = vmp + " " + jsonmetodos_pagos[j].valor+" método "+jsonmetodos_pagos[j].metodo;
        }
        html = html +"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[i].ID+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.nombre+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.telefono+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsondatoscliente.correo+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'> <p class='letra18pt-pc negrillaUno'>"+pedido+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[i].valor_total+" "+vmp+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+jsonVentas[i].notas+"</p></div></div></div>";
    }
    $('#primeraFila').after(html);
    $('#agregarVenta').on('click', function(){    
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        console.log(jsonIds);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].ID+"'>"+jsonIds[i].descripcion+"</option>"
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor0' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='0' form='formularioCliente' required=''><option value='S'>Seleccione un opción de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";
        for (let i = 1; i < jsonIds.length; i++) {
            html = html+"<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor"+i+"' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='"+i+"' form='formularioCliente' required=''><option value='S'>Seleccione un opción de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";            
        }
        $('#vendedordiv').after(html);
        $('.metodo').append(option);
        var vendedores = obtenerDatajson('ID,display_name ','con_users','variasfilasunicas','0','0');
        var jsonvendedores = JSON.parse(vendedores);
        console.log(jsonvendedores);
        var vendehtml = "";
        for (let i = 0; i < jsonvendedores.length; i++) {
            vendehtml = vendehtml+"<option value='"+jsonvendedores[i].ID+"'>"+jsonvendedores[i].display_name+"</option>";            
        }
        $('#vendedorselect').append(vendehtml);
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());    
        $('.metodo').on('change', function(){  
            var id = parseInt(this.id)+1;
            console.log(id);
            $("#v"+id+"").css('display', 'block');
            $("#metodo"+id+"").css('display', 'block');
        });    
        return false;     
    });      
    $('#close').on('click', function(){         
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.metodop').remove(); 
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
    $('#agregarPedido').on('click', function(){//cliente_id 	datos_cliente 	codigos_prendas 	notas 	origen 	valor_total metodos_pago 	vendedor_id 
        var cliente_id = $('#idCliente').val();
        var datos_cliente =  new Object();
        datos_cliente.nombre = $('#nombreVenta').val();
        datos_cliente.telefono  = $('#telVenta').val();
        datos_cliente.correo = $('#correov').val();
        datos_cliente.documento = $('#documentov').val();
        var clienteString= JSON.stringify(datos_cliente);
        var codigos_prendas = $('#datospedido').attr("name");  
        var notas = $('#notas').val();
        var valor_total = $('#valor').attr("name");
        var divsmetodos = $('.metodop');
        var metodospago =  new Object();
        var valorfinal = 0;
        var j=0;
        for (let i = 0; i < divsmetodos.length; i=i+2) {
            var metodopago =  new Object();
            console.log(divsmetodos[i].children[0].children[1].valueAsNumber);
            var valorp = divsmetodos[i].children[0].children[1].valueAsNumber;
            if(valorp>0){
                metodopago.valor = valorp;
                valorfinal = valorfinal+valorp;
                console.log(divsmetodos[i+1].children[0].children[1].value);
                var metdodo = divsmetodos[i+1].children[0].children[1].value;
                if(metdodo=="S"){alert("Por favor ingresa el método de pago correcto");return false;}
                metodopago.metodo = metdodo;
                metodospago[j]=metodopago;
                j++;
            }
        }
        var metodospagoString= JSON.stringify(metodospago);
        var vendedor_id = $('#vendedorselect').val();
        if(!cliente_id){alert("¿Quién es el cliente?");return false;}
        if(!codigos_prendas){alert("¿Qué prendas quiere el "+datos_cliente.nombre+"?");return false;}  
        var pagovsvalor = valorfinal-parseInt(valor_total);
        if(pagovsvalor!=0){alert("El valor total del pedido no coincide con el valor de pago");return false;}  
        var last = nuevaventatiendas(cliente_id,clienteString,codigos_prendas,notas,"Plaza de las américas",valor_total,metodospagoString,vendedor_id);
        var lastid = JSON.parse(last);
        console.log(lastid[0].id);
        var jsoncodigos = JSON.parse(codigos_prendas);
        var usuarioLevel = $('#usuarioCell').attr('name');
        console.log(jsoncodigos);
        console.log(usuarioLevel);
        console.log(Object.keys(jsoncodigos).length);
        for (let i = 0; i < Object.keys(jsoncodigos).length; i++) {      
            console.log(jsoncodigos[i]);      
            actualizarPrendas(usuarioLevel,"Venta local","PA-"+lastid[0].id,jsoncodigos[i].codigo);
            actualizar("con_t_prendasplaza","-",jsoncodigos[i].codigo,"-");
        }
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.metodop').remove(); 
    });      
    $('#close2').on('click', function(){         
        $('#popup2').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        return false;     
    });
    $('#clienteGuardado').on('click', function(){ 
        if(!$('#nombre').val()){alert("Ingresa el nombre del cliente :)");return false;}
        if(!$('#telefono').val()){alert("Ingresa el teléfono del cliente :)");return false;}
        if(!$('#correo').val()){alert("Ingresa el correo del cliente :)");return false;}
        if(!$('#documento').val()){alert("Ingresa el documento del cliente :)");return false;}
        var telef = $('#telefono').val().replace(' ', '');
        var id = guardarCliente( $('#nombre').val(),telef,"-","-","-",$('#correo').val(),$('#documento').val());
        $('#popup2').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('#nombreVenta').val($('#nombre').val());
        $('#correov').val($('#correo').val());
        $('#telVenta').val($('#telefono').val());
        $('#idCliente').val(id);
        $('#documentov').val($('#documento').val());
        return false;     
    });
    $('#clienteBuscar').on('click', function(){ 
        $('#popup').fadeOut('slow');         
        $('#popup3').fadeIn('slow'); 
        var html = "";
        var clientes = clientesBuscarjson($('#tele').val());        
        var jsonclientes = JSON.parse(clientes);
        console.log(jsonclientes.length);
        if(jsonclientes.length==0){
            html = "<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
        }else{
            console.log(jsonclientes);
            for(i=0;i<jsonclientes.length;i++){
                var datos = items[i].split('%');
                html=html+"<p class='off remover' id='clienteid"+i+"' >"+jsonclientes[i].cliente_id+"</p><p id='nombre"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].nombre+"</p><p id='telefono"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].telefono+"</p><p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover' id='documento"+i+"' >"+jsonclientes[i].documento+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 remover' id='correo"+i+"' >"+jsonclientes[i].correo+"</p><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'><button class='botonmodal' id='"+i+"' onclick='seleccionCliente("+i+")' style='width: 100%;'>Cargar</button></div>";
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
        imprimirprendasparavenderdetal(); 
        return false;
    });  
    $('#close4').on('click', function(){   
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });     
    $('#agregarprendaspedido').on('click', function(){  
        $('.removeprendavender').remove();
        var check = $("#popup4 input"); 
        var valor = 0;
        var html = "";
        var jsonPrendas = new Object();
        for (let i = 0; i < check.length; i++) {
            console.log(check[i].checked);
            if(check[i].checked){
                valor = valor + parseInt(check[i].value);
                var codigoDescr = check[i].name.split("/");
                var jsonPrenda = new Object();
                jsonPrenda.codigo = codigoDescr[0];
                jsonPrenda.descripcion = codigoDescr[1];
                jsonPrenda.valor = check[i].value;
                jsonPrendas[i] = jsonPrenda;
                html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeprendavender' id='"+check[i].id+"'><p class='letra3pt-mv letra16pt-pc'>"+codigoDescr[0]+" "+codigoDescr[1]+" "+check[i].value+"</p></div>";
                console.log(check[i]);
            }            
        }
        console.log(jsonPrendas);
        var prendaString= JSON.stringify(jsonPrendas);
        html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeprendavender' id='datospedido' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valor' name='"+valor+"'>Precio total: "+valor+"</p></div>";
        $('#pedido').append(html);
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });
    /*************************** Enviar para venta (CELULAR) *******************************/
    $('#empezarEscaner').on('click', function() {
        $('#escaneados').css('display', 'block');
        $('#inicialEscaner').css('display', 'block');
        $('#escanerInvInicial').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"inicialReader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(enviarVentamayorista);//principal.js
    });
    $('#enviarParaventa').on('click', function() {
        var prendas = ($('#escaneados p'));
        enviarparaventa(prendas);
        $('.remover').remove();
    });           
})
</script>
<script>
function seleccionCliente(id) {
        $('#nombreVenta').val($('#nombre'+id).text());
        $('#correov').val($('#correo'+id).text());
        $('#telVenta').val($('#telefono'+id).text());
        $('#idCliente').val($('#clienteid'+id).text());
        $('#documentov').val($('#documento'+id).text());        
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