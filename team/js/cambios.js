function formatoPrecio(precio){
    let myFunc = num => Number(num);
    var nuevoPrecio =  Array.from(String(precio), myFunc);
    var ultimo = nuevoPrecio[nuevoPrecio.length-1];
    let start =nuevoPrecio.length-3;
    nuevoPrecio.splice(start, 0, '.');
    nuevoPrecio.unshift("$");
    var preciodevuelto= nuevoPrecio.join('');
    return preciodevuelto;
};

function cambios() {   
    $('#botonCargacambiopedido').on('click', function(){ 
        var idventa = $("#ventainfo").text();
        var cliente_ok = $("#ventainfo").attr("name");
        var idcambio = $("#cambioinfo").text();
        var pedido = "";
        var precio = 0;    
        var itemCambio = "";
        var venta_id = $('#ventainfo').text();  
        var objetopedidoitem = {};
        objetopedidoitem.venta = 0;
        objetopedidoitem.cantidad = 0;
        let arraypedidoitem = [objetopedidoitem];  
        var arrayItems = []; 
        var refrestar = "";  
        for (let k = 1; k < 7; k++) {
            if($('#updateprenda'+k).val() == "NA"){continue;}
            if($('#updatecantidad'+k).val() <= 0){
                alert("Ingresa la cantidad para la referencia "+k+" ");
                break;
            }
            var dateos = $('#updateprenda'+k).val().split("%");
            pedido = pedido +$('#updatecantidad'+k).val()+" "+dateos[1]+" ";
            precio = precio + ($('#updatecantidad'+k).val() * parseInt(dateos[2]));
            for (let i = 0; i < $('#updatecantidad'+k).val(); i++) {
                var objetopedidoitem = {};
                objetopedidoitem.referencia = dateos[0];
                objetopedidoitem.ventainicial = venta_id;   
                arraypedidoitem.push(objetopedidoitem);  
                refrestar = refrestar+dateos[0]+",";   
                arrayItems.push(dateos[0]);               
            }
        }
        if(precio == 0){alert("Agrega al menos una referencia al pedido");return false;}
        var envio = 0;
        if($("#costosEnvioupdate").val()){
            envio = parseInt($("#costosEnvioupdate").val());
        }
        var valorsaliente = precio + envio;
        var venta = obtenerDatajson("cliente_ok,datos_cliente,pedido_item","con_t_ventas","valoresconcondicion","venta_id",venta_id);
        var jsonVentaCliente = JSON.parse(venta); 
        var prendav = obtenerDatajson("cual,estado,codigo,referencia_id","con_t_trprendas","valoresconcondicion","cual","'V"+venta_id+"'");
        var jsonprendav = JSON.parse(prendav); 
        var jsonpedidoitemventa = JSON.parse(jsonVentaCliente[0]['pedido_item']);
        var canttrprendas = jsonprendav.length;
        var valormercancia = 0;
        if(canttrprendas>0){
            for (let i = 0; i < canttrprendas; i++) {
                for (let j = 1; j < jsonpedidoitemventa.length; j++) {
                    if(jsonpedidoitemventa[j]['referencia']==jsonprendav[i]['referencia_id']){
                        jsonpedidoitemventa.splice(1, j);
                    }
                }                
            }
            for (let k = 1; k < jsonpedidoitemventa.length; k++) {
                valormercancia = valormercancia + parseInt(jsonpedidoitemventa[k]['valor']);                
            }
        }
        
        var diferencia = valorsaliente - valormercancia;

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "pedido";
        objeto.valor = pedido;
        var pedido = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "pedido_item";
        objeto.valor = arraypedidoitem;
        var pedido_item = prepararjson(objeto);
        var objeto = {};
        objeto.columna = "cambio_id";
        objeto.valor = idcambio;
        var condicion = prepararjson(objeto);
        var pedidoitem = obtenerDatajson("pedido_item","con_t_cambios","valoresconcondicion","cambio_id ",idcambio);
        var jsonpedidoitems = JSON.parse(pedidoitem);
        var jsonpedidoitem = JSON.parse(jsonpedidoitems[0]['pedido_item']);
        revisarfechasatelite(arrayItems);
        var refsumar = ""; 
        var arrayItems = [];
        for (let index = 1; index < jsonpedidoitem.length; index++) {
           refsumar = refsumar+jsonpedidoitem[index]['referencia']+",";     
           arrayItems.push(jsonpedidoitem[index]['referencia']);         
        }
        actualizarregistros("con_t_cambios",condicion,pedido_item,pedido,"0","0","0","0","0","0","0","0","0");
        sumarinventario(refsumar);
        restarInventario(refrestar);
        $('#popup6').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove();
        $('.removeCambio').remove();
        var ordenesCambio = ordenescambiojson("0","0","0","0","0");
        var html = imprimirCambiosjson(ordenesCambio,"pedidoUpdate","fechaUpdate","notasUpdate","usuarioUpdate");
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        cambios();
        return false;
    });
    $('#botonCargacambios').on('click', function(){ 
        var idventa = $("#datoscliente").attr("name");
        var pedido = "";
        var precio = 0;    
        var itemCambio = "";    
        for (let k = 1; k < 7; k++) {
            if($('#prenda'+k).val() == "NA"){continue;}
            if($('#cantidad'+k).val() <= 0){
                alert("Ingresa la cantidad para la referencia "+k+" ");
                break;
            }
            var dateos = $('#prenda'+k).val().split("%");
            pedido = pedido +$('#cantidad'+k).val()+" "+dateos[1]+" ";
            precio = precio + ($('#cantidad'+k).val() * parseInt(dateos[2]));
            itemCambio = itemCambio + $('#cantidad'+k).val()+"/"+dateos[0]+",";
        }
        if(precio == 0){alert("Agrega al menos una referencia al pedido");return false;}
        var envio = 0;
        if($("#costosEnvio").val()){
            envio = parseInt($("#costosEnvio").val());
        }
        var valorsaliente = precio + envio;
        
        var venta = obtenerDatajson("cliente_ok,datos_cliente,pedido_item","con_t_ventas","valoresconcondicion","venta_id",$('#ventaIdentificacion').val());
        var jsonVentaCliente = JSON.parse(venta); 
        var prendav = obtenerDatajson("cual,estado,codigo,referencia_id","con_t_trprendas","valoresconcondicion","cual","'V"+$('#ventaIdentificacion').val()+"'");
        var jsonprendav = JSON.parse(prendav); 
        var cambiosantiguos = obtenerDatajson("excedente,cambio_id,pedido_item,cliente_ok","con_t_cambios","valoresconcondicion","venta_id",$('#ventaIdentificacion').val());
        var jsoncambiosantiguos = JSON.parse(cambiosantiguos); 
        var jsonpedidoitemventa = JSON.parse(jsonVentaCliente[0]['pedido_item']);
        var canttrprendas = jsonprendav.length;
        var cantventas = jsonpedidoitemventa[0]['cantidad'];
        var cantcambios = 0;
        var valormercancia = 0;
        if(canttrprendas>0){
            for (let i = 0; i < canttrprendas; i++) {
                for (let j = 1; j < jsonpedidoitemventa.length; j++) {
                    if(jsonpedidoitemventa[j]['referencia']==jsonprendav[i]['referencia_id']){
                        jsonpedidoitemventa.splice(1, j);
                    }
                }                
            }
            for (let k = 1; k < jsonpedidoitemventa.length; k++) {
                valormercancia = valormercancia + parseInt(jsonpedidoitemventa[k]['valor']);                
            }
        }
        


        var datoscliente = $("#datoscliente").text();
        var diferencia = valorsaliente - valormercancia;
        var jsondatoscliente = JSON.parse(datoscliente); 
        var clienteAjuste = "";
        if(diferencia<0){                        
            var fefren = -1*diferencia;
            var formatopre = formatoPrecio(fefren);
            clienteAjuste = "El cliente queda con saldo a favor de: "+formatopre;
        }if(diferencia==0){
            clienteAjuste = "El cliente no queda con saldo";
        }if(diferencia>0){
            var formatopre = formatoPrecio(diferencia);
            clienteAjuste = "El cliente queda debe pagar de más: "+formatopre;
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 removeCambio'><p class='letra18pt-pc' id='clienteNombre'>"+jsondatoscliente.nombre+"</p></div>";     
        html =html+ "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 removeCambio'><p class='letra18pt-pc' id='clienteTelefono'>"+jsondatoscliente.telefono+"</p></div>";
        html =html+ "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 removeCambio'><p class='letra18pt-pc' id='clienteDireccion'>"+jsondatoscliente.direccion+"</p></div>";
        html =html+ "<div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 removeCambio'><p class='letra18pt-pc' id='clienteComplemento'>"+jsondatoscliente.complemento+"</p></div>";
        html =html+ "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 removeCambio'><p class='letra18pt-pc' id='clienteCiudad'>"+jsondatoscliente.ciudad+"</p></div>";
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc' id='tpedido' name='"+idventa+"'>Pedido</p></div>";
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p class='letra18pt-pc' id='pedido' name='"+itemCambio+"'>"+pedido+"</p></div>";
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><p class='letra18pt-pc' id='diferencia' name='"+diferencia+"'>"+clienteAjuste+"</p></div>";   
        $('#popup3').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.removeCambio').remove();
        $('#cambiosPrendas').append(html);  
    });
    $('.usuarioUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_cambios","row","cambio_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado"){
            var cambio = obtenerDatajson("datos_cliente","con_t_cambios","valoresconcondicion","cambio_id",ids);
            var jsoncambioCliente = JSON.parse(cambio); 
            var jsondatosCliente = JSON.parse(jsoncambioCliente[0].datos_cliente); 
            var ciuddes = ciudades();
            var items = ciuddes.split(',');
            var html = "<option value='"+jsondatosCliente.ciudad+"'>"+jsondatosCliente.ciudad+"</option>";
            for(i=1;i<items.length;i++){
                html=html+"<option value='"+items[i]+"'>"+items[i]+"</option>";
            }
            var ciudad1Update = $('#ciudad1Update');
            ciudad1Update.append(html);
            $('#nombreUpdate').val(jsondatosCliente.nombre);
            $('#telefonoUpdate').val(jsondatosCliente.telefono);
            $('#dir1Update').val(jsondatosCliente.direccion);
            $('#comp1Update').val(jsondatosCliente.complemento);
            $('#idClienteUpdate').text(ids);
            $('#popup5').fadeIn('slow');         
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());
        }else{alert("No puedes modificar este pedido porque ya salio");}
        return false;     
    });   
    $('#close5').on('click', function(){   
        $('#popup5').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });  
    $('#clienteUpdate').on('click', function(){ 
        var usuarioCell = $('#usuarioCell').attr("name");
        var dir1Update= $('#dir1Update').val().replace('#', 'No');
        var comp1Update= $('#comp1Update').val().replace('#', 'No');
        var ids = $('#idClienteUpdate').text();
        var idventa = obtenerData("venta_id","con_t_cambios","row","cambio_id",ids);
        var idcliente = obtenerData("cliente_id","con_t_ventas","row","venta_id",idventa);
        var columna = "°"+$('#nombreUpdate').val()+"°"+$('#telefonoUpdate').val()+"°"+dir1Update+"°"+comp1Update+"°"+$('#ciudad1Update').val();
        actualizar("con_t_clientes",columna,idcliente,usuarioCell,"-");
        var objeto = {};
        objeto.nombre = $('#nombreUpdate').val();
        objeto.telefono = $('#telefonoUpdate').val();
        objeto.direccion = dir1Update;
        objeto.complemento = comp1Update;
        objeto.ciudad = $('#ciudad1Update').val();            
        var datosCliente=JSON.stringify(objeto);
        var datosCliente1 = datosCliente.replaceAll("<","");  
        var datosCliente2 = datosCliente1.replaceAll(">","");
        var datosCliente3 = datosCliente2.replaceAll("{","<");  
        datosCliente = datosCliente3.replaceAll("}",">"); 
        actualizar("cambio_cliente",datosCliente,ids,usuarioCell,"-");
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow'); 
        $('.reinicia').remove();
        $('.removerCambios').remove();
        var ordenesCambio = ordenescambiojson("0","0","0","0","0");
        var html = imprimirCambiosjson(ordenesCambio,"pedidoUpdate","fechaUpdate","notasUpdate","usuarioUpdate");
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        cambios();
        return false;         
    });
    $('.pedidoUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_cambios","row","cambio_id",ids);
        if(estado == "Sin empacar" || estado == "No empacado"){
            $('.remover').remove();
            $("#prendasGuardadasUpdate").attr('name', ids);
            $('#popup6').fadeIn('slow'); 
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());
            var venta_id = obtenerData("venta_id","con_t_cambios","row","cambio_id",ids);
            var clienteok = obtenerData("cliente_ok","con_t_ventas","row","venta_id",venta_id);          
            var html = "<h1  style='display: none;' class='remover' id='cambioinfo' name='"+ids+"'>"+ids+"</h1>";
            html =html+ "<h1  style='display: none;' class='remover' id='ventainfo' name='"+clienteok+"'>"+venta_id+"</h1>";
            html = html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><button class='botonmodal remover botoncargar' id='botonCargacambiopedido' >Cambiar pedido</button></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 remover'><label for='cantidad6' class='control-label letra18pt-pc'> Valor de envío a pagar por el cliente</label><input class='form-control' type='number' id='costosEnvioupdate' name='costosEnvio' min='1'><span class='pmd-textfield-focused'></span></div>";
            $("#updateformularioPedido").after(html);
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
        }else{alert("No puedes modificar este pedido porque ya salio");}
        return false;      
    }); 
    $('#close6').on('click', function(){   
        $('.removeUpdate').remove();
        $(".removecero").val(0);
        $('#popup6').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    }); 
    $('.fechaUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_cambios","row","cambio_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado"){
           $("#tituloFecha").text("Cambiar fecha del pedido: "+ids);
            $("#tituloFecha").attr("name",ids);
            $('#popup7').fadeIn('slow'); 
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height()); 
        }else{alert("No puedes modificar este pedido porque ya salio");}
        return false;      
    });
    $('#close7').on('click', function(){   
        $('#popup7').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    }); 
    $('#fechaUpdate').on('click', function(){
        if($("#datetimepicker-update").val()){
            var fecha = $("#datetimepicker-update").val();
            var id =  $("#tituloFecha").attr("name");
            var usuarioCell = $('#usuarioCell').attr("name");
            actualizar("cambio_fecha",fecha,id,usuarioCell,"-");
            $('#popup7').fadeOut('slow');       
            $('.popup-overlay').fadeOut('slow');
            $('.popup-overlay').fadeOut('slow');      
            $('.reinicia').remove();
            $('.removeCambio').remove();
            var ordenesCambio = ordenescambiojson("0","0","0","0","0");
            var html = imprimirCambiosjson(ordenesCambio,"pedidoUpdate","fechaUpdate","notasUpdate","usuarioUpdate");
            var primeraFila = $('#primeraFila');
            primeraFila.after(html);
            cambios();
        }else{alert("Inserta una fecha");}
        return false;     
    }); 
    $('.notasUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_cambios","row","cambio_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado"){
            $("#tituloNotas").text("Cambiar notas del pedido: "+ids);
            $("#tituloNotas").attr("name",ids);
            $('#popup8').fadeIn('slow'); 
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());
        }else{
            alert("No puedes modificar este pedido porque ya salio");
        }
        return false;      
    });
    $('#close8').on('click', function(){   
        $('#popup8').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    }); 
    $('#notaUpdate').on('click', function(){
        var nota = $("#notasUpdate").val();
        var id =  $("#tituloNotas").attr("name");
        var usuarioCell = $('#usuarioCell').attr("name");
        actualizar("cambio_nota",nota,id,usuarioCell,"-");
        $('#popup8').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow');   
        $('.reinicia').remove();
        $('.removeCambio').remove();
        var ordenesCambio = ordenescambiojson("0","0","0","0","0");
        var html = imprimirCambiosjson(ordenesCambio,"pedidoUpdate","fechaUpdate","notasUpdate","usuarioUpdate");
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        cambios();
        return false;     
    });
    $('.botonrevisar').on('click', function(){  
        var ids = $(this).attr("name"); 
        var usuarioCell = $('#usuarioCell').attr("name");
        var htmlUpdate = $('#filtroFE').attr("name");
	    var htmlUpdateArray = htmlUpdate.split(",");
	    var pedidoUpdate = htmlUpdateArray[0];
	    var fechaUpdate = htmlUpdateArray[1];
	    var notasUpdate = htmlUpdateArray[2];
	    var usuarioUpdate = htmlUpdateArray[3];
	    var botonrevisar = htmlUpdateArray[4];
        actualizar("venta_estado","Revisar Pago",ids,usuarioCell,"-");
        $('.removerVentas').remove();
	    var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var arrayOrdenes = ordenesVenta.split('&');
        var primeraFila = $('#primeraFila');
        var html = imprimirVentas(arrayOrdenes,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
        return false;
    });
    
    $('.revisarPago').on('click', function(){ 
        var ids = $(this).attr("name"); 
        var htmlUpdate = $('#filtroFE').attr("name");
	    var htmlUpdateArray = htmlUpdate.split(",");
	    var pedidoUpdate = htmlUpdateArray[0];
	    var fechaUpdate = htmlUpdateArray[1];
	    var notasUpdate = htmlUpdateArray[2];
	    var usuarioUpdate = htmlUpdateArray[3];
	    var botonrevisar = htmlUpdateArray[4];
	    var ventaItems = obtenerData("prenda_id,valor,descuento_id,estado_id","con_t_ventaitem","rowVarios","venta_id",ids);
	    var html = imprimiritemventas(ventaItems);
	    $('#popup9').fadeIn('slow'); 
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());
        var itemsVentas = $('#itemsVentas');
    	itemsVentas.after(html);
    	$('#confirmarPago').attr("name",ids);
        /*actualizar("venta_clienteok","1",ids,usuarioCell);
        $('.removerVentas').remove();
	    var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var arrayOrdenes = ordenesVenta.split('&');
        var itemsVentas = $('#itemsVentas');
    	itemsVentas.after(html);
    	ventas();*/
        return false;
    });
    $('#close9').on('click', function(){   
        $('#popup9').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('.removeUpdate').remove();
        return false;     
    }); 
    $('#confirmarPago').on('click',function(){
        var ids = $(this).attr("name"); 
        var usuarioCell = $('#usuarioCell').attr("name");
        var pago = $('#valorConfirmado').val();
        $('#popup9').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('.removeUpdate').remove();
        actualizar("venta_clienteok",pago,ids,usuarioCell,"-");//(tabla,columna,id,usuarioCell)
        var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var arrayOrdenes = ordenesVenta.split('&');
        var itemsVentas = $('#itemsVentas');
    	itemsVentas.after(html);
    	ventas();
    	return false;
    });
};
function imprimirCambios(arrayOrdenes,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate){
    var arrayOrden = arrayOrdenes[0].split('%');
    var estado = arrayOrden[11];
    var datosCliente = arrayOrden[3];
    var datosClienteUnicos = datosCliente.split('°');
    var ok = 0;
    var excedente = arrayOrden[9];
    var signo = "";
    if(excedente < 0){
        excedente = -1*excedente;
        signo = "-";
    }
    var precioFormato = formatoPrecio(excedente);
    precioFormato = signo+precioFormato;
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCambios' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+arrayOrden[0]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+arrayOrden[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[2]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[4]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[5]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+arrayOrden[8]+"</p></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerCambios'><table border='1'><tr><th>Cambio</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Excedente</th><th>Notas</th></tr><tr><td>C"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+"</td><td>"+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>"+precioFormato+"</td><td>"+arrayOrden[8]+"</td></tr>";
    for(i=1;i<arrayOrdenes.length-1;i++){
        var arrayOrden = arrayOrdenes[i].split('%');
        var estado = arrayOrden[11];
        var datosCliente = arrayOrden[3];
        var datosClienteUnicos = datosCliente.split('°');
        var excedente = arrayOrden[9];
        var signo = "";
        if(excedente < 0){
            excedente = -1*excedente;
            signo = "-";
        }
        var precioFormato = formatoPrecio(excedente);
        precioFormato = signo+precioFormato;
        var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCambios'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+arrayOrden[0]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+arrayOrden[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[2]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[4]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[5]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+arrayOrden[8]+"</p></div></div>";
        var imprimir = imprimir+"<tr><td>C"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+"</td><td>"+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>C"+precioFormato+"</td><td>"+arrayOrden[8]+"</td></tr>"
    }
    html = html + imprimir +"</table></div>";
    return html;
};
function imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate){
    var jsonCambios = JSON.parse(ordenesCambio); 
    var ok = 0;
    var signo = "";
    if(jsonCambios[jsonCambios.length-1].excedente < 0){
        jsonCambios[jsonCambios.length-1].excedente = -1*jsonCambios[jsonCambios.length-1].excedente;
        signo = "-";
    }
    var precioFormato = formatoPrecio(jsonCambios[jsonCambios.length-1].excedente);
    precioFormato = signo+precioFormato;
    var jsonDatosCliente = JSON.parse(jsonCambios[jsonCambios.length-1].datos_cliente);
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCambios' id='primeraVenta'> <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[jsonCambios.length-1].estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+jsonCambios[jsonCambios.length-1].cambio_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[jsonCambios.length-1].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonCambios[jsonCambios.length-1].cambio_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonCambios[jsonCambios.length-1].cambio_id+"'>"+jsonCambios[jsonCambios.length-1].pedido+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonCambios[jsonCambios.length-1].cambio_id+"'>"+jsonCambios[jsonCambios.length-1].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonCambios[jsonCambios.length-1].cambio_id+"'>."+jsonCambios[jsonCambios.length-1].notas+"</p></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerCambios'><table border='1'><tr><th>Cambio</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Excedente</th></tr><tr><td>C"+jsonCambios[jsonCambios.length-1].cambio_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonCambios[jsonCambios.length-1].pedido+"</td><td>"+jsonCambios[jsonCambios.length-1].notas+"</td><td>"+precioFormato+"</td></tr>";
    
    if(jsonCambios.length>0){
        for(i=jsonCambios.length-2;i>=0;i--){
            var ok = 0;
            var signo = "";
            if(jsonCambios[i].excedente < 0){
                jsonCambios[i].excedente = -1*jsonCambios[i].excedente;
                signo = "-";
            }
            var precioFormato = formatoPrecio(jsonCambios[i].excedente);
            precioFormato = signo+precioFormato;
            var jsonDatosCliente = JSON.parse(jsonCambios[i].datos_cliente);
            html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCambios'> <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[i].estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+jsonCambios[i].cambio_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[i].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonCambios[i].cambio_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonCambios[i].cambio_id+"'>"+jsonCambios[i].pedido+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonCambios[i].cambio_id+"'>"+jsonCambios[i].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonCambios[i].cambio_id+"'>."+jsonCambios[i].notas+"</p></div></div>";
            imprimir = imprimir+"<tr><td>C"+jsonCambios[i].cambio_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonCambios[i].pedido+"</td><td>"+jsonCambios[i].notas+"</td><td>"+precioFormato+"</td></tr>";
        }        
    }
    html = html + imprimir +"</table></div>";
    return html;
};

function imprimiritemventas(ventaItems){
    var ventaItemsArray = ventaItems.split("%");
    var precio = 0;
    var html = "";
    for(var i = 0;i<(ventaItemsArray.length-1);i++){
        var elItem = ventaItemsArray[i].split("°");
        if(elItem[4]!=5){
            precio = precio + parseInt(elItem[2]);
            var referencia = obtenerData("nombre,color,talla","con_t_resumen","rowVarios","referencia_id",elItem[1]);//°Naori°Azul Oscuro°LXL%°Naori°Azul Oscuro°LXL%°Naori°Azul Oscuro°LXL%°Beisbolera°Gris Claro°SM%°Beisbolera°Azul Oscuro°SM%°Beisbolera°Azul Oscuro°SM%
            var refseparado = referencia.replaceAll('°', ' ');
            var refImprimir = refseparado.replace('%', '');
            html = html+"<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc removeUpdate'>"+refImprimir+"</p>";
        }
    }
    var precioFormato = formatoPrecio(precio);
    html = html+"<p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removeUpdate'>Precio total: "+precioFormato+"</p>";
    return html;
};