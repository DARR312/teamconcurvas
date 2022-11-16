<?php get_template_part('generalfooter'); ?>
    //<script>
    var html = "";
    var permisoVentas = permisosVentas();
    var items = permisoVentas.split(',');
    var pedidoUpdate = "";
    var usuarioUpdate = "";
    var notasUpdate = "";
    var verPedidos = 0;
    var botonrevisar ="";
    var segundo = $('#segundo');
    var confirmarvalor = "";
    for(var k = (items.length-1); k>0;k--){
        if(items[k]==5){
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal' type='button' id='agregarVenta'>+ Agregar venta </button></div>");
            botonrevisar = "botonrevisar";
        }
        if(items[k]==6){
            pedidoUpdate = "pedidoUpdate"; 
        }
        if(items[k]==7){
            notasUpdate = "notasUpdate";
        }
        if(items[k]==26){
            usuarioUpdate = "usuarioUpdate"; 
        }
        if(items[k]==27){
            confirmarvalor = "confirmarvalor"; 
        }
        if(items[k]==9){
           verPedidos = 1;
        }
    }
    $("#popup").attr("name",confirmarvalor);
    var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
    var jsonVenta = JSON.parse(ventasmayoristas); 
    console.log(jsonVenta);
    var html = imprimirVentasMayoristajson(jsonVenta);
    var primeraFila = $('#primeraFila');
    primeraFila.after(html);
    $('.editarcliente').on('click', function(){         
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());    
        var id = this.id;
        var arrayid = id.split("-");
        $("#actualizarCliente").attr("name",arrayid[1]);
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
        if(!$('#nombre').val()){alert("Ingresa el nombre del cliente :)");return false;}
        if(!$('#telefono').val()){alert("Ingresa el teléfono del cliente :)");return false;}
        if(!$('#dir1').val()){alert("Ingresa la dirección del cliente :)");return false;}
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
    $('#actualizarCliente').on('click', function(){ 
        //idCliente ciudadCliente complementoCliente dirVenta telVenta nombreVenta 
        $('#popup').fadeOut('slow');   
        $('.popup-overlay').fadeOut('slow');    
        var nombreVenta = $("#nombreVenta").val();
        var telVenta = $("#telVenta").val();
        var dirVenta = $("#dirVenta").val();
        var complementoCliente = $("#complementoCliente").val();
        var ciudadCliente = $("#ciudadCliente").val();
        var idCliente = $("#idCliente").val();
        var idVenta = this.name;
        if(!nombreVenta){alert("¿Quién es el cliente?");return false;}
        if(!telVenta){alert("¿Quién es el cliente?");return false;}
        if(!dirVenta){alert("¿Quién es el cliente?");return false;}
        if(!complementoCliente){alert("¿Quién es el cliente?");return false;}
        if(!ciudadCliente){alert("¿Quién es el cliente?");return false;}
        if(!idCliente){alert("¿Quién es el cliente?");return false;}
        if(!idVenta){alert("¿Quién es el cliente?");return false;}
        var objetoCliente = {};
        objetoCliente.nombreVenta = nombreVenta;
        objetoCliente.telVenta = telVenta;
        objetoCliente.dirVenta = dirVenta;
        objetoCliente.complementoCliente = complementoCliente;
        objetoCliente.ciudadCliente = ciudadCliente;
        objetoCliente.idVenta = idVenta;
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = idVenta;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "datos_cliente";
        objeto.valor = objetoCliente;
        var datos_cliente = prepararjson(objeto);
        actualizarregistros("con_t_mayorista",condicion,datos_cliente,"0","0","0","0","0","0","0","0","0","0"); 
        $(".removerventasmayorista").remove();
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        console.log(jsonVenta);
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        return false;     
    });  
    $('.ajustar_resumen').on('click', function(){  
        $('#popup4').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());  
        $(".removerprendas").remove();
        var id = this.id;
        var arraid = id.split("-");
        var VM_tr_mayoristas = obtenerDatajson("VM_tr_mayoristas","con_t_mayorista","valoresconcondicion","ID",arraid[1]);
        var jsonVM_tr_mayoristas = JSON.parse(VM_tr_mayoristas);
        console.log(jsonVM_tr_mayoristas[0].VM_tr_mayoristas);
        var vmnumero = jsonVM_tr_mayoristas[0].VM_tr_mayoristas;
        if(!jsonVM_tr_mayoristas[0].VM_tr_mayoristas){alert("No hay venta anterior");return false;}
        var prendasmayorista = obtenerDatajson("codigo,descripcion,referencia_id","con_t_trprendas","valoresconcondicion","cual","'VM-"+vmnumero+"'");
        var jsonprendasmayorista = JSON.parse(prendasmayorista);
        console.log(jsonprendasmayorista);
        var html = "";
        var precio_final = 0;
        for (let i = 0; i < (jsonprendasmayorista.length); i=i+4) {
            html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendas'>";
            if(i<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            if((i+1)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+1].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+1].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            if((i+2)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+2].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+2].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);    
            }
            if((i+3)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+3].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+3].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            html = html + "</div>";
        }
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = arraid[1];
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "resumen_mercancia";
        objeto.valor = jsonprendasmayorista;
        var resumen_mercancia = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_mercancia";
        objeto.valor = precio_final;
        var valor_mercancia = prepararjson(objeto);
        console.log(resumen_mercancia);
        console.log(valor_mercancia);
        actualizarregistros("con_t_mayorista",condicion,resumen_mercancia,valor_mercancia,"0","0","0","0","0","0","0","0","0"); 
       $("#primeraPrendas").after(html);
        return false;     
    });          
    $('.ver_resumen').on('click', function(){  
        $('#popup4').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());  
        $(".removerprendas").remove();
        var id = this.id;
        var arraid = id.split("-");
        var prendasmayorista = obtenerDatajson("resumen_mercancia","con_t_mayorista","valoresconcondicion","ID",arraid[1]);
        var jsonprendasmayoristas = JSON.parse(prendasmayorista);
        console.log("jsonprendasmayoristas");
        console.log(jsonprendasmayoristas);
        console.log(jsonprendasmayoristas[0]["resumen_mercancia"]);
        var jsonprendasmayorista = JSON.parse(jsonprendasmayoristas[0]["resumen_mercancia"]);
        var html = "";
        var precio_final = 0;
        for (let i = 0; i < (jsonprendasmayorista.length); i=i+4) {
            html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendas'>";
            if(i<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i].descripcion+"</p></div>";}
            if((i+1)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+1].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";}
            if((i+2)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+2].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";}
            if((i+3)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+3].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";}
            html = html + "</div>";
        }
       $("#primeraPrendas").after(html);
        return false;     
    });   
    $('#close4').on('click', function(){   
        $('#popup4').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow');   
        $(".removerprendas").remove();
        $(".removerventasmayorista").remove();
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        console.log(jsonVenta);
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        return false;     
    });     
    $('.confirmarvalor').on('click', function(){  
        $('#popup5').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());
        $("#valorpago").val(0);
        var id = this.id;
        var arrayid = id.split("-");
        $("#tituloconfirmarpago").text("Confirmar pago de la venta # "+arrayid[1]);
        $("#confirmarpago").attr("name",arrayid[1]);
        return false;  
    });
    $('#close5').on('click', function(){  
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow');   
        return false; 
    });  
    $('#confirmarpago').on('click', function(){  
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow');  
        var valor = $("#valorpago").val();
        var id = $("#confirmarpago").attr("name");
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = id;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_confirmado";
        objeto.valor = valor;
        var valor_confirmado = prepararjson(objeto);
        actualizarregistros("con_t_mayorista",condicion,valor_confirmado,"0","0","0","0","0","0","0","0","0","0"); 
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        console.log(jsonVenta);
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        return false; 
    }); 
    $('#agregarVenta').on('click', function(){ 
        $('#popup6').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());
        var lstid = obtenerDatajson("MAX(ID)","con_t_mayorista","variasfilasunicas","0","0");
        var jsstring = lstid.replace('MAX(ID)', 'id')
        var jsonlstid = JSON.parse(jsstring); 
        var nuevaid = parseInt(jsonlstid[0].id)+1;
        console.log(nuevaid);
        var prendasmayorista = obtenerDatajson("codigo,descripcion,referencia_id","con_t_trprendas","valoresconcondicion","cual","'VM-"+nuevaid+"'");
        var jsonprendasmayorista = JSON.parse(prendasmayorista);
        if(jsonprendasmayorista.length==0){alert("No hay prendas para la venta "+nuevaid+" por favor rectificar");return false;}
        console.log(jsonprendasmayorista);
        var html = "";
        var precio_final = 0;
        for (let i = 0; i < (jsonprendasmayorista.length); i=i+4) {
            html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendas'>";
            if(i<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            if((i+1)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+1].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+1].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            if((i+2)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+2].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+2].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);    
            }
            if((i+3)<jsonprendasmayorista.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayorista[i+3].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayorista[i+1].descripcion+"</p></div>";
                var valor_ref = obtenerDatajson("precio_mayorista","con_t_resumen","valoresconcondicion","referencia_id ",jsonprendasmayorista[i+3].referencia_id);
                var jsonvalor_ref = JSON.parse(valor_ref);
                precio_final = precio_final + parseInt(jsonvalor_ref[0].precio_mayorista);
            }
            html = html + "</div>";
        }
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "resumen_mercancia";
        objeto.valor = jsonprendasmayorista;
        var resumen_mercancia = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_mercancia";
        objeto.valor = precio_final;
        var valor_mercancia = prepararjson(objeto);
        console.log(resumen_mercancia);
        console.log(valor_mercancia);
        //actualizarregistros("con_t_mayorista",condicion,resumen_mercancia,valor_mercancia,"0","0","0","0","0","0","0","0","0"); 
        var idventanueva = insertarfila("con_t_mayorista",resumen_mercancia,valor_mercancia,"0","0","0","0","0","0","0","0","0");
        console.log(idventanueva);
       $("#primeraPrendasNuevas").after(html);
        return false;  
    });  
    $('#close6').on('click', function(){  
        $('#popup6').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow');   
        $(".removerprendas").remove();
        $(".removerventasmayorista").remove();
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        console.log(jsonVenta);
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
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
        var prendasCantidad = ($('#escaneados p').length);
        var pr = "";
        for(var i = 0;i<prendasCantidad;i++){
            var prenda = $("#escaneados p:eq("+i+")").text();
            pr = pr+prenda+"°";
        }//C1145RB4D13S64°C1145RB7D13S64°
        enviarparaventamayorista(pr);
        $('.remover').remove();
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