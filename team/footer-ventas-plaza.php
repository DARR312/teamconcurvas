<?php get_template_part('generalfooter'); ?>

    //<script>
    var jsonPrendasglobal = new Object();
    var jsonPrendasIngresan = new Object();
    var idNuevo =  new Object();
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
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal botonesbarrasuperior' type='button' id='agregarVenta'> Agregar venta </button></div>");
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal botonesbarrasuperior' type='button' id='agregarApartado'> Agregar apartado </button></div>");
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal botonesbarrasuperior' type='button' id='verApartados'> Ver apartados </button></div>");
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal botonesbarrasuperior' type='button' id='realizarCambio'> Cambios </button></div>");
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


    var resumen = obtenerDatajson('ID,fecha,valor_mercancia,metodos_pago','con_t_resumenplaza','variasfilasunicas','0','0');
    var jsonResumen = JSON.parse(resumen);
    // var html = 
    imprimirResumen2(jsonResumen);

    // $('#primeraFila').after(html);

    $('.verDia').on('click', function(){ 
        
        // $('.contenedor_loader').show();
        
        console.log("inicie"); 
        $('.ventasplazaResumen').remove(); 
        $('#primeraFila').css('display', 'none');
        $('.primeraFilaDia').css('display', 'block');
        var id = $(this).attr("name");
        var horaMenor = " 00:00:00";
        var horaMayor = " 23:59:00";
        var fecha = "'"+id+horaMenor+"' AND '"+id+horaMayor+"'";
        console.log('inicio');
        var resumenDia = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total,fecha_creada','con_t_ventasplaza','Between','fecha_creada',fecha);
        var jsonResumenDia = JSON.parse(resumenDia);
        console.log(jsonResumenDia);
        $('#primeraFila').after(imprimi(jsonResumenDia));
        // $('.contenedor_loader').css('display', 'none');
        console.log('fin');
        return false;     
    });    

    $('#BuscarEtiqueta').on('change',function(){
        $('.removerCambios').remove();
        // $('.ventasplaza').remove();
        $('.ventasplazaResumen').remove(); 
        $('#primeraFila').css('display', 'none');
        $('.primeraFilaDia').css('display', 'block');
        var Etiqueta = $('#BuscarEtiqueta').val();
        if(Etiqueta){
            var ventasFiltro = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total','con_t_ventasplaza','Like','codigos_prendas',Etiqueta);
            var jsonVentasFiltro = JSON.parse(ventasFiltro);
            if(jsonVentasFiltro.length !== 0){
                $('#primeraFila').after(imprimi(jsonVentasFiltro));
            }else{
                console.log('si entre');
                html = "<p style='margin: 335px 23% 200px 40%;'class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
                $('#primeraFila').after(html);
            }
        }
	}); 
    
    $('#BuscarTelefono').on('change',function(){
        $('.removerCambios').remove();
        // $('.ventasplaza').remove();
        $('.ventasplazaResumen').remove(); 
        $('#primeraFila').css('display', 'none');
        $('.primeraFilaDia').css('display', 'block');
	    var telefono = $('#BuscarTelefono').val();
        if(telefono){
            console.log($('#BuscarTelefono').val());
            var ventasFiltro = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total','con_t_ventasplaza','Like','datos_cliente',telefono);
            var jsonVentasFiltro = JSON.parse(ventasFiltro);
            if(jsonVentasFiltro.length !== 0){
                $('#primeraFila').after(imprimi(jsonVentasFiltro));
            }else{
                console.log('si entre');
                html = "<p style='margin: 335px 23% 200px 40%;' class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
                $('#primeraFila').after(html);
            }
        }
	});

    $('#buscarClienteCambio').on('click',function(){
        $('#ValorTotal').attr("name",0); 
        $("#ValorTotal").empty();
        $('#DatosClientesConatiner').empty();
        $('#PrendasConatiner').empty();
        $('#listaPrendasCargadas').empty();
        

        var telefono = $('#BuscarTelefono2').val();
        if(telefono){
            console.log($('#BuscarTelefono2').val());
            var ventasFiltro = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total','con_t_ventasplaza','Like','datos_cliente',telefono);
            var jsonVentasFiltro = JSON.parse(ventasFiltro);
            var ventasPaginaFiltro = obtenerDatajson('venta_id,datos_cliente,pedido,estado','con_t_ventas','Like','datos_cliente',telefono);
            var jsonventasPaginaFiltroFiltro = JSON.parse(ventasPaginaFiltro);

            console.log(jsonVentasFiltro,"VENTAS PLAZA");
            console.log(jsonventasPaginaFiltroFiltro, "VENTAS PAGINA");
        //     // console.log(jsonVentasFiltro);
            if(jsonventasPaginaFiltroFiltro.length !== 0){
                var datoInicial = "";
                var nombre = "";
                var tel = "";
                var dire = "";
                var prendas="";
                for (let i = 0; i < Object.keys(jsonventasPaginaFiltroFiltro).length; i++) {
                    // console.log(jsonVentasFiltro[i]);
                    console.log('1');
                    var datosclientejson = jsonventasPaginaFiltroFiltro[i].datos_cliente;
                    var jsonDatoscliente = JSON.parse(datosclientejson);
                    console.log(jsonDatoscliente);
                    datoInicial = datoInicial + ' V'+jsonventasPaginaFiltroFiltro[i].venta_id;
                    nombre = jsonDatoscliente.nombre;
                    tel= jsonDatoscliente.telefono;
                    dire = jsonDatoscliente.direccion;
                    var pedido = jsonventasPaginaFiltroFiltro[i].pedido;
                    var jsonpedido = JSON.parse(pedido);
                    console.log(jsonpedido);
                    var codigo = obtenerDatajson("codigo, descripcion, referencia_id","con_t_trprendas","valoresconcondicion","cual","'V"+jsonventasPaginaFiltroFiltro[i].venta_id+"'");
                    var jsoncodigo = JSON.parse(codigo);    
                    for (let j = 0; j < Object.keys(jsoncodigo).length; j++) {
                        console.log('HOLAAAA');
                        var valorPrenda = obtenerDatajson("precio_detal","con_t_resumen","valoresconcondicion","referencia_id","'"+jsoncodigo[j].referencia_id+"'");
                        var jsonValorPrenda = JSON.parse(valorPrenda);
                        console.log(jsonValorPrenda, 'consultaaa2');
                        prendas = prendas + '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prendasIngresa" style="margin-left: -27px; margin-top: 10px;">'+
                    						'<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">'+
                    							'<input class="form-check-input selectPrendas" type="checkbox" value="'+jsonValorPrenda[0].precio_detal+'" name="'+jsoncodigo[j].codigo+'/'+jsoncodigo[j].descripcion+'/V'+jsonventasPaginaFiltroFiltro[i].venta_id+'" id="flexCheckDefault">'+
                    						'</div>'+
										'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
											'<div class="letra18pt-pc letra2" for="flexCheckDefault">'+
												jsoncodigo[j].codigo+
											'</div>'+
										'</div>'+
										'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                                jsoncodigo[j].descripcion+
											'</div>'+
										'</div>'+
										'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                            ' V'+jsonventasPaginaFiltroFiltro[i].venta_id+ 
											'</div>'+
										'</div>'+
										'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                            formatoPrecio(jsonValorPrenda[0].precio_detal)+
											'</div>'+
										'</div>'+
									'</div>';
                    }
                }

                var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc letra">'+datoInicial+'</div>'+
                            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc letra">'+nombre+'</div>'+
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc letra">'+tel+'</div>'+ 
                            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc letra">'+dire+'</div></div>';
                $('#DatosClientesConatiner').append(html);
                $('#PrendasConatiner').append(prendas);
            }else{
                console.log('No hay datos');
                
            }
            if(jsonVentasFiltro.length !== 0){
                // for pra las ventas de plaza
                var datos= '';
                var prendasDiv='';
                idNuevo.codigo=jsonVentasFiltro[0].ID;
                for (let i = 0; i < Object.keys(jsonVentasFiltro).length; i++) {
                    // console.log(jsonVentasFiltro[i]);
                    var datoscliente = jsonVentasFiltro[i].datos_cliente;
                    var jsondatoscliente = JSON.parse(datoscliente);
                    datos = datos + ' PA-'+jsonVentasFiltro[i].ID;

                    var datosPrendas = jsonVentasFiltro[i].codigos_prendas;
                    var jsondatosPrendas = JSON.parse(datosPrendas);
                    console.log(jsondatosPrendas);
                    

                    var codigo = obtenerDatajson("codigo, descripcion, referencia_id","con_t_trprendas","valoresconcondicion","cual","'PA-"+jsonVentasFiltro[i].ID+"'");
                    var jsoncodigo = JSON.parse(codigo);

                    for (let j = 0; j < Object.keys(jsoncodigo).length; j++) {
                        var valorPrenda = obtenerDatajson("precio_detal","con_t_resumen","valoresconcondicion","referencia_id","'"+jsoncodigo[j].referencia_id+"'");
                        var jsonValorPrenda = JSON.parse(valorPrenda);

                        prendasDiv = prendasDiv + '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prendasIngresa" style="margin-left: -27px; margin-top: 10px;">'+
                                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">'+
                                                '<input class="form-check-input selectPrendas" type="checkbox" value="'+jsonValorPrenda[0].precio_detal+'" name="'+jsoncodigo[j].codigo+'/'+jsoncodigo[j].descripcion+'/PA-'+jsonVentasFiltro[i].ID+'" id="flexCheckDefault">'+
                                            '</div>'+
                                            '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
                                                '<div class="letra18pt-pc letra2" for="flexCheckDefault">'+
                                                jsoncodigo[j].codigo+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
                                                '<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                                jsoncodigo[j].descripcion+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
                                                '<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                                ' PA-'+jsonVentasFiltro[i].ID+ 
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
                                                '<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                                formatoPrecio(jsonValorPrenda[0].precio_detal)+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                    }
                }
                var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc letra codigoscuales">'+datos+'</div>'+
                            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc letra">'+jsondatoscliente.nombre+'</div>'+
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc letra">'+jsondatoscliente.telefono+'</div>'+ 
                            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc letra">No aplica</div></div>';
                $('#DatosClientesConatiner').append(html);
                $('#PrendasConatiner').append(prendasDiv);
            }else{
                console.log('No hay datos');
                
            }
        }
        carga();
	});

    // aq

    $('#agregarVenta').on('click', function(){    
        var htmll = apartados();
        $("#datosPrendas").after(htmll); 
        funcionespagina();
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].ID+"'>"+jsonIds[i].descripcion+"</option>"
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor0' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='0' form='formularioCliente' required=''><option value='S'>Seleccione un opci??n de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";
        for (let i = 1; i < jsonIds.length; i++) {
            html = html+"<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor"+i+"' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='"+i+"' form='formularioCliente' required=''><option value='S'>Seleccione un opci??n de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";            
        }
        $('#vendedordiv').after(html);
        $('.metodo').append(option);
        var vendedores = obtenerDatajson('ID,display_name ','con_users','variasfilasunicas','0','0');
        var jsonvendedores = JSON.parse(vendedores);
        var vendehtml = "";
        for (let i = 0; i < jsonvendedores.length; i++) {
            vendehtml = vendehtml+"<option value='"+jsonvendedores[i].ID+"'>"+jsonvendedores[i].display_name+"</option>";            
        }
        $('#vendedorselect').append(vendehtml);
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());    
        $('#agregarPedido').css('display','block'); 
        $('.metodo').on('change', function(){  
            var id = parseInt(this.id)+1;
            console.log(id);
            $("#v"+id+"").css('display', 'block');
            $("#metodo"+id+"").css('display', 'block');
        });    
        return false;     
    });      
    $('#close').on('click', function(){         
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.metodop').remove(); 
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


        $('#Guardar').on('click', function(){
            carga();
            
            var divsmetodos = $('.metodop');
            var metodospago =  new Object();
            var valorfinal = 0;
            var j=0;
            var text_val = $('#ValorTotal').attr("name");
            var cualesCodigos = $('.codigoscuales').text();
            console.log(cualesCodigos,'esto es lo que nos interesa ahora ');
            // if(parseInt(text_val)>0){
                for (let i = 0; i < divsmetodos.length; i=i+2) {
                    var metodopago =  new Object();
                    console.log(divsmetodos[i].children[0].children[1].valueAsNumber);
                    var valorp = divsmetodos[i].children[0].children[1].valueAsNumber;
                    if(valorp>0){
                        metodopago.valor = valorp;
                        valorfinal = valorfinal+valorp;
                        console.log(divsmetodos[i+1].children[0].children[1].value);
                        var metdodo = divsmetodos[i+1].children[0].children[1].value;
                        if(metdodo=="S"){alert("Por favor ingresa el m??todo de pago correcto");return false;}
                        metodopago.metodo = metdodo;
                        metodospago[j]=metodopago;
                        j++;
                    }
                }

                
                console.log(jsonPrendasglobal,"lo que sale");
                console.log(jsonPrendasIngresan,'lo que entra');
                

                var jsonPrendasVentsaId = new Object();
                for (let i = 0; i < Object.keys(jsonPrendasIngresan).length; i++) {
                    var jsonPrendas = new Object();
                    jsonPrendas.ventaId = jsonPrendasIngresan[i].ventaId;
                    jsonPrendas.codigo = jsonPrendasIngresan[i].codigo; 
                    jsonPrendasVentsaId[i] = jsonPrendas;
                }



                var metodospagoString= JSON.stringify(metodospago);
                console.log(metodospago);
                if(parseInt(text_val)<0){
                    var pagovsvalor = parseInt(text_val)+valorfinal;
                }else{
                    var pagovsvalor = valorfinal-parseInt(text_val);
                }
                console.log(pagovsvalor,'Este es el valor');
                if(pagovsvalor!=0){alert("El valor total del pedido no coincide con el valor de pago");return false;}
                
                var objeto = {};
                objeto.tipo = "json";
                objeto.columna = "venta_id";
                objeto.valor = jsonPrendasVentsaId;
                var venta_id = prepararjson(objeto);
                
                var objeto = {};
                objeto.tipo = "json";
                objeto.columna = "prenda_ingresa";
                objeto.valor = jsonPrendasIngresan;
                var prenda_ingresa = prepararjson(objeto);

                var objeto = {};
                objeto.tipo = "json";
                objeto.columna = "prenda_sale";
                objeto.valor = jsonPrendasglobal;
                var prenda_sale = prepararjson(objeto);

                const date = new Date();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
                let currentDate = `${year}/${month}/${day}`;//2022-08-08 13:58:58 	
                var objeto = {};
                objeto.tipo = "date";
                objeto.columna = "fecha";
                objeto.valor = currentDate;
                var fecha  = prepararjson(objeto);

                var objeto = {};
                objeto.tipo = "int";
                objeto.columna = "excedente";
                objeto.valor = parseInt(text_val);
                var excedenteEnviar  = prepararjson(objeto);
                
                var resultado = insertarfila("con_t_cambiosplaza",venta_id,prenda_ingresa,prenda_sale,fecha,excedenteEnviar,"0","0","0","0","0","0","0");
                var usuarioLevel = $('#usuarioCell').attr('name');




                
                
                console.log(usuarioLevel);
                console.log(Object.keys(jsonPrendasglobal).length);
                for (let i = 0; i < Object.keys(jsonPrendasglobal).length; i++) {      
                    console.log(jsonPrendasglobal[i]);      
                    // actualizarPrendas(usuarioLevel,"Venta local","PA-"+lastid[0].id,jsoncodigos[i].codigo);
                    actualizar("con_t_prendasplaza","-",jsonPrendasglobal[i].codigo,"-","-");
                    
                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "estado";
                    objeto.valor = "Venta local";
                    var estado = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "complemento_estado";
                    objeto.valor = "Cambio local";
                    var complemento_estado = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "cual";
                    objeto.valor = jsonPrendasVentsaId[0].ventaId;
                    var cual = prepararjson(objeto);

                    console.log(cual,'aquiiiiiiii');

                    const date = new Date();
                    let day = date.getDate();
                    let month = date.getMonth() + 1;
                    let year = date.getFullYear();
                    let currentDate = `${year}/${month}/${day}`;//2022-08-08 13:58:58 	
                    var objeto = {};
                    objeto.tipo = "date";
                    objeto.columna = "fecha_cambio";
                    objeto.valor = currentDate;
                    var fecha  = prepararjson(objeto);

                    var objeto = {};
                    objeto.columna = "codigo";
                    objeto.valor = "'"+jsonPrendasglobal[i].codigo+"'";
                    var condicion = prepararjson(objeto);

                    var re = actualizarregistros("con_t_trprendas",condicion,estado,complemento_estado,cual,fecha,"0","0","0","0","0","0","0");
                    
                }
                // console.log(resultado);
                // console.log('llegue'); 
                $('.remuve').remove(); 
                $('.prendasIngresa').remove(); 
                $('.prendasCargadas').attr('checked',false);   
                $('#ValorTotal').attr("name",0); 
                $("#ValorTotal").text(0);
                $('#ValorTotal').empty(); 
                $('#DatosClientesConatiner').empty(); 
                $('#ventana-modal').modal("hide");  
            // }else{
            //     console.log('se le debe al cliente');
            // }
            
            
        }); 

    $('#agregarPedido').on('click', function(){//cliente_id 	datos_cliente 	codigos_prendas 	notas 	origen 	valor_total metodos_pago 	vendedor_id 
        var cliente_id = $('#idCliente').val();
        var datos_cliente =  new Object();
        datos_cliente.nombre = $('#nombreVenta').val();
        datos_cliente.telefono  = $('#telVenta').val();
        datos_cliente.correo = $('#correov').val();
        datos_cliente.documento = $('#documentov').val();
        var clienteString= JSON.stringify(datos_cliente);
        var codigos_prendas = $('#datospedidoDescuentos').attr("name");  
        var valor_total = $('#valorDescuentos').attr("name");
        if(!valor_total){
            valor_total = $('#valor').attr("name");
            codigos_prendas = $('#datospedido').attr("name");  
        }
        console.log(valor_total);        
        var notas = $('#notas').val();
        var divsmetodos = $('.metodop');
        var metodospago =  new Object();
        var valorfinal = 0;
        var j=0;
        for (let i = 0; i < divsmetodos.length; i=i+2) {
            var metodopago =  new Object();
            console.log(divsmetodos[i].children[0].children[1].valueAsNumber);
            var valorp = divsmetodos[i].children[0].children[1].valueAsNumber;
            if(valorp>0){
                metodopago.valor = valorp;
                valorfinal = valorfinal+valorp;
                console.log(divsmetodos[i+1].children[0].children[1].value);
                var metdodo = divsmetodos[i+1].children[0].children[1].value;
                if(metdodo=="S"){alert("Por favor ingresa el m??todo de pago correcto");return false;}
                metodopago.metodo = metdodo;
                metodospago[j]=metodopago;
                j++;
            }
        }
        var metodospagoString= JSON.stringify(metodospago);
        var vendedor_id = $('#vendedorselect').val();
        if(!cliente_id){alert("??Qui??n es el cliente?");return false;}
        if(!codigos_prendas){alert("??Qu?? prendas quiere el "+datos_cliente.nombre+"?");return false;}  
        var pagovsvalor = valorfinal-parseInt(valor_total);
        if(pagovsvalor!=0){alert("El valor total del pedido no coincide con el valor de pago");return false;}  
        var last = nuevaventatiendas(cliente_id,clienteString,codigos_prendas,notas,"Plaza de las am??ricas",valor_total,metodospagoString,vendedor_id);
        var lastid = JSON.parse(last);
        console.log(lastid[0].id);
        var jsoncodigos = JSON.parse(codigos_prendas);
        var usuarioLevel = $('#usuarioCell').attr('name');
        console.log(jsoncodigos);
        console.log(usuarioLevel);
        console.log(Object.keys(jsoncodigos).length);
        for (let i = 0; i < Object.keys(jsoncodigos).length; i++) {      
            console.log(jsoncodigos[i]);      
            actualizarPrendas(usuarioLevel,"Venta local","PA-"+lastid[0].id,jsoncodigos[i].codigo);
            actualizar("con_t_prendasplaza","-",jsoncodigos[i].codigo,"-","-");
        }
        const date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let currentDateConsulta = `${year}-${month}-${day}`;//2022-08-08 13:58:58

        var metodosPago = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonMetodosPago = JSON.parse(metodosPago);
        console.log(jsonMetodosPago);
        var objMetodos = [];
        for (let i = 0; i < Object.keys(jsonMetodosPago).length; i++) {  
            objMetodos.push(jsonMetodosPago[i].ID+':'+jsonMetodosPago[i].descripcion+':0');  
            console.log(jsonMetodosPago[i].ID,jsonMetodosPago[i].descripcion,'aqui eees ');
        } 
        console.log(objMetodos, 'Objetooo');
        let efectivo = 0;
        let datafono = 0;
        let nequi = 0;
        let daviplata = 0;
        let PayU = 0;
        let Bancolombia = 0;
        let valorTotal = 0;
        var existe  = obtenerDatajson('ID,valor_mercancia,metodos_pago','con_t_resumenplaza','valoresconcondicion','fecha',"'"+currentDateConsulta+"'");
        var jsonExiste = JSON.parse(existe);
        console.log(typeof jsonExiste,jsonExiste.length, jsonExiste, "Informacion Importante");
        var jsonMetodosPago = JSON.parse(metodospagoString);
        console.log(jsonMetodosPago,Object.keys(jsonMetodosPago).length,"metodos selecionados");
        if(jsonExiste.length !== 0){

            console.log(jsonExiste[0].metodos_pago);
            var jsonMetodosPago2 = JSON.parse(jsonExiste[0].metodos_pago);
            console.log(jsonMetodosPago2,"aqui");

            console.log("se actualizo el dia 21 a la tabla");
            for (let i = 0; i < Object.keys(objMetodos).length; i++) {  
                for (let j = 0; j < Object.keys(jsonMetodosPago).length; j++) {
                    var datos = objMetodos[i].split(':');
                    
                    if(datos[0] === jsonMetodosPago[j].metodo){
                        var valor = parseInt(datos[2]);
                        var valorFinal = valor + jsonMetodosPago[j].valor 
                        objMetodos[i] = datos[0]+':'+datos[1]+':'+valorFinal;
                        console.log(objMetodos[i]);
                        valorTotal = valorTotal + valorFinal
                        console.log(valorTotal,'este es el valor dentro del for');
                    }  
                }
            }
            var objetoMetodo = {}; 
            for (let i = 0; i < Object.keys(objMetodos).length; i++) {  
                var datos = objMetodos[i].split(':');
                if(datos[0] == "1"){objetoMetodo.Efectivo = parseInt(datos[2]) + parseInt(jsonMetodosPago2.Efectivo);}
                if(datos[0] == "2"){objetoMetodo.Datafono = parseInt(datos[2]) + parseInt(jsonMetodosPago2.Datafono);}
                if(datos[0] == "3"){objetoMetodo.NequiDiego = parseInt(datos[2]) + parseInt(jsonMetodosPago2.NequiDiego);}
                if(datos[0] == "4"){objetoMetodo.DaviplataDiego = parseInt(datos[2]) + parseInt(jsonMetodosPago2.DaviplataDiego);}
                if(datos[0] == "5"){objetoMetodo.PayU = parseInt(datos[2]) + parseInt(jsonMetodosPago2.PayU);}
                if(datos[0] == "6"){objetoMetodo.BancolombiaD = parseInt(datos[2]) + parseInt(jsonMetodosPago2.BancolombiaD);} 	
                if(datos[0] == "7"){objetoMetodo.DaviplataNatalia = parseInt(datos[2]) + parseInt(jsonMetodosPago2.DaviplataNatalia);}
                if(datos[0] == "8"){objetoMetodo.DaviplataFrancisco = parseInt(datos[2]) + parseInt(jsonMetodosPago2.DaviplataFrancisco);}
                if(datos[0] == "9"){objetoMetodo.BancolombiaNatalia = parseInt(datos[2]) + parseInt(jsonMetodosPago2.BancolombiaNatalia);}
                if(datos[0] == "10"){objetoMetodo.BancolombiaFrancisco = parseInt(datos[2]) + parseInt(jsonMetodosPago2.BancolombiaFrancisco);}
                if(datos[0] == "11"){objetoMetodo.BancolombiaEsperanza = parseInt(datos[2]) + parseInt(jsonMetodosPago2.BancolombiaEsperanza);}
                if(datos[0] == "12"){objetoMetodo.NequiNatalia = parseInt(datos[2]) + parseInt(jsonMetodosPago2.NequiNatalia); }	
                if(datos[0] == "13"){objetoMetodo.NequiFrancisco = parseInt(datos[2]) + parseInt(jsonMetodosPago2.NequiFrancisco);}
                if(datos[0] == "14"){objetoMetodo.Davivienda = parseInt(datos[2]) + parseInt(jsonMetodosPago2.Davivienda);} 	
            }
            
            valorTotal = parseInt(objetoMetodo.Efectivo)+parseInt(objetoMetodo.Datafono)+parseInt(objetoMetodo.NequiDiego)+parseInt(objetoMetodo.DaviplataDiego)+parseInt(objetoMetodo.PayU)+parseInt(objetoMetodo.BancolombiaD)+parseInt(objetoMetodo.DaviplataNatalia)+parseInt(objetoMetodo.DaviplataFrancisco)+parseInt(objetoMetodo.BancolombiaNatalia)+parseInt(objetoMetodo.BancolombiaFrancisco)+parseInt(objetoMetodo.BancolombiaEsperanza)+parseInt(objetoMetodo.NequiNatalia)+parseInt(objetoMetodo.NequiFrancisco)+parseInt(objetoMetodo.Davivienda);
            console.log(valorTotal,'valor total antes de ingresar');
            // efectivo = jsonMetodosPago2.Efectivo;
            // datafono = jsonMetodosPago2.Datafono;
            // nequi = jsonMetodosPago2.Nequi;
            // daviplata = jsonMetodosPago2.Daviplata;
            // PayU = jsonMetodosPago2.PayU;
            // Bancolombia = jsonMetodosPago2.Bancolombia;
            // for (let i = 0; i < Object.keys(jsonMetodosPago).length; i)+parseInt()+) {    
            //     if(jsonMetodosPago[i].metodo == "1"){efectivo = efectivo + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "2"){datafono = datafono + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "3"){nequi = nequi + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "4"){daviplata = daviplata + jsonMetodosPago[i].valor }      
            //     if(jsonMetodosPago[i].metodo == "5"){PayU = PayU + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "6"){Bancolombia = Bancolombia + jsonMetodosPago[i].valor }  
            //     valorTotal = efectivo + datafono + nequi + daviplata + PayU + Bancolombia;
            // }
            // var objetoMetodo = {};
            // objetoMetodo.Efectivo = efectivo;
            // objetoMetodo.Datafono = datafono;
            // objetoMetodo.Nequi = nequi;
            // objetoMetodo.Daviplata = daviplata;
            // objetoMetodo.PayU = PayU;
            // objetoMetodo.Bancolombia = Bancolombia; 
            var objeto = {};
            objeto.tipo = "json";
            objeto.columna = "metodos_pago";
            objeto.valor = objetoMetodo;
            var metodos_pago_insert = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "valor_mercancia";
            objeto.valor = valorTotal;
            var valorTotal_insert = prepararjson(objeto);
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = jsonExiste[0].ID;
            var condicion = prepararjson(objeto);
            console.log(valorTotal_insert,'valor total a ingresar');
            actualizarregistros("con_t_resumenplaza",condicion,valorTotal_insert,metodos_pago_insert,"0","0","0","0","0","0","0","0","0");
            console.log(objMetodos);   
        }else{

            console.log("se Aagrego el dia 21 a la tabla");
            for (let i = 0; i < Object.keys(objMetodos).length; i++) {  
                for (let j = 0; j < Object.keys(jsonMetodosPago).length; j++) {
                    var datos = objMetodos[i].split(':');
                    
                    if(datos[0] === jsonMetodosPago[j].metodo){
                        var valor = parseInt(datos[2]);
                        var valorFinal = valor + jsonMetodosPago[j].valor
                        objMetodos[i] = datos[0]+':'+datos[1]+':'+valorFinal;
                        console.log(objMetodos[i]);
                        valorTotal = valorTotal + valorFinal
                    }  
                }
            }
            // for (let i = 0; i < Object.keys(jsonMetodosPago).length; i++) {    
            //     if(jsonMetodosPago[i].metodo == "1"){efectivo = efectivo + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "2"){datafono = datafono + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "3"){nequi = nequi + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "4"){daviplata = daviplata + jsonMetodosPago[i].valor }      
            //     if(jsonMetodosPago[i].metodo == "5"){PayU = PayU + jsonMetodosPago[i].valor }
            //     if(jsonMetodosPago[i].metodo == "6"){Bancolombia = Bancolombia + jsonMetodosPago[i].valor }  
            //        valorTotal = efectivo + datafono + nequi + daviplata + PayU + Bancolombia;
            // }
            var objetoMetodo = {}; 
            for (let i = 0; i < Object.keys(objMetodos).length; i++) {  
                var datos = objMetodos[i].split(':');
                if(datos[0] == "1"){objetoMetodo.Efectivo = datos[2];}
                if(datos[0] == "2"){objetoMetodo.Datafono = datos[2];}
                if(datos[0] == "3"){objetoMetodo.NequiDiego = datos[2];}
                if(datos[0] == "4"){objetoMetodo.DaviplataDiego = datos[2];}
                if(datos[0] == "5"){objetoMetodo.PayU = datos[2];}
                if(datos[0] == "6"){objetoMetodo.BancolombiaD = datos[2];} 	
                if(datos[0] == "7"){objetoMetodo.DaviplataNatalia = datos[2];}
                if(datos[0] == "8"){objetoMetodo.DaviplataFrancisco = datos[2];}
                if(datos[0] == "9"){objetoMetodo.BancolombiaNatalia = datos[2];}
                if(datos[0] == "10"){objetoMetodo.BancolombiaFrancisco = datos[2];}
                if(datos[0] == "11"){objetoMetodo.BancolombiaEsperanza = datos[2];}
                if(datos[0] == "12"){objetoMetodo.NequiNatalia = datos[2]; }	
                if(datos[0] == "13"){objetoMetodo.NequiFrancisco = datos[2];}
                if(datos[0] == "14"){objetoMetodo.Davivienda = datos[2];} 	
            }
            
            let currentDate = `${year}/${month}/${day}`;//2022-08-08 13:58:58
            var objeto = {};
            objeto.tipo = "date";
            objeto.columna = "fecha";
            objeto.valor = currentDate;
            var fecha_inser  = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "json";
            objeto.columna = "metodos_pago";
            objeto.valor = objetoMetodo;
            var metodos_pago_insert = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "valor_mercancia";
            objeto.valor = valorTotal;
            var valorTotal_insert = prepararjson(objeto);
            var idregla = insertarfila("con_t_resumenplaza",fecha_inser,metodos_pago_insert,valorTotal_insert,"0","0","0","0","0","0","0","0");
            console.log(objMetodos);
        }
        $('#bodyTabla').empty();
        $('#titulosTabla').empty();
        $('.ventasplazaResumen').remove(); 
        var resumen = obtenerDatajson('ID,fecha,valor_mercancia,metodos_pago','con_t_resumenplaza','variasfilasunicas','0','0');
        var jsonResumen = JSON.parse(resumen);
        // var html = 
        imprimirResumen2(jsonResumen);
        // $('#primeraFila').after(html);
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.metodop').remove(); 
        $('.verDia').on('click', function(){ 
            $('.tablaResumen').empty(); 
            $('#primeraFila').css('display', 'none');
            $('.primeraFilaDia').css('display', 'block');
            var id = $(this).attr("name");
            var horaMenor = " 00:00:00";
            var horaMayor = " 23:00:00";
            var fecha = "'"+id+horaMenor+"' AND '"+id+horaMayor+"'";
            console.log('inicio');
            var resumenDia = obtenerDatajson('ID,cliente_id,datos_cliente,codigos_prendas,notas,metodos_pago,valor_total','con_t_ventasplaza','Between','fecha_creada',fecha);
            var jsonResumenDia = JSON.parse(resumenDia);
            console.log(jsonResumenDia);
            $('#primeraFila').after(imprimi(jsonResumenDia));
            console.log('fin');
            return false;     
        }); 
    });      
    $('#close2').on('click', function(){         
        $('#popup2').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        return false;     
    });
    $('#bscar').on('change',function(){
	    $('.removerCambios').remove();
        $('.ventasplazaResumen').remove(); 
	    var ordenesCambio = ordenescambiojson($('#bscar').val(),$('#estadoFiltro').val(),$('#transportador').val(),$('#tipoenvio').val(),$('#datetimepicker-creadacambios').val(),$('#datetimepicker-entregacambios').val());
        var html = imprimirCambiosjson(ordenesCambio,pedidoUpdate,fechaUpdate,notasUpdate,usuarioUpdate);
        var primeraFila = $('#primeraFila');
        primeraFila.after(html);
    	cambios();
	}); 
    $('#clienteGuardado').on('click', function(){ 
        if(!$('#nombre').val()){alert("Ingresa el nombre del cliente :)");return false;}
        if(!$('#telefono').val()){alert("Ingresa el tel??fono del cliente :)");return false;}
        if(!$('#correo').val()){alert("Ingresa el correo del cliente :)");return false;}
        if(!$('#documento').val()){alert("Ingresa el documento del cliente :)");return false;}
        var telef = $('#telefono').val().replace(' ', '');
        var id = guardarCliente( $('#nombre').val(),telef,"-","-","-",$('#correo').val(),$('#documento').val());
        $('#popup2').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('#nombreVenta').val($('#nombre').val());
        $('#correov').val($('#correo').val());
        $('#telVenta').val($('#telefono').val());
        $('#idCliente').val(id);
        $('#documentov').val($('#documento').val());
        return false;     
    });
    $('#clienteBuscar').on('click', function(){ 
        $('#popup').fadeOut('slow');         
        $('#popup3').fadeIn('slow'); 
        var html = "";
        var clientes = clientesBuscarjson($('#tele').val());        
        var jsonclientes = JSON.parse(clientes);
        console.log(jsonclientes.length);
        if(jsonclientes.length==0){
            html = "<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
        }else{
            console.log(jsonclientes);
            for(i=0;i<jsonclientes.length;i++){
                var datos = items[i].split('%');
                html=html+"<p class='off remover' id='clienteid"+i+"' >"+jsonclientes[i].cliente_id+"</p><p id='nombre"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].nombre+"</p><p id='telefono"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].telefono+"</p><p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover' id='documento"+i+"' >"+jsonclientes[i].documento+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 remover' id='correo"+i+"' >"+jsonclientes[i].correo+"</p><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'><button class='botonmodal' id='"+i+"' onclick='seleccionCliente("+i+")' style='width: 100%;'>Cargar</button></div>";
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
        imprimirprendasparavenderdetal(); 
        return false;
    });  
    $('#close4').on('click', function(){   
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });  

       
    // aqui
    $('#agregarprendaspedido').on('click', function(){  
        $('.removeprendavender').remove();
        var check = $("#popup4 input"); 
        var valor = 0;
        var html = "";
        var jsonPrendas = new Object();
        var j=0;
        for (let i = 0; i < check.length; i++) {
            if(check[i].checked){
                valor = valor + parseInt(check[i].value);
                var codigoDescr = check[i].name.split("/");
                var jsonPrenda = new Object();
                jsonPrenda.codigo = codigoDescr[0];
                jsonPrenda.descripcion = codigoDescr[1];
                jsonPrenda.valor = check[i].value;
                jsonPrendas[j] = jsonPrenda;
                j++;
                html=html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeprendavender' id='"+check[i].id+"'><p class='letra3pt-mv letra16pt-pc'>"+codigoDescr[0]+" "+codigoDescr[1]+" "+check[i].value+"</p></div>";
            }            
        }
        var prendaString= JSON.stringify(jsonPrendas);
        html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeprendavender' id='datospedido' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valor' name='"+valor+"'>Precio total: "+valor+"</p></div>";
        $('#pedido').append(html);
        $('#popup4').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });
    // ******************************************************************APARTADOS
    $('#agregarApartado').on('click', function(){    
        var html = apartados();
        $("#datosPrendasapartado").after(html);        
        var vendedores = obtenerDatajson('ID,display_name ','con_users','variasfilasunicas','0','0');
        var jsonvendedores = JSON.parse(vendedores);
        console.log(jsonvendedores);
        var vendehtml = "";
        for (let i = 0; i < jsonvendedores.length; i++) {
            vendehtml = vendehtml+"<option value='"+jsonvendedores[i].ID+"'>"+jsonvendedores[i].display_name+"</option>";            
        }
        $('#vendedorselectapartado').append(vendehtml);
        $('#popup5').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());    
        $('#agregarPedidoApartado').css('display','block'); 
        funcionespagina();
        return false;     
    });      
    $('#close5').on('click', function(){         
        $('#popup5').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.removertodo').remove(); 
        return false;     
    });        
    $('#agregarClienteapartado').on('click', function(){ 
        $('#popup5').fadeOut('slow');         
        $('#popup6').fadeIn('slow'); 
        return false;     
    });      
    $('#close6').on('click', function(){         
        $('#popup6').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        return false;     
    });
    $('#clienteGuardadoApartado').on('click', function(){ 
        if(!$('#nombreapartado').val()){alert("Ingresa el nombre del cliente :)");return false;}
        if(!$('#telefonoapartado').val()){alert("Ingresa el tel??fono del cliente :)");return false;}
        if(!$('#correoapartado').val()){alert("Ingresa el correo del cliente :)");return false;}
        if(!$('#documentoapartado').val()){alert("Ingresa el documento del cliente :)");return false;}
        var telef = $('#telefonoapartado').val().replace(' ', '');
        var id = guardarCliente( $('#nombreapartado').val(),telef,"-","-","-",$('#correoapartado').val(),$('#documentoapartado').val());
        $('#popup6').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        $('#nombreVentaapartado').val($('#nombreapartado').val());
        $('#correovapartado').val($('#correoapartado').val());
        $('#telVentaapartado').val($('#telefonoapartado').val());
        $('#idClienteapartado').val(id);
        $('#documentovapartado').val($('#documentoapartado').val());
        return false;     
    });
    $('#clienteBuscarapartado').on('click', function(){ 
        $('#popup5').fadeOut('slow');         
        $('#popup7').fadeIn('slow'); 
        var html = "";
        var clientes = clientesBuscarjson($('#teleapartado').val());        
        var jsonclientes = JSON.parse(clientes);
        console.log(jsonclientes.length);
        if(jsonclientes.length==0){
            html = "<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 cliente'>Sin resultados</p>"
        }else{
            console.log(jsonclientes);
            for(i=0;i<jsonclientes.length;i++){
                var datos = items[i].split('%');
                html=html+"<p class='off remover' id='clienteid"+i+"' >"+jsonclientes[i].cliente_id+"</p><p id='nombre"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].nombre+"</p><p id='telefono"+i+"' class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'>"+jsonclientes[i].telefono+"</p><p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover' id='documento"+i+"' >"+jsonclientes[i].documento+"</p><p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 remover' id='correo"+i+"' >"+jsonclientes[i].correo+"</p><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 remover'><button class='botonmodal' id='"+i+"' onclick='seleccionClienteApartado("+i+")' style='width: 100%;'>Cargar</button></div>";
            }
        }
        var clientesEncontrados = $('#clientesEncontradosapartado');
        clientesEncontrados.append(html);
        return false;     
    }); 
     $('#close7').on('click', function(){   
        $('#popup7').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        $('.cliente').remove();
        return false;     
    });
    $('#agregarPrendaapartado').on('click', function(){ 
        $('#popup5').fadeOut('slow');         
        $('#popup8').fadeIn('slow'); 
        $('.reinicia').remove();
        imprimirprendasparavenderdetal(); 
        return false;
    });  
    $('#close8').on('click', function(){   
        $('#popup8').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });        
    $('#agregarprendaspedidoapartado').on('click', function(){  
        $('.removeprendavender').remove();
        var check = $("#popup8 input"); 
        var valor = 0;
        var html = "";
        var jsonPrendas = new Object();
        var j=0;
        for (let i = 0; i < check.length; i++) {
            console.log(check[i].checked);
            if(check[i].checked){
                valor = valor + parseInt(check[i].value);
                var codigoDescr = check[i].name.split("/");
                var jsonPrenda = new Object();
                jsonPrenda.codigo = codigoDescr[0];
                jsonPrenda.descripcion = codigoDescr[1];
                jsonPrenda.valor = check[i].value;
                jsonPrenda.id = check[i].id;
                jsonPrendas[j] = jsonPrenda;
                j++;
                html=html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeprendavender' id='"+check[i].id+"'><p class='letra3pt-mv letra16pt-pc'>"+codigoDescr[0]+" "+codigoDescr[1]+" "+check[i].value+"</p></div>";
                console.log(check[i]);
            }            
        }
        console.log(jsonPrendas);
        var prendaString= JSON.stringify(jsonPrendas);
        html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12  removeprendavender' id='datospedido' name='"+prendaString+"'><p class='letra3pt-mv letra16pt-pc' id='valor' name='"+valor+"'>Precio total: "+valor+"</p></div>";
        $('#pedidoapartado').append(html);
        $('#popup8').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        $('.removerprendasparaventa').remove();
        return false;     
    });
    $('#agregarPedidoApartado').on('click', function(){ 
        var nombreVentaapartado = $('#nombreVentaapartado').val();
        var correovapartado = $('#correovapartado').val();
        var telVentaapartado = $('#telVentaapartado').val();
        var idClienteapartado = $('#idClienteapartado').val();
        var documentovapartado = $('#documentovapartado').val();  
        console.log(idClienteapartado);
        if(!idClienteapartado){alert("??Cu??l es el cliente?");return false;}
        var datoscliente = {};
        datoscliente.nombre= nombreVentaapartado;
        datoscliente.correo = correovapartado;
        datoscliente.telefono = telVentaapartado;
        datoscliente.documento = documentovapartado;
        var datospedido = $("#datospedido").attr("name");
        if(!datospedido){alert("??Qu?? quiere "+nombreVentaapartado+"?");return false;}
        var valor = $("#valor").attr("name");
        var datospedidoDescuentos = $("#datospedidoDescuentos").attr("name");
        if(datospedidoDescuentos){datospedido = $("#datospedidoDescuentos").attr("name");valor = $("#valorDescuentos").attr("name");}
        var jsondatospedido= JSON.parse(datospedido);
        var notasapartado = $("#notasapartado").val();
        var vendedorselectapartado = $("#vendedorselectapartado").val();
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "cliente_id";
        objeto.valor = idClienteapartado;
        var cliente_id = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "datos_cliente";
        objeto.valor = datoscliente;
        var datos_cliente = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "pedido";
        objeto.valor = jsondatospedido;
        var pedido = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_total";
        objeto.valor = valor;
        var valor_total = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = "Apartado";
        var estado = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "notas";
        objeto.valor = notasapartado;
        var notas = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "id_vendedor";
        objeto.valor = vendedorselectapartado;
        var id_vendedor = prepararjson(objeto);
        var idapartado = insertarfila("con_t_apartados",cliente_id,datos_cliente,pedido,valor_total,estado,notas,id_vendedor,"0","0","0","0");
        var jsonidapartado= JSON.parse(idapartado);
        console.log(jsonidapartado);
        var usuarioLevel = $('#usuarioCell').attr('name');
        for (let i = 0; i < Object.keys(jsondatospedido).length; i++) {
            console.log(jsondatospedido[i]);
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = jsondatospedido[i].id;
            var condicion = prepararjson(objeto);
            var regla_activa = "";
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "agregada";
            objeto.valor = 1;
            agregada = prepararjson(objeto);
            actualizarregistros("con_t_prendasplaza",condicion,agregada,"0","0","0","0","0","0","0","0","0","0"); 
            actualizarPrendas(usuarioLevel,"Apartado local","AP-"+jsonidapartado[0].id,jsondatospedido[i].codigo);           
        }
        $('#popup5').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.removertodo').remove(); 
        $('.ventasplazaResumen').remove();
        return false;     
    });    
    $('#verApartados').on('click', function(){    
        $('.ventasplazaResumen').remove();     
        $('.ventasplaza').remove();
        imprimirapartados();
        funcionespagina();
        return false;     
    });    
    // aq
    $('#realizarCambio').on('click', function(){   
        $('#continerMetodos').empty();  
        $('#ventana-modal').modal("show");    
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        console.log(jsonIds);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].ID+"'>"+jsonIds[i].descripcion+"</option>"
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v0'>"+
                        "<div class='form-group pmd-textfield pmd-textfield-floating-label'>"+
                            "<label class='control-label letra18pt-pc' for='regular1'>Valor</label>"+
                            "<input class='form-control' type='number' id='valor0' name='valor' required='><span class='pmd-textfield-focused'></span>"+
                        "</div>"+
                    "</div>"+
                    "<div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo0'>"+
                        "<div class='form-group pmd-textfield pmd-textfield-floating-label'>"+
                            "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                            "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='0' form='formularioCliente' required=''>"+
                                "<option value='S'>Seleccione un opci??n de pago</option>"+
                            "</select><span class='pmd-textfield-focused'></span>"+
                        "</div>"+
                    "</div>";
        for (let i = 1; i < jsonIds.length; i++) {
            html = html+"<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor"+i+"' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='"+i+"' form='formularioCliente' required=''><option value='S'>Seleccione un opci??n de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";            
        }
        $('#continerMetodos').append(html);
        $('.metodo').append(option);
        $('.metodo').on('change', function(){  
            var id = parseInt(this.id)+1;
            console.log(id);
            $("#v"+id+"").css('display', 'block');
            $("#metodo"+id+"").css('display', 'block');
        }); 
    });  
    // $('#closeModalPrincipal').on('click', function(){    
    //     $('#continerMetodos').empty(); 
    // }); 
    function carga() { 
    $('.selectPrendas').on('change', function(){   
        var check = $(".prendasIngresa input"); 
        var valor = 0;
        var valor2 = 0;
        var html = "";
        var j=0;
        console.log(check,'le doy');

        
        
        for (let i = 0; i < check.length; i++) {
            var jsonPrenda = new Object();
            var codigoDescr = check[i].name.split("/");
            jsonPrenda.codigo = codigoDescr[0];
            jsonPrenda.descripcion = codigoDescr[1];
            jsonPrenda.ventaId = codigoDescr[2];
            jsonPrenda.valor = check[i].value;
            jsonPrendasIngresan[i] = jsonPrenda;
            if(check[i].checked){
                console.log(check[i],'aquies2');
                valor = valor + parseInt(check[i].value);
            }            
        }
        for (let i = 0; i < Object.keys(jsonPrendasglobal).length; i++) {
            valor2 =  valor2 + parseInt(jsonPrendasglobal[i].valor);    
        }
        console.log( jsonPrendasglobal,'global');  

        

        $("#ValorTotal").text(formatoPrecio(valor2-valor));
        $('#ValorTotal').attr('name',valor2-valor);
    }); 
};

    $('#cargarPrenda2').on('click', function(){  
        $('.remuve').remove();   
        $('#ventana-modal').modal("show");    
        $('#modalAgregarPrendas').modal("hide");
        var check = $("#modalAgregarPrendas input"); 
        var valor = 0;
        var html = "";
        var j=0;
        
        for (let i = 0; i < check.length; i++) {
            if(check[i].checked){
                console.log(check[i],'aquies');
                valor = valor + parseInt(check[i].value);
                var codigoDescr = check[i].name.split("/");
                var jsonPrenda = new Object();
                jsonPrenda.codigo = codigoDescr[0];
                jsonPrenda.descripcion = codigoDescr[1];
                jsonPrenda.valor = check[i].value;
                console.log(formatoPrecio(jsonPrenda.valor));
                jsonPrendasglobal[j] = jsonPrenda;
                j++;
                html=html+'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remuve">'+
							    '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
									'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                        jsonPrenda.descripcion+ 
									'</div>'+
								'</div>'+
								'<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">'+
									'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                        formatoPrecio(jsonPrenda.valor)+ 
									'</div>'+
								'</div>'+
							'</div>';
            }            
        }
        $('#listaPrendasCargadas').append(html);
        console.log(jsonPrendasglobal);
    });

    // $('.removeprendavender').remove();
    //     var check = $("#popup4 input"); 
    //     var valor = 0;
    //     var html = "";
    //     var jsonPrendas = new Object();
    //     var j=0;
    //     for (let i = 0; i < check.length; i++) {
    //         if(check[i].checked){
    //             valor = valor + parseInt(check[i].value);
    //             var codigoDescr = check[i].name.split("/");
    //             var jsonPrenda = new Object();
    //             jsonPrenda.codigo = codigoDescr[0];
    //             jsonPrenda.descripcion = codigoDescr[1];
    //             jsonPrenda.valor = check[i].value;
    //             jsonPrendas[j] = jsonPrenda;
    //             j++;
    //             html=html+"<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3  removeprendavender' id='"+check[i].id+"'><p class='letra3pt-mv letra16pt-pc'>"+codigoDescr[0]+" "+codigoDescr[1]+" "+check[i].value+"</p></div>";
    //         }            
    //     }

    $('#cargarPrenda').on('click', function(){ 
        for (const key in jsonPrendasglobal) {
            delete jsonPrendasglobal[key];
        }
        $(".prendasplaza").remove();
        $('#ValorTotal').attr("name",0); 
        $("#ValorTotal").text(0);
        $('#listaPrendasCargadas').empty();
        $('#modalAgregarPrendas').modal("show");
        $('.prendasCargadas').attr('checked',false);
        var prendasjson = imprimirprendasparavenderdetal(); 
        console.log(prendasjson); 
        var prendasunitario =""
        for (let j = 0; j < Object.keys(prendasjson).length; j++) {
            prendasunitario = prendasunitario + '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prendasplaza"style="margin-left: -14px; margin-top: 10px;">'+
			                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">'+
											"<input class='form-check-input prendasCargadas' type='checkbox' value='"+prendasjson[j].valor+"' name='"+prendasjson[j].codigo+"/"+prendasjson[j].descripcion+"' id='flexCheckDefault'>"+
										'</div>'+
										'<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
												prendasjson[j].codigo+
											'</div>'+
										'</div>'+
										'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                                prendasjson[j].descripcion+
											'</div>'+
										'</div>'+
										'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">'+
											'<div class="letra18pt-pc letra" for="flexCheckDefault">'+
                                            formatoPrecio(prendasjson[j].valor)+
											'</div>'+
										'</div>'+
									'</div>';
                }   
        $('#prendasAgregar').after(prendasunitario);
        
    }); 
    $('#cierreSegundoModal').on('click', function(){
        $('#ventana-modal').modal("show");      
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
        var prendas = ($('#escaneados p'));
        enviarparaventa(prendas);
        $('.remover').remove();
    });       
    $('#agregarVentaCell').on('click', function() {
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        console.log(jsonIds);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].ID+"'>"+jsonIds[i].descripcion+"</option>"
        }
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor0' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo0'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='0' form='formularioCliente' required=''><option value='S'>Seleccione un opci??n de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";
        for (let i = 1; i < jsonIds.length; i++) {
            html = html+"<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 metodop' id='v"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Valor</label><input class='form-control' type='number' id='valor"+i+"' name='valor' required='><span class='pmd-textfield-focused'></span></div></div><div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 metodop' id='metodo"+i+"' style='display: none;'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='regular1'>Metodo</label><select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='"+i+"' form='formularioCliente' required=''><option value='S'>Seleccione un opci??n de pago</option></select><span class='pmd-textfield-focused'></span></div></div>";            
        }
        $('#vendedordiv').after(html);
        $('.metodo').append(option);
        var vendedores = obtenerDatajson('ID,display_name ','con_users','variasfilasunicas','0','0');
        var jsonvendedores = JSON.parse(vendedores);
        console.log(jsonvendedores);
        var vendehtml = "";
        for (let i = 0; i < jsonvendedores.length; i++) {
            vendehtml = vendehtml+"<option value='"+jsonvendedores[i].ID+"'>"+jsonvendedores[i].display_name+"</option>";            
        }
        $('#vendedorselect').append(vendehtml);
        $('#pop').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());    
        $('#agregarPedido').css('display','block'); 
        $('.metodo').on('change', function(){  
            var id = parseInt(this.id)+1;
            console.log(id);
            $("#v"+id+"").css('display', 'block');
            $("#metodo"+id+"").css('display', 'block');
        });    
        return false;     
    });    
}) 
</script>
<script>
function seleccionCliente(id) {
        $('#nombreVenta').val($('#nombre'+id).text());
        $('#correov').val($('#correo'+id).text());
        $('#telVenta').val($('#telefono'+id).text());
        $('#idCliente').val($('#clienteid'+id).text());
        $('#documentov').val($('#documento'+id).text());        
        $('#popup3').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.cliente').remove();
        $('.remover').remove();
        return false;  
    }
function seleccionClienteApartado(id) {
        $('#nombreVentaapartado').val($('#nombre'+id).text());
        $('#correovapartado').val($('#correo'+id).text());
        $('#telVentaapartado').val($('#telefono'+id).text());
        $('#idClienteapartado').val($('#clienteid'+id).text());
        $('#documentovapartado').val($('#documento'+id).text());        
        $('#popup7').fadeOut('slow');      
        $('#popup5').fadeIn('slow');
        $('.cliente').remove();
        $('.remover').remove();
        return false;  
    }
    function funcionespagina() {
        $(".checkregla").change(function() {
            if(this.checked) {
                var descuentosr = $("#descuentosr input");
                for (let i = 0; i < descuentosr.length; i++) {
                    if(descuentosr[i].value != this.value){
                        $(descuentosr[i]).attr('checked', false);
                    }   
                }
                var con_t_reglasdescuentos = obtenerDatajson("*","con_t_reglasdescuentos","valoresconcondicion","ID",this.value);
                var jsoncon_t_reglasdescuentos = JSON.parse(con_t_reglasdescuentos); 
                var valor_total = $('#valor').attr("name");
                if(!valor_total){console.log("esta vacio");return false;}
                $(".removeresumendescuento").remove();
                var datospedido = JSON.parse($("#datospedido").attr("name"));
                var jsonData = calculardescuentos(datospedido,valor_total,jsoncon_t_reglasdescuentos);
                console.log(jsonData);        
                $("#datosPrendasapartado").after(jsonData.html);
                $("#datosPrendas").after(jsonData.html);
            }
        });
        $('.agregarabono').on('click', function() {
            console.log(this.id);
            $('#popup9').fadeIn('slow');         
            $('.popup-overlay').fadeIn('slow');
            $('.popup-overlay').height($(window).height()); 
            $("#agregarabonodiv").attr("name",this.id);
        });   
        $('#close9').on('click', function(){         
            $('#popup9').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');       
            return false;     
        });
        $("#abonoguardado").on('click', function(){   
            var id = $("#agregarabonodiv").attr("name");
            var arrayid = id.split("_");
            var idapartado = arrayid[1];
            var abonovalor = $("#abonovalor").val();
            if(!abonovalor){alert("Ingresa un valor para este abono");return false;}
            $('#popup9').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');      
            $('.ventasplaza').remove();
            var con_t_apartados = obtenerDatajson("*","con_t_apartados","valoresconcondicion","ID",idapartado);
            var jsoncon_t_apartados = JSON.parse(con_t_apartados); 
            console.log(jsoncon_t_apartados);
            var numeroabono = "";
            if(jsoncon_t_apartados[0].abono_3 == "0"){
                numeroabono = "abono_3";
                fechaabono = "fecha_abono_3";
            }
            if(jsoncon_t_apartados[0].abono_2 == "0"){
                numeroabono = "abono_2";
                fechaabono = "fecha_abono_2";
            }
            if(jsoncon_t_apartados[0].abono_1 == "0"){
                numeroabono = "abono_1";
                fechaabono = "fecha_abono_1";
            }
            if(numeroabono=="abono_3"){
                var abono = parseInt(jsoncon_t_apartados[0].valor_total) - (parseInt(jsoncon_t_apartados[0].abono_1) + parseInt(jsoncon_t_apartados[0].abono_2));                
                alert("El abono final tiene que completar el valor del pedido, se deben recibir: "+abono);
                abonovalor = abono;
            }
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = idapartado;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = numeroabono;
            objeto.valor = abonovalor;
            var abonoenviar  = prepararjson(objeto);
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            let currentDate = `${year}/${month}/${day}`;//2022-08-08 13:58:58 	
            var objeto = {};
            objeto.tipo = "date";
            objeto.columna = fechaabono;
            objeto.valor = currentDate;
            var fecha_abono  = prepararjson(objeto);
            var resultado = actualizarregistros("con_t_apartados",condicion,abonoenviar,fecha_abono,"0","0","0","0","0","0","0","0","0");
            console.log(resultado);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "id_apartado";
            objeto.valor = idapartado;
            var id_apartado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = "Agregando un abono";
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambiado";
            objeto.valor = numeroabono;
            var campo_cambiado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "date";
            objeto.columna = "fehca_cambio";
            objeto.valor = currentDate;
            var fehca_cambio  = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "id_usuario";
            objeto.valor = 1;
            var id_usuario  = prepararjson(objeto);
            var idapartadotr = insertarfila("con_t_apartadostr",id_apartado,cambio,campo_cambiado,fehca_cambio,id_usuario,"0","0","0","0","0","0");                
            imprimirapartados();
            funcionespagina();       
            return false;     
        });
        return false;  
    }
    function imprimirapartados() {
        var html  = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza' id='primeraFila'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>Cliente</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>Pedido</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Abono 1</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Fecha 1</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Abono 2</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Fecha 2</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Abono 3</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Fecha 3</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Notas</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Valor total</p></div></div>"
        var apartados = obtenerDatajson('*','con_t_apartados','variasfilasunicas','0','0');
        var jsonapartados = JSON.parse(apartados);
        console.log(jsonapartados);
        var primeraventa = "primeraventa";
        for (let i = ( Object.keys(jsonapartados).length-1); i >= 0; i--) {
            var datos_cliente = JSON.parse(jsonapartados[i].datos_cliente);
            var pedido = JSON.parse(jsonapartados[i].pedido);
            var pedidohtml = "";
            for (let j = 0; j < pedido.length; j++) {
                pedidohtml = pedidohtml + pedido[j].codigo + " " + pedido[j].descripcion + " - ";
            }
            html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza' id='"+primeraventa+"'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno' id='cliente"+jsonapartados[i].ID+"'>"+datos_cliente.nombre+" "+datos_cliente.telefono+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno' id='pedido"+jsonapartados[i].ID+"'>"+pedidohtml+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno agregarabono' id='abono1_"+jsonapartados[i].ID+"'>"+jsonapartados[i].abono_1+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno' id='fecha3_"+jsonapartados[i].ID+"'>"+jsonapartados[i].fecha_abono_1+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno agregarabono' id='abono2_"+jsonapartados[i].ID+"'>"+jsonapartados[i].abono_2+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno' id='fecha3_"+jsonapartados[i].ID+"'>"+jsonapartados[i].fecha_abono_2+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno agregarabono' id='abono3_"+jsonapartados[i].ID+"'>"+jsonapartados[i].abono_3+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno' id='fecha3_"+jsonapartados[i].ID+"'>"+jsonapartados[i].fecha_abono_3+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno' id='notas"+jsonapartados[i].ID+"'>"+jsonapartados[i].notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno' id='valortotal"+jsonapartados[i].ID+"'>"+jsonapartados[i].valor_total+"</p></div></div>";
            primeraventa = i+1;
        }
        $("#bloquePrincipal").append(html);
        return false;  
    }
    function imprimirResumen2(jsonResumen){

        var metodosPago = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonMetodosPago = JSON.parse(metodosPago);
        console.log(jsonMetodosPago);
        var htmlTitulo='';
        var htmlBody='';
        htmlTitulo = htmlTitulo+"<th><p class='letra18pt-pc negrillaUno'>Fecha</p></th>"+"<th><p class='letra18pt-pc negrillaUno'>Mercanc??a</p></th>";
        for (let i = 0; i < Object.keys(jsonMetodosPago).length; i++) {    
            htmlTitulo = htmlTitulo + "<th><p class='letra18pt-pc negrillaUno'>"+jsonMetodosPago[i].descripcion+"</p></th>"
        }
        $('#titulosTabla').append(htmlTitulo);

        for (let i = (jsonResumen.length-1); i >=0; i--) {
            var jsonMetodosPago2 = JSON.parse(jsonResumen[i].metodos_pago);
            console.log(jsonMetodosPago2,'importante');
            var htmlBodyDentro='';
            for (let i = 0; i < Object.keys(jsonMetodosPago).length; i++) { 
                for (let j in jsonMetodosPago2){
                    
                    if(j===jsonMetodosPago[i].descripcion){
                        htmlBodyDentro = htmlBodyDentro +"<td><p class='letra18pt-pc negrillaUno'>"+formatoPrecio(jsonMetodosPago2[j])+"</p></td>";

                    }
                    console.log(jsonMetodosPago[i].descripcion,j,jsonMetodosPago2[j]);
                }
                   
    
            }

            htmlBody = htmlBody 
            +"<tr>"
                +"<td><p class='letra18pt-pc negrillaUno verDia' name='"+jsonResumen[i].fecha+"'>"+jsonResumen[i].fecha+"</p></td>"
                +"<td><p class='letra18pt-pc negrillaUno'>"+formatoPrecio(jsonResumen[i].valor_mercancia)+"</p></td>"
                +htmlBodyDentro
            +"</tr>";

            
            
            // "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplazaResumen'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno verDia' name='"+jsonResumen[i].fecha+"' >"
            // +jsonResumen[i].fecha+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonResumen[i].valor_mercancia)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.Efectivo)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.Datafono)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'> <p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.Nequi)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.Daviplata)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.PayU)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
            // +formatoPrecio(jsonMetodosPago2.Bancolombia)+"</p></div></div>";
        }
        $('#bodyTabla').append(htmlBody);


        // var jsonMetodosPago = JSON.parse(jsonResumen[jsonResumen.length-1].metodos_pago);
        // var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplazaResumen' id='primeraventa'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno verDia' name='"+jsonResumen[jsonResumen.length-1].fecha+"' >"
        // +jsonResumen[jsonResumen.length-1].fecha+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonResumen[jsonResumen.length-1].valor_mercancia)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.Efectivo)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.Datafono)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'> <p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.Nequi)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.Daviplata)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.PayU)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        // +formatoPrecio(jsonMetodosPago.Bancolombia)+"</p></div></div>";
        // for (let i = (jsonResumen.length-2); i >=0; i--) {
        //     var jsonMetodosPago2 = JSON.parse(jsonResumen[i].metodos_pago);
        //     console.log(jsonMetodosPago2);
        //     html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplazaResumen'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno verDia' name='"+jsonResumen[i].fecha+"' >"
        //     +jsonResumen[i].fecha+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonResumen[i].valor_mercancia)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.Efectivo)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.Datafono)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'> <p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.Nequi)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.Daviplata)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.PayU)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 containerTabla'><p class='letra18pt-pc negrillaUno'>"
        //     +formatoPrecio(jsonMetodosPago2.Bancolombia)+"</p></div></div>";
        // }
        // return html;
    }
    function imprimi(jsonVentas) {
        console.log(jsonVentas);
        var datoscliente = jsonVentas[jsonVentas.length-1].datos_cliente;
        var jsondatoscliente = JSON.parse(datoscliente);
        var codigos_prendas = jsonVentas[jsonVentas.length-1].codigos_prendas;
        var jsoncodigos_prendas = JSON.parse(codigos_prendas);
        var pedido = "";
        console.log(jsoncodigos_prendas);
        for (let j = 0; j < Object.keys(jsoncodigos_prendas).length; j++) {
            console.log(jsoncodigos_prendas[j]);
            pedido = pedido + " " + jsoncodigos_prendas[j].codigo+" "+jsoncodigos_prendas[j].descripcion;
        }
        var metodos_pago = jsonVentas[jsonVentas.length-1].metodos_pago;
        var jsonmetodos_pagos = JSON.parse(metodos_pago);
        var vmp = "";
        console.log(jsonmetodos_pagos);
        for (let j = 0; j < Object.keys(jsonmetodos_pagos).length; j++) {
            console.log(jsonmetodos_pagos[j] , "aqui");
            var metodoConsultado = obtenerDatajson('descripcion','con_t_metodospago','valoresconcondicion','ID',jsonmetodos_pagos[j].metodo);
            var metodoModificado = JSON.parse(metodoConsultado);
            vmp = vmp + " " + jsonmetodos_pagos[j].valor+" m??todo "+metodoModificado[0].descripcion;
        }
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza' id='primeraventa'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"
        +jsonVentas[jsonVentas.length-1].ID+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"
        +jsondatoscliente.nombre+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
        +jsondatoscliente.telefono+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
        +jsonVentas[jsonVentas.length-1].fecha_creada+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'> <p class='letra18pt-pc negrillaUno'>"
        +pedido+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
        +jsonVentas[jsonVentas.length-1].valor_total+" "+vmp+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
        +jsonVentas[jsonVentas.length-1].notas+"</p></div></div></div>";
        
        for (let i = (jsonVentas.length-2); i >=0; i--) {
            var datoscliente = jsonVentas[i].datos_cliente;
            var jsondatoscliente = JSON.parse(datoscliente);
            var codigos_prendas = jsonVentas[i].codigos_prendas;
            var jsoncodigos_prendas = JSON.parse(codigos_prendas);
            var pedido = "";
            // console.log(jsoncodigos_prendas);
            for (let j = 0; j < Object.keys(jsoncodigos_prendas).length; j++) {
                pedido = pedido + " " + jsoncodigos_prendas[j].codigo+" "+jsoncodigos_prendas[j].descripcion;
            }
            var metodos_pago = jsonVentas[i].metodos_pago;
            var jsonmetodos_pagos = JSON.parse(metodos_pago);
            var vmp = "";
            // console.log(jsoncodigos_prendas);
            for (let j = 0; j < Object.keys(jsonmetodos_pagos).length; j++) {
                console.log(jsonmetodos_pagos[j] , "aqui2");
                var metodoConsultado2 = obtenerDatajson('descripcion','con_t_metodospago','valoresconcondicion','ID',jsonmetodos_pagos[j].metodo);
                var metodoModificado2 = JSON.parse(metodoConsultado2);
                vmp = vmp + " " + jsonmetodos_pagos[j].valor+" m??todo "+metodoModificado2[0].descripcion;
            }
            html = html +"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 ventasplaza'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"
            +jsonVentas[i].ID+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"
            +jsondatoscliente.nombre+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
            +jsondatoscliente.telefono+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
            +jsonVentas[i].fecha_creada+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'> <p class='letra18pt-pc negrillaUno'>"
            +pedido+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
            +jsonVentas[i].valor_total+" "+vmp+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"
            +jsonVentas[i].notas+"</p></div></div></div>";
        }
        return html;
    }
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


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