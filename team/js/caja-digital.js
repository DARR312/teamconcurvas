function cajadigital() { 
    $('.verInforme').on('click', function(){        
        $('.remover').remove();    
        var cajasemanal = cajadigita(this.name);
        var jsoncajasemanal = JSON.parse(cajasemanal);
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='primeraFila' name='"+this.name+"'>"+
        "</div>	"+
        "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover"+jsoncajasemanal[0].venta_id+"' id='primerinforme'>"+
            "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 remover"+jsoncajasemanal[0].venta_id+"'>"+
                "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                    "<p class='letra18pt-pc negrillaDos'>"+jsoncajasemanal[0].venta_id+"</p>"+
                "</div> "+
                "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>"+
                    "<p class='letra18pt-pc negrillaUno' id='estado"+jsoncajasemanal[0].venta_id+"'>"+jsoncajasemanal[0].estado+"</p>"+
                "</div>"+
                "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                    "<p class='letra18pt-pc negrillaUno' id='prenda"+jsoncajasemanal[0].venta_id+"'>Prendas venta: "+jsoncajasemanal[0].prendas+"</p>"+
                "</div>"+
                "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                    "<p class='letra18pt-pc negrillaUno' id='prenda"+jsoncajasemanal[0].venta_id+"'>Prendas cambio: 0</p>"+
                "</div>"+            
                "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                    "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                        "<label class='control-label letra18pt-pc' for='regular1'>Valor</label>"+
                        "<input class='form-control' type='number' id='valor"+jsoncajasemanal[0].venta_id+"' name='valor' value='"+jsoncajasemanal[0].dinero+"'>"+
                        "<span class='pmd-textfield-focused'></span>"+
                    "</div>"+
                "</div>	"+
                "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                    "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                        "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                        "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='metodo"+jsoncajasemanal[0].venta_id+"' form='formularioCliente' required=''>"+
                            "<option value='S'>Seleccione un opción de pago</option>"+
                        "</select><span class='pmd-textfield-focused'>"+
                        "<span class='pmd-textfield-focused'></span></span>"+
                    "</div>"+
                "</div>	"+
                "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                    "<button class='botonmodal botonenmodal letra18pt-pc cancelarorden' type='button' name='"+jsoncajasemanal[0].venta_id+"'> Cancelar </button>"+
                "</div>	"+
                "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                    "<button class='botonmodal botonenmodal letra18pt-pc entregarpedido' type='button' name='"+jsoncajasemanal[0].venta_id+"'> Entregado </button>"+
                "</div>	"+
            "</div>	"+
            "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 remover"+jsoncajasemanal[0].venta_id+"'>"+
                "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+
                    "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                        "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                        "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='1tipoegreso"+jsoncajasemanal[0].venta_id+"' form='formularioCliente' required=''>"+
                            "<option value='S'>Seleccione un opción de pago</option>"+
                        "</select><span class='pmd-textfield-focused'>"+
                        "<span class='pmd-textfield-focused'></span></span>"+
                    "</div>"+
                "</div>	"+          
                "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+
                    "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                        "<label class='control-label letra18pt-pc' for='regular1'>Valor</label>"+
                        "<input class='form-control' type='number' id='1valor"+jsoncajasemanal[0].venta_id+"' name='valor' value='"+jsoncajasemanal[0].dinero+"'>"+
                        "<span class='pmd-textfield-focused'></span>"+
                    "</div>"+
                "</div>	"+            
                "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>"+
                    "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                        "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                        "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='1metodo"+jsoncajasemanal[0].venta_id+"' form='formularioCliente' required=''>"+
                            "<option value='S'>Seleccione un opción de pago</option>"+
                        "</select><span class='pmd-textfield-focused'>"+
                        "<span class='pmd-textfield-focused'></span></span>"+
                    "</div>"+
                "</div>	"+
            "</div>	"+
        "</div>	";
        for (let j = 1; j < jsoncajasemanal.length; j++) {
            html = html + "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 remover"+jsoncajasemanal[i].venta_id+"'>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno'>"+jsoncajasemanal[j].venta_id+"</p>"+
            "</div> "+
            "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>"+
                "<p class='letra18pt-pc negrillaDos' id='estado"+jsoncajasemanal[j].venta_id+"'>"+jsoncajasemanal[j].estado+"</p>"+
            "</div>"+
            "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                "<p class='letra18pt-pc negrillaUno' id='prenda"+jsoncajasemanal[j].venta_id+"'>Prendas venta: "+jsoncajasemanal[j].prendas+"</p>"+
            "</div>"+
            "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                "<p class='letra18pt-pc negrillaUno' id='prenda"+jsoncajasemanal[j].venta_id+"'>Prendas cambio: 0</p>"+
            "</div>"+            
            "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                    "<label class='control-label letra18pt-pc' for='regular1'>Valor</label>"+
                    "<input class='form-control' type='number' id='valor"+jsoncajasemanal[j].venta_id+"' name='valor' value='"+jsoncajasemanal[j].dinero+"'>"+
                    "<span class='pmd-textfield-focused'></span>"+
                "</div>"+
            "</div>	"+
            "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>"+
                "<div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'>"+
                    "<label class='control-label letra18pt-pc' for='regular1'>Metodo</label>"+
                    "<select class='form-control letra18pt-pc metodo' type='select' name='metodo' id='metodo"+jsoncajasemanal[j].venta_id+"' form='formularioCliente' required=''>"+
                        "<option value='S'>Seleccione un opción de pago</option>"+
                    "</select><span class='pmd-textfield-focused'>"+
                    "<span class='pmd-textfield-focused'></span></span>"+
                "</div>"+
            "</div>	"+
            "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                "<button class='botonmodal botonenmodal letra18pt-pc cancelarorden' type='button' name='"+jsoncajasemanal[j].venta_id+"'> Cancelar </button>"+
            "</div>	"+
            "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                "<button class='botonmodal botonenmodal letra18pt-pc entregarpedido' type='button' name='"+jsoncajasemanal[j].venta_id+"'> Entregado </button>"+
            "</div>	"+
        "</div>	";     
        }
        $("#bloquePrincipal").append(html);
        var ids = obtenerDatajson('ID,descripcion','con_t_metodospago','variasfilasunicas','0','0');
        var jsonIds = JSON.parse(ids);
        var option = "";
        for (let i = 0; i < jsonIds.length; i++) {
            option = option + "<option value='"+jsonIds[i].descripcion+"'>"+jsonIds[i].descripcion+"</option>"
        }
        $('.metodo').append(option);
        cajadigital();
        return false;     
    });  
    $('.cancelarorden').on('click', function(){ 
        var prendas = obtenerDatajson("*","con_t_trprendas","valoresconcondicion","cual","'V"+this.name+"'");
        var jsonprendas = JSON.parse(prendas); 
        if(jsonprendas.length>0){alert("El pedido tiene prendas, no se puede cancelar");return false;}
        var dinero = obtenerDatajson("cliente_ok","con_t_ventas","valoresconcondicion","venta_id",this.name);
        var jsondinero = JSON.parse(dinero); 
        if(jsondinero[0].cliente_ok>0){alert("El pedido tiene dinero, no se puede cancelar");return false;}
        var objeto = {};
        objeto.columna = "venta_id";
        objeto.valor = this.name;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = "Cancelado";
        var estado = prepararjson(objeto);
        actualizarregistros("con_t_ventas",condicion,estado,"0","0","0","0","0","0","0","0","0","0");
        $(".remover"+this.name+"").remove();
    });  
    $('.entregarpedido').on('click', function(){ 
        if($("#valor"+this.name).val()<=0){alert("Ingresa cuánto dinero pagó el cliente");return false;}
        if($("#metodo"+this.name).val()=='S'){alert("Ingresa el método de pagó del cliente");return false;}
        var objeto = {};
        objeto.columna = "cual";
        objeto.valor = "'V"+this.name+"'";
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = "Entregado";
        var estado = prepararjson(objeto);
        actualizarregistros("con_t_trprendas",condicion,estado,"0","0","0","0","0","0","0","0","0","0");
        var pedido_item = obtenerDatajson("pedido_item","con_t_ventas","valoresconcondicion","venta_id",this.name);
        var jsonpedido = JSON.parse(pedido_item); 
        var jsonpedido_item = JSON.parse(jsonpedido[0].pedido_item);
        jsonpedido_item[0]['cantidad']=$("#prendas"+this.name).text();
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "cliente_ok";
        objeto.valor = $("#valor"+this.name).val();
        var cliente_ok = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = "Entregado";
        var estado = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "metodo_pago";
        objeto.valor = $("#metodo"+this.name).val();
        var metodo_pago = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "pedido_item";
        objeto.valor = jsonpedido_item;
        var pedido_item = prepararjson(objeto);
        var objeto = {};
        objeto.columna = "venta_id";
        objeto.valor = this.name;
        var condicion = prepararjson(objeto);
        actualizarregistros("con_t_ventas",condicion,pedido_item,estado,cliente_ok,metodo_pago,"0","0","0","0","0","0","0");
        // cajadigita($("#primeraFila").attr('name'));
        $(".remover"+this.name+"").remove();
    });  

};
function imprimirinformes(){
    var cajas = obtenerDatajson('*','con_t_cierredigital','variasfilasunicas','0','0');
    var jsoncajas = JSON.parse(cajas);
    var local = formatoPrecio(jsoncajas[jsoncajas.length-1].local);
    var nacional = formatoPrecio(jsoncajas[jsoncajas.length-1].nacional);
    var cuentas_cobrar = formatoPrecio(jsoncajas[jsoncajas.length-1].cuentas_cobrar);
    html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover' id='primerinforme'>"+
    "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>"+
        "<p class='letra18pt-pc negrillaUno'>"+jsoncajas[jsoncajas.length-1].rango+"</p>"+
    "</div> "+
    "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
        "<p class='letra18pt-pc negrillaUno'>"+local+"</p>"+
    "</div>"+
    "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
        "<p class='letra18pt-pc negrillaUno'>"+nacional+"</p>"+
    "</div>"+
    "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
        "<p class='letra18pt-pc negrillaUno'>"+cuentas_cobrar+"</p>"+
    "</div>"+
    "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>"+
        "<button class='botonmodal botonenmodal letra18pt-pc verInforme' type='button' name='"+jsoncajas[jsoncajas.length-1].ID+"'> Ver Informe </button>"+
    "</div></div>";   
    for (let i = (jsoncajas.length-2); i >= 0 ; i--) {
        var local = formatoPrecio(jsoncajas[i].local);
        var nacional = formatoPrecio(jsoncajas[i].nacional);
        var cuentas_cobrar = formatoPrecio(jsoncajas[i].cuentas_cobrar);
        html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'>"+
            "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>"+
                "<p class='letra18pt-pc negrillaUno'>"+jsoncajas[i].rango+"</p>"+
            "</div> "+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno'>"+local+"</p>"+
            "</div>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno'>"+nacional+"</p>"+
            "</div>"+
            "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>"+
                "<p class='letra18pt-pc negrillaUno'>"+cuentas_cobrar+"</p>"+
            "</div>"+
            "<div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>"+
                "<button class='botonmodal botonenmodal letra18pt-pc verInforme' type='button' name='"+jsoncajas[i].ID+"'> Ver Informe </button>"+
            "</div></div>";        
    }
    $('#primeraFila').after(html);
    cajadigital();
};
