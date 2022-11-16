function ventas() { 

};
function imprimirVentasMayoristajson(jsonVenta){   
    console.log(jsonVenta);
    var cliente = "-";
    if(jsonVenta[jsonVenta.length-1].datos_cliente){
        var Jsoncliente = JSON.parse(jsonVenta[jsonVenta.length-1].datos_cliente);
        console.log(Jsoncliente);
        cliente = Jsoncliente.nombreVenta+" "+Jsoncliente.telVenta+" "+Jsoncliente.dirVenta+" "+Jsoncliente.complementoCliente+" "+Jsoncliente.ciudadCliente;
    }
    var ver_resumen = "ajustar_resumen";
    var valor_confirmado =jsonVenta[jsonVenta.length-1].valor_confirmado;
    if(!valor_confirmado){valor_confirmado=0;}
    else{ver_resumen="ver_resumen";}
    valor_confirmado = formatoPrecio(valor_confirmado);
    var valor_mercancia = formatoPrecio(jsonVenta[jsonVenta.length-1].valor_mercancia);
    var confirmarvalor =  $("#popup").attr("name");
    var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerventasmayorista' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsonVenta[jsonVenta.length-1].ID+"</p></div><div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><p class='letra18pt-pc negrillaUno editarcliente' id='VM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+cliente+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno "+ver_resumen+"' id='RM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+valor_mercancia+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno "+confirmarvalor+"'  id='PM-"+jsonVenta[jsonVenta.length-1].ID+"'>"+valor_confirmado+"</p></div></div>";
for (let i = (jsonVenta.length-2); i >= 0; i--) {
    var cliente = "-";
    if(jsonVenta[i].datos_cliente){
        var Jsoncliente = JSON.parse(jsonVenta[i].datos_cliente);
        console.log(Jsoncliente);
        cliente = Jsoncliente.nombreVenta+" "+Jsoncliente.telVenta+" "+Jsoncliente.dirVenta+" "+Jsoncliente.complementoCliente+" "+Jsoncliente.ciudadCliente;
    }
    var ver_resumen = "ajustar_resumen";
    var valor_confirmado =jsonVenta[i].valor_confirmado;
    if(!valor_confirmado){valor_confirmado=0;}
    else{ver_resumen="ver_resumen";}
    valor_confirmado = formatoPrecio(valor_confirmado);
    var valor_mercancia = formatoPrecio(jsonVenta[i].valor_mercancia);
    html = html + "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerventasmayorista'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class='letra18pt-pc negrillaUno'>"+jsonVenta[i].ID+"</p></div><div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><p class='letra18pt-pc negrillaUno editarcliente' id='VM-"+jsonVenta[i].ID+"'>"+cliente+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno "+ver_resumen+"' id='RM-"+jsonVenta[i].ID+"'>"+valor_mercancia+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno "+confirmarvalor+"' id='PM-"+jsonVenta[i].ID+"'>"+valor_confirmado+"</p></div></div>";
}
return html;
    // var jsonDatosCliente = JSON.parse(jsonVenta[jsonVenta.length-1].datos_cliente);
    // console.log(jsonDatosCliente);
    // var jsonPedido = JSON.parse(jsonVenta[jsonVenta.length-1].pedido);
    // console.log(jsonPedido);
    // var ok = 0;
    // var press = 0;
    // if(jsonVenta[jsonVenta.length-1].cliente_ok>0){
    //     ok = 1;
    //     press = jsonVenta[jsonVenta.length-1].cliente_ok;
    //     botonrevisar = "cliente_ok1";
    // }else{
    //     press = jsonPedido.precio;
    //     botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
    // }
    // var precioFormato = formatoPrecio(press);
    // var notas = jsonVenta[jsonVenta.length-1].notas;
    // var estado = jsonVenta[jsonVenta.length-1].estado;
    // var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas' id='primeraVenta'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVenta[jsonVenta.length-1].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVenta[jsonVenta.length-1].cliente_id+"%"+jsonVenta[jsonVenta.length-1].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVenta[jsonVenta.length-1].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVenta[jsonVenta.length-1].venta_id+"'>"+jsonVenta[jsonVenta.length-1].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVenta[jsonVenta.length-1].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVenta[jsonVenta.length-1].origen+"</p></div></div>";
    // var imprimir = "<div id='impresionParaempacar' style='display: none;' class='removerVentas'><table border='1'><tr><th>Orden</th><th>Cliente</th><th>Dirección</th><th>Complemento</th><th>Ciudad</th><th>Teléfono</th><th>Pedido</th><th>Notas</th><th>Precio</th><th>Pedido pago</th></tr><tr><td>"+jsonVenta[jsonVenta.length-1].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVenta[jsonVenta.length-1].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    // for(i=(jsonVenta.length-2);i>=0;i--){
    //     console.log(jsonVenta[i]);
    //     var jsonDatosCliente = JSON.parse(jsonVenta[i].datos_cliente);        
    //     var jsonPedido = JSON.parse(jsonVenta[i].pedido);  
    //     var ok = 0;
    //     var press = 0;
    //     if(jsonVenta[i].cliente_ok>0){
    //         ok = 1;
    //         press = jsonVenta[i].cliente_ok;
    //         botonrevisar = "cliente_ok1";
    //     }else{
    //         press = jsonPedido.precio;
    //         botonrevisar = "revisarPago";//<div class='col-lg-1 col-md-1 col-sm-1 col-xs-12 cliente_ok"+arrayOrden[7]+"'><button class='botonmodal "+botonrevisar+"' type='button' name='"+arrayOrden[0]+"'>R</button></div>
    //     }
    //     var precioFormato = formatoPrecio(press);
    //     var notas = jsonVenta[i].notas;
    //     var estado = jsonVenta[i].estado;
    //     html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerVentas'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Estado'><p class='letra18pt-pc'>"+estado+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Orden'><p class='letra18pt-pc'>"+jsonVenta[i].venta_id+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Cliente'><p class='letra18pt-pc "+usuarioUpdate+"' name='"+jsonVenta[i].cliente_id+"%"+jsonVenta[i].venta_id+"'>"+jsonDatosCliente.nombre+" "+jsonDatosCliente.telefono+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Dirección'><p class='letra18pt-pc'>"+jsonDatosCliente.direccion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' name='Adición'><p class='letra18pt-pc'>"+jsonDatosCliente.complemento+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Ciudad'><p class='letra18pt-pc'>"+jsonDatosCliente.ciudad+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Pedido'><p class='letra18pt-pc "+pedidoUpdate+"' name='"+jsonVenta[i].venta_id+"'>"+jsonPedido.prendas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Precio'><p class='letra18pt-pc dinerook"+ok+"'>"+precioFormato+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Entrega'><p class='letra18pt-pc "+fechaUpdate+"' name='"+jsonVenta[i].venta_id+"'>"+jsonVenta[i].fecha_entrega+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Notas'><p class='letra18pt-pc "+notasUpdate+"' name='"+jsonVenta[i].venta_id+"'>."+notas+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1' name='Origen'><p class='letra18pt-pc'>"+jsonVenta[i].origen+"</p></div></div>";
    //     imprimir = imprimir+"<tr><td>"+jsonVenta[i].venta_id+"</td><td>"+jsonDatosCliente.nombre+"</td><td>"+jsonDatosCliente.direccion+"</td><td>"+jsonDatosCliente.complemento+"</td><td>"+jsonDatosCliente.ciudad+"</td><td>"+jsonDatosCliente.telefono+"</td><td>"+jsonPedido.prendas+"</td><td>"+jsonVenta[i].notas+"</td><td>"+precioFormato+"</td><td>"+jsonPedido.precio+"</td></tr>";
    // }
    // html = html + imprimir +"</table></div>";
    // console.log(html);
    // return html;
};
