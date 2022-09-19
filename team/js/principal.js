//const urlhost = "http://localhost/wordpress/index.php/controlador" ;//http://localhost/wordpress/index.php/controlador/
const urlhost = "https://concurvas.com/team/controlador/" ; 
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

function guardarCliente(nombre,telefono,dir1,comp1,ciudad1) {
	var enviar = "funcion=guardarCliente&nombre="+nombre+"&telefono="+telefono+"&dir1="+dir1+"&comp1="+comp1+"&ciudad1="+ciudad1;
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
        //console.log(`Scan result: ${decodedText}`, decodedResult);
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

function escanearInventa(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        //console.log(`Scan result: ${decodedText}`, decodedResult);
        var escaneados = $('#escanerInv');
        escaneados.append(decodedText+",");
};
function readerPrendaEmpacada(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        //console.log(`Scan result: ${decodedText}`, decodedResult);
        var prendasCantidad = ($('#funcionesEmpacar p').length-1)/2;
        var item = obtenerData("referencia_id","con_t_trprendas","row","codigo",decodedText);
        var referencia = obtenerData("nombre,color,talla","con_t_resumen","rowVarios","referencia_id",item);//°Londres°Rosa Bebé°SM%
        var flag = 0;
        for(var i = 1; i<=prendasCantidad;i++){
            var pa = (i*2)-1;
            var name = $("#funcionesEmpacar p:eq("+pa+")").attr("name");
            if(name == referencia){
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
        //console.log(`Scan result: ${decodedText}`, decodedResult);
		var estad = "";
		if(decodedText[0] == "C"){estad = obtenerData("estado","con_t_cambios","row","cambio_id",decodedText.slice(1));
		}else{estad = obtenerData("estado","con_t_ventas","row","venta_id",decodedText);}        
        if(estad == "Sin empacar" || estad == "No empacado"){
            var items = "";
            var html= "";
            if(decodedText[0] == "C"){
				items = obtenerData("prenda_idsale,prenda_idregresa,cliente_ok,estado,cambioitem_id","con_t_cambioitem","rowVarios","cambio_id",decodedText.slice(1));
				//°113°140000°0°5%°113°140000°0°1%°113°140000°0°1%
            }else{
               items = obtenerData("prenda_id,valor,descuento_id,estado_id,ordenitem_id","con_t_ventaitem","rowVarios","venta_id",decodedText);
               //°113°140000°0°5%°113°140000°0°1%°113°140000°0°1%
            }
            var itemsArray = items.split("%");
            for(var i = 0; i<(itemsArray.length-1);i++){
                var item = itemsArray[i].split("°");
                if(item[4]!=5){
                    var referencia = obtenerData("nombre,color,talla","con_t_resumen","rowVarios","referencia_id",item[1]);//°Londres°Rosa Bebé°SM%
                    var refseparado = referencia.replaceAll('°', ' ');
                    var refImprimir = refseparado.replace('%', '');
                    html =html+ "<p class='col-lg-8 col-md-8 col-sm-8 col-xs-8 letra18pt-pc removerPrendasemp' name='"+referencia+"'>"+refImprimir+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc removerPrendasemp' name='Sin empacar' id='"+item[5]+"'>Sin empacar</p>";
                }
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
			alert(decodedText);
			if(decodedText[0] == "C"){
                actualizar("cambio_estado","Empacado",decodedText.slice(1),usuarioLevel);//$tabla,$columna,$valor,$valor2
				var items = obtenerData("prenda_idsale,prenda_idregresa,cliente_ok,estado,cambioitem_id","con_t_cambioitem","rowVarios","cambio_id",decodedText.slice(1));
				//°113°140000°0°5%°113°140000°0°1%°113°140000°0°1%			
				var itemsArray = items.split("%");
				for(var i = 0; i<(itemsArray.length-1);i++){
					var item = itemsArray[i].split("°");
					if( (item[4]==1) || (item[4]=="Empacado") || (item[4]=="Despachado") ){
						actualizar("cambioitem_estado",item[5],'Empacado',0);//					
					}
				}
				codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual",decodedText);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
				for(var i = 0;i<(codigosArray.length-1);i++){
					var codigoPrendaArray = codigosArray[i].split("°");
					var item = itemsArray[i].split("°");
					alert(codigoPrendaArray[2] );
					if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
						var codigoPrenda = codigoPrendaArray[1];
						actualizarPrendas(usuarioLevel+"°"+codigoPrenda,"Empacado",ventaId,codigoPrenda);
						alert(usuarioLevel+"°"+item[4]+",Empacado,"+ventaId+","+codigoPrenda);
					}
				}
				alert("Empaque actualizado");
			}else{
               actualizar("venta_estado","Empacado",decodedText,usuarioLevel);//$tabla,$columna,$valor,$valor2
               var items = obtenerData("prenda_id,valor,descuento_id,estado_id,ordenitem_id","con_t_ventaitem","rowVarios","venta_id",decodedText);
			   var itemsArray = items.split("%");
			   for(var i = 0; i<(itemsArray.length-1);i++){
				   var item = itemsArray[i].split("°");
				   if( (item[4]==1) || (item[4]=="Empacado") || (item[4]=="Despachado") ){
					   actualizarVentaitem("Empacado",item[5]);					
				   }
			   }
			   codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual","V"+decodedText);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
			   for(var i = 0;i<(codigosArray.length-1);i++){
				   var codigoPrendaArray = codigosArray[i].split("°");
				   var item = itemsArray[i].split("°");
				   alert(codigoPrendaArray[2] );
				   if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
					   var codigoPrenda = codigoPrendaArray[1];
					   actualizarPrendas(usuarioLevel+"°"+item[4],"Empacado",ventaId,codigoPrenda);
					   alert(usuarioLevel+"°"+item[4]+",Empacado,"+ventaId+","+codigoPrenda);
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
        //console.log(`Scan result: ${decodedText}`, decodedResult);
        $('.removerPrendasdesp').remove();
		if(decodedText[0] == "C"){estadoVenta = obtenerData("estado","con_t_cambios","row","cambio_id",decodedText.slice(1));
		}else{estadoVenta = obtenerData("estado","con_t_ventas","row","venta_id",decodedText);} 
        if(estadoVenta == "Empacado" || estadoVenta == "Despachado"){
            var items = "";
            var html= "";
            if(decodedText[0] == "C"){
				items = obtenerData("prenda_idsale,prenda_idregresa,cliente_ok,estado,cambioitem_id","con_t_cambioitem","rowVarios","cambio_id",decodedText.slice(1));
				//°113°140000°0°5%°113°140000°0°1%°113°140000°0°1%
			}else{
               items = obtenerData("prenda_id,valor,descuento_id,estado_id,ordenitem_id","con_t_ventaitem","rowVarios","venta_id",decodedText);
               //°113°140000°0°5%°113°140000°0°1%°113°140000°0°1%
            }
            var itemsArray = items.split("%");
            for(var i = 0; i<(itemsArray.length-1);i++){
                var item = itemsArray[i].split("°");
                if(item[4]!=5){
                    var referencia = obtenerData("nombre,color,talla","con_t_resumen","rowVarios","referencia_id",item[1]);//°Londres°Rosa Bebé°SM%
                    var refseparado = referencia.replaceAll('°', ' ');
                    var refImprimir = refseparado.replace('%','');
                    html =html+ "<p class='col-lg-8 col-md-8 col-sm-8 col-xs-8 letra18pt-pc removerPrendasdesp' name='"+item[5]+"'>"+refImprimir+"</p>";
                }
            }
            $('#escanerDespachos').text("Pedido: "+decodedText);
            $('#escanerDespachos').attr("name",decodedText);
            $('#escanerDespachos').after(html);
        }else{alert("El pedido no ha sido empacado o ya está en ruta.");}
};

function escanearDanados(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	//console.log(`Scan result: ${decodedText}`, decodedResult);
	var escaneados = $('#escanerDan');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanerventaplaza(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	//console.log(`Scan result: ${decodedText}`, decodedResult);
	var escaneados = $('#ventaPlazaenviar');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanearmarugon(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	//console.log(`Scan result: ${decodedText}`, decodedResult);
	var escaneados = $('#escanerMadru');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function escanerventamayorista(decodedText, decodedResult) {
	// Handle on success condition with the decoded text or result.
	//console.log(`Scan result: ${decodedText}`, decodedResult);
	var escaneados = $('#ventaMayoristaenviar');
	escaneados.append("<p class='removerr'>"+decodedText+"</p>");
};

function agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario) {
    var datos = idCliente+"¬"+notas+"¬"+origen+"¬"+fecha+"¬"+idUsuario+"¬"+idUsuario+"¬"+datosCliente+"¬"+pedido+"¬"+precio;
    var enviar = "funcion=agregarventa&valor="+datos;
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
function agregarcambio(venta_id,datos_cliente,prendasSalen,prendasEntran,notas,excedente,fecha_entrega,idUsuario,idUsuario){
    if(!notas || notas == " "){notas="0";}
    if(!excedente || excedente == " "){excedente="0";}
    var datos = venta_id+"¬"+datos_cliente+"¬"+prendasSalen+"¬"+prendasEntran+"¬"+notas+"¬"+excedente+"¬"+fecha_entrega+"¬"+idUsuario+"¬"+idUsuario;
    var enviar = "funcion=agregarcambio&valor="+datos;
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

function actualizar(tabla,columna,id,usuarioCell) {
   var enviar = "funcion=actualizar&columna="+columna+"&tabla="+tabla+"&valor="+id+"&valor2="+usuarioCell;
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
   
function restar(id,valor,valor2) {
   var enviar = "funcion=restar&id="+id+"&valor="+valor+"&valor2="+valor2;
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
		$('#ventaNuevaTitulo').attr("name",objetoFinal[0].fecha);
	}else{
		$('#ventaNuevaTitulo').attr("name","2020-09-14");
	}
	$('#datetimepicker-entrega').css('display', 'block');
	$('#datetimepicker-entrega').datetimepicker({
		format: 'L',
        minDate: $('#ventaNuevaTitulo').attr("name")
	});
};