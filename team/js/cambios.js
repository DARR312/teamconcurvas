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
    $('#botonCargacambios').on('click', function(){ 
        //$("#prendasEncontradas select:eq("+(i+2)+")")
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><p class='letra18pt-pc' id='clienteDirecc'>"+$('#ventaCliente').text()+"</p></div>";
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc'>Prendas que entran</p></div><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc'>Prendas que salen</p></div></div>";
        var flag = 0;
        var prendasSalen = "";
        var prendasSalenName = "";
        var prendasEntran = "";
        var prendasEntranName = "";
        var diferencia = 0;
        for(var i = 0;i<$("#prendasEncontradas select").length;i++){
            var datosNueva = $("#prendasEncontradas select:eq("+(i)+")").val();//192%Abbie Camel SM%120000
            if(datosNueva != "NA"){
                flag = 1;
                var precioViejo = $("#prendasEncontradas p:eq("+(i)+")").attr("name");
                var nuevoArray = datosNueva.split("%");
                diferencia =parseInt(diferencia)+ parseInt(precioViejo)-parseInt(nuevoArray[2]);
                prendasEntran = prendasEntran+$("#prendasEncontradas p:eq("+(i)+")").text()+", "
                prendasEntranName = prendasEntranName+$("#prendasEncontradas select:eq("+(i)+")").attr("name")+"%";
                prendasSalen = prendasSalen+nuevoArray[1]+",";
                prendasSalenName = prendasSalenName+nuevoArray[0]+"%";
            }
        }
        if(flag == 1){
            $('#popup3').fadeOut('slow');      
            $('#popup').fadeIn('slow');
            $('.removeCambio').remove();
            var clienteAjuste = "";
            var costoEnvio = $('#costosEnvio').val();
            var cstasd = parseInt(costoEnvio)+0;
            diferencia = diferencia + cstasd;
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
            html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc' id='prendasEntran' name='"+prendasEntranName+"'>"+prendasEntran+"</p></div><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc' id='prendasSalen' name='"+prendasSalenName+"'>"+prendasSalen+"</p></div></div>";
            html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removeCambio'><p class='letra18pt-pc' id='diferencia' name='"+diferencia+"'>"+clienteAjuste+"</p></div>";
            $('#cambiosPrendas').append(html);
            $('#datosCliente').attr("name",$('#ventaCliente').attr("name"));
        }else{
            alert("No hay cambios realizados");
            $('#popup3').fadeOut('slow');      
            $('#popup').fadeIn('slow');
            $('.removeCambio').remove();
        }
        return false;     
    });
    $('.usuarioUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_cambios","row","venta_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado"){
            var idcliente = obtenerData("cliente_id","con_t_ventas","row","venta_id",ids);
            var clienteDatos = obtenerData("nombre,telefono,direccion_1,complemento_1,ciudad_1","con_t_clientes","rowVarios","cliente_id",idcliente);
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
        var idcliente = obtenerData("cliente_id","con_t_ventas","row","venta_id",ids);
        var columna = "°"+$('#nombreUpdate').val()+"°"+$('#telefonoUpdate').val()+"°"+dir1Update+"°"+comp1Update+"°"+$('#ciudad1Update').val();
        actualizar("con_t_clientes",columna,idcliente,usuarioCell);
        var cambioId = obtenerData("cambio_id","con_t_cambios","row","venta_id",ids);
        actualizar("cambio_cliente",columna+"%",cambioId,usuarioCell);
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });
    $('.pedidoUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_cambios","row","cambio_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado" || estado == "No empacado"){
            $('.remover').remove();
            $("#prendasGuardadasUpdate").attr('name', ids);
            var datosCambio = obtenerData("cambioitem_id,prenda_idsale,ventainicial_id,estado","con_t_cambioitem","rowVarios","cambio_id",ids);
            //°34°5°89900°0°1%°35°7°130000°0°1%°36°8°89900°0°1%°37°11°89900°0°1%°38°34°130000°0°1%°39°34°130000°0°1%
            //°1°250°40°Sin empacar%°2°72°40°Sin empacar%
            var datosArray = datosCambio.split("%");    
            var datoArray = datosArray[0].split("°");
            var ventaItems = obtenerData("complemento_estado,descripcion","con_t_trprendas","rowVarios","cual","V"+datoArray[3]);
            //°Diego 1Diego 1°144°Beisbolera rojo L%°Diego 1Diego 1°145°Beisbolera Azul Oscuro L%
            var ventaCliente = obtenerData("datos_cliente","con_t_ventas","row","venta_id",datoArray[3]);
            var ventaItemsArray = ventaItems.split("%");
            //°Diego 1Diego 1°144°Beisbolera rojo L,°Diego 1Diego 1°145°Beisbolera Azul Oscuro L,
            var html = "<h1  style='display: none;' class='remover' id='ventaCliente' name='"+$('#ventaIdentificacion').val()+"'>"+ventaCliente+"</h1>";
            for(var k = 0;k<(ventaItemsArray.length-1);k++){
                var splt = ventaItemsArray[k].split("°");
                var itemId = splt[2];
                var datosVenta = obtenerData("ordenitem_id,prenda_id,valor,descuento_id,estado_id","con_t_ventaitem","rowVarios","ordenitem_id",itemId);
                //°137°113°140000°0°En ruta%
                var datosArray = datosVenta.split("°");
                var estado = datosArray[5].replace('%', '');
                var precio = datosArray[3];
                var prendaItemId = datosArray[2];
                if(estado == "Entregado"){
                    flag = 1;
                    html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'><p class='letra18pt-pc' name='"+precio+"'>"+splt[3]+"</p></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6'><label for='prenda1' class='control-label letra18pt-pc'> Prenda </label><select class='form-control disponibles' type='select' id='"+itemId+"' name='"+prendaItemId+"' form='formularioCliente'></select><span class='pmd-textfield-focused'></span></div></div>";
                }
            }      
            $('#popup6').fadeIn('slow'); 
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());
            html = html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><button class='botonmodal remover botoncargar' id='botonCargacambiosEncontrados' >Cargar</button></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 remover'><label for='cantidad6' class='control-label letra18pt-pc'> Valor de envío a pagar por el cliente</label><input class='form-control' type='number' id='costosEnvioEncontrado' name='costosEnvio' min='1'><span class='pmd-textfield-focused'></span></div>";
            $("#prendasCambiosEncontradas").append(html);
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
    $('#botonCargacambiosEncontrados').on('click', function(){
        
    });
    $('.fechaUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
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
            actualizar("venta_fecha",fecha,id,usuarioCell);
            $('#popup7').fadeOut('slow');       
            $('.popup-overlay').fadeOut('slow');
        }else{alert("Inserta una fecha");}
        return false;     
    }); 
    $('.notasUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
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
        actualizar("venta_nota",nota,id,usuarioCell);
        $('#popup8').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow');
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
        actualizar("venta_estado","Revisar Pago",ids,usuarioCell);
        $('.removerVentas').remove();
	    var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val());
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
	    var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val());
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
        actualizar("venta_clienteok",pago,ids,usuarioCell);//(tabla,columna,id,usuarioCell)
        var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val());
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
        var imprimir = imprimir+"<tr><td>"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+"</td><td>"+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>C"+precioFormato+"</td><td>"+arrayOrden[8]+"</td></tr>"
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
    /*var arrayOrden = arrayOrdenes[0].split('%');
    var estado = arrayOrden[11];
    var datosCliente = arrayOrden[2];
    var datosClienteUnicos = datosCliente.split('°');
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+arrayOrden[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[14]+"%"+arrayOrden[0]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[4]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+arrayOrden[7]+"'>"+arrayOrden[6]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+arrayOrden[8]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerVentas'><table border='1'><tr><th>Orden</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Precio</th><th>Pedido pago</th></tr><tr><td>"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+" "+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>"+arrayOrden[8]+"</td><td>"+arrayOrden[6]+"</td><td>"+arrayOrden[7]+"</td></tr>";
    for(i=1;i<arrayOrdenes.length-1;i++){
        var arrayOrden = arrayOrdenes[i].split('%');
        var estado = arrayOrden[11];
        var datosCliente = arrayOrden[2];
        var datosClienteUnicos = datosCliente.split('°');
        var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+arrayOrden[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[14]+"%"+arrayOrden[0]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosClienteUnicos[4]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc  dinerook"+arrayOrden[7]+"'>"+arrayOrden[6]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+arrayOrden[8]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div></div>";
        var imprimir = imprimir+"<tr><td>"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+" "+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>"+arrayOrden[8]+"</td><td>"+arrayOrden[6]+"</td><td>"+arrayOrden[7]+"</td></tr>"
    }
    html = html + imprimir +"</table></div>";
    return html;*/
};