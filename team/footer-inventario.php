<?php get_template_part('generalfooter'); ?>
//<script>
    var permisoInventario = permisosInventario();
    var botonesEscaner = $('#botonesEscaner');
    botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion01'><button class='botonmodal' type='button' id='inicialInventario'>Inventario inicial</button></div>");
    var segundo = $('#segundo');
    segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion1'><button class='botonmodal botonesInventario' type='button' id='registrarCodigos'>Inventario inicial </button></div>");
    var items = permisoInventario.split(',');
    for(i=1;i<items.length;i++){
        if(items[i]==17){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion17'><button class='botonmodal botonesInventario' type='button' id='crearReferencia'>Referencia nueva </button></div>");
        }if(items[i]==19){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion19'><button class='botonmodal botonesInventario' type='button' id='crearCodigos'>Crear códigos</button></div>");
        }if(items[i]==20){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion20'><button class='botonmodal' type='button' id='escanearInventario'>Escanear inventario</button></div>");
        }if(items[i]==21){
            var botonesEscaner = $('#botonesEscaner');
            botonesEscaner.append("<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='accion21'><button class='botonmodal' type='button' id='empacar'>Empacar</button></div>");
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
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion31'><button class='botonmodal botonesInventario' type='button' id='lym'>Lonas y madrugón</button></div>");
        }if(items[i]==32){
            var fechaAudito = $('#fechaAudito');
            var fechaInventario = obtenerData("fecha","con_t_auditoriasinventario","row","ID",fechaAudito.attr("name"));
            fechaAudito.append("<p class='removFecha'>Fecha de la auditoría actual: "+fechaInventario+"</p>");
        }if(items[i]==33){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion33'><button class='botonmodal botonesInventario' type='button' id='Sinf'>Subir informe</button></div>");
        }if(items[i]==34){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion34'><button class='botonmodal botonesInventario' type='button' id='infD'>Informe de dinero</button></div>");
        }if(items[i]==35){
            var segundo = $('#segundo');
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion35'><button class='botonmodal botonesInventario' type='button' id='reviVentas'>Ventas vs inventario</button></div>");
        }if(items[i]==36){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion36'><button class='botonmodal' type='button' id='enviarDanado'>Enviar dañados</button></div>");
        }if(items[i]==37){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion37'><button class='botonmodal' type='button' id='ventaPlaza'>Venta plaza</button></div>");
        }if(items[i]==38){
            var segundo = $('#botonesEscaner');
            segundo.append("<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='accion38'><button class='botonmodal' type='button' id='ventaMayorista'>Venta mayorista</button></div>");
        }
    }
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
    $('#guardarReferencia').on('click', function() {
        var nombre = $('#nombreReferencia').val();
        var color = $('#colorReferencia').val();
        var talla = $('#tallaReferencia').val();
        var detal = $('#precioDetal').val();
        var mayor = $('#precioMayor').val();
        var categoria = $('#categoria').val();
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
        var codigosprenda = codigosprendas($('#bscar').val(),"0","0","0");
        var arrayPrendas = codigosprenda.split('&');
        var primeraFila = $('#primeraFila');
        var html = imprimirCodigos(arrayPrendas);
    	primeraFila.after(html);
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
        var resumen = resumenprendas($('#bscar').val(),"0","0","0");
        var arrayPrendas = resumen.split('&');
        var primeraFila = $('#primeraFilaResumen');
        var html = imprimirResumen(arrayPrendas);
    	primeraFila.after(html);
    });
    $('#auditInvent').on('click', function(){   
        $('.remover').remove();
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
    });
    $('#cargarInforme').on('click', function(){ 
        var usuarioCell = $('#usuarioCell').attr("name");
        var cantidadInfo = $("#informe p").length;
        for(var i = 3;i<cantidadInfo;i=i+3){
            var id = $("#informe p:eq("+i+")").text();
            var estado = $("#informe p:eq("+(i+1)+")").text();
            var notas = $("#informe p:eq("+(i+2)+")").text();
            if(id[0]=="C"){
                if(estado == "Cancelada"){
                    actualizar("cambio_nota",nota,id,usuarioCell);
                    actualizar("cambio_estado","En ruta",id.slice(1),usuarioCell);
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizar("cambioitem_estado",idVentaItem,'En ruta',0);//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Pendiente"){
                    actualizar("cambio_estado","En ruta",id.slice(1),usuarioCell);
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                         actualizar("cambioitem_estado",idVentaItem,'En ruta',0);//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
                if(estado == "Completada"){
                    actualizar("cambio_estado","Entregado sin informe",id.slice(1),usuarioCell);
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual",id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizar("cambioitem_estado",idVentaItem,'Entregado sin informe',0);//
                    }
                    $("#informe p:eq("+(i+2)+")").css('color', 'green');
                }
            }else{
                if(estado == "Cancelada"){
                    actualizar("venta_nota",notas,id,usuarioCell);
                    actualizar("venta_estado","En ruta",id,usuarioCell);
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
                    actualizar("venta_estado","En ruta",id,usuarioCell);
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
                    actualizar("venta_estado","Entregado sin informe",id,usuarioCell);
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
    });
    $('#cargarInformeDineroButton').on('click', function(){
        var usuarioCell = $('#usuarioCell').attr("name");
        var cantidadInfo = $("#informeD p").length;
        for(var i = 3;i<cantidadInfo;i=i+3){
            var id = $("#informeD p:eq("+i+")").text();
            if(id[0]=="C"){
                var recaudo = $("#informeD p:eq("+(i+1)+")").text();
                var excedente = obtenerData("excedente","con_t_cambios","row","cambio_id",id.slice(1));
                var clienteok = obtenerData("cliente_ok","con_t_cambios","row","cambio_id",id.slice(1));
                var idVenta = obtenerData("venta_id","con_t_cambios","row","cambio_id",id.slice(1));
                var clienteokVenta = obtenerData("cliente_ok","con_t_ventas","row","venta_id",idVenta);
                var items = obtenerData("prenda_idsale","con_t_cambioitem","rowVarios","ventainicial_id",idVenta);
                //°117%
                var valorSalida = 0;
                var itemsArray = items.split("%");
                alert(itemArray);
                for(var i = 0;i < itemsArray.length;i++){
                    var val = itemsArray[i].split("°");
                    var valor = obtenerData("precio_detal","con_t_resumen","row","referencia_id",val[1]);
                    alert(parseInt(valor)+1);
                    alert(valorSalida);
                    valorSalida = parseInt(valorSalida) + parseInt(valor);
                }
                alert(valorSalida);
                /*var ok = parseInt(excedente)-parseInt(recaudo);
                var dif = parseInt(clienteokVenta)+parseInt(recaudo)-parseInt(clienteok)+parseInt(recaudo);
                //alert("Pedido: "+id+" Precio: "+precio+" Clienteok: "+clienteok+" Recaudo: "+recaudo+" Dif: "+dif);
                if(dif<0){
                    $("#informeD p:eq("+(i+2)+")").text("Para auditar");
                    actualizar("venta_estado","Auditar",id,usuarioCell);
                    actualizar("venta_clienteok",recaudo,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("Auditar",idVentaItem);
                    }
                }if(dif==0){
                    $("#informeD p:eq("+(i+2)+")").text("Pedido ok");
                    var prendasPedido = obtenerData("codigo,complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°C1145RB5D13S64°Diego 1°138%
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
                            actualizar("venta_estado","Entregado",id,usuarioCell);
                            actualizar("venta_estado","Entregado",id,usuarioCell);
                            actualizarPrendas(usuarioCell+prendaArray[2]+"°"+prendaArray[3],"Entregado","V"+id,prenda);
                            actualizar("venta_clienteok",recaudo,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                            actualizarVentaitem("Entregado",prendaArray[3]);
                        }
                    }else{
                        for(var v =0 ;v < (prendas.length-1); v++ ){
                            var prenda = prendas[v].replace("°","");
                            actualizar("venta_estado","Auditar",id,usuarioCell);
                            actualizar("venta_estado","Auditar",id,usuarioCell);
                            actualizar("venta_clienteok",recaudo+clienteok,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                        }
                    }
                }if(dif>0){
                    $("#informeD p:eq("+(i+2)+")").text("Faltan prendas");
                    actualizar("venta_estado","Ajustar",id,usuarioCell);
                    actualizar("venta_estado","Ajustar",id,usuarioCell);
                }*/
            }else{
                var recaudo = $("#informeD p:eq("+(i+1)+")").text();
                var pedido = obtenerData("pedido","con_t_ventas","row","venta_id",id);
                var clienteok = obtenerData("cliente_ok","con_t_ventas","row","venta_id",id);
                var pedidoArray = pedido.split("%");
                var precio = pedidoArray[1];
                var dif = parseInt(precio)-parseInt(clienteok)-parseInt(recaudo);
                //alert("Pedido: "+id+" Precio: "+precio+" Clienteok: "+clienteok+" Recaudo: "+recaudo+" Dif: "+dif);
                if(dif<0){
                    $("#informeD p:eq("+(i+2)+")").text("Para auditar");
                    actualizar("venta_estado","Auditar",id,usuarioCell);
                    actualizar("venta_clienteok",recaudo,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                    var cualVentaItem = obtenerData("complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°Diego 1°137%°Diego 1°138%
                    var cualArry = cualVentaItem.split("%");
                    for(var j = 0;j<(cualArry.length-1);j++){
                        var idVentaItmeArray = cualArry[j].split("°");
                        var idVentaItem = idVentaItmeArray[2];
                        actualizarVentaitem("Auditar",idVentaItem);
                    }
                }if(dif==0){
                    $("#informeD p:eq("+(i+2)+")").text("Pedido ok");
                    var prendasPedido = obtenerData("codigo,complemento_estado","con_t_trprendas","rowVarios","cual","V"+id);//°C1145RB5D13S64°Diego 1°138%
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
                            actualizar("venta_estado","Entregado",id,usuarioCell);
                            actualizar("venta_estado","Entregado",id,usuarioCell);
                            actualizarPrendas(usuarioCell+prendaArray[2]+"°"+prendaArray[3],"Entregado","V"+id,prenda);
                            actualizar("venta_clienteok",recaudo,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                            actualizarVentaitem("Entregado",prendaArray[3]);
                        }
                    }else{
                        for(var v =0 ;v < (prendas.length-1); v++ ){
                            var prenda = prendas[v].replace("°","");
                            actualizar("venta_estado","Auditar",id,usuarioCell);
                            actualizar("venta_estado","Auditar",id,usuarioCell);
                            actualizar("venta_clienteok",recaudo+clienteok,id,usuarioCell);//(tabla,columna,id,usuarioCell)
                        }
                    }
                }if(dif>0){
                    $("#informeD p:eq("+(i+2)+")").text("Faltan prendas");
                    actualizar("venta_estado","Ajustar",id,usuarioCell);
                    actualizar("venta_estado","Ajustar",id,usuarioCell);
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
        imrpimirinicialcodigos();
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
        var prendasAjustar = obtenerData("fecha_creada,venta_id,cliente_ok,notas,estado","con_t_ventas","rowVarios","estado","Ajustar");
        //°2022-07-05 17:39:36°28°0°°Ajustar%
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='primeraFila'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>Estado</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>Orden</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>Dinero registrado</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>Prendas fuera</p></div></div>";
        var arrayAjustar = prendasAjustar.split("%");
        for(var i = 0; i<(arrayAjustar.length-1);i++){
            var pedido = arrayAjustar[i].split("°");
            var codigos = obtenerData("codigo","con_t_trprendas","rowVarios","cual","V"+pedido[2]);//°C1145RB1D13S64%°C1145RB2D13S64%°C1145RB3D13S64%°C1145RB9D13S64%
            html =html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[3]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+codigos+"</p></div></div>";
        }
        var prendasAuditar = obtenerData("fecha_creada,venta_id,cliente_ok,notas,estado","con_t_ventas","rowVarios","estado","Auditar");
        //°2022-06-13 01:52:06°15°560000°°Auditar%
        var arrayAuditar = prendasAuditar.split("%");
        for(var i = 0; i<(arrayAuditar.length-1);i++){
            var pedido = arrayAuditar[i].split("°");
            var codigos = obtenerData("codigo","con_t_trprendas","rowVarios","cual","V"+pedido[2]);//°C1145RB1D13S64%°C1145RB2D13S64%°C1145RB3D13S64%°C1145RB9D13S64%
            html =html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[5]+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+pedido[3]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 remover'><p class='letra18pt-pc negrillaUno'>"+codigos+"</p></div></div>";
        }
        var informeAuditoriaz = $('#informeAuditoriaz');
    	informeAuditoriaz.append(html);
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
        alert(escaneadosData);
        var escaneadosEnviar = escaneadosData.replace(" ","");
        var usuarioLevel = $('#usuarioCell').attr('name');
        var data = escaneadosEnviar+usuarioLevel;
        enviarInventario(data);
        var escaneados = $('#escanerInv');
        escaneados.text(" ");
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
                actualizar("cambio_estado","Empacado",ventaId.slice(1),usuarioLevel);//$tabla,$columna,$valor,$valor2
                var codigosArray = codigosPrendas.split("°");
                var idItemsArray = idItems.split("°");
                for(var i = 1; i<codigosArray.length;i++){
                    actualizar("cambioitem_estado",idItemsArray[i],'Empacado',0);//
                    actualizarPrendas(usuarioLevel+"°"+idItemsArray[i],"Empacado",ventaId,codigosArray[i]);//$valor="10,Diego,1";$valor2="Empacado";$valor3=29;$valor4="C1132AO6D20S2";
                } 
            }else{
                actualizar("venta_estado","Empacado",ventaId,usuarioLevel);//$tabla,$columna,$valor,$valor2
                var codigosArray = codigosPrendas.split("°");
                var idItemsArray = idItems.split("°");
                for(var i = 1; i<codigosArray.length;i++){
                    actualizarVentaitem("Empacado",idItemsArray[i]);
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
            codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual",ventaId);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
        }else{
            codigos = obtenerData("codigo,estado","con_t_trprendas","rowVarios","cual","V"+ventaId);//°C1145RB10D13S64°Despachado%°C1160RL1D15S14°Despachado%
        }             
        var codigosArray = codigos.split("%");
        if(ventaId[0] == "C"){
            actualizar("cambio_estado","Despachado",ventaId.slice(1),usuarioLevel);//$tabla,$columna,$valor,$valor2
            for(var i = 0;i<(codigosArray.length-1);i++){
                var codigoPrendaArray = codigosArray[i].split("°");
                if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
                    var codigoPrenda = codigoPrendaArray[1];
                    var name = $("#funcionesDespachar p:eq("+(i+1)+")").attr("name");
                    actualizarPrendas(usuarioLevel+"°"+name,"Despachado",ventaId,codigoPrenda);
                    actualizar("cambioitem_estado",name,'Despachado',0);//
                }
            }

        }else{
            actualizar("venta_estado","Despachado",ventaId,usuarioLevel);//$tabla,$columna,$valor,$valor2
            for(var i = 0;i<(codigosArray.length-1);i++){
                var codigoPrendaArray = codigosArray[i].split("°");
                if((codigoPrendaArray[2] == "Empacado") || (codigoPrendaArray[2] == "Despachado")){
                    var codigoPrenda = codigoPrendaArray[1];
                    var name = $("#funcionesDespachar p:eq("+(i+1)+")").attr("name");
                    actualizarPrendas(usuarioLevel+"°"+name,"Despachado","V"+ventaId,codigoPrenda);
                    actualizarVentaitem("Despachado",name);
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
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#escanerDan p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var usuarioArray = usuarioLevel.split(",");
        cambiarEstadoprenda(escaneadosEnviar,16,usuarioArray[1],usuarioArray[2]);
        restarInventario(escaneadosEnviar);
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
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#ventaPlazaenviar p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var pa = $('#pavender').val();  
        var usuarioArray = usuarioLevel.split(",");
        if(pa){               
            cambiarEstadoprenda(escaneadosEnviar,17,'PA-'+pa,usuarioArray[1]);
            restarInventario(escaneadosEnviar);
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
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#escanerMadru p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var usuarioArray = usuarioLevel.split(",");
        cambiarEstadoprenda(escaneadosEnviar,18,usuarioArray[1],usuarioArray[2]);
        restarInventario(escaneadosEnviar);
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
        for(var i = 0;i<cantidadInfo;i++){
            var id = $("#ventaMayoristaenviar p:eq("+i+")").text();
            var flag1 = 0;
            for(var j =0;j<codigos.length;j++){
                if(id == codigos[j]){flag1=1;}
            }
            if(flag1==0){
                codigos.push(id);
                escaneadosEnviar=escaneadosEnviar+id+",";
            }
        }
        var usuarioLevel = $('#usuarioCell').attr('name');//10,Diego Rodríguez,2
        var pa = $('#vmvender').val();  
        var usuarioArray = usuarioLevel.split(",");
        if(pa){               
            cambiarEstadoprenda(escaneadosEnviar,19,'VM-'+pa,usuarioArray[1]);
            restarInventario(escaneadosEnviar);
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