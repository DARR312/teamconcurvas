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
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    }
    ventas();

	$('#bscar').on('change',function(){
	    $('.removerVentas').remove();
	    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});
	
	$('#buscadortelefono').on('change',function(){
	    $('.removerVentas').remove();
	    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVentaCambio = JSON.parse(ordenesVenta); 
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasCambiosjson(jsonVentaCambio,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});

	$('#estadoFiltro').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});

	$('#transportador').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});	

	$('#tipoenvio').on('change',function(){
	    $('.removerVentas').remove();
        var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
        var jsonVenta = JSON.parse(ordenesVenta); 
        var primeraFila = $('#primeraFila');
        var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    	primeraFila.after(html);
    	ventas();
	});
	
	
    $('#agregarVenta').on('click', function(){         
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());   
        var htmll = apartados();
        $("#datosPrendas").after(htmll);  
        ventas();    
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
        var html = "<option class='removerdisponibles' value='NA'>NA</option>";
        var disponibl = disponibles();
        var items = disponibl.split(',');
        for(i=0;i<(items.length-1);i++){
            var item = items[i].split('!');
            html=html+"<option class='removerdisponibles' value='"+item[0]+"%"+item[1]+"%"+item[2]+"'>"+item[1]+"</option>";
        }
        var disp = $('.disponibles');
        disp.append(html);
        ventas();
        return false;     
    });  
    $('#prendasGuardadas').on('click', function(){         
        var html = ""; 
        var j = 1;
        var arraItems = [];
        var precio =0;
        var jsonPrendas = new Object();
        for (let i = 1; i < $("#formularioPedido")[0].children.length; i=i+2) {
            if($("#formularioPedido")[0].children[i].children[1].value == 'NA'){break;}
            var items = $("#formularioPedido")[0].children[i].children[1].value.split('%');
            html = html + "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV"+j+"'>"+$('#cantidad1').val()+"</p>"+
            "<p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe"+j+"'>"+items[1]+"</p>"+
            "<p class='reinicia' style='display: none;' id='idref"+j+"'>"+items[0]+"</p>"+
            "<p class='reinicia' style='display: none;' id='precio"+j+"'>"+items[2]+"</p>";
            arraItems.push[items[0]];
            precio = precio + (parseInt($('#cantidad1').val())*parseInt(items[2]));
            var jsonPrenda = new Object();
            jsonPrenda.codigo = items[1];
            jsonPrenda.descripcion = items[1];
            jsonPrenda.valor = items[2];
            jsonPrendas[j-1] = jsonPrenda;
            j++;
        }
        var prendaString= JSON.stringify(jsonPrendas);
        html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeprendavender' id='datospedido' name='"+prendaString+"'>"+
        "<p class='letra3pt-mv letra16pt-pc' id='valor_total' name='"+precio+"'>Precio total: "+precio+"</p></div>";
        revisarfechasatelite(arraItems);
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        var pedido = $('#pedido');
        pedido.append(html);
        $(".removerinputprendas").remove();
        return false;
    });
    $('#close4').on('click', function(){ 
        $(".removerinputprendas").remove();  
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
        var fecha = $('#datetimepicker-entrega').val();
        var idUsuario = $('#usuario').attr("name");
        if(!idCliente){
            alert("Por favor ingresa un cliente");
            return false;
        }
        var objeto = {};
        objeto.nombre = nombreVenta;
        objeto.telefono = telVenta;
        objeto.direccion = dirVenta;
        objeto.complemento = complementoCliente;
        objeto.ciudad = ciudadCliente;            
        var datosCliente=JSON.stringify(objeto);
        var datosCliente1 = datosCliente.replaceAll("<","");  
        var datosCliente2 = datosCliente1.replaceAll(">","");
        var datosCliente3 = datosCliente2.replaceAll("{","<");  
        datosCliente = datosCliente3.replaceAll("}",">");   
        if(!fecha){
            alert("Por favor ingresa una fecha");
            return false;
        }
        var numprendas = $("#pedido")[0].children.length/4;
        var pedido = "";
        var objetopedido = {};
        objetopedido.prendas = '';
        var precio =0;
        var itemVenta = "";
        for (let i = 1; i <= numprendas; i++) {
            var cantidad = $("#cantidadV"+i).text();
            var id = $("#idref"+i).text();
            var refe = $("#refe"+i).text();
            var precio1 = $("#precio"+i).text();
            pedido = pedido + cantidad+" "+refe + " ";
            objetopedido.prendas = objetopedido.prendas + cantidad+" "+refe+" ";
            precio = parseInt(precio) + (parseInt(cantidad) * parseInt(precio1));
            itemVenta = itemVenta + cantidad+"/"+id+",";
        }
        objetopedido.precio = precio;
        var pedido=JSON.stringify(objetopedido);
        var pedido1 = pedido.replaceAll("<","");  
        var pedido2 = pedido1.replaceAll(">","");
        var pedido3 = pedido2.replaceAll("{","<");  
        pedido = pedido3.replaceAll("}",">");       
        let cadenaCorregida = itemVenta.substring(0, itemVenta.length - 1);
        agregandotodo(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,cadenaCorregida,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);       
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
function agregandotodo(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,itemVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate) {       
    $('#popup').fadeOut('slow');         
    $('.popup-overlay').fadeOut('slow');      
    $('.reinicia').remove(); 
    var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario);    
    ventaitem(idVenta,itemVenta);
    $('.removerVentas').remove();
    var ordenesVenta = ordenesventajson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#datetimepicker-default').val(),$('#datetimepicker-defaultFiltro').val(),$('#bscartelefono').val());
    var jsonVenta = JSON.parse(ordenesVenta); 
    var primeraFila = $('#primeraFila');
    var html = imprimirVentasjson(jsonVenta,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
    primeraFila.after(html);
    ventas();
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