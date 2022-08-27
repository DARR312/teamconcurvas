function ventas() {   
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
        actualizar("con_t_clientes",columna,idsArray[0],usuarioCell);
        actualizar("venta_cliente",columna+"%",idsArray[1],usuarioCell);
        $('#popup5').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });
    $('.pedidoUpdate').on('click', function(){  
        var ids = $(this).attr("name");
        var estado = obtenerData("estado","con_t_ventas","row","venta_id",ids);
        if(estado == "Sin empacar" || estado == "Empacado" || estado == "No empacado"){
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
        for (var i = 0; i < 6; i++) {
           datosNuevos[i] = new Array(4);
        }
        if($('#prenda1Update').val() != "NA"){
            if($('#cantidad1Update').val() > 0){
                if($('#prenda2Update').val() != "NA"){
                    if($('#cantidad2Update').val() > 0){
                        if($('#prenda3Update').val() != "NA"){
                            if($('#cantidad3Update').val() > 0){
                                if($('#prenda4Update').val() != "NA"){
                                    if($('#cantidad4Update').val() > 0){
                                        if($('#prenda5Update').val() != "NA"){
                                            if($('#cantidad5Update').val() > 0){
                                                if($('#prenda6Update').val() != "NA"){
                                                    if($('#cantidad6Update').val() > 0){
                                                        var datos = $('#prenda1Update').val();
                                                        var items = datos.split('%');
                                                        var datos = $('#prenda2Update').val();
                                                        var items2 = datos.split('%');
                                                        var datos = $('#prenda3Update').val();
                                                        var items3 = datos.split('%');
                                                        var datos = $('#prenda4Update').val();
                                                        var items4 = datos.split('%');
                                                        var datos = $('#prenda5Update').val();
                                                        var items5 = datos.split('%');
                                                        var datos = $('#prenda6Update').val();
                                                        var items6 = datos.split('%');
                                                        datosNuevos[0][0] = items[0];
                                                        datosNuevos[0][1] = $('#cantidad1Update').val();
                                                        datosNuevos[0][2] = items[2];
                                                        datosNuevos[0][3] = items[1];
                                                        datosNuevos[1][0] = items2[0];
                                                        datosNuevos[1][1] = $('#cantidad2Update').val();
                                                        datosNuevos[1][2] = items2[2];
                                                        datosNuevos[1][3] = items2[1];
                                                        datosNuevos[2][0] = items3[0];
                                                        datosNuevos[2][1] = $('#cantidad3Update').val();
                                                        datosNuevos[2][2] = items3[2];
                                                        datosNuevos[2][3] = items3[1];
                                                        datosNuevos[3][0] = items4[0];
                                                        datosNuevos[3][1] = $('#cantidad4Update').val();
                                                        datosNuevos[3][2] = items4[2];
                                                        datosNuevos[3][3] = items4[1];
                                                        datosNuevos[4][0] = items5[0];
                                                        datosNuevos[4][1] = $('#cantidad5Update').val();
                                                        datosNuevos[4][2] = items5[2];
                                                        datosNuevos[4][3] = items5[1];
                                                        datosNuevos[5][0] = items6[0];
                                                        datosNuevos[5][1] = $('#cantidad6Update').val();
                                                        datosNuevos[5][2] = items6[2];
                                                        datosNuevos[5][3] = items6[1];
                                                        var datosInicialesArray = datosInicialesString.split('°');
                                                        var datosIniciales = new Array(6);
                                                        for (var i = 0; i < 6; i++) {
                                                           datosIniciales[i] = new Array(3);
                                                        }
                                                        for (var i = 1; i < datosInicialesArray.length; i++) {
                                                            var itemArray = datosInicialesArray[i].split('-');
                                                            datosIniciales[i-1][0] = itemArray[0];
                                                            datosIniciales[i-1][1] = itemArray[1];
                                                            datosIniciales[i-1][2] = itemArray[2];
                                                        }
                                                        var arrayResta = new Array(6);
                                                        var arraySuma = new Array(6);
                                                        for (var i = 0; i < 6; i++) {
                                                           arrayResta[i] = new Array(2);
                                                           arraySuma[i] = new Array(2);
                                                        }
                                                        var r = 0;
                                                        var s = 0;
                                                        for (var i = 0; i < 6; i++) {
                                                           if(datosIniciales[i][0]){
                                                           var flag = 0;
                                                           for (var j = 0; j < 6; j++) {
                                                               if(datosNuevos[j][0]){
                                                                    if(datosIniciales[i][0] == datosNuevos[j][0]){
                                                                        flag = 1;
                                                                        if(datosIniciales[i][1] > datosNuevos[j][1]){
                                                                            var d = datosIniciales[j][1] - datosNuevos[i][1];
                                                                            arrayResta[r][0] = datosIniciales[i][0];
                                                                            arrayResta[r][1] = d;
                                                                            r++;
                                                                            j=6;
                                                                        }
                                                                        j=6;
                                                                    }
                                                               }else{
                                                                    arrayResta[r][0] = datosIniciales[i][0];
                                                                    arrayResta[r][1] = datosIniciales[i][1];
                                                                    r++;
                                                                    j = 6;
                                                                    flag = 1;
                                                               }
                                                           }
                                                           if(flag==0){
                                                                arrayResta[r][0] = datosIniciales[i][0];
                                                                arrayResta[r][1] = datosIniciales[i][1];
                                                                r++;
                                                           }
                                                       }else{i = 6;}
                                                    }
                                                    var pedido = "";
                                                    var precio = 0;
                                                    for (var i = 0; i < 6; i++) {
                                                        var flag = 0;
                                                       if(datosNuevos[i][0]){
                                                           pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                                                           precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                                                           for (var j = 0; j < 6; j++) {
                                                               if(datosIniciales[j][0]){
                                                                    if(datosIniciales[j][0] == datosNuevos[i][0]){
                                                                        flag = 1;
                                                                        if(datosIniciales[j][1] < datosNuevos[i][1]){
                                                                            var d = datosNuevos[i][1] - datosIniciales[j][1];
                                                                            arraySuma[s][0] = datosNuevos[i][0];
                                                                            arraySuma[s][1] = d;
                                                                            s++;
                                                                            j=6;
                                                                        }
                                                                        j=6;
                                                                    }
                                                               }else{
                                                                    arraySuma[s][0] = datosNuevos[i][0];
                                                                    arraySuma[s][1] = datosNuevos[i][1];
                                                                    s++;
                                                                    flag = 1;
                                                                    j = 6;
                                                               }
                                                           }
                                                            if(flag==0){
                                                                arraySuma[s][0] = datosNuevos[i][0];
                                                                arraySuma[s][1] = datosNuevos[i][1];
                                                                s++;
                                                           }
                                                       }else{i = 6;}
                                                    }
                                                        pedido = pedido+"°"+precio;
                                                        var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                                                        var usuarioCell = $('#usuarioCell').attr("name");
                                                        actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                                                        $('.removeUpdate').remove();
                                                        $(".removecero").val(0);
                                                        $('#popup6').fadeOut('slow');       
                                                        $('.popup-overlay').fadeOut('slow'); 
                                                    }else{alert("Ingresa la cantidad para la referencia 6");}
                                                }else{
                                                    var datos = $('#prenda1Update').val();
                                                    var items = datos.split('%');
                                                    var datos = $('#prenda2Update').val();
                                                    var items2 = datos.split('%');
                                                    var datos = $('#prenda3Update').val();
                                                    var items3 = datos.split('%');
                                                    var datos = $('#prenda4Update').val();
                                                    var items4 = datos.split('%');
                                                    var datos = $('#prenda5Update').val();
                                                    var items5 = datos.split('%');
                                                    datosNuevos[0][0] = items[0];
                                                    datosNuevos[0][1] = $('#cantidad1Update').val();
                                                    datosNuevos[0][2] = items[2];
                                                    datosNuevos[0][3] = items[1];
                                                    datosNuevos[1][0] = items2[0];
                                                    datosNuevos[1][1] = $('#cantidad2Update').val();
                                                    datosNuevos[1][2] = items2[2];
                                                    datosNuevos[1][3] = items2[1];
                                                    datosNuevos[2][0] = items3[0];
                                                    datosNuevos[2][1] = $('#cantidad3Update').val();
                                                    datosNuevos[2][2] = items3[2];
                                                    datosNuevos[2][3] = items3[1];
                                                    datosNuevos[3][0] = items4[0];
                                                    datosNuevos[3][1] = $('#cantidad4Update').val();
                                                    datosNuevos[3][2] = items4[2];
                                                    datosNuevos[3][3] = items4[1];
                                                    datosNuevos[4][0] = items5[0];
                                                    datosNuevos[4][1] = $('#cantidad5Update').val();
                                                    datosNuevos[4][2] = items5[2];
                                                    datosNuevos[4][3] = items5[1];
                                                    var datosInicialesArray = datosInicialesString.split('°');
                                                    var datosIniciales = new Array(6);
                                                    for (var i = 0; i < 6; i++) {
                                                       datosIniciales[i] = new Array(3);
                                                    }
                                                    for (var i = 1; i < datosInicialesArray.length; i++) {
                                                        var itemArray = datosInicialesArray[i].split('-');
                                                        datosIniciales[i-1][0] = itemArray[0];
                                                        datosIniciales[i-1][1] = itemArray[1];
                                                        datosIniciales[i-1][2] = itemArray[2];
                                                    }
                                                    var arrayResta = new Array(6);
                                                    var arraySuma = new Array(6);
                                                    for (var i = 0; i < 6; i++) {
                                                       arrayResta[i] = new Array(2);
                                                       arraySuma[i] = new Array(2);
                                                    }
                                                    var r = 0;
                                                    var s = 0;
                                                    for (var i = 0; i < 6; i++) {
                                                       if(datosIniciales[i][0]){
                                                           var flag = 0;
                                                           for (var j = 0; j < 6; j++) {
                                                               if(datosNuevos[j][0]){
                                                                    if(datosIniciales[i][0] == datosNuevos[j][0]){
                                                                        flag = 1;
                                                                        if(datosIniciales[i][1] > datosNuevos[j][1]){
                                                                            var d = datosIniciales[j][1] - datosNuevos[i][1];
                                                                            arrayResta[r][0] = datosIniciales[i][0];
                                                                            arrayResta[r][1] = d;
                                                                            r++;
                                                                            j=6;
                                                                        }
                                                                        j=6;
                                                                    }
                                                               }else{
                                                                    arrayResta[r][0] = datosIniciales[i][0];
                                                                    arrayResta[r][1] = datosIniciales[i][1];
                                                                    r++;
                                                                    j = 6;
                                                                    flag = 1;
                                                               }
                                                           }
                                                           if(flag==0){
                                                                arrayResta[r][0] = datosIniciales[i][0];
                                                                arrayResta[r][1] = datosIniciales[i][1];
                                                                r++;
                                                           }
                                                       }else{i = 6;}
                                                    }
                                                    var pedido = "";
                                                    var precio = 0;
                                                    for (var i = 0; i < 6; i++) {
                                                        var flag = 0;
                                                       if(datosNuevos[i][0]){
                                                           pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                                                           precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                                                           for (var j = 0; j < 6; j++) {
                                                               if(datosIniciales[j][0]){
                                                                    if(datosIniciales[j][0] == datosNuevos[i][0]){
                                                                        flag = 1;
                                                                        if(datosIniciales[j][1] < datosNuevos[i][1]){
                                                                            var d = datosNuevos[i][1] - datosIniciales[j][1];
                                                                            arraySuma[s][0] = datosNuevos[i][0];
                                                                            arraySuma[s][1] = d;
                                                                            s++;
                                                                            j=6;
                                                                        }
                                                                        j=6;
                                                                    }
                                                               }else{
                                                                    arraySuma[s][0] = datosNuevos[i][0];
                                                                    arraySuma[s][1] = datosNuevos[i][1];
                                                                    s++;
                                                                    flag = 1;
                                                                    j = 6;
                                                               }
                                                           }
                                                            if(flag==0){
                                                                arraySuma[s][0] = datosNuevos[i][0];
                                                                arraySuma[s][1] = datosNuevos[i][1];
                                                                s++;
                                                           }
                                                       }else{i = 6;}
                                                    }
                                                    pedido = pedido+"°"+precio;
                                                    var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                                                    var usuarioCell = $('#usuarioCell').attr("name");
                                                    actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                                                    $('.removeUpdate').remove();
                                                    $(".removecero").val(0);
                                                    $('#popup6').fadeOut('slow');       
                                                    $('.popup-overlay').fadeOut('slow'); 
                                                }
                                            }else{alert("Ingresa la cantidad para la referencia 5");}
                                        }else{
                                            var datos = $('#prenda1Update').val();
                                            var items = datos.split('%');
                                            var datos = $('#prenda2Update').val();
                                            var items2 = datos.split('%');
                                            var datos = $('#prenda3Update').val();
                                            var items3 = datos.split('%');
                                            var datos = $('#prenda4Update').val();
                                            var items4 = datos.split('%');
                                            datosNuevos[0][0] = items[0];
                                            datosNuevos[0][1] = $('#cantidad1Update').val();
                                            datosNuevos[0][2] = items[2];
                                            datosNuevos[0][3] = items[1];
                                            datosNuevos[1][0] = items2[0];
                                            datosNuevos[1][1] = $('#cantidad2Update').val();
                                            datosNuevos[1][2] = items2[2];
                                            datosNuevos[1][3] = items2[1];
                                            datosNuevos[2][0] = items3[0];
                                            datosNuevos[2][1] = $('#cantidad3Update').val();
                                            datosNuevos[2][2] = items3[2];
                                            datosNuevos[2][3] = items3[1];
                                            datosNuevos[3][0] = items4[0];
                                            datosNuevos[3][1] = $('#cantidad4Update').val();
                                            datosNuevos[3][2] = items4[2];
                                            datosNuevos[3][3] = items4[1];
                                            var datosInicialesArray = datosInicialesString.split('°');
                                            var datosIniciales = new Array(6);
                                            for (var i = 0; i < 6; i++) {
                                               datosIniciales[i] = new Array(3);
                                            }
                                            for (var i = 1; i < datosInicialesArray.length; i++) {
                                                var itemArray = datosInicialesArray[i].split('-');
                                                datosIniciales[i-1][0] = itemArray[0];
                                                datosIniciales[i-1][1] = itemArray[1];
                                                datosIniciales[i-1][2] = itemArray[2];
                                            }
                                            var arrayResta = new Array(6);
                                            var arraySuma = new Array(6);
                                            for (var i = 0; i < 6; i++) {
                                               arrayResta[i] = new Array(2);
                                               arraySuma[i] = new Array(2);
                                            }
                                            var r = 0;
                                            var s = 0;
                                            for (var i = 0; i < 6; i++) {
                                                if(datosIniciales[i][0]){
                                                   var flag = 0;
                                                   for (var j = 0; j < 6; j++) {
                                                       if(datosNuevos[j][0]){
                                                            if(datosIniciales[i][0] == datosNuevos[j][0]){
                                                                flag = 1;
                                                                if(datosIniciales[i][1] > datosNuevos[j][1]){
                                                                    var d = datosIniciales[j][1] - datosNuevos[i][1];
                                                                    arrayResta[r][0] = datosIniciales[i][0];
                                                                    arrayResta[r][1] = d;
                                                                    r++;
                                                                    j=6;
                                                                }
                                                                j=6;
                                                            }
                                                       }else{
                                                            arrayResta[r][0] = datosIniciales[i][0];
                                                            arrayResta[r][1] = datosIniciales[i][1];
                                                            r++;
                                                            j = 6;
                                                            flag = 1;
                                                       }
                                                   }
                                                   if(flag==0){
                                                        arrayResta[r][0] = datosIniciales[i][0];
                                                        arrayResta[r][1] = datosIniciales[i][1];
                                                        r++;
                                                   }
                                               }else{i = 6;}
                                            }
                                            var pedido = "";
                                            var precio = 0;
                                            for (var i = 0; i < 6; i++) {
                                                var flag = 0;
                                               if(datosNuevos[i][0]){
                                                   pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                                                   precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                                                   for (var j = 0; j < 6; j++) {
                                                       if(datosIniciales[j][0]){
                                                            if(datosIniciales[j][0] == datosNuevos[i][0]){
                                                                flag = 1;
                                                                if(datosIniciales[j][1] < datosNuevos[i][1]){
                                                                    var d = datosNuevos[i][1] - datosIniciales[j][1];
                                                                    arraySuma[s][0] = datosNuevos[i][0];
                                                                    arraySuma[s][1] = d;
                                                                    s++;
                                                                    j=6;
                                                                }
                                                                j=6;
                                                            }
                                                       }else{
                                                            arraySuma[s][0] = datosNuevos[i][0];
                                                            arraySuma[s][1] = datosNuevos[i][1];
                                                            s++;
                                                            flag = 1;
                                                            j = 6;
                                                       }
                                                   }
                                                    if(flag==0){
                                                        arraySuma[s][0] = datosNuevos[i][0];
                                                        arraySuma[s][1] = datosNuevos[i][1];
                                                        s++;
                                                   }
                                               }else{i = 6;}
                                            }
                                            pedido = pedido+"°"+precio;
                                            var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                                            var usuarioCell = $('#usuarioCell').attr("name");
                                            actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                                            $('.removeUpdate').remove();
                                            $(".removecero").val(0);
                                            $('#popup6').fadeOut('slow');       
                                            $('.popup-overlay').fadeOut('slow'); 
                                        }
                                    }else{alert("Ingresa la cantidad para la referencia 4");}
                                }else{
                                    var datos = $('#prenda1Update').val();
                                    var items = datos.split('%');
                                    var datos = $('#prenda2Update').val();
                                    var items2 = datos.split('%');
                                    var datos = $('#prenda3Update').val();
                                    var items3 = datos.split('%');
                                    datosNuevos[0][0] = items[0];
                                    datosNuevos[0][1] = $('#cantidad1Update').val();
                                    datosNuevos[0][2] = items[2];
                                    datosNuevos[0][3] = items[1];
                                    datosNuevos[1][0] = items2[0];
                                    datosNuevos[1][1] = $('#cantidad2Update').val();
                                    datosNuevos[1][2] = items2[2];
                                    datosNuevos[1][3] = items2[1];
                                    datosNuevos[2][0] = items3[0];
                                    datosNuevos[2][1] = $('#cantidad3Update').val();
                                    datosNuevos[2][2] = items3[2];
                                    datosNuevos[2][3] = items3[1];
                                    var datosInicialesArray = datosInicialesString.split('°');
                                    var datosIniciales = new Array(6);
                                    for (var i = 0; i < 6; i++) {
                                       datosIniciales[i] = new Array(3);
                                    }
                                    for (var i = 1; i < datosInicialesArray.length; i++) {
                                        var itemArray = datosInicialesArray[i].split('-');
                                        datosIniciales[i-1][0] = itemArray[0];
                                        datosIniciales[i-1][1] = itemArray[1];
                                        datosIniciales[i-1][2] = itemArray[2];
                                    }
                                    var arrayResta = new Array(6);
                                    var arraySuma = new Array(6);
                                    for (var i = 0; i < 6; i++) {
                                       arrayResta[i] = new Array(2);
                                       arraySuma[i] = new Array(2);
                                    }
                                    var r = 0;
                                    var s = 0;
                                    for (var i = 0; i < 6; i++) {
                                       if(datosIniciales[i][0]){
                                   var flag = 0;
                                   for (var j = 0; j < 6; j++) {
                                        if(datosNuevos[j][0]){
                                            if(datosIniciales[i][0] == datosNuevos[j][0]){
                                                flag = 1;
                                                if(datosIniciales[i][1] > datosNuevos[j][1]){
                                                    var d = datosIniciales[j][1] - datosNuevos[i][1];
                                                    arrayResta[r][0] = datosIniciales[i][0];
                                                    arrayResta[r][1] = d;
                                                    r++;
                                                    j=6;
                                                }
                                                j=6;
                                            }
                                        }else{
                                            arrayResta[r][0] = datosIniciales[i][0];
                                            arrayResta[r][1] = datosIniciales[i][1];
                                            r++;
                                            j = 6;
                                            flag = 1;
                                        }
                                        }
                                       if(flag==0){
                                            arrayResta[r][0] = datosIniciales[i][0];
                                            arrayResta[r][1] = datosIniciales[i][1];
                                            r++;
                                       }
                                   }else{i = 6;}
                                }
                                var pedido = "";
                                var precio = 0;
                                for (var i = 0; i < 6; i++) {
                                    var flag = 0;
                                   if(datosNuevos[i][0]){
                                       pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                                       precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                                       for (var j = 0; j < 6; j++) {
                                           if(datosIniciales[j][0]){
                                                if(datosIniciales[j][0] == datosNuevos[i][0]){
                                                    flag = 1;
                                                    if(datosIniciales[j][1] < datosNuevos[i][1]){
                                                        var d = datosNuevos[i][1] - datosIniciales[j][1];
                                                        arraySuma[s][0] = datosNuevos[i][0];
                                                        arraySuma[s][1] = d;
                                                        s++;
                                                        j=6;
                                                    }
                                                    j=6;
                                                }
                                           }else{
                                                arraySuma[s][0] = datosNuevos[i][0];
                                                arraySuma[s][1] = datosNuevos[i][1];
                                                s++;
                                                flag = 1;
                                                j = 6;
                                           }
                                       }
                                        if(flag==0){
                                            arraySuma[s][0] = datosNuevos[i][0];
                                            arraySuma[s][1] = datosNuevos[i][1];
                                            s++;
                                       }
                                   }else{i = 6;}
                                }
                                    pedido = pedido+"°"+precio;
                                    var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                                    var usuarioCell = $('#usuarioCell').attr("name");
                                    actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                                    $('.removeUpdate').remove();
                                    $(".removecero").val(0);
                                    $('#popup6').fadeOut('slow');       
                                    $('.popup-overlay').fadeOut('slow');
                                }
                            }else{alert("Ingresa la cantidad para la referencia 3");}
                        }else{
                            var datos = $('#prenda1Update').val();
                            var items = datos.split('%');
                            var datos = $('#prenda2Update').val();
                            var items2 = datos.split('%');
                            datosNuevos[0][0] = items[0];
                            datosNuevos[0][1] = $('#cantidad1Update').val();
                            datosNuevos[0][2] = items[2];
                            datosNuevos[0][3] = items[1];
                            datosNuevos[1][0] = items2[0];
                            datosNuevos[1][1] = $('#cantidad2Update').val();
                            datosNuevos[1][2] = items2[2];
                            datosNuevos[1][3] = items2[1];
                            var datosInicialesArray = datosInicialesString.split('°');
                            var datosIniciales = new Array(6);
                            for (var i = 0; i < 6; i++) {
                               datosIniciales[i] = new Array(3);
                            }
                            for (var i = 1; i < datosInicialesArray.length; i++) {
                                var itemArray = datosInicialesArray[i].split('-');
                                datosIniciales[i-1][0] = itemArray[0];
                                datosIniciales[i-1][1] = itemArray[1];
                                datosIniciales[i-1][2] = itemArray[2];
                            }
                            var arrayResta = new Array(6);
                            var arraySuma = new Array(6);
                            for (var i = 0; i < 6; i++) {
                               arrayResta[i] = new Array(2);
                               arraySuma[i] = new Array(2);
                            }
                            var r = 0;
                            var s = 0;
                            for (var i = 0; i < 6; i++) {
                               if(datosIniciales[i][0]){
                                   var flag = 0;
                                   for (var j = 0; j < 6; j++) {
                                       if(datosNuevos[j][0]){
                                            if(datosIniciales[i][0] == datosNuevos[j][0]){
                                                flag = 1;
                                                if(datosIniciales[i][1] > datosNuevos[j][1]){
                                                    var d = datosIniciales[j][1] - datosNuevos[i][1];
                                                    arrayResta[r][0] = datosIniciales[i][0];
                                                    arrayResta[r][1] = d;
                                                    r++;
                                                    j=6;
                                                }
                                                j=6;
                                            }
                                       }else{
                                            arrayResta[r][0] = datosIniciales[i][0];
                                            arrayResta[r][1] = datosIniciales[i][1];
                                            r++;
                                            j = 6;
                                            flag = 1;
                                       }
                                   }
                                   if(flag==0){
                                        arrayResta[r][0] = datosIniciales[i][0];
                                        arrayResta[r][1] = datosIniciales[i][1];
                                        r++;
                                   }
                               }else{i = 6;}
                            }
                            var pedido = "";
                            var precio = 0;
                            for (var i = 0; i < 6; i++) {
                                var flag = 0;
                               if(datosNuevos[i][0]){
                                   pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                                   precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                                   for (var j = 0; j < 6; j++) {
                                       if(datosIniciales[j][0]){
                                            if(datosIniciales[j][0] == datosNuevos[i][0]){
                                                flag = 1;
                                                if(datosIniciales[j][1] < datosNuevos[i][1]){
                                                    var d = datosNuevos[i][1] - datosIniciales[j][1];
                                                    arraySuma[s][0] = datosNuevos[i][0];
                                                    arraySuma[s][1] = d;
                                                    s++;
                                                    j=6;
                                                }
                                                j=6;
                                            }
                                       }else{
                                            arraySuma[s][0] = datosNuevos[i][0];
                                            arraySuma[s][1] = datosNuevos[i][1];
                                            s++;
                                            j = 6;
                                            flag = 1;
                                       }
                                   }
                                    if(flag==0){
                                        arraySuma[s][0] = datosNuevos[i][0];
                                        arraySuma[s][1] = datosNuevos[i][1];
                                        s++;
                                   }
                               }else{i = 6;}
                            }
                            pedido = pedido+"°"+precio;
                            var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                            var usuarioCell = $('#usuarioCell').attr("name");
                            actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                            $('.removeUpdate').remove();
                            $(".removecero").val(0);
                            $('#popup6').fadeOut('slow');       
                            $('.popup-overlay').fadeOut('slow');
                        }
                    }else{alert("Ingresa la cantidad para la referencia 2");}
                }else{
                    var datos = $('#prenda1Update').val();
                    var items = datos.split('%');
                    datosNuevos[0][0] = items[0];
                    datosNuevos[0][1] = $('#cantidad1Update').val();
                    datosNuevos[0][2] = items[2];
                    datosNuevos[0][3] = items[1];
                    var datosInicialesArray = datosInicialesString.split('°');
                    var datosIniciales = new Array(6);
                    for (var i = 0; i < 6; i++) {
                       datosIniciales[i] = new Array(3);
                    }
                    for (var i = 1; i < datosInicialesArray.length; i++) {
                        var itemArray = datosInicialesArray[i].split('-');
                        datosIniciales[i-1][0] = itemArray[0];
                        datosIniciales[i-1][1] = itemArray[1];
                        datosIniciales[i-1][2] = itemArray[2];
                    }
                    var arrayResta = new Array(6);
                    var arraySuma = new Array(6);
                    for (var i = 0; i < 6; i++) {
                       arrayResta[i] = new Array(2);
                       arraySuma[i] = new Array(2);
                    }
                    var r = 0;
                    var s = 0;
                    for (var i = 0; i < 6; i++) {
                       if(datosIniciales[i][0]){
                           var flag = 0;
                           for (var j = 0; j < 6; j++) {
                               if(datosNuevos[j][0]){
                                    if(datosIniciales[i][0] == datosNuevos[j][0]){
                                        flag = 1;
                                        if(datosIniciales[i][1] > datosNuevos[j][1]){
                                            var d = datosIniciales[j][1] - datosNuevos[i][1];
                                            arrayResta[r][0] = datosIniciales[i][0];
                                            arrayResta[r][1] = d;
                                            r++;
                                            j=6;
                                        }
                                        j=6;
                                    }
                               }else{
                                    arrayResta[r][0] = datosIniciales[i][0];
                                    arrayResta[r][1] = datosIniciales[i][1];
                                    r++;
                                    j = 6;
                                    flag = 1;
                               }
                           }
                           if(flag==0){
                                arrayResta[r][0] = datosIniciales[i][0];
                                arrayResta[r][1] = datosIniciales[i][1];
                                r++;
                           }
                       }else{i = 6;}
                    }
                    var pedido = "";
                    var precio = 0;
                    for (var i = 0; i < 6; i++) {
                        var flag = 0;
                       if(datosNuevos[i][0]){
                           pedido = pedido+datosNuevos[i][1]+" "+datosNuevos[i][3]+" ";
                           precio = precio + (parseInt(datosNuevos[i][2])*parseInt(datosNuevos[i][1]));
                           alert("i: "+i+"precio: "+precio);
                           for (var j = 0; j < 6; j++) {
                               if(datosIniciales[j][0]){
                                    if(datosIniciales[j][0] == datosNuevos[i][0]){
                                        flag = 1;
                                        if(datosIniciales[j][1] < datosNuevos[i][1]){
                                            var d = datosNuevos[i][1] - datosIniciales[j][1];
                                            arraySuma[s][0] = datosNuevos[i][0];
                                            arraySuma[s][1] = d;
                                            s++;
                                            j=6;
                                        }
                                        j=6;
                                    }
                               }else{
                                    arraySuma[s][0] = datosNuevos[i][0];
                                    arraySuma[s][1] = datosNuevos[i][1];
                                    s++;
                                    flag = 1;
                                    j = 6;
                               }
                           }
                            if(flag==0){
                                arraySuma[s][0] = datosNuevos[i][0];
                                arraySuma[s][1] = datosNuevos[i][1];
                                s++;
                           }
                       }else{i = 6;}
                    } 
                    pedido = pedido+"°"+precio;
                    var itemVenta = arraySuma[0][1]+"/"+arraySuma[0][0];
                    var usuarioCell = $('#usuarioCell').attr("name");
                    actualizar("venta_pedido",pedido,ids,usuarioCell);
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
                    $('.removeUpdate').remove();
                    $(".removecero").val(0);
                    $('#popup6').fadeOut('slow');       
                    $('.popup-overlay').fadeOut('slow');
                }
            }else{alert("Ingresa la cantidad para la referencia 1");}
        }else{alert("Ingresa al menos una referencia para el pedido");}
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
    var notas = arrayOrden[8].substring(0, 30)+"...";
    var direcc = datosClienteUnicos[3].substring(0, 30)+"...";
    var compleDirecc = datosClienteUnicos[4].substring(0, 30)+"...";
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
        var notas = arrayOrden[8].substring(0, 30)+"...";
        var direcc = datosClienteUnicos[3].substring(0, 30)+"...";
        var compleDirecc = datosClienteUnicos[4].substring(0, 30)+"...";
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