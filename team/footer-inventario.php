<?php get_template_part('generalfooter'); ?>
//<script>
    
    var permisoInventario = permisosInventario();
    var botonesEscaner = $('#botonesEscaner');
    // botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion01'><button class='botonmodal' type='button' id='inicialInventario'>Inventario inicial</button></div>");
    var segundo = $('#segundo');
    segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion1'><button class='botonmodal botonesInventario' type='button' id='registrarCodigos'>Inventario inicial </button></div>");
    var items = permisoInventario.split(',');    
    var fechaAudito = $('#fechaAudito');
        var fechaInventario = obtenerData("fecha","con_t_auditoriasinventario","row","ID",fechaAudito.attr("name"));
        fechaAudito.append("<p class='removFecha'>Fecha de la auditoría actual: "+fechaInventario+"</p>");
        var flag = 0;
    for(i=1;i<items.length;i++){
        if(items[i]==17 || items[i]==21){
            if (flag == 0){
                var fechaAudito = $('#fechaAudito');
                fechaAudito.after("<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3 padding5'><label for='tipo' class='control-label letra18pt-pc'>Selecciona tipo de auditoría</label><select class='form-control' type='select' id='tipoAuditoria' name='tipoAuditoria' form='tipoAuditoria'><option value='Personal'>Personal</option><option value='Empacado'>Empacados</option><option value='Despachado'>Despachados</option><option value='Satelite'>En satélite</option></select><span class='pmd-textfield-focused'></span></div>");    
                flag = 1;
            }            
        }
        if(items[i]==17){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion17'><button class='botonmodal botonesInventario' type='button' id='crearReferencia'>Referencia nueva </button></div>");
            // segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion17'><button class='botonmodal botonesInventario' type='button' id='crearReferenciaVieja'>Referencia nueva - Antiguo </button></div>");
        }
        if(items[i]==19){
            var segundo = $('#segundo');
            // segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion19'><button class='botonmodal botonesInventario' type='button' id='crearCodigos'>Crear códigos</button></div>");
            // segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion19'><button class='botonmodal botonesInventario' type='button' id='fechaslotes'>Fechas de lotes</button></div>");
        }
        if(items[i]==20){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion20'><button class='botonmodal' type='button' id='escanearInventario'>Escanear inventario</button></div>");
        }if(items[i]==21){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion21'><button class='botonmodal' type='button' id='empacar'>Empacar</button></div>");
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion40'><button class='botonmodal botonesInventario' type='button' id='verLiberar'>Liberar empaque</button></div>");
        }if(items[i]==22){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion22'><button class='botonmodal' type='button' id='despachar'>Despachar</button></div>");
        }if(items[i]==23){
            /*var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion23'><button class='botonmodal' type='button' id='venderPlaza'>Vender Plaza</button></div>");*/
        }if(items[i]==24){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion24'><button class='botonmodal' type='button' id='enviarMadrugon'>Enviar Madrugón</button></div>");
        }if(items[i]==25){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion25'><button class='botonmodal' type='button' id='entregarCliente'>Entregar Cliente</button></div>");
        }if(items[i]==28){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion28'><button class='botonmodal botonesInventario' type='button' id='verCodigos'>Ver códigos</button></div>");
        }if(items[i]==29){
            var segundo = $('#segundo');
            var tercero = $('#botonesEscaner');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion29'><button class='botonmodal botonesInventario' type='button' id='verResumen'>Resumen</button></div>");
            tercero.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion290'><button class='botonmodal' type='button' id='verResumenCell'>Resumen</button></div>");
        }if(items[i]==30){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion30'><button class='botonmodal botonesInventario' type='button' id='auditInvent'>Auditoria inventario</button></div>");
        }if(items[i]==31){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion31'><button class='botonmodal botonesInventario' type='button' id='madrug'>Madrugón</button></div>");
        }if(items[i]==32){
        }if(items[i]==33){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion33'><button class='botonmodal botonesInventario' type='button' id='Sinf'>Subir informe</button></div>");
        }if(items[i]==34){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion34'><button class='botonmodal botonesInventario' type='button' id='infD'>Informe de dinero</button></div>");
        }if(items[i]==35){
            var segundo = $('#segundo');
            //segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion35'><button class='botonmodal botonesInventario' type='button' id='reviVentas'>Ventas vs inventario</button></div>");
        }if(items[i]==36){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion36'><button class='botonmodal' type='button' id='enviarDanado'>Enviar dañados</button></div>");
        }if(items[i]==37){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion37'><button class='botonmodal' type='button' id='ventaPlaza'>Venta plaza</button></div>");
        }if(items[i]==38){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion38'><button class='botonmodal' type='button' id='ventaMayorista'>Venta mayorista</button></div>");
        }if(items[i]==57){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion38'><button class='botonmodal' type='button' id='confirmarTerminados'>Confirmar terminados</button></div>");
        }       
    }
    $('#crearReferenciaVieja').on('click', function(){   
        $('.remover').remove();
        $('#referenciaNuevaAntiguo').css('display', 'block');
        $('#codigosNuevos').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none'); 
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var html = "";
        var nombresReferencias = obtenerData("nombre","con_t_resumen","unico");
        var items = nombresReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var nombreinput = $('#nombreReferenciaAntiguo');
        nombreinput.append(html);
        var html = "";
        var coloresReferencias = obtenerData("color","con_t_resumen","unico");
        var items = coloresReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var colorinput = $('#colorReferencia');
        colorinput.append(html);
        var html = "";
        var tallasReferencias = obtenerData("talla","con_t_resumen","unico");
        var items = tallasReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var tallainput = $('#tallaReferencia');
        tallainput.append(html);
        var html = "";
        var categoriasIds = obtenerData("categoria,categoria_id","con_t_categoria","varios");
        var item = categoriasIds.split(',');
        for(i=1;i<item.length;i++){
            var items = item[i].split('%');
            html=html+"<option class='remover' value='"+items[1]+"'>"+items[0]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var categoriainput = $('#categoriaViejaSelect');
        categoriainput.append(html);
        return false;     
    }); 
    $('#crearReferencia').on('click', function(){   
        $('.remover').remove();
        $('#referenciaNueva').css('display', 'block');
        $('#codigosNuevos').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none'); 
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var html = "";
        var nombresReferencias = obtenerData("nombre","con_t_resumen","unico");
        var items = nombresReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var nombreinput = $('#nombreReferencia');
        nombreinput.append(html);
        var html = "";
        var coloresReferencias = obtenerData("color","con_t_resumen","unico");
        var items = coloresReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var colorinput = $('#colorReferencia');
        colorinput.append(html);
        var html = "";
        var tallasReferencias = obtenerData("talla","con_t_resumen","unico");
        var items = tallasReferencias.split(',');
        for(i=1;i<items.length;i++){
            html=html+"<option class='remover' value='"+items[i]+"'>"+items[i]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var tallainput = $('#tallaReferencia');
        tallainput.append(html);
        var html = "";
        var categoriasIds = obtenerData("categoria,categoria_id","con_t_categoria","varios");
        var item = categoriasIds.split(',');
        for(i=1;i<item.length;i++){
            var items = item[i].split('%');
            html=html+"<option class='remover' value='"+items[1]+"'>"+items[0]+"</option>";
        }
        html=html+"<option class='remover' value='Otro'>Otro</option>";
        var categoriainput = $('#categoria');
        categoriainput.append(html);
        return false;     
    }); 
    $('#nombreReferenciaAntiguo').on('change', function() {
            if( this.value == "Otro"){
               $('#cualdiv').css('display', 'block');
            }else{$('#cualdiv').css('display', 'none');}
    }); 
    $('#nombreReferencia').on('change', function() {
            if( this.value == "Otro"){
               $('#cualdiv').css('display', 'block');
            }else{$('#cualdiv').css('display', 'none');}
    }); 
    $('#colorReferencia').on('change', function() {
            if( this.value == "Otro"){
               $('#cualdivColor').css('display', 'block');
            }else{$('#cualdivColor').css('display', 'none');}
    }); 
    $('#tallaReferencia').on('change', function() {
            if( this.value == "Otro"){
               $('#cualdivTalla').css('display', 'block');
            }else{$('#cualdivTalla').css('display', 'none');}
    });
    $('#categoria').on('change', function() {
            if( this.value == "Otro"){
               $('#categoriaDiv').css('display', 'block');
            }else{$('#categoriaDiv').css('display', 'none');}
    });
    $('#guardarReferenciaAntiguo').on('click', function() {
        var nombre = $('#nombreReferenciaAntiguo').val();
        var color = $('#colorReferencia').val();
        var talla = $('#tallaReferencia').val();
        var detal = $('#precioDetalAntiguo').val();
        var mayor = $('#precioMayorAntiguo').val();
        var categoria = $('#categoriaViejaSelect').val();
        if($('#cual').val()){
            nombre = $('#cual').val();
            nuevocodigo("referencia",nombre);
        }if($('#cualColor').val()){
            color = $('#cualColor').val();
            nuevocodigo("color",color);
        }if($('#cualTalla').val()){
            talla = $('#cualTalla').val();
        }if($('#cualCategoria').val()){
            categoria = $('#cualCategoria').val();
        }
       var idRef = referenciaNueva(nombre,color,talla,"Pendiente",detal,mayor,categoria);
       
        $('#referenciaNueva').css('display', 'none');
        $('.remover').remove();
        
    });
    $('#guardarReferencia').on('click', function() {
        var nombre = $('#nombreReferencia').val();
        var detal = $('#precioDetal').val();
        var mayor = $('#precioMayor').val();
        var categoria = $('#categoria').val();

        if(!nombre){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Agrega un nombre para la referencia nueva`); 
            return false;
        }
        var nombres = obtenerDatajson("nombre","con_t_referencias","valoresconcondicion","nombre",`'${nombre}'`);
        var nombresj = JSON.parse(nombres);  

        if(nombresj.length > 0){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`El nombre de referencia que estás tratando de agregar ya está agregada`); 
            return false;
        }

        if(!detal){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Agrega el precio al que se va a vender la prenda al detal`); 
            return false;
        }

        if(!mayor){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Agrega el precio al que se va a vender la prenda al por mayor`); 
            return false;
        }
        var idcat = categoria;
        if($('#cualCategoria').val()){
            categoria = $('#cualCategoria').val();
            // con_t_categoria  categoria_id    categoria  padre_id
            let objeto = {};
            objeto.tipo = "string";
            objeto.columna = "categoria";
            objeto.valor = categoria;
            let categoriai = prepararjson(objeto);
            
            objeto = {};
            objeto.tipo = "string";
            objeto.columna = "padre_id";
            objeto.valor = 0;
            let padre_id = prepararjson(objeto);

            let idcategoria = insertarfila("con_t_categoria",categoriai,padre_id,"0","0","0","0","0","0","0","0","0");
            
            idcat = 10;
        }

        // con_t_referencias  	nombre  id_categoria    precio_detal 	precio_mayorista 	
        let objeto = {};
        objeto.tipo = "string";
        objeto.columna = "nombre";
        objeto.valor = nombre;
        let nombrei = prepararjson(objeto);

        
        objeto = {};
        objeto.tipo = "string";
        objeto.columna = "id_categoria";
        objeto.valor = idcat;
        let id_categoria = prepararjson(objeto);

        objeto = {};
        objeto.tipo = "string";
        objeto.columna = "precio_detal";
        objeto.valor = detal;
        let precio_detal = prepararjson(objeto);

        objeto = {};
        objeto.tipo = "string";
        objeto.columna = "precio_mayorista";
        objeto.valor = mayor;
        let precio_mayorista = prepararjson(objeto);
        
        let idinsumo = insertarfila("con_t_referencias",nombrei,id_categoria,precio_detal,precio_mayorista,"0","0","0","0","0","0","0");
        
        console.log('nombre');
        console.log(nombre);
        console.log('detal');
        console.log(detal);
        console.log('mayor');
        console.log(mayor);
        console.log('categoria');
        console.log(categoria);

        $('#referenciaNueva').css('display', 'none');
        $('.remover').remove();
        
    });
    $('#crearCodigos').on('click', function(){   
        $('.remover').remove();
        $('#codigosNuevos').css('display', 'block');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var htmlnombre = "<option class='remover' value='NA'>No aplica</option>";
        var datosreferencias = obtenerData("referencia_id,nombre,color,talla","con_t_resumen","varios");
        var items = datosreferencias.split(',');
        for(i=1;i<items.length;i++){
            var itemssi = items[i].split('%');
            htmlnombre=htmlnombre+"<option class='remover' value='"+itemssi[0]+"°"+itemssi[1]+"°"+itemssi[2]+"°"+itemssi[3]+"'>"+itemssi[1]+" "+itemssi[2]+" "+itemssi[3]+"</option>";
        }
        var refe = $('.referencia');
        refe.append(htmlnombre);
    });
    $('#btnExport').on('click', function() {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#marquillas').html()));
        e.preventDefault();
    });
    $('#crearCodes').on('click', function() {
        var referencia1 = $('#referencia1').val();
        var cantidad1 = $('#cantidad1').val();
        var referencia2 = $('#referencia2').val();
        var cantidad2 = $('#cantidad2').val();
        var referencia3 = $('#referencia3').val();
        var cantidad3 = $('#cantidad3').val();
        var referencia4 = $('#referencia4').val();
        var cantidad4 = $('#cantidad4').val();
        var referencia5 = $('#referencia5').val();
        var cantidad5 = $('#cantidad5').val();
        var datosEnviar = "";
        var ok = 0;
        if(referencia1 != "NA"){
            if(cantidad1>0){
                ok = 1;
                datosEnviar = datosEnviar + "," + referencia1+"°"+cantidad1;
                if(referencia2 != "NA"){
                    var ref1 = referencia1.split('%');
                    var ref2 = referencia2.split('%');
                    if(ref1[1]==ref2[1]){
                        if(cantidad2>0){
                            datosEnviar = datosEnviar + "," + referencia2+"°"+cantidad2;
                            if(referencia3 != "NA"){
                                var ref3 = referencia3.split('%');
                                var ref2 = referencia2.split('%');
                                if(ref3[1]==ref2[1]){
                                    if(cantidad3>0){
                                        datosEnviar = datosEnviar + "," + referencia3+"°"+cantidad3;
                                        if(referencia4 != "NA"){
                                            var ref3 = referencia3.split('%');
                                            var ref4 = referencia4.split('%');
                                            if(ref3[1]==ref4[1]){
                                                if(cantidad4>0){
                                                    datosEnviar = datosEnviar + "," + referencia4+"°"+cantidad4;
                                                    if(referencia5 != "NA"){
                                                        var ref5 = referencia5.split('%');
                                                        var ref4 = referencia4.split('%');
                                                        if(ref5[1]==ref4[1]){
                                                            if(cantidad5>0){
                                                                 datosEnviar = datosEnviar + "," + referencia5+"°"+cantidad5;
                                                            }else{alert("La cantidad 5 es debe ser mayor que 0");ok=0;}
                                                        }else{alert("Todos las referencías deben ser del mismo modelo, por favor revisa");ok=0;}
                                                    }
                                                }else{alert("La cantidad 4 es debe ser mayor que 0");ok=0;}
                                            }else{alert("Todos las referencíasdeben ser del mismo modelo, por favor revisa");ok=0;}
                                        }
                                    }else{alert("La cantidad 3 es debe ser mayor que 0");ok=0;}
                                }else{alert("Todos las referencías deben ser del mismo modelo, por favor revisa");ok=0;}
                            }
                        }else{alert("La cantidad 2 es debe ser mayor que 0");ok=0;}
                    }else{alert("Todos las referencías deben ser del mismo modelo, por favor revisa");ok=0;}
                }
            }else{alert("La cantidad 1 es debe ser mayor que 0");ok=0;}
        }
        if(ok == 1){
            var corte =  parseInt(obtenerData("ID","con_t_lotes","ultimo",0,0))+1;
            var satelite = $('#numeroSatelite').val();
            nuevolote();
            if(corte>0&&satelite>0){
                datosEnviar = datosEnviar + "," + corte+"°"+satelite;
                //alert(datosEnviar);
                var imprimir = nuevaMarquilla(datosEnviar);
                $('#codigosNuevos').css('display', 'none');
                $('.remover').remove();
                var resultados = $('#resultados');
                resultados.append(imprimir);
                $('#resultados').css('display', 'block');
                $('#btnExport').css('display', 'block');
            }else{alert("Por favor ingresa número de corte y satélite.");}
        }
        
    });
    $('#verCodigos').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'block');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var codigosprenda = codigosprendasjson($('#bscar').val(),"0","0","0");
        var tituloscodigos = $('#tituloscodigos');
        var html = imprimirCodigosjson(codigosprenda);
        console.log(html);
    	tituloscodigos.after(html);
    });
    
    $('#bscar').on('change', function(){          
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'block');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var codigosprenda = codigosprendasjson($('#bscar').val(),"0","0","0");
        var tituloscodigos = $('#tituloscodigos');
        var html = imprimirCodigosjson(codigosprenda);
        console.log(html);
    	tituloscodigos.after(html);
    });

    $('#bscardescripcion').on('change', function(){          
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'block');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var codigosprenda = codigosprendasjson("0","0","0",$('#bscardescripcion').val());
        var tituloscodigos = $('#tituloscodigos');
        var html = imprimirCodigosjson(codigosprenda);
        console.log(html);
    	tituloscodigos.after(html);
    });

    $('#bscarcual').on('change', function(){          
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'block');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var codigosprenda = codigosprendasjson("0","0",$('#bscarcual').val(),"0");//bscar,estadoFiltro,cual,descripcion
        var tituloscodigos = $('#tituloscodigos');
        var html = imprimirCodigosjson(codigosprenda);
        console.log(html);
    	tituloscodigos.after(html);
    });

    $('#verResumen').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'block');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');  
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var resumen = resumenprendas($('#bscar').val(),"0","0","0");
        var arrayPrendas = resumen.split('&');
        var primeraFila = $('#primeraFilaResumen');
        var html = imprimirResumen(arrayPrendas);
    	primeraFila.after(html);
    });
    $('#verResumenCell').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'block');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var resumen = resumenprendas($('#bscar').val(),"0","0","0");
        var arrayPrendas = resumen.split('&');
        var primeraFila = $('#primeraFilaResumen');
        var html = imprimirResumen(arrayPrendas);
    	primeraFila.after(html);
    });
    $('#auditInvent').on('click', function(){   
        $('.remover').remove();
        $('#segundo').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'block');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none'); 
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var usuarioCell = $('#usuarioCell').attr("name");
        var usuarioCellArray = usuarioCell.split(",");
        var resumen = auditprendas($('#bscar').val(),usuarioCellArray[0],usuarioCellArray[1],"0");
        var arrayPrendas = resumen.split('&');
        var primeraFila = $('#primeraAuditoria');
        var html = imprimirCodigos(arrayPrendas);
    	primeraFila.after(html);
    });
    $('#empezarNueva').on('click', function(){
        $('.removFecha').remove();
        var maxId = empezarnuevaauditoria($('#datetimepicker-filtroNuevoinv').val());
        var fechaAudito = $('#fechaAudito');
        var fechaInventario = obtenerData("fecha","con_t_auditoriasinventario","row","ID",maxId);
        fechaAudito.append("<p class='removFecha'>Fecha de la auditoría actual: "+fechaInventario+"</p>");
    });
    /*************************** Subir informe *******************************/
     $('#Sinf').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'block');
        $('#informeDinero').css('display', 'none');        
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        var ventas = obtenerDatajson("*","con_t_ventas","variasCondiciones",
        `estado = 'Despachado' 
        ||  estado = 'Empacado' 
        ||  estado = 'No empacado'`,"0");
        var jsonventas = JSON.parse(ventas);
        console.log(jsonventas);
        var html = '';
        // Recorre el JSON desde el final hacia el principio
        for (var i = jsonventas.length - 1; i >= 0; i--) {
            var venta = jsonventas[i];

            // Construye el HTML dinámicamente usando los datos del JSON
            html += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            html += '    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" name="Estado">';
            html += '        <p class="letra18pt-pc">' + venta.estado + '</p>';
            html += '    </div>';
            html += '    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" name="Orden">';
            html += '        <p class="letra18pt-pc">#' + venta.venta_id + '</p>';
            html += '    </div>';
            html += '    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" name="Orden">';
            html += '        <p class="letra18pt-pc">' + venta.notas + '</p>';
            html += '    </div>';
            html += '    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">';
            html += '        <button class="botonmodal darInforme" type="button" id="' + venta.venta_id + '">Dar informe </button>';
            html += '    </div>';
            html += '</div>';
        }

        // Para añadir el HTML a algún contenedor de tu página
        $('#cargarInformediv').html(html);

    });
    $('#darInforme').on('click', function(){ 
        
    });

    $('#cargarInforme').on('click', function(){ 
        var usuarioCell = $('#usuarioCell').attr("name");
        console.log(usuarioCell);
        var cantidadInfo = $("#informe p").length;
        console.log(cantidadInfo);
        for(var i = 3;i<cantidadInfo;i=i+3){
            var id = $("#informe p:eq("+i+")").text();
            var estado = $("#informe p:eq("+(i+1)+")").text();
            var notas = $("#informe p:eq("+(i+2)+")").text();
            console.log(id);
            if(id[0]=="C"){
                console.log(estado);
                if(estado == "Cancelada"){
                    actualizar("cambio_nota",nota,id,usuarioCell,"-");
                    actualizar("cambio_estado","En ruta",id.slice(1),usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizar("cambioitem_estado",idVentaItem,'En ruta',0,"-");//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Pendiente"){
                    actualizar("cambio_estado","En ruta",id.slice(1),usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                         actualizar("cambioitem_estado",idVentaItem,'En ruta',0,"-");//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Completada"){
                    actualizar("cambio_estado","Entregado sin informe",id.slice(1),usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizar("cambioitem_estado",idVentaItem,'Entregado sin informe',0,"-");//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
            }else{
                console.log(estado);
                if(estado == "Cancelada"){
                    actualizar("venta_nota",notas,id,usuarioCell,"-");
                    actualizar("venta_estado","En ruta",id,usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("En ruta",idVentaItem);
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Pendiente"){
                    actualizar("venta_estado","En ruta",id,usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("En ruta",idVentaItem);
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Completada"){
                    actualizar("venta_estado","Entregado sin informe",id,usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("Entregado sin informe",idVentaItem);
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
            }
        }
    });
    $('#infD').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'block');
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
    });
    $('#cargarInformeDineroButton').on('click', function(){
        var usuarioCell = $('#usuarioCell').attr("name");
        var cantidadInfo = $("#informeD p").length;
        for(var i = 3;i<cantidadInfo;i=i+3){
            var id = $("#informeD p:eq("+i+")").text();
            console.log(id);
            if(id[0]=="C" || id[0]=="c"){
                var recaudo = $("#informeD p:eq("+(i+1)+")").text();
                var excedente = obtenerData("excedente","con_t_cambios","row","cambio_id",id.slice(1));
                var clienteok = obtenerData("cliente_ok","con_t_cambios","row","cambio_id",id.slice(1));
                var idVenta = obtenerData("venta_id","con_t_cambios","row","cambio_id",id.slice(1));
                var clienteokVenta = obtenerData("cliente_ok","con_t_ventas","row","venta_id",idVenta);
                var items = obtenerData("complemento_estado,estado,codigo","con_t_trprendas","rowVarios","cual","V"+idVenta);
                var itemsCambio = obtenerData("complemento_estado,estado","con_t_trprendas","rowVarios","cual",id);
                var valorSalida = 0;
                var valor = 0;
                var itemsArray = items.split("%");
                var itemVentas = [];
                for(var j = 0;j < (itemsArray.length-1);j++){
                    var val = itemsArray[j].split("°");
                    if(val[3]=="Entregado"){
                        valor = obtenerData("valor","con_t_ventaitem","row","ordenitem_id",val[2]);
                        valorSalida = parseInt(valorSalida) + parseInt(valor);
                        itemVentas.push(val[4]);
                    }
                }
                var itemsCambioArray = itemsCambio.split("%");
                var itemCambios =[];
                for(var j = 0;j < (itemsCambioArray.length-1);j++){
                    var val = itemsCambioArray[j].split("°");
                    itemCambios.push(val[2]);
                }
                var ok = parseInt(excedente)-parseInt(recaudo);
                var dif = parseInt(clienteokVenta)+parseInt(ok)-parseInt(valorSalida);
                //alert("Pedido: "+id+" Precio ya pagado por el cliente: "+clienteokVenta+" Excedente - Recaudo: "+ok+" Valor de la prenda que sale: "+valorSalida+" Dif: "+dif);
                actualizar("cambio_clienteok",recaudo,id.slice(1),usuarioCell,"-");
                if(dif<0){//Al cliente le sobra
                    $("#informeD p:eq("+(i+2)+")").text("Para auditar");
                    actualizar("cambio_estado","Auditar",id.slice(1),usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizar("cambioitem_estado",idVentaItem,'Auditar',0,"-");//
                    }
                }if(dif==0){//Pedido ok
                    $("#informeD p:eq("+(i+4)+")").text("Pedido ok");
                    var prendasPedido = obtenerData("codigoshow,complemento_estado","con_t_trprendas","rowVarios","cual",id);//°C1145RB5D13S64°Diego 1°138%
                    //°C688CV403D900S149°Diego Rodríguez 2°24%
                    var items = obtenerData("estado,cambioitem_id","con_t_cambioitem","rowVarios","cambio_id",id.slice(1));//°5%°Despachado%
                    var itemArray = items.split("%");//°En ruta°24,
                    var prendas = prendasPedido.split("%");
                    //alert("itemVentas: "+itemVentas+" itemCambios: "+itemCambios+" prendas: "+prendas);
                    //itemVentas: 787 itemCambios: 24 prendas: °C688CV403D900S149°Diego Rodríguez 2°24,
                    //alert("itemVentas: "+itemVentas.length+" itemCambios: "+itemCambios.length+" prendas: "+prendas.length);
                    if((itemVentas.length != itemCambios.length) || (itemVentas.length != (prendas.length-1)) || ((prendas.length-1) != itemCambios.length)){
                        actualizar("cambio_estado","Auditar",id.slice(1),usuarioCell,"-");
                    }else{
                        actualizar("cambio_estado","Entregado",id.slice(1),usuarioCell,"-");
                        for(var v =0 ;v < (prendas.length-1); v++ ){
                            actualizar("cambioitem_estado",itemCambios[v],'Entregado',0,"-");
                            var prendaArray = prendas[v].split("°");
                            var prenda = prendaArray[1];
                            actualizarPrendas(usuarioCell+prendaArray[2]+"°"+prendaArray[3],"Entregado",id,prenda);//Entregar prendas de cambio
                           // alert(itemVentas);
                            actualizarPrendas("Informe","Prenda por volver","V"+idVentaItem,itemVentas[v]);
                        }
                    }                    
                }if(dif>0){//El cliente nos debe dinero
                    $("#informeD p:eq("+(i+2)+")").text("Faltan prendas");
                    actualizar("cambio_estado","Auditar",id.slice(1),usuarioCell,"-");
                }
            }else{
                var recaudo = $("#informeD p:eq("+(i+1)+")").text();
                actualizar("venta_clienteok",recaudo,id,usuarioCell,"-");//(tabla,columna,id,usuarioCell)
                //var resultado = verificarinforme(id,"venta");
                if(dif<0){
                    $("#informeD p:eq("+(i+2)+")").text("Para auditar");
                    actualizar("venta_estado","Auditar",id,usuarioCell,"-");
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("Auditar",idVentaItem);
                    }
                }if(dif==0){
                    $("#informeD p:eq("+(i+2)+")").text("Pedido ok");
                    var prendasPedido = obtenerData("codigoshow,complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°C1145RB5D13S64°Diego 1°138%
                    var items = obtenerData("prenda_id,valor,descuento_id,estado_id","con_t_ventaitem","rowVarios","venta_id",id);//°44°120000°0°5%°113°140000°0°Despachado%
                    var itemArray = items.split("%");
                    var precio = 0;
                    var cantidadItem = 0;
                    for(var h = 0; h<(itemArray.length-1);h++){
                        var item = itemArray[h].split("°");
                        if(item[4]!=5){
                            precio = precio + item[2];
                            cantidadItem = cantidadItem +1;
                        }
                    }
                    var prendas = prendasPedido.split("%");
                    if((prendas.length-1) == cantidadItem){
                        for(var v =0 ;v < (prendas.length-1); v++ ){
                            var prendaArray = prendas[v].split("°");
                            var prenda = prendaArray[1];
                            actualizar("venta_estado","Entregado",id,usuarioCell,"-");
                            actualizarPrendas(usuarioCell+prendaArray[2]+"°"+prendaArray[3],"Entregado","V"+id,prenda);
                            actualizarVentaitem("Entregado",prendaArray[3]);
                        }
                    }else{
                        for(var v =0 ;v < (prendas.length-1); v++ ){
                            var prenda = prendas[v].replace("°","");
                            actualizar("venta_estado","Auditar",id,usuarioCell,"-");
                        }
                    }
                }if(dif>0){
                    $("#informeD p:eq("+(i+2)+")").text("Faltan prendas");
                    actualizar("venta_estado","Auditar",id,usuarioCell,"-");
                }
            }
        }
    });
    $('#registrarCodigos').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'block');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'none');
        imrpimirinicialcodigos();
    });
    $('#fechaslotes').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');
        $('#madrugonDiv').css('display', 'none'); 
        $('#fechaslotesdiv').css('display', 'block');
        imrpimirlotes();
    });
    /********************** VENTAS VS INVENTARIO *******************************/
    $('#reviVentas').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');
        $('#ventasVSinventario').css('display', 'block');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');  
        $('#madrugonDiv').css('display', 'none'); 
        var prendasAjustar = obtenerData("fecha_creada,venta_id,cliente_ok,notas,estado","con_t_ventas","rowVarios","estado","Ajustar");
        //°2022-07-05 17:39:36°28°0°°Ajustar%
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='primeraFila'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>Estado</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Orden</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>Dinero registrado</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>Prendas fuera</p></div></div>";
        var arrayAjustar = prendasAjustar.split("%");
        for(var i = 0; i<(arrayAjustar.length-1);i++){
            var pedido = arrayAjustar[i].split("°");
            var codigos = obtenerData("codigoshow","con_t_trprendas","rowVarios","cual","V"+pedido[2]);//°C1145RB1D13S64%°C1145RB2D13S64%°C1145RB3D13S64%°C1145RB9D13S64%
            html =html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[3]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+codigos+"</p></div></div>";
        }
        var prendasAuditar = obtenerData("fecha_creada,venta_id,cliente_ok,notas,estado","con_t_ventas","rowVarios","estado","Auditar");
        //°2022-06-13 01:52:06°15°560000°°Auditar%
        var arrayAuditar = prendasAuditar.split("%");
        for(var i = 0; i<(arrayAuditar.length-1);i++){
            var pedido = arrayAuditar[i].split("°");
            var codigos = obtenerData("codigoshow","con_t_trprendas","rowVarios","cual","V"+pedido[2]);//°C1145RB1D13S64%°C1145RB2D13S64%°C1145RB3D13S64%°C1145RB9D13S64%
            html =html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[3]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+codigos+"</p></div></div>";
        }
        var informeAuditoriaz = $('#informeAuditoriaz');
    	informeAuditoriaz.append(html);
    });
    $('#tipoAuditoria').on('change', function() {
            $('.removerCodigos').remove();
            var usuarioCell = $('#usuarioCell').attr("name");
            var usuarioCellArray = usuarioCell.split(",");
            var resumen = auditprendas($('#bscar').val(),usuarioCellArray[0],usuarioCellArray[1],$('#tipoAuditoria').val());
            var arrayPrendas = resumen.split('&');
            var primeraFila = $('#primeraAuditoria');
            var html = imprimirCodigos(arrayPrendas);
            primeraFila.after(html);
    }); 
    $('#verLiberar').on('click', function(){   
        $('.remover').remove();
        $('.removerCodigos').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'block');  
        $('#madrugonDiv').css('display', 'none');  
        $('#fechaslotesdiv').css('display', 'none');      
    });    
    $('#liberarEmpaque').on('click', function(){   
        var codigo = $('#buscarempacado').val();      
        var resultado = liberarpaquete(codigo);
        $('#buscarempacado').val(0);
        alert(resultado);
    });
    $('#madrug').on('click', function(){   
        $('.remover').remove();
        $('.removerMadurgones').remove();
        $('.removerPMadurgones').remove();
        $('#codigosNuevos').css('display', 'none');
        $('#referenciaNueva').css('display', 'none');
        $('#resultados').css('display', 'none');
        $('#btnExport').css('display', 'none');
        $('#verCodigo').css('display', 'none');
        $('#verResumenprendas').css('display', 'none');
        $('#auditoriaInventario').css('display', 'none');
        $('#subirInformes').css('display', 'none');
        $('#informeDinero').css('display', 'none');         
        $('#ventasVSinventario').css('display', 'none');
        $('#inventarioInicialPc').css('display', 'none');
        $('#liberarEmpacados').css('display', 'none');  
        $('#madrugonDiv').css('display', 'block');  
        $('#fechaslotesdiv').css('display', 'none');
        $('#primeraMadrugones').css('display', 'block');
        $('#primeraPrendasMadrugones').css('display', 'none');
        var usuarioCell = $('#usuarioCell').attr("name");
        var usuarioCellArray = usuarioCell.split(",");
        var madrugones = madru();//principal.js      
        var madrugos = JSON.parse(madrugones);     
        var primeraFila = $('#primeraMadrugones');
        var html = imprimirMadrugones(madrugos);
    	primeraFila.after(html);
        inventario();
    }); 
    /****************CELULAR********************/
    /*************************** Ver resumen *******************************/
    $('#verResumenCell').on('click', function(){   
        $('#verResumenprendasCell').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var resumen = resumenprendas($('#bscar').val(),"0","0","0");
        var arrayPrendas = resumen.split('&');
        var verResumenprendasCell = $('#verResumenprendasCell');
        var html = imprimirResumenCell();//principal.js>>controlador.php
    	verResumenprendasCell.append(html);
    });
    /*************************** Inventario inicial *******************************/
    $('#inicialInventario').on('click', function() {
        $('#escanerInv').css('display', 'block');
        $('#inicialEscaner').css('display', 'block');
        $('#escanerInvInicial').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"inicialReader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanerInicialInv);
    });
    $('#enviarInicialEscaneados').on('click', function() {
        var prendasCantidad = ($('#escanerInvInicial p').length);
        var pr = "";
        for(var i = 0;i<prendasCantidad;i++){
            var prenda = $("#escanerInvInicial p:eq("+i+")").text();
            pr = pr+prenda+"°";
        }//C1145RB4D13S64°C1145RB7D13S64°
        inicialcaja(pr);
        $('.remover').remove();
    });    
    /*************************** Escaner terminados *******************************/
    $('#confirmarTerminados').on('click', function() {
        $('#escanerTermin').css('display', 'block');
        $('#funcionesEscanerTerminados').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerTerminados", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanearTerminados);
    });
    $('#enviarTerminados').on('click', function() {

        var prendasenviadasATerminados = 0;
        var noEnviados = '';
        var banderaTerminados  = 0;
        
        var usuarioLevel = $('#usuarioCell').attr('name');
        var usuarioLevelArray = usuarioLevel.split(",");
        
        prendasEviadasATerminados = [];
        var notificacionEnviaraTerminados = 'Se confirma que se terminan las siguientes prendas: ';

        
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "cual_cambio";
        objeto.valor = usuarioLevelArray[1];
        var cual_cambio = prepararjson(objeto);

        
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "usuario_id";
        objeto.valor = usuarioLevelArray[0];
        var usuario_id = prepararjson(objeto);

        
        const fechaActual = new Date();

        // Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        const hora = String(fechaActual.getHours()).padStart(2, '0');
        const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
        const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

        // Construir la cadena de fecha y hora en el formato deseado
        var fechaActuall  = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_cambio";
        objeto.valor = fechaActuall;
        var fecha_cambio  = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_terminado";
        objeto.valor = fechaActuall;
        var fecha_terminado  = prepararjson(objeto);

        var estadoNuevoJ = obtenerDatajson("estado","con_t_estadoprendas","valoresconcondicion","ID",`${usuarioLevelArray[0]}`);
    	var estadoNuevoA = JSON.parse(estadoNuevoJ); 
        var estadoNuevo = estadoNuevoA[0].estado;

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "cual";
        objeto.valor = usuarioLevelArray[1];
        var cual  = prepararjson(objeto);

        
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = estadoNuevo;
        var estado  = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado_cambio";
        objeto.valor = estadoNuevo;
        var estado_cambio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "terminado";
        objeto.valor = 1;
        var terminado = prepararjson(objeto);

        for (let i = 0; i < datosPrendaActuales.length; i++) {
            
            var terminadoEstadoJ = obtenerDatajson("terminado","con_t_terminados","valoresconcondicion","codigo",`'${datosPrendaActuales[i].codigo}'`);
            let terminadoEstadoA = JSON.parse(terminadoEstadoJ); 

            if(terminadoEstadoA.length == 0){continue;}
            if(terminadoEstadoA[0].terminado==1){continue;}


            prendasenviadasATerminados++;

            //  con_t_terminados	codigo 	terminado 	fecha_terminado 	
            var objeto = {};
            objeto.columna = "codigo";
            objeto.valor = `'${datosPrendaActuales[i].codigo}'`;
            var condicion = prepararjson(objeto);

            actualizarregistros("con_t_terminados",condicion,terminado,fecha_terminado,"0","0","0","0","0","0","0","0","0");

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prenda_id";
            objeto.valor = datosPrendaActuales[i].codigo;
            var prenda_id = prepararjson(objeto);           

            insertarfila("con_t_estadostr",prenda_id,estado_cambio,cual_cambio,usuario_id,"0","0","0","0","0","0","0");
            

            actualizarregistros("con_t_trprendas",condicion,estado,fecha_cambio,cual,"0","0","0","0","0","0","0","0");

            notificacionEnviaraTerminados = `${notificacionEnviaraTerminados} ${datosPrendaActuales[i].codigoshow}`;
            prendasEviadasATerminados.push(notificacionEnviaraTerminados);
        }
        if(prendasEviadasATerminados.legth > 0){
            notificacionEnviaraTerminados=`${notificacionEnviaraTerminados}. El total de prendas enviadas a terminados fueron ${prendasenviadasATerminados}.
            Las prendas ausentes en esta lista aún no se habían registrado para la fase de terminado, o bien no requerían de esta etapa o ya habían sido registradas en días anteriores.`;
            const textoCodificado = encodeURIComponent(notificacionEnviaraTerminados.replace(/No aplica/g,""));
            var url = `https://wa.me/573017209186?text=${textoCodificado}`;

            window.open(url, '_blank');
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`${notificacionEnviaraTerminados}`); 
        }
    });
    /*************************** Escaner inventario *******************************/
    $('#escanearInventario').on('click', function() {
        $('#escanerInv').css('display', 'block');
        $('#funcionesEscaner').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanearInventa);
    });
    $('#enviarEscaneados').on('click', function() {
        var escaneadosData = $('#escanerInv').text();
        var noEnviados = '';
        var banderaTerminados  = 0;

        var escaneadosEnviar = escaneadosData.replace(" ","");
        var usuarioLevel = $('#usuarioCell').attr('name');
        var usuarioLevelArray = usuarioLevel.split(",");
        var estadoNuevoJ = obtenerDatajson("estado","con_t_estadoprendas","valoresconcondicion","ID",`${usuarioLevelArray[0]}`);
    	let estadoNuevoA = JSON.parse(estadoNuevoJ); 
        if(usuarioLevelArray[0] == 1){
            estadoNuevoA[0].estado = 'En Plaza de las américas'
        }
        prendasEviadasATerminados = [];
        var notificacionEnviaraTerminados = 'Se enviaron a terminados las siguientes prendas: ';
        for (let i = 0; i < datosPrendaActuales.length; i++) {
            var estadoNuevo = estadoNuevoA[0].estado;

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prenda_id";
            objeto.valor = datosPrendaActuales[i].codigo;
            var prenda_id = prepararjson(objeto);

            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cual_cambio";
            objeto.valor = usuarioLevelArray[1];
            var cual_cambio = prepararjson(objeto);

            var objeto = {};
            objeto.columna = "codigo";
            objeto.valor = `'${datosPrendaActuales[i].codigo}'`;
            var condicion = prepararjson(objeto);
            
            if((datosPrendaActuales[i].terminado == 1)){
                
                var terminadoEstadoJ = obtenerDatajson("terminado","con_t_terminados","valoresconcondicion","codigo",`'${datosPrendaActuales[i].codigo}'`);
    	        let terminadoEstadoA = JSON.parse(terminadoEstadoJ); 

                if(terminadoEstadoA.length == 0){
                     //  con_t_terminados	codigo 	terminado 	fecha_terminado 	
                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "codigo";
                    objeto.valor = datosPrendaActuales[i].codigo;
                    var codigo = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = "int";
                    objeto.columna = "terminado";
                    objeto.valor = 0;
                    var terminado = prepararjson(objeto);

                    insertarfila("con_t_terminados",codigo,terminado,"0","0","0","0","0","0","0","0","0");

                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "estado_cambio";
                    objeto.valor = 'En terminados';
                    var estado_cambio = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = "int";
                    objeto.columna = "usuario_id";
                    objeto.valor = usuarioLevelArray[0];
                    var usuario_id = prepararjson(objeto);

                    insertarfila("con_t_estadostr",prenda_id,estado_cambio,cual_cambio,usuario_id,"0","0","0","0","0","0","0");
                    

                    estadoNuevo = 'En terminados';   
                    
                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "estado";
                    objeto.valor = estadoNuevo;
                    var estado  = prepararjson(objeto);
                    
                    const fechaActual = new Date();

                    // Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
                    const anio = fechaActual.getFullYear();
                    const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
                    const dia = String(fechaActual.getDate()).padStart(2, '0');
                    const hora = String(fechaActual.getHours()).padStart(2, '0');
                    const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
                    const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

                    // Construir la cadena de fecha y hora en el formato deseado
                    var fechaActuall  = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;

                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "fecha_cambio";
                    objeto.valor = fechaActuall;
                    var fecha_cambio  = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = "string";
                    objeto.columna = "cual";
                    objeto.valor = usuarioLevelArray[1];
                    var cual  = prepararjson(objeto);

                    actualizarregistros("con_t_trprendas",condicion,estado,fecha_cambio,cual,"0","0","0","0","0","0","0","0");

                    notificacionEnviaraTerminados = `${notificacionEnviaraTerminados} ${datosPrendaActuales[i].codigoshow}`;
                    prendasEviadasATerminados.push(datosPrendaActuales[i]);  
                    
                    continue;
                }
                if(terminadoEstadoA[0].terminado==0){
                    
                    noEnviados = `${noEnviados} ${datosPrendaActuales[i].codigo}`;
                    banderaTerminados = 1;
                    continue;
                }

            }

            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado_cambio";
            objeto.valor = 'En terminados';
            var estado_cambio = prepararjson(objeto);

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioLevelArray[0];
            var usuario_id = prepararjson(objeto);

            insertarfila("con_t_estadostr",prenda_id,estado_cambio,cual_cambio,usuario_id,"0","0","0","0","0","0","0");
            
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = estadoNuevo;
            var estado  = prepararjson(objeto);
            
            const fechaActual = new Date();

            // Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
            const anio = fechaActual.getFullYear();
            const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
            const dia = String(fechaActual.getDate()).padStart(2, '0');
            const hora = String(fechaActual.getHours()).padStart(2, '0');
            const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
            const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

            // Construir la cadena de fecha y hora en el formato deseado
            var fechaActuall  = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;

            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "fecha_cambio";
            objeto.valor = fechaActuall;
            var fecha_cambio  = prepararjson(objeto);

            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cual";
            objeto.valor = usuarioLevelArray[1];
            var cual  = prepararjson(objeto);
            
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "complemento_estado";
            objeto.valor = usuarioLevelArray[2];
            var complemento_estado  = prepararjson(objeto);

            actualizarregistros("con_t_trprendas",condicion,estado,fecha_cambio,cual,complemento_estado,"0","0","0","0","0","0","0");
        }
        var escaneados = $('.removerEscaneadosP');
        escaneados.remove();
        datosPrendaActuales = [];

        if(prendasEviadasATerminados.length > 0){
             const textoCodificado = encodeURIComponent(notificacionEnviaraTerminados.replace(/No aplica/g,""));
            var url = `https://wa.me/573017209186?text=${textoCodificado}`; 
            window.open(url, '_blank');
        }
       

       
        if(banderaTerminados == 1){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`
                La prendas con los códigos ${noEnviados} no pueden ser escaneadas en este momento, 
                ya que se encuentran en la etapa de terminados. 
                Por favor, dirígete a la sección de "Terminados" para escanear las prendas y confirmar que han sido completadas.`
            ); 
        }
        

    });
    /*************************** Empacar *******************************/
    $('#empacar').on('click', function() {
        $('#escanerEmpaques').css('display', 'block');
        $('#funcionesEmpacar').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerEmpacar", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanearEmpacar);//function escanearEmpacar(decodedText, decodedResult) ***** principal.js, renderizamos la función escanearEmpacar 
    });
    $('#enviarEmpacados').on('click', function() {
        var usuarioLevel = $('#usuarioCell').attr('name');
        var ventaId =  $('#escanerEmpaques').attr("name");
        var prendasCantidad = ($('#funcionesEmpacar p').length-1)/2;
        var codigosPrendas = "";
        var idItems = "";
        var flag = 0;
        for(var i = 1; i<=prendasCantidad;i++){
            var pp = i*2;
            var nam = $("#funcionesEmpacar p:eq("+pp+")").attr("name");
            if(nam=="Sin empacar"){
                flag = 1;
                alert("Hay items del pedido sin prendas asignadas");
            }else{
                codigosPrendas = codigosPrendas+"°"+$("#funcionesEmpacar p:eq("+pp+")").attr("name");
                idItems = idItems+"°"+$("#funcionesEmpacar p:eq("+pp+")").attr("id");
            }
        }
        if(flag==0){
            var data = usuarioLevel+"%"+ventaId+"%"+codigosPrendas+"%"+idItems;//10,Diego,1%29%°C1145RB2D13S64°C1145RB9D13S64%°106°98
            if(ventaId[0] == "C"){
                actualizar("cambio_estado","Empacado",ventaId.slice(1),usuarioLevel,"-");//$tabla,$columna,$valor,$valor2
                var codigosArray = codigosPrendas.split("°");
                var idItemsArray = idItems.split("°");
                for(var i = 1; i<codigosArray.length;i++){
                    actualizarPrendas(usuarioLevel+"°"+idItemsArray[i],"Empacado",ventaId,codigosArray[i]);//$valor="10,Diego,1";$valor2="Empacado";$valor3=29;$valor4="C1132AO6D20S2";
                } 
            }else{
                actualizar("venta_estado","Empacado",ventaId,usuarioLevel,codigosPrendas);//$tabla,$columna,$valor,$valor2
                var codigosArray = codigosPrendas.split("°");
                var idItemsArray = idItems.split("°");
                for(var i = 1; i<codigosArray.length;i++){
                    actualizarPrendas(usuarioLevel+"°"+idItemsArray[i],"Empacado","V"+ventaId,codigosArray[i]);//$valor="10,Diego,1";$valor2="Empacado";$valor3=29;$valor4="C1132AO6D20S2";
                }
            }        
            $('#escanerEmpaques').css('display', 'block');
            $('#funcionesEmpacar').css('display', 'none');
            $('#readerPrendaEmpacada__dashboard_section_csr button:eq(1)').click();
            $('#readerEmpacar__scan_region').css('display', 'block');
            $('#readerEmpacar__dashboard').css('display', 'block');
            $('#barraCelu').css('display', 'block');
            $('#escanerEmpaques').text("");
            $('#escanerEmpaques').attr("name","");
             var html5QrcodeScanner = new Html5QrcodeScanner(
        	"readerEmpacar", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(escanearEmpacar);//function escanearEmpacar(decodedText, decodedResult) ***** principal.js, renderizamos la función escanearEmpacar
            $('#enviarEmpacados').css('display', 'none');
            $('#readerPrendaEmpacada').css('display', 'none');
            $('.removerPrendasemp').remove();
        }
    });
     /*************************** Despachar *******************************/
     $('#despachar').on('click', function() {
        $('#barraCelu').css('display', 'none');
        $('#escanerDespachos').css('display', 'block');
        $('#funcionesDespachar').css('display', 'block');
        $('#confirmarDespacho').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerDespachar", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(readerDespachar);//function escanearEmpacar(decodedText, decodedResult) ***** principal.js, renderizamos la función escanearEmpacar 
    });
    $('#confirmarDespachoButton').on('click',function() {
        var usuarioLevel = $('#usuarioCell').attr('name');
        var ventaId = $('#escanerDespachos').attr("name");
        var codigos = "";
        if(ventaId[0] == "C"){
            codigos = obtenerData("codigoshow,estado","con_t_trprendas","rowVarios","cual",ventaId);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
        }else{
            codigos = obtenerData("codigoshow,estado","con_t_trprendas","rowVarios","cual","V"+ventaId);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
        }             
        var codigosArray = codigos.split("%");
        if(ventaId[0] == "C"){
            actualizar("cambio_estado","Despachado",ventaId.slice(1),usuarioLevel,"-");//$tabla,$columna,$valor,$valor2
            for(var i = 0;i<(codigosArray.length-1);i++){
                var codigoPrendaArray = codigosArray[i].split("°");
                if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
                    var codigoPrenda = codigoPrendaArray[1];
                    var name = $("#funcionesDespachar p:eq("+(i+1)+")").attr("name");
                    actualizarPrendas(usuarioLevel+"°"+name,"Despachado",ventaId,codigoPrenda);
                }
            }

        }else{
            var codigoscosito = codigos.replace("%","°");
            actualizar("venta_estado","Despachado",ventaId,usuarioLevel,codigoscosito);//$tabla,$columna,$valor,$valor2
            for(var i = 0;i<(codigosArray.length-1);i++){
                var codigoPrendaArray = codigosArray[i].split("°");
                if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
                    var codigoPrenda = codigoPrendaArray[1];
                    var name = $("#funcionesDespachar p:eq("+(i+1)+")").attr("name");
                    actualizarPrendas(usuarioLevel+"°"+name,"Despachado","V"+ventaId,codigoPrenda);
                }
            }
        }
        
        $('#escanerDespachos').text("Pedido: ");
        $('#escanerDespachos').attr("name","");
        $('.removerPrendasdesp').remove();
    });
    /*************************** Enviar dañado *******************************/
    $('#enviarDanado').on('click', function() {
        $('#escanerDan').css('display', 'block');
        $('#funcionesDan').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerDan", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanearDanados);//esta función esta en Principal.js
    });
    $('#enviarDan').on('click', function() {    
        //var escaneadosData = $('#escanerDan').text();
        var cantidadInfo = $("#escanerDan p").length;
        var flag = 0;        
        var codigos = [];
        var escaneadosEnviar = "";
        var inventario = "";
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#escanerDan p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
                var idref = obtenerDatajson("referencia_id,estado","con_t_trprendas","valoresconcondicion","codigo","'"+id+"'");
                var jsonidref = JSON.parse(idref); 
                if(jsonidref[0]['estado'] != 'Dañada'){
                    inventario=inventario+jsonidref[0]['referencia_id']+",";
                }
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var usuarioArray = usuarioLevel.split(",");
        cambiarEstadoprenda(escaneadosEnviar,16,usuarioArray[1],usuarioArray[2]);
        restarInventario(inventario);
        $('.removerr').remove();
    });
    /*************************** Venta plaza *******************************/
    $('#ventaPlaza').on('click', function() {
        $('#funcionesVentaplaza').css('display', 'block');
        $('#ventaPlazaenviar').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerVentaplaza", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanerventaplaza);//esta función esta en Principal.js
    });
    $('#ventaEnviar').on('click', function() {    
        //var escaneadosData = $('#escanerDan').text();
        var cantidadInfo = $("#ventaPlazaenviar p").length;
        var flag = 0;        
        var codigos = [];
        var escaneadosEnviar = "";
        var inventario = "";
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#ventaPlazaenviar p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
                var idref = obtenerDatajson("referencia_id,estado","con_t_trprendas","valoresconcondicion","codigo","'"+id+"'");
                var jsonidref = JSON.parse(idref); 
                if(jsonidref[0]['estado'] != 'Dañada'){
                    inventario=inventario+jsonidref[0]['referencia_id']+",";
                }
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var pa = $('#pavender').val();  
        var usuarioArray = usuarioLevel.split(",");
        if(pa){               
            cambiarEstadoprenda(escaneadosEnviar,17,'PA-'+pa,usuarioArray[1]);
            restarInventario(inventario);
            $('.removerr').remove();            
            alert('Vendido(s): PA-'+pa); 
        }else{alert('Por favor ingresa el PA de la venta');}
    });
     /*************************** Enviar madrugón *******************************/
     $('#enviarMadrugon').on('click', function() {
        $('#escanerMadru').css('display', 'block');
        $('#funcionesMadru').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerDan", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanearmarugon);//esta función esta en Principal.js
    });
    $('#enviarMadru').on('click', function() {    
        //var escaneadosData = $('#escanerDan').text();
        var cantidadInfo = $("#escanerMadru p").length;
        var flag = 0;        
        var codigos = [];
        var escaneadosEnviar = "";
        var inventario = "";
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#escanerMadru p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
                var idref = obtenerDatajson("referencia_id,estado","con_t_trprendas","valoresconcondicion","codigo","'"+id+"'");
                var jsonidref = JSON.parse(idref); 
                if(jsonidref[0]['estado'] != 'Dañada'){
                    inventario=inventario+jsonidref[0]['referencia_id']+",";
                }
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var usuarioArray = usuarioLevel.split(",");
        cambiarEstadoprenda(escaneadosEnviar,18,usuarioArray[1],usuarioArray[2]);
        restarInventario(inventario);
        $('.removerr').remove();
    });
    /*************************** Venta mayorista *******************************/
    $('#ventaMayorista').on('click', function() {
        $('#funcionesVetamayorista').css('display', 'block');
        $('#ventaMayoristaenviar').css('display', 'block');
        $('#botonesEscaner').css('display', 'none');
        var html5QrcodeScanner = new Html5QrcodeScanner(
    	"readerVentamayorista", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(escanerventamayorista);//esta función esta en Principal.js
    });
    $('#ventaEnviarMayorista').on('click', function() {    
        //var escaneadosData = $('#escanerDan').text();
        var cantidadInfo = $("#ventaMayoristaenviar p").length;
        var flag = 0;        
        var codigos = [];
        var escaneadosEnviar = "";
        var inventario = "";
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#ventaMayoristaenviar p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
                var idref = obtenerDatajson("referencia_id,estado","con_t_trprendas","valoresconcondicion","codigo","'"+id+"'");
                var jsonidref = JSON.parse(idref); 
                if(jsonidref[0]['estado'] != 'Dañada'){
                    inventario=inventario+jsonidref[0]['referencia_id']+",";
                }
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var pa = $('#vmvender').val();  
        var usuarioArray = usuarioLevel.split(",");
        if(pa){               
            cambiarEstadoprenda(escaneadosEnviar,19,'VM-'+pa,usuarioArray[1]);
            restarInventario(inventario);
            $('.removerr').remove();            
            alert('Vendido(s): VM-'+pa); 
        }else{alert('Por favor ingresa el VM de la venta');}
    });
})

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
	$('#datetimepicker-filtroNuevoinv').datetimepicker({
		format: 'L'
	});
	
</script>
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>