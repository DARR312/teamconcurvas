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
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal botonesbarrasuperior' type='button' id='agregarVenta'>+ Agregar venta </button></div>");
            botonrevisar = "botonrevisar";
        }
        if(items[k]==6){
            pedidoUpdate = "pedidoUpdate"; 
        }
        if(items[k]==7){
            fechaUpdate = "fechaUpdate"; 
            notasUpdate = "notasUpdate";
            usuarioUpdate = "usuarioUpdate"; 
        }
        if(items[k]==26){
            // segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='cajadigital'><a href='https://concurvas.com/team/caja-digital'> <button class='botonmodal botonesbarrasuperior' type='button' id='subirGuias'>Cierre de caja</button></a></div>");
        }
        if(items[k]==9){
           verPedidos = 1;
        }
    }
    var usuarioCell = $('#usuarioCell').attr("name");
    var identifi = usuarioCell.split(",");
    var level = identifi[0];
    var idUsuarioNa = identifi[2];
    if(idUsuarioNa == 9){
        segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='cajadigital'><a href='https://concurvas.com/team/caja-digital'> <button class='botonmodal botonesbarrasuperior' type='button' id='subirGuias'>Cierre de caja</button></a></div>");
    }
    var empacar = obtenerData("level","con_t_rolespermisos","rowVarios","permiso_id",10);
    var levelCheck = empacar.split("%");
    for(var i = 0;i<(levelCheck.length-1);i++){
        var levelSi = levelCheck[i].split("°");
        if(level == levelSi[1]){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accionEmpaques'><button class='botonmodal botonesbarrasuperior' type='button' id='imprimirEmpaques'>Imprimir</button></div>");
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
        var l=0;
        var arraItems = [];
        var precio =0;
        var jsonPrendas = new Object();
        for (let i = 1; i < $("#formularioPedido")[0].children.length; i=i+2) {
            if($("#formularioPedido")[0].children[i].children[1].value == 'NA'){break;}
            var items = $("#formularioPedido")[0].children[i].children[1].value.split('%');
            html = html + "<p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 reinicia' id='cantidadV"+j+"'>"+$("#cantidad"+j+"").val()+"</p>"+
            "<p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reinicia' id='refe"+j+"'>"+items[1]+"</p>"+
            "<p class='reinicia' style='display: none;' id='idref"+j+"'>"+items[0]+"</p>"+
            "<p class='reinicia' style='display: none;' id='precio"+j+"'>"+items[2]+"</p>";
            arraItems.push(items[0]);
            precio = precio + (parseInt($("#cantidad"+j+"").val())*parseInt(items[2]));
            var jsonPrenda = new Object();
            jsonPrenda.codigo = items[0];
            jsonPrenda.descripcion = items[1];
            jsonPrenda.valor = items[2];
            for (let k = 0; k < $("#cantidad"+j+"").val(); k++) {
                jsonPrendas[l] = jsonPrenda;
                l++;
            }            
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
        var idCliente= $('#idCliente').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var nombreVenta= $('#nombreVenta').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var dirVenta= $('#dirVenta').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var telVenta= $('#telVenta').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var ciudadCliente= $('#ciudadCliente').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var complementoCliente= $('#complementoCliente').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var not= $('#notas').val().replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');
        var notas = not.replace('%', 'porciento').replace('#', 'No').replace(/[^\w\sáéíóúÁÉÍÓÚ]/gi, '').replace(/"/g, '');;
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
        var refrestar = "";
        if(!fecha){
            alert("Por favor ingresa una fecha");
            return false;
        }        
        if($("#valorDescuentos").attr("name")){
            var datospedidoDescuentos = $("#datospedidoDescuentos").attr("name");
            var datospedidoDescuentosJson = JSON.parse(datospedidoDescuentos);
            var pedido = "";
            var objetopedido = {};
            objetopedido.prendas = '';
            var precio =0;
            let arraypedidoitem = [objetopedidoitem];
            
            for (let i = 0; i < Object.keys(datospedidoDescuentosJson).length; i++) {
                var cantidad = 1;
                var id = datospedidoDescuentosJson[i].codigo;
                var refe = datospedidoDescuentosJson[i].descripcion;
                var precio1 = datospedidoDescuentosJson[i].valor;
                pedido = pedido + cantidad+" "+refe + " ";
                objetopedido.prendas = objetopedido.prendas + cantidad+" "+refe+" ";//voy aqui
                for (let j = 0; j < cantidad; j++) {
                    var objetopedidoitem = {};
                    objetopedidoitem.referencia = id;
                    objetopedidoitem.valor = precio1;   
                    arraypedidoitem.push(objetopedidoitem);        
                    refrestar = refrestar+id+",";     
                }            
            }     
            objetopedido.precio = $("#valorDescuentos").attr("name");
            var pedido=JSON.stringify(objetopedido);
            var pedido1 = pedido.replaceAll("<","");  
            var pedido2 = pedido1.replaceAll(">","");
            var pedido3 = pedido2.replaceAll("{","<");  
            pedido = pedido3.replaceAll("}",">");       
            var items=JSON.stringify(arraypedidoitem);
            var items1 = items.replaceAll("<","");  
            var items2 = items1.replaceAll(">","");
            var items3 = items2.replaceAll("{","<");  
            items = items3.replaceAll("}",">");   
            agregandotodo(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,items,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);       
            restarInventario(refrestar);
            return false;
        }
        var numprendas = $("#pedido")[0].children.length/4;
        var pedido = "";
        var objetopedido = {};
        objetopedido.prendas = '';
        var objetopedidoitem = {};
        objetopedidoitem.comision = 0;
        objetopedidoitem.cantidad = 0;
        let arraypedidoitem = [objetopedidoitem];
        var precio =0;
        for (let i = 1; i <= numprendas; i++) {
            var cantidad = $("#cantidadV"+i).text();
            var id = $("#idref"+i).text();
            var refe = $("#refe"+i).text();
            var precio1 = $("#precio"+i).text();
            pedido = pedido + cantidad+" "+refe + " ";
            objetopedido.prendas = objetopedido.prendas + cantidad+" "+refe+" ";
            precio = parseInt(precio) + (parseInt(cantidad) * parseInt(precio1));
            for (let j = 0; j < cantidad; j++) {
                var objetopedidoitem = {};
                objetopedidoitem.referencia = id;
                objetopedidoitem.valor = precio1;   
                arraypedidoitem.push(objetopedidoitem);  
                refrestar = refrestar+id+",";            
            }            
        }
        objetopedido.precio = precio;
        var pedido=JSON.stringify(objetopedido);
        var pedido1 = pedido.replaceAll("<","");  
        var pedido2 = pedido1.replaceAll(">","");
        var pedido3 = pedido2.replaceAll("{","<");  
        pedido = pedido3.replaceAll("}",">");       
        var items=JSON.stringify(arraypedidoitem);
        var items1 = items.replaceAll("<","");  
        var items2 = items1.replaceAll(">","");
        var items3 = items2.replaceAll("{","<");  
        items = items3.replaceAll("}",">");   
        agregandotodo(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,items,botonrevisar,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);       
        restarInventario(refrestar);
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
    var idVenta = agregarventa(idCliente,datosCliente,pedido,precio,notas,origen,fecha,idUsuario,idUsuario,itemVenta);    
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
<!-- <script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script> -->

 <!-- Cargar Moment.js -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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