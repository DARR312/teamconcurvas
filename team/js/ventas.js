function ventas() { 

    function sumarRestarpedido(datosIniciales,datosNuevos) {
        console.log(datosIniciales);
        console.log(datosNuevos);
        var arrayResta = new Array(6);var arraySuma = new Array(6);
        for (var i = 0; i < 6; i++) {arrayResta[i] = new Array(2);arraySuma[i] = new Array(2);}
        var r = 0;var s = 0;           
        for (var i = 0; i < 6; i++){
            if(!datosIniciales[i][0]){j=6;}
            for (var j = 0; j < 6; j++){
                if(!datosNuevos[j][0]){                            
                    arrayResta[r][0] = datosIniciales[i][0];
                    arrayResta[r][1] = datosIniciales[i][1];
                    r++;
                    break;                    
                }
                if(datosIniciales[i][0] != datosNuevos[j][0]){ continue;}
                if(datosIniciales[i][1] <= datosNuevos[j][1]){break;}
                var d = datosIniciales[j][1] - datosNuevos[i][1];
                arrayResta[r][0] = datosIniciales[i][0];
                arrayResta[r][1] = d;
                r++;
                break;
            }
        }
        var pedido = "";var precio = 0;
        var arrayItems = [];
        for (var i = 0; i < 6; i++) {
            if(!datosNuevos[i][0]){break;}
            pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
            precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
            arrayItems.push(datosNuevos[i][0]);
            for (var j = 0; j < 6; j++){
                if(!datosIniciales[j][0]){
                    arraySuma[s][0] = datosNuevos[i][0];
                    arraySuma[s][1] = datosNuevos[i][1];
                    s++;
                    flag = 1;
                    break;
                }
                if(datosIniciales[j][0] != datosNuevos[i][0]){continue;}
                if(datosIniciales[j][1] >= datosNuevos[i][1]){break;}
                var d = datosNuevos[i][1] - datosIniciales[j][1];
                arraySuma[s][0] = datosNuevos[i][0];
                arraySuma[s][1] = d;
                s++;
                break;
            }        
        }
        pedido = pedido+"°"+precio;
        var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
        var usuarioCell = $('#usuarioCell').attr("name");
        actualizar("venta_pedido",pedido,ids,usuarioCell,"-");
        console.log("Suma");console.log(arraySuma);
        console.log("Resta");console.log(arrayResta);
        for (var i = 1; i < arraySuma.length; i++){
            if(arraySuma[i][0]){
                itemVenta = itemVenta+","+arraySuma[i][1]+"/"+arraySuma[i][0];
            }else{i=7;}
        }
        for (var i = 0; i < arrayResta.length; i++){
            if(arrayResta[i][0]){
                restar(ids,arrayResta[i][0],arrayResta[i][1]);
            }else{i=7;}
        }
        ventaitem(ids,itemVenta);
        revisarfechasatelite(arrayItems);
        //console.log(ids);
        var fechaActual = obtenerData("fecha_entrega","con_t_ventas","row","venta_id",ids);
        var fecha_restriccion = $('#ventaNuevaTitulo').attr("name");
        var actual = new Date(fechaActual); 
        var restriccion = new Date(fecha_restriccion); 
        if(actual<restriccion){
            console.log("se debe cambiar la fecha del pedido "+fechaActual+"<"+fecha_restriccion);
            var frarray = fecha_restriccion.split('-');
            var fr = frarray[1]+"/"+frarray[2]+"/"+frarray[0];
            actualizar("venta_fecha",fr,ids,usuarioCell,"-");
        }
    };

    $('.usuarioUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var idsArray = ids.split("%");
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",idsArray[1]);
        if(estado == "Sin empacar" || estado == "Empacado"){
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
        var idsArray = ids.split("%");
        var columna = "°"+$('#nombreUpdate').val()+"°"+$('#telefonoUpdate').val()+"°"+dir1Update+"°"+comp1Update+"°"+$('#ciudad1Update').val();
        actualizar("con_t_clientes",columna,idsArray[0],usuarioCell,"-");
        actualizar("venta_cliente",columna+"%",idsArray[1],usuarioCell,"-");
        $('#popup5').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });
    $('.pedidoUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
        if(estado == "Sin empacar" || estado == "No empacado"){
            $("#prendasGuardadasUpdate").attr('name', ids);
            var datosVenta = obtenerData("ordenitem_id,prenda_id,valor,descuento_id,estado_id","con_t_ventaitem","rowVarios","venta_id",ids);
            //°34°5°89900°0°1%°35°7°130000°0°1%°36°8°89900°0°1%°37°11°89900°0°1%°38°34°130000°0°1%°39°34°130000°0°1%
            var datosArray = datosVenta.split("%");
            var datosOrdenados = new Array(6);
            for (var i = 0; i < 6; i++) {
               datosOrdenados[i] = new Array(3);
            }
            for(var i=0;i<datosArray.length;i++){
                var arrrayItem = datosArray[i].split("°");
                //alert(arrrayItem[5]+" "+arrrayItem[2]);
                if(arrrayItem[5] < 5){
                    for(var j=0;j<6;j++){
                        //alert(datosOrdenados[j][0]);
                        if(datosOrdenados[j][0]){
                            if(arrrayItem[2] == datosOrdenados[j][0]){
                                datosOrdenados[j][1] = datosOrdenados[j][1]+1;
                                j=6;
                            }
                        }else{
                            datosOrdenados[j][0] = arrrayItem[2];
                            datosOrdenados[j][1] = 1;
                            datosOrdenados[j][2] = arrrayItem[3];
                            j=6;
                        }
                        //alert(datosOrdenados);
                    } 
                }
            }
            var datosIniciales = "";
            for(var i=0;i<6;i++){
                if(datosOrdenados[i][0]){
                    var p = i+1;
                    var datosPrenda =  obtenerData("nombre,color,talla","con_t_resumen","rowVarios","referencia_id",datosOrdenados[i][0]);
                    var datosPrendaArray = datosPrenda.split("°");
                    var seleccion = $("#prenda"+p+"Update");
                    var talla = datosPrendaArray[3].split("%");
                    $(".s"+p).css('display', 'block');
                    seleccion.append("<option class='removeUpdate' value='"+datosOrdenados[i][0]+"%"+datosPrendaArray[1]+" "+datosPrendaArray[2]+" "+datosPrendaArray[3]+datosOrdenados[i][2]+"'>"+datosPrendaArray[1]+" "+datosPrendaArray[2]+" "+talla[0]+"</option>");
                    var cant = "#cantidad"+p+"Update";
                   $(cant).val(datosOrdenados[i][1]);
                   datosIniciales = datosIniciales+"°"+datosOrdenados[i][0]+"-"+datosOrdenados[i][1]+"-"+datosOrdenados[i][2];
                   /*  
                    //alert(datosOrdenados[i][0]+"-"+datosOrdenados[i][1]+"-"+datosOrdenados[i][2]);
                    <option value="5%Beisbolera Mostaza XL%89900">Beisbolera Mostaza XL</option>
                    °Beisbolera°Mostaza°XL%
                    */
                }
            }
            $('#popup6').attr("name",datosIniciales);    
            $('#popup6').fadeIn('slow'); 
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());
            var html = "<option class='removeUpdate' value='NA'>NA</option>";
            var disponibl = disponibles();
            var items = disponibl.split(',');
            for(i=0;i<(items.length-1);i++){
                var item = items[i].split('!');
                html=html+"<option class='removeUpdate' value='"+item[0]+"%"+item[1]+"%"+item[2]+"'>"+item[1]+"</option>";
            }
            var disp = $('.disponiblesUpdate');
            disp.append(html);
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
    $('#prendasGuardadasUpdate').on('click', function(){   
        ids = $(this).attr("name");
        var datosInicialesString = $('#popup6').attr("name"); 
        var datosNuevos = new Array(6);
        for (var i = 0; i < 6; i++) {datosNuevos[i] = new Array(4);}
        for (let k = 1; k < 7; k++) {
            if(k==6){
                if($('#cantidad6Update').val() <= 0){
                    alert("Ingresa la cantidad para la referencia 6");
                    break;
                }
                for (let i = 1; i < 7; i++) {
                    var datos = $('#prenda'+i+'Update').val();var items = datos.split('%');
                    datosNuevos[i-1][0] = items[0];
                    datosNuevos[i-1][1] = $('#cantidad'+i+'Update').val();
                    datosNuevos[i-1][2] = items[2];
                    datosNuevos[i-1][3] = items[1];        
                }        
                var datosInicialesArray = datosInicialesString.split('°');
                var datosIniciales = new Array(6);
                for (var i = 0; i < 6; i++) {datosIniciales[i] = new Array(3);}
                for (var i = 1; i < datosInicialesArray.length; i++) {
                    var itemArray = datosInicialesArray[i].split('-');
                    datosIniciales[i-1][0] = itemArray[0];
                    datosIniciales[i-1][1] = itemArray[1];
                    datosIniciales[i-1][2] = itemArray[2];
                }
                sumarRestarpedido(datosIniciales,datosNuevos);                
                $('.removeUpdate').remove();
                $(".removecero").val(0);
                $('#popup6').fadeOut('slow');       
                $('.popup-overlay').fadeOut('slow');

            }
            if($('#prenda'+k+'Update').val() == "NA"){
                if(k==1){alert("Ingresa cantidades para la referencia 1 "+k);console.log(datosNuevos);break;}
                for (let i = 1; i < k; i++) {
                    var datos = $('#prenda'+i+'Update').val();var items = datos.split('%');
                    datosNuevos[i-1][0] = items[0];
                    datosNuevos[i-1][1] = $('#cantidad'+i+'Update').val();
                    datosNuevos[i-1][2] = items[2];
                    datosNuevos[i-1][3] = items[1]; 
                }        
                var datosInicialesArray = datosInicialesString.split('°');
                var datosIniciales = new Array(6);
                for (var i = 0; i < 6; i++) {datosIniciales[i] = new Array(3);}
                for (var i = 1; i < datosInicialesArray.length; i++) {
                    var itemArray = datosInicialesArray[i].split('-');
                    datosIniciales[i-1][0] = itemArray[0];
                    datosIniciales[i-1][1] = itemArray[1];
                    datosIniciales[i-1][2] = itemArray[2];
                }
                sumarRestarpedido(datosIniciales,datosNuevos);                
                $('.removeUpdate').remove();
                $(".removecero").val(0);
                $('#popup6').fadeOut('slow');       
                $('.popup-overlay').fadeOut('slow'); 
                break;
            }            
            if($('#cantidad'+k+'Update').val() <= 0){
                alert("Ingresa la cantidad para la referencia "+k+" ");
                break;
            }          
        }      
        return false;    
    }); 
    $('.fechaUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado" || estado == "No empacado"){
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
            actualizar("venta_fecha",fecha,id,usuarioCell,"-");
            $('#popup7').fadeOut('slow');       
            $('.popup-overlay').fadeOut('slow');
        }else{alert("Inserta una fecha");}
        return false;     
    }); 
    $('.notasUpdate').on('click', function(){  
        var ids = $(this).attr("name"); 
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado" || estado == "No empacado"){
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
        actualizar("venta_nota",nota,id,usuarioCell,"-");
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
        actualizar("venta_estado","Revisar Pago",ids,usuarioCell,"-");
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
        actualizar("venta_clienteok",pago,ids,usuarioCell,"-");//(tabla,columna,id,usuarioCell)
        var ordenesVenta = ordenesventa($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val());
        var arrayOrdenes = ordenesVenta.split('&');
        var itemsVentas = $('#itemsVentas');
    	itemsVentas.after(html);
    	ventas();
    	return false;
    });
};
function imprimirVentas(arrayOrdenes,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate){
    var arrayOrden = arrayOrdenes[0].split('%');
    var estado = arrayOrden[11];
    var datosCliente = arrayOrden[2];
    var datosClienteUnicos = datosCliente.split('°');
    var ok = 0;
    var press = 0;
    if(arrayOrden[7]>0){
        ok = 1;
        press = arrayOrden[7];
        botonrevisar = "cliente_ok1";
    }else{
        press = arrayOrden[6];
        botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
    }
    var precioFormato = formatoPrecio(press);
    var notas = arrayOrden[8];
    var direcc = datosClienteUnicos[3];
    var compleDirecc = datosClienteUnicos[4];
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+arrayOrden[0]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[14]+"%"+arrayOrden[0]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+direcc+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+compleDirecc+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+datosClienteUnicos[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+arrayOrden[9]+"</p></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerVentas'><table border='1'><tr><th>Orden</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Precio</th><th>Pedido pago</th></tr><tr><td>"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+"</td><td>"+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>"+arrayOrden[8]+"</td><td>"+precioFormato+"</td><td>"+arrayOrden[7]+"</td></tr>";
    for(i=1;i<arrayOrdenes.length-1;i++){
        var arrayOrden = arrayOrdenes[i].split('%');
        var estado = arrayOrden[11];
        var datosCliente = arrayOrden[2];
        var datosClienteUnicos = datosCliente.split('°');
        if(arrayOrden[7]>0){
            ok = 1;
            press = arrayOrden[7];
            botonrevisar = "cliente_ok1";
        }else{
            press = arrayOrden[6];
            ok = 0;
            botonrevisar = "revisarPago";
        }
        var notas = arrayOrden[8];
        var direcc = datosClienteUnicos[3];
        var compleDirecc = datosClienteUnicos[4];
        var precioFormato = formatoPrecio(press);
        var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+arrayOrden[0]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+arrayOrden[14]+"%"+arrayOrden[0]+"'>"+datosClienteUnicos[1]+" "+datosClienteUnicos[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+direcc+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+compleDirecc+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+datosClienteUnicos[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+arrayOrden[0]+"'>"+arrayOrden[10]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+arrayOrden[0]+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+arrayOrden[9]+"</p></div></div>";
        var imprimir = imprimir+"<tr><td>"+arrayOrden[0]+"</td><td>"+datosClienteUnicos[1]+"</td><td>"+datosClienteUnicos[3]+"</td><td>"+datosClienteUnicos[4]+"</td><td>"+datosClienteUnicos[5]+"</td><td>"+datosClienteUnicos[2]+"</td><td>"+arrayOrden[5]+"</td><td>"+arrayOrden[8]+"</td><td>"+precioFormato+"</td><td>"+arrayOrden[7]+"</td></tr>"
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
function imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate){
    // {
    //     "0": {
    //         "venta_id": "41",
    //         "fecha_creada": "2022-08-08 16:55:39",
    //         "datos_cliente": "{\"nombre\":\"Diego Rodríguez\",\"telefono\":\"3229261615\",\"direccion\":\"Cll 33 No 6 - 9\",\"complemento\":\"Apto 1005\",\"ciudad\":\"Bogotá\"}",
    //         "pedido": "{\"prendas\":\"1 Alaska Negro XS\",\"precio\":\"140000\"}",
    //         "cliente_ok": "0",
    //         "notas": "",
    //         "fecha_entrega": "2022-08-09",
    //         "estado": "Cancelado"
    //     }
    // }
    // { nombre: "Diego Rodríguez", telefono: "3229261615", direccion: "Cll 33 No 6 - 9", complemento: "Apto 1005", ciudad: "Bogotá" }
    //{   "prendas": "1 Alaska Negro XS",    "precio": "140000"    }
    var jsonDatosCliente = JSON.parse(jsonVenta[0].datos_cliente);
    console.log(jsonDatosCliente);
    var jsonPedido = JSON.parse(jsonVenta[0].pedido);
    console.log(jsonPedido);
    var ok = 0;
    var press = 0;
    if(jsonVenta[0].cliente_ok>0){
        ok = 1;
        press = jsonVenta[0].cliente_ok;
        botonrevisar = "cliente_ok1";
    }else{
        press = jsonPedido.precio;
        botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
    }
    var precioFormato = formatoPrecio(press);
    var notas = jsonVenta[0].notas;
    var estado = jsonVenta[0].estado;
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVenta[0].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVenta[0].cliente_id+"%"+jsonVenta[0].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVenta[0].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVenta[0].venta_id+"'>"+jsonVenta[0].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVenta[0].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVenta[0].origen+"</p></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerVentas'><table border='1'><tr><th>Orden</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Precio</th><th>Pedido pago</th></tr><tr><td>"+jsonVenta[0].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVenta[0].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    for(i=1;i<jsonVenta.length;i++){
        console.log(jsonVenta[i]);
        var jsonDatosCliente = JSON.parse(jsonVenta[i].datos_cliente);        
        var jsonPedido = JSON.parse(jsonVenta[i].pedido);  
        var ok = 0;
        var press = 0;
        if(jsonVenta[i].cliente_ok>0){
            ok = 1;
            press = jsonVenta[i].cliente_ok;
            botonrevisar = "cliente_ok1";
        }else{
            press = jsonPedido.precio;
            botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
        }
        var precioFormato = formatoPrecio(press);
        var notas = jsonVenta[i].notas;
        var estado = jsonVenta[i].estado;
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVenta[i].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVenta[i].cliente_id+"%"+jsonVenta[i].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVenta[i].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVenta[i].venta_id+"'>"+jsonVenta[i].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVenta[i].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVenta[i].origen+"</p></div></div>";
        imprimir = imprimir+"<tr><td>"+jsonVenta[i].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVenta[i].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    }
    html = html + imprimir +"</table></div>";
    console.log(html);
    return html;
};
function imprimirVentasCambiosjson(jsonVentaCambio,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate){
    var jsonVentas = jsonVentaCambio.ventas; 
    var jsonCambios = jsonVentaCambio.cambios; 
    console.log("jsventas");
    console.log(jsonVentas);
    console.log("jscambios");
    console.log(jsonCambios);
    var jsonDatosCliente = JSON.parse(jsonVentas[0].datos_cliente);
    var jsonPedido = JSON.parse(jsonVentas[0].pedido);
    var ok = 0;
    var press = 0;
    if(jsonVentas[0].cliente_ok>0){
        ok = 1;
        press = jsonVentas[0].cliente_ok;
        botonrevisar = "cliente_ok1";
    }else{
        press = jsonPedido.precio;
        botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
    }
    var precioFormato = formatoPrecio(press);
    var notas = jsonVentas[0].notas;
    var estado = jsonVentas[0].estado;
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVentas[0].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVentas[0].cliente_id+"%"+jsonVentas[0].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVentas[0].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVentas[0].venta_id+"'>"+jsonVentas[0].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVentas[0].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVentas[0].origen+"</p></div></div>";
    var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerVentas'><table border='1'><tr><th>Orden</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Precio</th><th>Pedido pago</th></tr><tr><td>"+jsonVentas[0].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVentas[0].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    for(i=1;i<jsonVentas.length;i++){
        var jsonDatosCliente = JSON.parse(jsonVenta[i].datos_cliente);
        var jsonPedido = JSON.parse(jsonVenta[i].pedido);  
        var ok = 0;
        var press = 0;
        if(jsonVentas[i].cliente_ok>0){
            ok = 1;
            press = jsonVentas[i].cliente_ok;
            botonrevisar = "cliente_ok1";
        }else{
            press = jsonPedido.precio;
            botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
        }
        var precioFormato = formatoPrecio(press);
        var notas = jsonVentas[i].notas;
        var estado = jsonVentas[i].estado;
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVentas[i].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVentas[i].cliente_id+"%"+jsonVentas[i].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVentas[i].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVentas[i].venta_id+"'>"+jsonVentas[i].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVentas[i].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVentas[i].origen+"</p></div></div>";
        imprimir = imprimir+"<tr><td>"+jsonVentas[i].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVentas[i].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    }
    html = html + imprimir +"</table></div>";
    var jsonCambios = jsonVentaCambio.cambios; 
    var ok = 0;
    var signo = "";
    if(jsonCambios.length>0){
        if(jsonCambios[0].excedente < 0){
            jsonCambios[0].excedente = -1*jsonCambios[0].excedente;
            signo = "-";
        }
        var precioFormato = formatoPrecio(jsonCambios[0].excedente);
        precioFormato = signo+precioFormato;
        var datosdelcliente = jsonCambios[0].datos_cliente.split("°");
        html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Estado</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Orden de cambio</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Orden de venta</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Cliente</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Dirección</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Adición</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Ciudad</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>Pedido</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Excedente</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Entrega</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Notas</p></div></div>";
        html = html +"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'> <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[0].estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+jsonCambios[0].cambio_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[0].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonCambios[0].venta_id+"'>"+datosdelcliente[1]+" "+datosdelcliente[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[4]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[5].substr(0, datosdelcliente[5].length - 1)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonCambios[0].cambio_id+"'>"+jsonCambios[0].pedido+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonCambios[0].cambio_id+"'>"+jsonCambios[0].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonCambios[0].cambio_id+"'>."+jsonCambios[0].notas+"</p></div></div>";
        //imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerCambios'><table border='1'><tr><th>Cambio</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Excedente</th></tr><tr><td>C"+jsonCambios[0].cambio_id+"</td><td>"+datosdelcliente[1]+"</td><td>"+datosdelcliente[3]+"</td><td>"+datosdelcliente[4]+"</td><td>"+datosdelcliente[5].substr(0, datosdelcliente[5].length - 1)+"</td><td>"+datosdelcliente[2]+"</td><td>"+jsonCambios[0].pedido+"</td><td>"+jsonCambios[0].notas+"</td><td>"+precioFormato+"</td></tr>";
        if(jsonCambios.length>0){
            for(i=1;i<jsonCambios.length;i++){
                console.log(jsonCambios[i]);
                var ok = 0;
                var signo = "";
                if(jsonCambios[i].excedente < 0){
                    jsonCambios[i].excedente = -1*jsonCambios[i].excedente;
                    signo = "-";
                }
                var precioFormato = formatoPrecio(jsonCambios[i].excedente);
                precioFormato = signo+precioFormato;
                var datosdelcliente = jsonCambios[i].datos_cliente.split("°");
                html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCambios'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[i].estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>C"+jsonCambios[i].cambio_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+jsonCambios[i].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonCambios[i].venta_id+"'>"+datosdelcliente[1]+" "+datosdelcliente[2]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[3]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[4]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>"+datosdelcliente[5].substr(0, datosdelcliente[5].length - 1)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonCambios[i].cambio_id+"'>"+jsonCambios[i].pedido+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonCambios[i].cambio_id+"'>"+jsonCambios[i].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonCambios[i].cambio_id+"'>."+jsonCambios[i].notas+"</p></div></div>";
                //imprimir = imprimir+"<tr><td>C"+jsonCambios[i].cambio_id+"</td><td>"+datosdelcliente[1]+"</td><td>"+datosdelcliente[3]+"</td><td>"+datosdelcliente[4]+"</td><td>"+datosdelcliente[5].substr(0, datosdelcliente[5].length - 1)+"</td><td>"+datosdelcliente[2]+"</td><td>"+jsonCambios[i].pedido+"</td><td>"+jsonCambios[i].notas+"</td><td>"+precioFormato+"</td></tr>";
            }        
        }
        html = html + imprimir +"</table></div>";
    }else{ html = html +"<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc'>Sin cambios</p></div>";}
    
    return html;
};
function minmax(id) {
  var valor = $("#"+id).val();//265%Abbie Negro SM%140000
  var valArray = valor.split("%");
  var cantidad = obtenerData("cantidad","con_t_resumen","row","referencia_id",valArray);
  var ultimo = id[id.length-1];
  if(ultimo != "6"){
      var siguiente = parseInt(ultimo)+1;
    $(".s"+siguiente).css('display', 'block');
  }
  $("#cantidad"+ultimo).attr("max",cantidad);
  $("#cantidad"+ultimo).val(1);
}
function minmaxupdate(id) {
  var valor = $("#"+id).val();//265%Abbie Negro SM%140000
  var valArray = valor.split("%");
  var cantidad = obtenerData("cantidad","con_t_resumen","row","referencia_id",valArray);
  var ultimo = id[id.length-7];  
  if(ultimo != "6"){
      var siguiente = parseInt(ultimo)+1;
    $(".s"+siguiente).css('display', 'block');
  }
  $("#cantidad"+ultimo).attr("max",cantidad);
  $("#cantidad"+ultimo).val(1);
}