// const urlhost = "http://localhost/wordpress/index.php/controlador" ;
const urlhost = "https://concurvas.com/team/controlador/";
function formatoPrecio(precio){
	var pre = Math.sqrt(precio*precio);
    let myFunc = num => Number(num);
    var nuevoPrecio =  Array.from(String(pre), myFunc);
    var ultimo = nuevoPrecio[nuevoPrecio.length-1];
	if(nuevoPrecio.length>6){
		let start =nuevoPrecio.length-6;
    	nuevoPrecio.splice(start, 0, '´');
	}
    let start =nuevoPrecio.length-3;
    nuevoPrecio.splice(start, 0, '.');
	if(precio<0){nuevoPrecio.unshift("-$");}
	else{nuevoPrecio.unshift("$");}
    var preciodevuelto= nuevoPrecio.join('');
    return preciodevuelto;
};

function permisosPrincipales () {//permisos para los logos de la barra principal
	var enviar = "funcion=permisosPrincipales";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	//alert(habilitados);
	return habilitados;
};

function permisosVentas() {
	var enviar = "funcion=permisosVentas";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	//alert(habilitados);
	return habilitados;
};

function permisosCambios() {
	var enviar = "funcion=permisosCambios";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	//alert(habilitados);
	return habilitados;
};

function ciudades() {
	var enviar = "funcion=ciudades";
	var ciudades = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			ciudades = data;
		}						
	});	
	//alert(habilitados);
	return ciudades;
};
	
function clientesBuscar(telefono) {
	var enviar = "funcion=clientesEncontrados&telefono="+telefono;
	var client = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			client = data;
		}						
	});	
	//alert(habilitados);
	return client;
};
	
function clientesBuscarjson(telefono) {
	var enviar = "funcion=clientesBuscarjson&telefono="+telefono;
	var client = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			client = data;
		}						
	});	
	//alert(habilitados);
	return client;
};	

function clientesEncontrados(telefono) {
	var enviar = "funcion=clientesEncontrados&telefono="+telefono;
	var client = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			client = data;
		}						
	});	
	//alert(habilitados);
	return client;
};

function guardarCliente(nombre,telefono,dir1,comp1,ciudad1,correo,documento) {
	var enviar = "funcion=guardarCliente&nombre="+nombre+"&telefono="+telefono+"&dir1="+dir1+"&comp1="+comp1+"&ciudad1="+ciudad1+"&valor="+correo+"&valor2="+documento;
	var id;
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			id = data;
		}						
	});
	return id;
};

function permisosInventario() {
	var enviar = "funcion=permisosInventario";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function disponibles() {
    var enviar = "funcion=disponibles";
	var obtenidos = "no";
    //alert(enviar);
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function referenciaNueva(nombre,color,talla,link,detal,mayor,categoria) {
	var enviar = "funcion=referenciaNueva&nombre="+nombre+"&color="+color+"&talla="+talla+"&link="+link+"&detal="+detal+"&mayor="+mayor+"&categoria="+categoria;
	var id;
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			id = data;
		}						
	});
	return id;
};

function obtenerData(columna,tabla,tipo,valor,valor2) {
    if(!valor){valor=0;}if(!valor2){valor2=0;}
	var enviar = "funcion=obtenerData&columna="+columna+"&tabla="+tabla+"&tipo="+tipo+"&valor="+valor+"&valor2="+valor2;
	var obtenidos = "no";
	//alert(enviar);
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos;
};

function obtenerDatajson(columna,tabla,tipo,columnacondicion,condicion) {
    if(!columnacondicion){columnacondicion=0;}if(!condicion){condicion=0;}
	var enviar = "funcion=obtenerDatajson&columna="+columna+"&tabla="+tabla+"&tipo="+tipo+"&valor="+columnacondicion+"&valor2="+condicion;
	var obtenidos = "no";
	//alert(enviar);
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos;
};

function nuevocodigo(tipo,item) {
	var enviar = "funcion=nuevocodigo&valor="+item+"&tipo="+tipo;
	var obtenidos = "no";
	//alert(enviar);
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos;
};

function nuevaMarquilla(datos) {
	var enviar = "funcion=nuevaMarquilla&valor="+datos;
	var obtenidos = "no";
	//alert(enviar);
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos;
};

function escanerInicialInv(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        var prendasCant = ($('#escanerInvInicial p').length);
        if(prendasCant==0){
            var escanerInvInicial = $('#escanerInvInicial');
            var html = "<p class='letra18pt-pc negrillaUno remover'>"+decodedText+"</p>"
            escanerInvInicial.append(html);
        }else{
            var flag = 1;
            for(var i = 0;i<prendasCant;i++){
                var prenda = $("#escanerInvInicial p:eq("+i+")").text();
                if(prenda == decodedText){
                    i=200;
                    flag = 0;
                }
            }
            if(flag == 1){
                var escanerInvInicial = $('#escanerInvInicial');
                var html = "<p class='letra18pt-pc negrillaUno remover'>"+decodedText+"</p>"
                escanerInvInicial.append(html);
            }
        }
        
};
var datosPrendaActuales = [];
var prendasEviadasATerminados = [];
function escanearInventa(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
		console.log('decodedText');
		console.log(decodedText);
		let datosPrendaActualj = obtenerDatajson("terminado,codigo,codigoshow,estado","con_t_trprendas","valoresconcondicion","codigo",`'${decodedText}'`);
    	let datosPrendaActual = JSON.parse(datosPrendaActualj);
		console.log('datosPrendaActuales');
		console.log(datosPrendaActuales);
		const codigoshowNuevo = datosPrendaActual[0].codigoshow;

		const existeEnDatosPrendaActuales = datosPrendaActuales.some(item => item.codigoshow === codigoshowNuevo);
		
		
		if (!existeEnDatosPrendaActuales) {
		datosPrendaActuales.push(datosPrendaActual[0]);
		} else {return false;}
		console.log('datosPrendaActuales');
		console.log(datosPrendaActuales);
		var verificado = verificarinv(decodedText);
		if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
        var escaneados = $('#escanerInv');
		var insertarEscan = `<p class='letra18pt-pc  removerEscaneadosP' > ${datosPrendaActual[0].codigoshow} </p>`;
        escaneados.append(insertarEscan);
};
function escanearTerminados(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
		console.log('decodedText');
		console.log(decodedText);
		let datosPrendaActualj = obtenerDatajson("terminado,codigo,codigoshow,estado","con_t_trprendas","valoresconcondicion","codigo",`'${decodedText}'`);
    	let datosPrendaActual = JSON.parse(datosPrendaActualj);

		const codigoshowNuevo = datosPrendaActual[0].codigoshow;

		const existeEnDatosPrendaActuales = datosPrendaActuales.some(item => item.codigoshow === codigoshowNuevo);
		
		
		if (!existeEnDatosPrendaActuales) {
		datosPrendaActuales.push(datosPrendaActual[0]);
		} else {return false;}

		var verificado = verificarinv(decodedText);
		if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
        var escaneados = $('#escanerTermin');
		var insertarEscan = `<p class='letra18pt-pc  removerEscaneadosP' > ${datosPrendaActual[0].codigoshow} </p>`;
        escaneados.append(insertarEscan);
};
function readerPrendaEmpacada(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
		var verificado = verificarinv(decodedText);
		if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
        var prendasCantidad = ($('#funcionesEmpacar p').length-1)/2;
        var item = obtenerData("referencia_id","con_t_trprendas","row","codigo",decodedText);
        var flag = 0;
        for(var i = 1; i<=prendasCantidad;i++){
            var pa = (i*2)-1;
            var name = $("#funcionesEmpacar p:eq("+pa+")").attr("name");
            if(name == item){
                var pp = i*2;
                var nam = $("#funcionesEmpacar p:eq("+pp+")").attr("name");
                if(nam=="Sin empacar"){
                    $("#funcionesEmpacar p:eq("+pp+")").attr("name",decodedText);
                    $("#funcionesEmpacar p:eq("+pp+")").text("Empacado");
                    i=prendasCantidad+1;
                    flag=1;
                }else{
                    if(nam==decodedText){
                        alert("La prenda con código "+decodedText+" ya está asignada a este pedido");
                        i=prendasCantidad+1;
                        flag=1;
                    }
                }
            }
        }
        if(flag==0){
            alert("La prenda escaneada no coincide con ninguna prenda del pedido actual");
        }
};
function escanearEmpacar(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
		var estad = "";
		if(decodedText[0] == "C"){estad = obtenerData("estado","con_t_cambios","row","cambio_id",decodedText.slice(1));
		}else{estad = obtenerData("estado","con_t_ventas","row","venta_id",decodedText);}        
        if(estad == "Sin empacar" || estad == "No empacado"){
            var items = "";
            var html= "";
            if(decodedText[0] == "C"){
				var cambioitems = obtenerDatajson("pedido_item","con_t_cambios","valoresconcondicion","cambio_id",decodedText.slice(1));
				var jsoncambioitem = JSON.parse(cambioitems); 
				var jsonitems = JSON.parse(jsoncambioitem[0]['pedido_item']); 
            }else{
			   	var ventaitems = obtenerDatajson("pedido_item","con_t_ventas","valoresconcondicion","venta_id",decodedText);
				var jsonventaitem = JSON.parse(ventaitems); 
				var jsonitems = JSON.parse(jsonventaitem[0]['pedido_item']); 
            }
            for(var i = 1; i<jsonitems.length;i++){				
				var referencia = obtenerDatajson("nombre,color,talla","con_t_resumen","valoresconcondicion","referencia_id",jsonitems[i]['referencia']);
				var jsonreferencia= JSON.parse(referencia);
				html =html+ "<p class='col-lg-8 col-md-8 col-sm-8 col-xs-8 letra18pt-pc removerPrendasemp' name='"+jsonitems[i]['referencia']+"'>"+jsonreferencia[0]['nombre']+" "+jsonreferencia[0]['color']+" "+jsonreferencia[0]['talla']+"</p>"+
				"<p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc removerPrendasemp' name='Sin empacar' id='"+decodedText+"'>Sin empacar</p>";
            }
            $('#readerEmpacar__dashboard_section_csr button:eq(1)').click();
            $('#readerEmpacar__scan_region').css('display', 'none');
            $('#readerEmpacar__dashboard').css('display', 'none');
            $('#barraCelu').css('display', 'none');
            $('#escanerEmpaques').text("Orden de pedido: "+decodedText);
            $('#escanerEmpaques').attr("name",decodedText);
            $('#escanerEmpaques').after(html);
            var html5QrcodeScanner = new Html5QrcodeScanner(
        	"readerPrendaEmpacada", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(readerPrendaEmpacada);//function escanearEmpacar(decodedText, decodedResult) ***** principal.js, renderizamos la función escanearEmpacar
            $('#enviarEmpacados').css('display', 'block');
            $('#readerPrendaEmpacada').css('display', 'block');
            $('#funcionesEmpacar').css('display', 'block');
        }else{//***********************************ELSE**************************************************************** */
			var usuarioLevel = $('#usuarioCell').attr('name');
			alert("Venta o cambio: "+decodedText);
			if(decodedText[0] == "C"){
                actualizar("cambio_estado","Empacado",decodedText.slice(1),usuarioLevel,"-");//$tabla,$columna,$valor,$valor2		
				var itemsArray = items.split("%");
				alert(items);
				for(var i = 0; i<(itemsArray.length-1);i++){
					var item = itemsArray[i].split("°");
					if( (item[4]==1) || (item[4]=="Empacado") || (item[4]=="Despachado") ){
						actualizar("cambioitem_estado",item[5],'Empacado',0,"-");//					
					}
				}
				var codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual",decodedText);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
				var codigosArray = codigos.split("%");
				alert(codigos);
				for(var i = 0;i<(codigosArray.length-1);i++){
					var codigoPrendaArray = codigosArray[i].split("°");
					var item = itemsArray[i].split("°");
					alert("El : "+codigoPrendaArray[1]+" esta "+codigoPrendaArray[2] );
					if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
						var codigoPrenda = codigoPrendaArray[1];
						alert(usuarioLevel+"°"+item[5]+",Empacado,C"+decodedText+","+codigoPrenda);
						actualizarPrendas(usuarioLevel+"°"+item[5],"Empacado","C"+decodedText,codigoPrenda);
					}
				}
				alert("Empaque actualizado");
			}else{
               actualizar("venta_estado","Empacado",decodedText,usuarioLevel,"-");//$tabla,$columna,$valor,$valor2
               var items = obtenerData("prenda_id,valor,descuento_id,estado_id,ordenitem_id","con_t_ventaitem","rowVarios","venta_id",decodedText);
			   var itemsArray = items.split("%");
			   alert(items);
			   for(var i = 0; i<(itemsArray.length-1);i++){
				   var item = itemsArray[i].split("°");
				   if( (item[4]==1) || (item[4]=="Empacado") || (item[4]=="Despachado") ){
					   actualizarVentaitem("Empacado",item[5]);					
				   }
			   }
			   var codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual","V"+decodedText);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
			   var codigosArray = codigos.split("%");
			   alert(codigos);  
			   for(var i = 0;i<(codigosArray.length-1);i++){
				   var codigoPrendaArray = codigosArray[i].split("°");
				   var item = itemsArray[i].split("°");
				   alert("El : "+codigoPrendaArray[1]+" esta "+codigoPrendaArray[2] );
				   if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
					   var codigoPrenda = codigoPrendaArray[1];
					   alert(usuarioLevel+"°"+item[5]+",Empacado,V"+decodedText+","+codigoPrenda);
					   actualizarPrendas(usuarioLevel+"°"+item[5],"Empacado","V"+decodedText,codigoPrenda);
				   }
			   }
			   alert("Empaque actualizado");
			}        
		}
};

function enviarInventario(datos) {
   var data = datos.split(',');
   if(data.length > 2){
       var id =data[data.length -1];
       var nombre =data[data.length -2];
       var estado = data[data.length -3];
       if(estado == 1){estado=11;}
        var enviar = "funcion=cambiarEstadoprendas&valor="+datos+"&valor2="+estado+"&nombre="+nombre+"&id="+id;
    	var obtenidos = "no";
    	$.ajax({
    		url: urlhost,
    		headers: {'Access-Control-Allow-Origin': urlhost},
    		type: "GET",
    		async: false,
    		data: enviar,
    		success: function(data){
    			obtenidos = data;
    		}						
    	});
    	return obtenidos;
   }
};

function cambiarEstadoprenda(valor,valor2,nombre,id) {
	var enviar = "funcion=cambiarEstadoprenda&valor="+valor+"&valor2="+valor2+"&nombre="+nombre+"&id="+id;
	var obtenidos = "no";
	$.ajax({
	 	url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos	
 };

 function restarInventario(valor) {
	var enviar = "funcion=restarInventario&valor="+valor;
	var obtenidos = "no";
	$.ajax({
	 	url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			obtenidos = data;
		}						
	});
	return obtenidos	
 };

function readerDespachar(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        $('.removerPrendasdesp').remove();
		if(decodedText[0] == "C"){estadoVenta = obtenerData("estado","con_t_cambios","row","cambio_id",decodedText.slice(1));
		}else{estadoVenta = obtenerData("estado","con_t_ventas","row","venta_id",decodedText);} 
        if(estadoVenta == "Empacado" || estadoVenta == "Despachado"){
            var items = "";
            var html= "";
            if(decodedText[0] == "C"){
				var items = obtenerDatajson("pedido_item","con_t_cambios","valoresconcondicion","cambio_id",decodedText.slice(1));
				var jsonitem = JSON.parse(items); 
				var jsonitems = JSON.parse(jsonitem[0]['pedido_item']); 
			}else{
			   	var items = obtenerDatajson("pedido_item","con_t_ventas","valoresconcondicion","venta_id",decodedText);
				var jsonitem = JSON.parse(items); 
				var jsonitems = JSON.parse(jsonitem[0]['pedido_item']); 
            }
			for(var i = 1; i<jsonitems.length;i++){
				var referencia = obtenerDatajson("nombre,color,talla","con_t_resumen","valoresconcondicion","referencia_id",jsonitems[i]['referencia']);
				var jsonreferencia= JSON.parse(referencia);
				html =html+ "<p class='col-lg-8 col-md-8 col-sm-8 col-xs-8 letra18pt-pc removerPrendasdesp' name='"+decodedText+"'>"+jsonreferencia[0]['nombre']+" "+jsonreferencia[0]['color']+" "+jsonreferencia[0]['talla']+"</p>";
			}
            $('#escanerDespachos').text("Pedido: "+decodedText);
            $('#escanerDespachos').attr("name",decodedText);
            $('#escanerDespachos').after(html);
        }else{alert("El pedido no ha sido empacado o ya está en ruta.");}
};

function escanearDanados(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var verificado = verificarinv(decodedText);
	if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
	var escaneados = $('#escanerDan');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanerventaplaza(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var verificado = verificarinv(decodedText);
	if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
	var escaneados = $('#ventaPlazaenviar');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanearmarugon(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var verificado = verificarinv(decodedText);
	if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
	var escaneados = $('#escanerMadru');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanerventamayorista(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var verificado = verificarinv(decodedText);
	if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
	var escaneados = $('#ventaMayoristaenviar');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,itemVenta) {
    var enviar = "funcion=agregarventa&valor="+idCliente+"&valor2="+datosCliente+"&valor3="+pedido+"&valor4="+precio+"&valor5="+notas+"&valor6="+origen+"&valor7="+fecha+"&valor8="+idUsuario+"&valor9="+itemVenta;
	var obtenidos = "0";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
}; 
//venta_id fecha_creada cliente_id datos_cliente direccion pedido cliente_ok notas origen fecha_entrega estado vendedor_id usuario_id 
function agregarcambio(venta_id,datos_cliente,prendasSalen,pedidoitem,notas,excedente,fecha_entrega,idUsuario,idUsuario){
    if(!notas || notas == " "){notas="0";}
    if(!excedente || excedente == " "){excedente="0";}
    var enviar = "funcion=agregarcambio&valor="+venta_id+"&valor2="+datos_cliente+"&valor3="+prendasSalen+"&valor4="+pedidoitem+"&valor5="+notas+"&valor6="+excedente+"&valor7="+fecha_entrega+"&valor8="+idUsuario;
	var obtenidos = "0";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
}; 
//cambio_id	fecha_creada	venta_id	direccion	pedido	cliente_ok	notas excedente	fecha_entrega	estado	vendedor_id	usuarioactual_id
function ventaitem(idVenta,itemVenta) {
   var enviar = "funcion=ventaitem&valor="+idVenta+"&valor2="+itemVenta;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};//ordenitem_id prenda_id valor descuento_id venta_id estado_id comision comision_paga

function cambioitem(prenda_idsale,prenda_idregresa,cambio_id,ventainicial_id) {
   var enviar = "funcion=cambioitem&valor="+prenda_idsale+"&valor2="+prenda_idregresa+"&valor3="+cambio_id+"&valor4="+ventainicial_id;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};//cambioitem_id	prenda_id	valor	cambio_id	prendacliente_id	cliente_ok

function ordenesventa(bscar,estadoFiltro,transportador,datetimepicker_default,datetimepicker_defaultFiltro) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!transportador || transportador == " "){transportador="0";}
    if(!datetimepicker_default || datetimepicker_default == " "){datetimepicker_default="0";}
    if(!datetimepicker_defaultFiltro || datetimepicker_defaultFiltro == " "){datetimepicker_defaultFiltro="0";}
    var enviar = "funcion=ordenesventa&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+transportador+"&valor4="+datetimepicker_default+"&valor5="+datetimepicker_defaultFiltro;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function ordenesventajson(bscar,estadoFiltro,transportador,datetimepicker_default,datetimepicker_defaultFiltro,buscadortelefono) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!transportador || transportador == " "){transportador="0";}
    if(!datetimepicker_default || datetimepicker_default == " "){datetimepicker_default="0";}
    if(!datetimepicker_defaultFiltro || datetimepicker_defaultFiltro == " "){datetimepicker_defaultFiltro="0";}
    if(!buscadortelefono || buscadortelefono == " "){buscadortelefono="0";}
    var enviar = "funcion=ordenesventajson&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+transportador+"&valor4="+datetimepicker_default+"&valor5="+datetimepicker_defaultFiltro+"&valor6="+buscadortelefono;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function ordenescambio(bscar,estadoFiltro,transportador,datetimepicker_default,datetimepicker_defaultFiltro) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!transportador || transportador == " "){transportador="0";}
    if(!datetimepicker_default || datetimepicker_default == " "){datetimepicker_default="0";}
    if(!datetimepicker_defaultFiltro || datetimepicker_defaultFiltro == " "){datetimepicker_defaultFiltro="0";}
    var enviar = "funcion=ordenescambio&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+transportador+"&valor4="+datetimepicker_default+"&valor5="+datetimepicker_defaultFiltro;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function ordenescambiojson(bscar,estadoFiltro,transportador,tipo,datetimepicker_default,datetimepicker_entregacambios) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!transportador || transportador == " "){transportador="0";}
    if(!tipo || tipo == " "){tipo="0";}
    if(!datetimepicker_default || datetimepicker_default == " "){datetimepicker_default="0";}
    if(!datetimepicker_entregacambios || datetimepicker_entregacambios == " "){datetimepicker_entregacambios="0";}
    var enviar = "funcion=ordenescambiojson&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+transportador+"&valor4="+tipo+"&valor5="+datetimepicker_default+"&valor6="+datetimepicker_entregacambios;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function actualizar(tabla,columna,id,usuarioCell,valorextra) {
   var enviar = "funcion=actualizar&columna="+columna+"&tabla="+tabla+"&valor="+id+"&valor2="+usuarioCell+"&valor3="+valorextra;
   var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};
   
function sumarinventario(id) {
   var enviar = "funcion=sumarinventario&id="+id;
   var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};   

function codigosprendas(bscar,estadoFiltro,cual,notas) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!cual || cual == " "){cual="0";}
    if(!notas || notas == " "){notas="0";}
    var enviar = "funcion=codigosprendas&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+cual+"&valor4="+notas;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};


function codigosprendasjson(bscar,estadoFiltro,cual,descripcion) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!cual || cual == " "){cual="0";}
    if(!descripcion || descripcion == " "){descripcion="0";}
    var enviar = "funcion=codigosprendasjson&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+cual+"&valor4="+descripcion;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function resumenprendas(bscar,nombre,color,talla) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!nombre || nombre == " "){nombre="0";}
    if(!color || color == " "){color="0";}
    if(!talla || talla == " "){talla="0";}
    var enviar = "funcion=resumenprendas&valor="+bscar+"&valor2="+nombre+"&valor3="+color+"&valor4="+talla;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function empezarnuevaauditoria(fecha) {
    var enviar = "funcion=empezarnuevaauditoria&valor="+fecha;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function auditprendas(bscar,estadoFiltro,cual,notas) {
    if(!bscar || bscar == " "){bscar="0";}
    if(!estadoFiltro || estadoFiltro == " "){estadoFiltro="0";}
    if(!cual || cual == " "){cual="0";}
    if(!notas || notas == " "){notas="0";}
    var enviar = "funcion=auditprendas&valor="+bscar+"&valor2="+estadoFiltro+"&valor3="+cual+"&valor4="+notas;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function enviarEmpacados(data) {//10,Diego,1%29%°C1145RB2D13S64°C1145RB9D13S64%°106°98
    var dataArray = data.split("%");
    var enviar = "funcion=enviarEmpacados&valor="+dataArray[0]+"&valor2="+dataArray[1]+"&valor3="+dataArray[2]+"&valor4="+dataArray[3];
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function actualizarVentaitem(estado,id) {
    var enviar = "funcion=actualizarVentaitem&valor="+estado+"&valor2="+id;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function actualizarPrendas(usuarioCell,estado,ventaId,codigo) {
    var enviar = "funcion=actualizarPrendas&valor="+usuarioCell+"&valor2="+estado+"&valor3="+ventaId+"&valor4="+codigo;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function inicialcaja(valor) {
    var enviar = "funcion=inicialcaja&valor="+valor;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function referenciasrodas(valor) {
    var enviar = "funcion=referenciasrodas&valor="+valor;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function nuevocodigoinicial(codigo,referencia,usuario) {
    var enviar = "funcion=nuevocodigoinicial&valor="+codigo+"&valor2="+referencia+"&valor3="+usuario;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function nuevolote () {
	var enviar = "funcion=nuevolote";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	//alert(habilitados);
	return habilitados;
};

function cantidadesinventario () {
	var enviar = "funcion=cantidadesinventario";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function madru() {
	var enviar = "funcion=madrugones";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function imprimirResumen() {
	var enviar = "funcion=imprimirResumen";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function imprimirResumenCell() {
	var enviar = "funcion=imprimirResumenCell";
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function  liberarpaquete(codigo){
	var enviar = "funcion=liberarpaquete&valor="+codigo;
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function  prendasMadrugon(id){
	var enviar = "funcion=prendasMadrugon&valor="+id;
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	return habilitados;
};

function  revisarfechasatelite(arraItem){
	var items = "";
	for(var i = 0;i<arraItem.length;i++){
		items=items+"°"+arraItem[i];
	}
	var enviar = "funcion=revisarfechasatelite&valor="+items;
	var habilitados = 'no';
	$.ajax({
		url: urlhost,
		headers: {'Access-Control-Allow-Origin': urlhost},
		type: "GET",
		async: false,
		data: enviar,
		success: function(data){
			habilitados = data;
		}						
	});	
	if(habilitados.length>2){
		var verificados = JSON.parse(habilitados); 
		var end = new Date('2015-01-28'); 
		var fechas = [end];
		let text = '{ "referencia":"NA" , "fecha_check":"'+end+'" , "fecha":"2015-01-28" }';
		const objetoFinal = JSON.parse(text);
		for (let index = 0; index < verificados.length; index++){
			var fecha_terminadas = verificados[index].fecha;	
			var fs = new Date(fecha_terminadas[0].fecha_terminada);
			if(fs > fechas[0]){
				fechas[0] = fs;
				text = '{ "referencia":"'+verificados[index].descripcion+'" , "fecha_check":"'+fs+'", "fecha":"'+fecha_terminadas[0].fecha_terminada+'" }';
				objetoFinal[0] = JSON.parse(text);
			}
		}
		alert("El pedido puede ser despachado hasta el: "+objetoFinal[0].fecha+" debido a que la/el "+objetoFinal[0].referencia+" está en satélite");
		// $('#ventaNuevaTitulo').attr("name",objetoFinal[0].fecha);
	}else{
		$('#ventaNuevaTitulo').attr("name","2020-09-14");
	}
	$('#datetimepicker-entrega').css('display', 'block');
	$('#datetimepicker-entrega').datetimepicker({
		format: 'L',
        minDate: $('#ventaNuevaTitulo').attr("name")
	});
};

function enviarVentamayorista(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var verificado = verificarinv(decodedText);
	if(verificado!="ok"){alert("Este código quedó en el inventario inicial, por favor al botón de inventario inicial desde un computador y dirigirse a una bogeda para ingresarlo. ALERTA ESTO QUEDA A NOMBRE DE "+verificado+" PARA AUDITORIA DE INVENTARIO ");return false;}
	var prendasCant = ($('#escaneados p').length);
	var codigoReal;
	var codigoAuxiliar;
	if (decodedText.endsWith("914")) {
		codigoReal = decodedText;
		decodedText = decodedText.slice(0, -3); // Elimina los últimos tres caracteres
	}else{
		codigoReal = decodedText;
	}
	if(prendasCant==0){
		var escaneados = $('#escaneados');
		var html = "<p class='letra18pt-pc negrillaUno remover' name='"+codigoReal+"'>"+decodedText+"</p>"
		escaneados.append(html);
	}else{
		var flag = 1;
		for(var i = 0;i<prendasCant;i++){
			var prenda = $("#escaneados p:eq("+i+")").text();
			if(prenda == decodedText){
				flag = 0;
				break;
			}
		}
		if(flag == 1){
			var escaneados = $('#escaneados');
			var html = "<p class='letra18pt-pc negrillaUno remover' name='"+codigoReal+"'>"+decodedText+"</p>"
			escaneados.append(html);
		}
	}
	
};

function enviarparaventamayorista(valor) {
    var enviar = "funcion=enviarparaventamayorista&valor="+valor;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function enviarVentaplaza(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	var prendasCant = ($('#escaneados p').length);
	if(prendasCant==0){
		var escaneados = $('#escaneados');
		var html = "<p class='letra18pt-pc negrillaUno remover'>"+decodedText+"</p>"
		escaneados.append(html);
	}else{
		var flag = 1;
		for(var i = 0;i<prendasCant;i++){
			var prenda = $("#escaneados p:eq("+i+")").text();
			if(prenda == decodedText){
				flag = 0;
				break;
			}
		}
		if(flag == 1){
			var escaneados = $('#escaneados');
			var html = "<p class='letra18pt-pc negrillaUno remover'>"+decodedText+"</p>"
			escaneados.append(html);
		}
	}
	
};

function enviarparaventa(prendas) {
	var valor='';
	for (let i = 0; i < prendas.length; i++){valor = valor+'°'+prendas[i].innerText;}
    var enviar = "funcion=enviarparaventa&valor="+valor;
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};


function imprimirprendasparavender(valor) {
    var enviar = "funcion=imprimirprendasparavender";
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
	var pventamayorista = JSON.parse(obtenidos);  
    var html = "";
	for (let i = 0; i < pventamayorista.length; i++) {
		html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendasparaventa'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc' > "+pventamayorista[i].codigo+" </p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc'>"+pventamayorista[i].descripcion+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc'> "+pventamayorista[i].valor+" </p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 form-check'><input class='form-check-input' type='checkbox' value='"+pventamayorista[i].ID+"' id='check"+pventamayorista[i].ID+"'><label class='form-check-label' for='flexCheckDefault"+pventamayorista[i].ID+"'>Agregar</label></div></div>";
	}
	var primeraPrendas = $('#primeraPrendas');
	primeraPrendas.after(html);
};

function imprimirprendasparavenderdetal(valor) {
    var enviar = "funcion=imprimirprendasparavenderdetal";
    var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
	var pventamayorista = JSON.parse(obtenidos);  
    var html = "";
	for (let i = 0; i < pventamayorista.length; i++) {
		html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendasparaventa'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc' > "+pventamayorista[i].codigo+" </p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc'>"+pventamayorista[i].descripcion+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc'> "+pventamayorista[i].valor+" </p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 form-check'><input class='form-check-input' type='checkbox' value='"+pventamayorista[i].valor+"' id='"+pventamayorista[i].ID+"' name='"+pventamayorista[i].codigo+"/"+pventamayorista[i].descripcion+"'><label class='form-check-label' for='flexCheckDefault"+pventamayorista[i].ID+"'>Agregar</label></div></div>";
	}
	var primeraPrendas = $('#primeraPrendas');
	primeraPrendas.after(html);
	var primeraPrendas = $('#primeraPrendasapartados');
	primeraPrendas.after(html);
	return pventamayorista;
};

function nuevaventatiendas(cliente_id,clienteString,codigos_prendas,notas,origen,valor_total,metodospagoString,vendedor_id) {
	var envia = "funcion=nuevaventatiendas&valor="+cliente_id+"&valor2="+clienteString+"&valor3="+codigos_prendas+"&valor4="+notas+"&valor5="+origen+"&valor6="+valor_total+"&valor7="+metodospagoString+"&valor8="+vendedor_id;
	var envio = envia.replaceAll("<","");  
    var enviando = envio.replaceAll(">","");
	var env = enviando.replaceAll("{","<");  
	var enviar = env.replaceAll("}",">");    
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function borrarfilas(tabla,condicion,valor_condicion) {
	var enviar = "funcion=borrarfilas&tabla="+tabla+"&valor="+condicion+"&valor2="+valor_condicion;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function prepararjson(json){
	var stringJson1=JSON.stringify(json);
	var stringJson2 = stringJson1.replaceAll("<","");  
	var stringJson3 = stringJson2.replaceAll(">","");
	var stringJson4 = stringJson3.replaceAll("{","<"); 
	var stringJson5 = stringJson4.replaceAll("}",">");
	stringJson1 = stringJson5.replaceAll("#","No");
	return stringJson1;
};

function insertarfila(tabla,valor,valor2,valor3,valor4,valor5,valor6,valor7,valor8,valor9,valor10,valor11) {
	if(valor == "0" || !valor){
		alert("El valor uno de la función no puede quedar vacio");
		return false;
	}
	var enviar = "funcion=insertarfila&tabla="+tabla+"&valor="+valor+"&valor2="+valor2+"&valor3="+valor3+"&valor4="+valor4+"&valor5="+valor5+"&valor6="+valor6+"&valor7="+valor7+"&valor8="+valor8+"&valor9="+valor9+"&valor10="+valor10+"&valor11="+valor11;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function actualizarregistros(tabla,condicion,valor,valor2,valor3,valor4,valor5,valor6,valor7,valor8,valor9,valor10,valor11) {
	if(valor == "0" || !valor){
		alert("El valor uno de la función no puede quedar vacio");
		return false;
	}
	var enviar = "funcion=actualizarregistros&tabla="+tabla+"&condicion="+condicion+"&valor="+valor+"&valor2="+valor2+"&valor3="+valor3+"&valor4="+valor4+"&valor5="+valor5+"&valor6="+valor6+"&valor7="+valor7+"&valor8="+valor8+"&valor9="+valor9+"&valor10="+valor10+"&valor11="+valor11;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function calculardescuentos(datospedido,valor_total,jsoncon_t_reglasdescuentos){
	if(jsoncon_t_reglasdescuentos[0].tipo_regla==1){
		var prendas_condicion = jsoncon_t_reglasdescuentos[0].prendas_condicion;
		var porcentaje_descuento = jsoncon_t_reglasdescuentos[0].porcentaje_descuento;
		var prendas_descuento = jsoncon_t_reglasdescuentos[0].prendas_descuento;
		var prendas_pedido = Object.keys(datospedido).length;
		var indice = Math.floor(prendas_pedido/prendas_condicion)*prendas_descuento;         
		var objetoReferencias = [];
		var objetoNuevo = [];
		var menor = {};
		var contador = 0;
		for (let i = 0; i < prendas_pedido; i++) {
			var contador = prendas_pedido-i-1;
			for (let j = 0; j < contador; j++) {
				if(parseInt(datospedido[j].valor)>parseInt(datospedido[j+1].valor)){
					var valorj = datospedido[j];
					datospedido[j] = datospedido[j+1];
					datospedido[j+1] = valorj;
				}                            
			}                        
		}
		var valor_descuento = 0;
		for (let i = 0; i < indice; i++) {                        
			menor = datospedido[i];
			valor_descuento = valor_descuento + ((parseInt(menor.valor)*parseInt(porcentaje_descuento)/100));
			menor.valor =  parseInt(menor.valor) -  (parseInt(menor.valor)*parseInt(porcentaje_descuento)/100);
			objetoReferencias.push(menor);                
		}
		var html = "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeresumendescuento removeprendavender'><p class='letra3pt-mv letra18pt-pc'>Las siguientes unidades quedan con el precio: </p></div>"
		for (let i = 0; i < objetoReferencias.length; i++) {
			html=html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeresumendescuento removeprendavender'><p class='letra3pt-mv letra16pt-pc'>"+objetoReferencias[i].codigo+" "+objetoReferencias[i].descripcion+" "+objetoReferencias[i].valor+"</p></div>";
			for (let j = 0; j < prendas_pedido; j++) {
				if(datospedido[j].codigo == objetoReferencias[i].codigo){
					datospedido[j].valor == objetoReferencias[i].valor;
					break; 
				}   
			}
		}
		var valor_nuevo = valor_total - valor_descuento;
		var prendaString= JSON.stringify(datospedido);
		html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeresumendescuento removeprendavender' id='datospedidoDescuentos' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valorDescuentos' name='"+valor_nuevo+"'>Precio final: "+valor_nuevo+"</p></div>";
		var jsonData = {};
        jsonData.datosnuevos = datospedido;
        jsonData.datosdescuento = objetoReferencias;
        jsonData.valornuevo = valor_nuevo;
        jsonData.html = html;
		return jsonData;
	}
	if(jsoncon_t_reglasdescuentos[0].tipo_regla==2){
		var porcentaje_descuento = jsoncon_t_reglasdescuentos[0].porcentaje_descuento;
		var valor_nuevo =  parseInt(valor_total) - (parseInt(valor_total)*parseInt(porcentaje_descuento)/100);
		var prendas_pedido = Object.keys(datospedido).length;
		var html = "<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5  removeresumendescuento removeprendavender'><p class='letra3pt-mv letra18pt-pc'>Todas las prendas tienen un descuento del "+porcentaje_descuento+"% </p></div>"
		for (let i = 0; i < prendas_pedido; i++) {
			datospedido[i].valor = parseInt(datospedido[i].valor) -( parseInt(datospedido[i].valor)*parseInt(porcentaje_descuento)/100 );
		}
		var prendaString= JSON.stringify(datospedido);
		html=html+"<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5  removeresumendescuento removeprendavender' id='datospedidoDescuentos' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valorDescuentos' name='"+valor_nuevo+"'>Precio final: "+valor_nuevo+"</p></div>";
		var jsonData = {};
        jsonData.datosnuevos = datospedido;
        jsonData.datosdescuento = "todas las referencias";
        jsonData.valornuevo = valor_nuevo;
        jsonData.html = html;
		return jsonData;
	}
	if(jsoncon_t_reglasdescuentos[0].tipo_regla==3){
		var porcentaje_descuento = jsoncon_t_reglasdescuentos[0].porcentaje_descuento;
		var referencias = JSON.parse(jsoncon_t_reglasdescuentos[0].referencias);
		var objetoReferencias = [];
		var prendas_pedido = Object.keys(datospedido).length;
		var valor_descuento = 0;
		var html = "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeresumendescuento removeprendavender'><p class='letra3pt-mv letra18pt-pc'>Las siguientes unidades quedan con el precio: </p></div>"
		for (let i = 0; i < referencias.length; i++) {
			for (let j = 0; j < prendas_pedido; j++) {
				var referencia_id = obtenerDatajson("referencia_id","con_t_trprendas","valoresconcondicion","codigo","'"+datospedido[j].codigo+"'");
				referencia_id = JSON.parse(referencia_id); 
				var nombrereferencia = obtenerDatajson("nombre","con_t_resumen","valoresconcondicion","referencia_id",referencia_id[0].referencia_id);
				nombrereferencia = JSON.parse(nombrereferencia); 
				var menor = {};
				if(referencias[i] == nombrereferencia[0].nombre){
					menor = datospedido[j];
					var nuevo_valor = parseInt(menor.valor)-(parseInt(menor.valor)*parseInt(porcentaje_descuento)/100);
					valor_descuento = valor_descuento + (parseInt(menor.valor)*parseInt(porcentaje_descuento)/100);
					menor.valor =  nuevo_valor;
					datospedido[j].valor =  nuevo_valor;
					objetoReferencias.push(menor);     
					html=html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeresumendescuento removeprendavender'><p class='letra3pt-mv letra16pt-pc'>"+menor.codigo+" "+menor.descripcion+" "+menor.valor+"</p></div>";
				}
			}		
		}
		var prendaString= JSON.stringify(datospedido);
		var valor_nuevo = valor_total - valor_descuento;
		html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeresumendescuento removeprendavender' id='datospedidoDescuentos' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valorDescuentos' name='"+valor_nuevo+"'>Precio final: "+valor_nuevo+"</p></div>";
		var jsonData = {};
        jsonData.datosnuevos = datospedido;
        jsonData.datosdescuento =objetoReferencias;
        jsonData.valornuevo = valor_nuevo;
        jsonData.html = html;
		return jsonData;
	}

};

function cajadigita(id) {
	var enviar = "funcion=cajasemanal&valor="+id;
	var obtenidos = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		obtenidos = data;
    	}						
    });
    return obtenidos;
};

function apartados() {
	var con_t_reglasdescuentos = obtenerDatajson("*","con_t_reglasdescuentos","valoresconcondicion","regla_activa",1);
	var jsoncon_t_reglasdescuentos = JSON.parse(con_t_reglasdescuentos); 
	if(jsoncon_t_reglasdescuentos.length >0){
		var html = "<div id='descuentosr' class='removertodo'>";
		for (let i = 0; i < jsoncon_t_reglasdescuentos.length; i++) {
			html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removertodo'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p type='submit' class='letra18pt-pc'>"+jsoncon_t_reglasdescuentos[i].nombre_regla+"</p></div><div class='col-lg-7 col-md-7 col-sm-7 col-xs-7'><p type='submit' class='letra18pt-pc'>"+jsoncon_t_reglasdescuentos[i].descripcion+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-3'><p type='submit' class='letra18pt-pc'>"+jsoncon_t_reglasdescuentos[i].porcentaje_descuento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 form-check'><input class='form-check-input checkregla' type='checkbox' value='"+jsoncon_t_reglasdescuentos[i].ID+"'></div></div>"; 
		}
		html = html +'</div>';
		return html;
	}
    return "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removertodo'><p type='submit' class='letra18pt-pc'>No hay descuentos activos</p></div>";
};

function verificarinv(decodedText) {
	var prendainfo = obtenerDatajson("*","con_t_trprendas","valoresconcondicion","codigo ","'"+decodedText+"'");
	var jsonprendainfo= JSON.parse(prendainfo); 
	if(jsonprendainfo.length==0){		
		var  rectificar = obtenerDatajson("*","con_t_invinicial","valoresconcondicion","codigo ","'"+decodedText+"'");
		var jsonrectificar= JSON.parse(rectificar); 
		if(jsonrectificar.length==0){	
			var usuario =  obtenerDatajson("user_login ","con_users","valoresconcondicion","ID ",$("#usuario").attr("name"));
			var jsonusuario = JSON.parse(usuario); 
			var objeto = {};
			objeto.tipo = "string";
			objeto.columna = "codigo";
			objeto.valor = decodedText;
			var codigo = prepararjson(objeto);
			var objeto = {};
			objeto.tipo = "string";
			objeto.columna = "usuario";
			objeto.valor = jsonusuario[0].user_login;
			var usuario = prepararjson(objeto);
			var idventanueva = insertarfila("con_t_invinicial",codigo,usuario,"0","0","0","0","0","0","0","0","0");
			return jsonusuario[0].user_login;
		}
		return jsonrectificar[0].usuario;
		
	}
	return "ok";
};
