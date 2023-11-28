function mayoristafunciones() {
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
        var datos_clientea = prepararjson(objeto);
        var datos_cliente = datos_clientea.replace('#', 'No');
        actualizarregistros("con_t_mayorista",condicion,datos_cliente,"0","0","0","0","0","0","0","0","0","0"); 
        $(".removerventasmayorista").remove();
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
    mayoristafunciones();
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
        var vmnumero = jsonVM_tr_mayoristas[0].VM_tr_mayoristas;
        if(jsonVM_tr_mayoristas[0].VM_tr_mayoristas==0){vmnumero=arraid[1];}
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
        var prendasmayorista = obtenerDatajson("codigo,descripcion,referencia_id","con_t_trprendas","valoresconcondicion","cual","'VM-"+arraid[1]+"'");
        // var prendasmayorista = obtenerDatajson("resumen_mercancia","con_t_mayorista","valoresconcondicion","ID",arraid[1]);
        var jsonprendasmayoristas = JSON.parse(prendasmayorista);
        // console.log(jsonprendasmayoristas[0]["resumen_mercancia"]);
        // var jsonprendasmayorista = JSON.parse(jsonprendasmayoristas[0]["resumen_mercancia"]);
        var html = "";
        var precio_final = 0;
        for (let i = 0; i < (jsonprendasmayoristas.length); i=i+4) {
            html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerprendas'>";
            if(i<jsonprendasmayoristas.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayoristas[i].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayoristas[i].descripcion+"</p></div>";}
            if((i+1)<jsonprendasmayoristas.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayoristas[i+1].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayoristas[i+1].descripcion+"</p></div>";}
            if((i+2)<jsonprendasmayoristas.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayoristas[i+2].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayoristas[i+2].descripcion+"</p></div>";}
            if((i+3)<jsonprendasmayoristas.length){
                html = html + "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p type='submit' class='letra16pt-pc' > "+jsonprendasmayoristas[i+3].codigo+" </p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p type='submit' class='letra16pt-pc'>"+jsonprendasmayoristas[i+3].descripcion+"</p></div>";}
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
    mayoristafunciones();
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
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        console.log(jsonIds);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].descripcion+"'>"+jsonIds[i].descripcion+"</option>"
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v0'>"+
            "<div class='form-group pmd-textfield  pmd-textfield-floating-label'>"+
                "<label class='control-label letra18pt-pc' for='regular1'>Valor</label>"+
                "<input class='form-control' type='number' id='valor0' name='valor' required='>"+
                "<span class='pmd-textfield-focused'></span>"+
                "</div></div>"+
                "<div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo0'>"+
                "<div class='form-group pmd-textfield pmd-textfield-floating-label'>"+
                "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='0' form='formularioCliente' required=''>"+
                "<option value='S'>Seleccione un opción de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";
        for (let i = 1; i < jsonIds.length; i++) {
            html = html+"<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor"+i+"' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='"+i+"' form='formularioCliente' required=''><option value='S'>Seleccione un opción de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";            
        }
        $('#tituloconfirmarpago').after(html);
        $('.metodo').append(option);
        $('.metodo').on('change', function(){  
            var id = parseInt(this.id)+1;
            console.log(id);
            $("#v"+id+"").css('display', 'block');
            $("#metodo"+id+"").css('display', 'block');
        });    
        return false;  
    });
    $('#close5').on('click', function(){  
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow');   
        $(".metodop").remove();
        return false; 
    });  
    $('#confirmarpago').on('click', function(){  
        $('#popup5').fadeOut('slow');      
        $('.popup-overlay').fadeOut('slow'); 
        let precio = 0;
        var metodos = $(".metodo");
        var metodosarray = [];
        for (let i = 0; i < metodos.length; i++){
            var metodo = {};
            if(metodos[i].value != "S"){
                metodo.metodo =metodos[i].value;
                metodo.valor =$("#valor"+i).val();
                precio = precio + parseInt($("#valor"+i).val());
                metodosarray.push(metodo);
            }            
        }
        var id = $("#confirmarpago").attr("name");
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = id;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_confirmado";
        objeto.valor = precio;
        var valor_confirmado = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "metodos_pago";
        objeto.valor = metodosarray;
        var metodos_pago = prepararjson(objeto);
        actualizarregistros("con_t_mayorista",condicion,valor_confirmado,metodos_pago,"0","0","0","0","0","0","0","0","0"); 
        var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
        var jsonVenta = JSON.parse(ventasmayoristas); 
        console.log(jsonVenta);
        var html = imprimirVentasMayoristajson(jsonVenta);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
        $(".metodop").remove();
        mayoristafunciones();
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
        // objeto.valor = jsonprendasmayorista;
        objeto.valor = "Hay "+jsonprendasmayorista.length+" prendas en la venta";
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
    mayoristafunciones();
        return false; 
    });  
    return false;  
}

function imprimirVentasMayoristajson(jsonVenta){   
    console.log(jsonVenta);
    var cliente = "-";
    if(jsonVenta[jsonVenta.length-1].datos_cliente){
        var Jsoncliente = JSON.parse(jsonVenta[jsonVenta.length-1].datos_cliente);
        cliente = Jsoncliente.nombreVenta+" "+Jsoncliente.telVenta+" "+Jsoncliente.dirVenta+" "+Jsoncliente.complementoCliente+" "+Jsoncliente.ciudadCliente;
    }    
    var resumenpago = "-";
    if(jsonVenta[jsonVenta.length-1].metodos_pago != 0){
        var JsonPagos = JSON.parse(jsonVenta[jsonVenta.length-1].metodos_pago);
        for (let j = 0; j < JsonPagos.length; j++) {
          console.log(JsonPagos[j].metodo,JsonPagos[j].valor);
          resumenpago = JsonPagos[j].metodo+" "+JsonPagos[j].valor+" ";
        }            
    }
    var ver_resumen = "ajustar_resumen";
    var valor_confirmado =jsonVenta[jsonVenta.length-1].valor_confirmado;
    if(!valor_confirmado){valor_confirmado=0;}
    else{ver_resumen="ver_resumen";}
    valor_confirmado = formatoPrecio(valor_confirmado);
    var valor_mercancia = formatoPrecio(jsonVenta[jsonVenta.length-1].valor_mercancia);
    var confirmarvalor =  $("#popup").attr("name");
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerventasmayorista' id='primeraVenta'>"+
        "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>"+
            "<p class='letra18pt-pc negrillaUno'>"+jsonVenta[jsonVenta.length-1].ID+"</p></div>"+
        "<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>"+
            "<p class='letra18pt-pc negrillaUno editarcliente' id='VM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+cliente+"</p></div>"+
        "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
            "<p class='letra18pt-pc negrillaUno "+ver_resumen+"' id='RM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+valor_mercancia+"</p></div>"+
        "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
            "<p class='letra18pt-pc negrillaUno "+confirmarvalor+"'  id='PM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+valor_confirmado+"</p></div>"+
        "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
            "<p class='letra18pt-pc negrillaUno' >"+resumenpago+"</p></div></div>";
    for (let i = (jsonVenta.length-2); i >= 0; i--) {
        var cliente = "-";
        if(jsonVenta[i].datos_cliente){
            var Jsoncliente = JSON.parse(jsonVenta[i].datos_cliente);
            cliente = Jsoncliente.nombreVenta+" "+Jsoncliente.telVenta+" "+Jsoncliente.dirVenta+" "+Jsoncliente.complementoCliente+" "+Jsoncliente.ciudadCliente;
        }
        var resumenpago = "-";
        if(jsonVenta[i].metodos_pago != 0){
            var JsonPagos = JSON.parse(jsonVenta[i].metodos_pago);
            for (let j = 0; j < JsonPagos.length; j++) {
              console.log(JsonPagos[j].metodo,JsonPagos[j].valor);
              resumenpago = resumenpago + JsonPagos[j].metodo+" "+JsonPagos[j].valor+" ";
            }            
        }
        var ver_resumen = "ajustar_resumen";
        var valor_confirmado =jsonVenta[i].valor_confirmado;
        if(!valor_confirmado){valor_confirmado=0;}
        else{ver_resumen="ver_resumen";}
        if(valor_confirmado==0){ver_resumen="ajustar_resumen";}
        valor_confirmado = formatoPrecio(valor_confirmado);
        var valor_mercancia = formatoPrecio(jsonVenta[i].valor_mercancia);
        html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerventasmayorista'>"+
            "<div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>"+
                "<p class='letra18pt-pc negrillaUno'>"+jsonVenta[i].ID+"</p></div>"+
            "<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>"+
                "<p class='letra18pt-pc negrillaUno editarcliente' id='VM-"+jsonVenta[i].ID+"'>"+cliente+"</p></div>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno "+ver_resumen+"' id='RM-"+jsonVenta[i].ID+"'>"+valor_mercancia+"</p></div>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno "+confirmarvalor+"' id='PM-"+jsonVenta[i].ID+"'>"+valor_confirmado+"</p></div>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno' >"+resumenpago+"</p></div></div>";
    }
    return html;
};
