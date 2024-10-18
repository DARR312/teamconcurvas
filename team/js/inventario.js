
function inventario(){
    $('.verMadrugon').on('click', function(){ 
        var id = $(this).attr("name");
        var prednasM = prendasMadrugon(id);
        $('.removerMadurgones').remove();     
        var pmadrugos = JSON.parse(prednasM);  
        $('#primeraMadrugones').css('display', 'none');
        $('#primeraPrendasMadrugones').css('display', 'block');
        var primeraFila = $('#primeraPrendasMadrugones');
        var html = imprimirPrendasMadrugones(pmadrugos);
    	primeraFila.after(html);
        inventario();
    });
    $('.editarValorDinero').on('click', function(){  
        var ids = $(this).attr("name");
        $('#editarValorVenta').attr("name",ids);
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());
        return false;     
    });   
    $('#close').on('click', function(){   
        $('#popup').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });         
    $('#dineroGuardado').on('click', function(){   
        $('#popup').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('#primeraMadrugones').css('display', 'block');
        $('#primeraPrendasMadrugones').css('display', 'none');
        $('.removerMadurgones').remove(); 
        var id = $('#editarValorVenta').attr("name");
        var valor = $('#valorDinero').val();
        actualizar("dinero_madrugon",valor,id,0,"-");//
        var madrugones = madru();//principal.js      
        var madrugos = JSON.parse(madrugones);     
        var primeraFila = $('#primeraMadrugones');
        var html = imprimirMadrugones(madrugos);
    	primeraFila.after(html);
        inventario();
        return false;     
    });  
    $('.editarValorCambios').on('click', function(){  
        var ids = $(this).attr("name");
        $('#editarValorCambios').attr("name",ids);
        $('#popup1').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());
        return false;     
    });   
    $('#close1').on('click', function(){   
        $('#popup1').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        return false;     
    });         
    $('#dineroGuardadoCambios').on('click', function(){   
        $('#popup1').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow'); 
        $('#primeraMadrugones').css('display', 'block');
        $('#primeraPrendasMadrugones').css('display', 'none');
        $('.removerMadurgones').remove(); 
        var id = $('#editarValorCambios').attr("name");
        var valor = $('#valorDineroCambio').val();
        actualizar("dinero_madrugonCambio",valor,id,0,"-");//
        var madrugones = madru();//principal.js      
        var madrugos = JSON.parse(madrugones);     
        var primeraFila = $('#primeraMadrugones');
        var html = imprimirMadrugones(madrugos);
    	primeraFila.after(html);
        inventario();
        return false;     
    });  
    $('.darInforme').on('click', function(){            
        var id = this.id; // Utiliza 'this.id' directamente, es más eficiente
        var html = '<p>Estas prendas están asosciadas al pedido</p>';

        // Guardar el valor de 'id' en una cookie
        document.cookie = "pedidoID=" + id + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT"; // La cookie será válida en todo el sitio y no caducará

        $('#labelInforme').text("Informe para: "+id); // Cambia 'attr("text")' por 'text()' para actualizar el contenido de texto
        $('#popup2').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());    
        var prendasAsociadas = obtenerDatajson('*','con_t_trprendas',"valoresconcondicion","cual","'V"+id+"'");
        var jsonprendasAsociadas = JSON.parse(prendasAsociadas);
        
        // Convertir el objeto JSON a una cadena
        var jsonString = JSON.stringify(jsonprendasAsociadas);
        // Guardar la cadena JSON en una cookie
        document.cookie = "prendasAsociadas=" + encodeURIComponent(jsonString) + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
        
        for (var i = 0; i < jsonprendasAsociadas.length; i++) {
            html += "<p>" + jsonprendasAsociadas[i].codigoshow + " " + jsonprendasAsociadas[i].descripcion + "</p>";
        }
        $('#prendasPreinforme').append(html); 
        return false;    
    });      
    $('#close2').on('click', function(){  
        $('#popup2').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('#prendasPreinforme').empty(); 
        return false;  // Si no necesitas prevenir el comportamiento predeterminado, puedes eliminar esta línea
    });
    $('#guardarPreinforme').on('click', function(){  
        // Obtener el valor de la cookie 'prendasAsociadas'
        var prendasAsociadasCookie = getCookie("prendasAsociadas");
        var existenPrendas = 0;
        if (prendasAsociadasCookie) {
            // Decodificar y convertir la cadena JSON de nuevo a un objeto
            var jsonprendasAsociadasFromCookie = JSON.parse(decodeURIComponent(prendasAsociadasCookie));
            console.log(jsonprendasAsociadasFromCookie.length);
            if(jsonprendasAsociadasFromCookie.length>0){
                existenPrendas=1;
            }
        }

        // Ejemplo para obtener el valor de la cookie 'pedidoID'
        var pedidoID = getCookie("pedidoID");

        var usuarioId = getCookie("user_id");

        var nuevoEstado = $('#nuevoEstado').val();
        var motivoCancelado = $('#motivoCancelado').val();
        var valorDineroVenta = $('#valorDineroVenta').val();
        var notasPreinforme = $('#notasPreinforme').val();

        

        if(nuevoEstado == 'cancelado'){
            if(motivoCancelado == 'nada'){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor agrega un motivo por el cuál este pedido está cancelado`); 
                return false;
            }
            if(existenPrendas==1){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`No puedes cancelar un pedido que aún tiene prendas asociadas, por favor revisa las prendas y escanealas a tu nombre antes de cancelar este pedido`); 
                return false;
            }
            var objeto = {};
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = 'Cancelado por revisar';
            var estado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "motivo_cancelado";
            objeto.valor = motivoCancelado;
            var motivo_cancelado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "notas_preinforme";
            objeto.valor = notasPreinforme;
            var notas_preinforme = prepararjson(objeto);
            
            actualizarregistros("con_t_ventas",condicion,estado,motivo_cancelado,notas_preinforme,"0","0","0","0","0","0","0","0");


            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth()+1;
            let year = date.getFullYear();
            let currentDate = `${month}/${day}/${year}`;//2022-08-08 13:58:58 	
            var objeto = {};
            objeto.tipo = "date";
            objeto.columna = "fecha_hora";
            objeto.valor = currentDate;
            var fecha  = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var venta_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = 'Cancelado por revisar';
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioId;
            var usuario_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambio";
            objeto.valor = "estado";
            var campo_cambio = prepararjson(objeto);
            insertarfila("con_t_ventastr",fecha,venta_id,cambio,usuario_id,campo_cambio,"0","0","0","0","0","0");

            $('#cargarInformediv').empty();
            cargarInformesVentas();
        }
        if(nuevoEstado == 'entregado'){
            if(!valorDineroVenta || valorDineroVenta == 0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor si el pedido está entregado agrega el valor que pagó el cliente`); 
                return false;
            }
            var objeto = {};
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = 'Entregado por revisar';
            var estado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "dinero_preinforme";
            objeto.valor = valorDineroVenta;
            var dinero_preinforme = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "notas_preinforme";
            objeto.valor = notasPreinforme;
            var notas_preinforme = prepararjson(objeto);
            
            actualizarregistros("con_t_ventas",condicion,estado,dinero_preinforme,notas_preinforme,"0","0","0","0","0","0","0","0");

            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth()+1;
            let year = date.getFullYear();
            let currentDate = `${month}/${day}/${year}`;//2022-08-08 13:58:58 	
            var objeto = {};
            objeto.tipo = "date";
            objeto.columna = "fecha_hora";
            objeto.valor = currentDate;
            var fecha  = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var venta_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = 'Entregado por revisar';
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioId;
            var usuario_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambio";
            objeto.valor = "estado";
            var campo_cambio = prepararjson(objeto);

            insertarfila("con_t_ventastr",fecha,venta_id,cambio,usuario_id,campo_cambio,"0","0","0","0","0","0");

            $('#cargarInformediv').empty();
            cargarInformesVentas();
        }
        
        $('#popup2').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('#prendasPreinforme').empty(); 
        return false;  // Si no necesitas prevenir el comportamiento predeterminado, puedes eliminar esta línea
    });

    
    $('.darInformeFinal').on('click', function(){            
        var id = this.id; // Utiliza 'this.id' directamente, es más eficiente
        var html = '<p>Estas prendas están asosciadas al pedido</p>';

        // Guardar el valor de 'id' en una cookie
        document.cookie = "pedidoID=" + id + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT"; // La cookie será válida en todo el sitio y no caducará

        $('#labelInformeFinal').text("Informe para: "+id); // Cambia 'attr("text")' por 'text()' para actualizar el contenido de texto
        $('#popup3').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());    
        var prendasAsociadas = obtenerDatajson('*','con_t_trprendas',"valoresconcondicion","cual","'V"+id+"'");
        var jsonprendasAsociadas = JSON.parse(prendasAsociadas);
        
        // Convertir el objeto JSON a una cadena
        var jsonString = JSON.stringify(jsonprendasAsociadas);
        // Guardar la cadena JSON en una cookie
        document.cookie = "prendasAsociadas=" + encodeURIComponent(jsonString) + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
        
        for (var i = 0; i < jsonprendasAsociadas.length; i++) {
            html += "<p>" + jsonprendasAsociadas[i].codigoshow + " " + jsonprendasAsociadas[i].descripcion + "</p>";
        }
        $('#prendasPreinformeFinal').append(html); 
        return false;    
    });      
    $('#close3').on('click', function(){  
        $('#popup3').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('#prendasPreinformeFinal').empty(); 
        return false;  // Si no necesitas prevenir el comportamiento predeterminado, puedes eliminar esta línea
    });

    $('#guardarInformeFinal').on('click', function(){  
        var prendasAsociadasCookie = getCookie("prendasAsociadas");
        var existenPrendas = 0;
        if (prendasAsociadasCookie) {
            // Decodificar y convertir la cadena JSON de nuevo a un objeto
            var jsonprendasAsociadasFromCookie = JSON.parse(decodeURIComponent(prendasAsociadasCookie));
            console.log(jsonprendasAsociadasFromCookie.length);
            if(jsonprendasAsociadasFromCookie.length>0){
                existenPrendas=1;
            }
        }

        // Ejemplo para obtener el valor de la cookie 'pedidoID'
        var pedidoID = getCookie("pedidoID");

        var usuarioId = getCookie("user_id");

        var nuevoEstado = $('#nuevoEstadoFinal').val();
        var valorDineroVenta = $('#valorDineroVentaFinal').val();
        var notasAuditar = $('#notasAuditar').val();

        if(nuevoEstado == 'cancelado'){
            if(existenPrendas==1){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`No puedes cancelar un pedido que aún tiene prendas asociadas, por favor envialo a auditar de nuevo si este pedido debe estar cancelado`); 
                return false;
            }
            var objeto = {};
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = 'Cancelado';
            var estado = prepararjson(objeto);
            
            actualizarregistros("con_t_ventas",condicion,estado,"0","0","0","0","0","0","0","0","0","0");


            
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var venta_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = 'Cancelado';
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioId;
            var usuario_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambio";
            objeto.valor = "estado";
            var campo_cambio = prepararjson(objeto);
            insertarfila("con_t_ventastr",venta_id,cambio,usuario_id,campo_cambio,"0","0","0","0","0","0","0");

            $('#informeFinalDiv').empty();
            cargarInformeFinalVentas();
        }
        if(nuevoEstado == 'entregado'){
            if(!valorDineroVenta || valorDineroVenta == 0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor si el pedido está entregado agrega el valor que pagó el cliente`); 
                return false;
            }
            var objeto = {};
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = 'Entregado';
            var estado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "cliente_ok";
            objeto.valor = valorDineroVenta;
            var cliente_ok = prepararjson(objeto);
            
            actualizarregistros("con_t_ventas",condicion,estado,cliente_ok,"0","0","0","0","0","0","0","0","0");

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var venta_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = 'Entregado';
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioId;
            var usuario_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambio";
            objeto.valor = "estado";
            var campo_cambio = prepararjson(objeto);

            insertarfila("con_t_ventastr",venta_id,cambio,usuario_id,campo_cambio,"0","0","0","0","0","0","0");

            $('#informeFinalDiv').empty();
            cargarInformeFinalVentas();
        }
        if(nuevoEstado == 'auditar'){
            if(!notasAuditar){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor si vas a enviar este pedido para auditar, pon en notas las razones por las que se debe auditar`); 
                return false;
            }
            var objeto = {};
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "estado";
            objeto.valor = 'Auditar';
            var estado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "notas_auditar";
            objeto.valor = notasAuditar;
            var notas_auditar = prepararjson(objeto);
            
            actualizarregistros("con_t_ventas",condicion,estado,notas_auditar,"0","0","0","0","0","0","0","0","0");

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "venta_id";
            objeto.valor = pedidoID;
            var venta_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "cambio";
            objeto.valor = 'Auditar';
            var cambio = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "usuario_id";
            objeto.valor = usuarioId;
            var usuario_id = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "campo_cambio";
            objeto.valor = "estado";
            var campo_cambio = prepararjson(objeto);

            insertarfila("con_t_ventastr",venta_id,cambio,usuario_id,campo_cambio,"0","0","0","0","0","0","0");

            $('#informeFinalDiv').empty();
            cargarInformeFinalVentas();
        }

        $('#popup3').fadeOut('slow');       
        $('.popup-overlay').fadeOut('slow'); 
        $('#prendasPreinformeFinal').empty(); 
        return false;  // Si no necesitas prevenir el comportamiento predeterminado, puedes eliminar esta línea
    });  
    
};

function cargarInformesVentas(){
    var ventas = obtenerDatajson("*","con_t_ventas","variasCondiciones",
        `estado = 'Despachado' 
        ||  estado = 'Empacado' 
        ||  estado = 'Auditar' 
        ||  estado = 'No empacado'`,"0");
        var jsonventas = JSON.parse(ventas);
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
            html += '        <p class="letra18pt-pc">' + venta.notas + ' - '+ venta.notas_preinforme +' - '+ venta.notas_auditar +'</p>';
            html += '    </div>';
            html += '    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">';
            html += '        <button class="botonmodal darInforme" type="button" id="' + venta.venta_id + '">Dar informe </button>';
            html += '    </div>';
            html += '</div>';
        }

        // Para añadir el HTML a algún contenedor de tu página
        $('#cargarInformediv').html(html);
        inventario();
};

function cargarInformeFinalVentas(){
    var ventas = obtenerDatajson("*","con_t_ventas","variasCondiciones",
        `estado = 'Entregado por revisar' 
        ||  estado = 'Cancelado por revisar'`,"0");
        var jsonventas = JSON.parse(ventas);
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
            html += '        <p class="letra18pt-pc">' + venta.notas + ' - '+ venta.notas_preinforme +' - '+ venta.notas_auditar +'</p>';
            html += '    </div>';
            html += '    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" name="Orden">';
            html += '        <p class="letra18pt-pc">El cliente pagó: ' + venta.dinero_preinforme + '</p>';
            html += '    </div>';
            html += '    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">';
            html += '        <button class="botonmodal darInformeFinal" type="button" id="' + venta.venta_id + '">Dar informe </button>';
            html += '    </div>';
            html += '</div>';
        }

        // Para añadir el HTML a algún contenedor de tu página
        $('#informeFinalDiv').html(html);
        inventario();
};
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}


function imprimirCodigos(arrayPrendas){
    var arrayPrenda = arrayPrendas[0].split('%');
    var html = "<div id='listadoCodigos'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos' id='primerCodigo'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[5]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[1]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[2]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[3]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[4]+"</p></div></div>";
    for(i=1;i<arrayPrendas.length-1;i++){
        var arrayPrenda = arrayPrendas[i].split('%');
        var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[5]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[1]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[2]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[3]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[4]+"</p></div></div>";
    }
    html = html+"</div>";
    return html;
};

function imprimirCodigosjson(codigos){
    var jsonPrenda = JSON.parse(codigos); 
    console.log(jsonPrenda);
    var html = "<div><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos' id='primerCodigo'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].codigoshow+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].descripcion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].cual+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].complemento_estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[0].fecha_cambio+"</p></div></div>";
    if(jsonPrenda.length>0){
        for(i=1;i<jsonPrenda.length;i++){
            console.log(jsonPrenda[i]);
            var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].codigoshow+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].descripcion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].cual+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].complemento_estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+jsonPrenda[i].fecha_cambio+"</p></div></div>";
        }
    }    
    html = html+"</div>";
    return html;
};


/*function imprimirResumen(arrayPrendas){
    var arrayPrenda = arrayPrendas[0].split('%');
    var html = "<div id='listadoResumen'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos' id='primerCodigo'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc'>"+arrayPrenda[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[1]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc'>"+arrayPrenda[3]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[4]+"</p></div></div>";
    for(i=1;i<arrayPrendas.length-1;i++){
        var arrayPrenda = arrayPrendas[i].split('%');
        var html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCodigos'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc'>"+arrayPrenda[0]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[1]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[2]+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc'>"+arrayPrenda[3]+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>"+arrayPrenda[4]+"</p></div></div>";
    }
    html = html+"</div>";
    return html;
};*/

function imrpimirinicialcodigos(){
    $('.removerInicial').remove();
    var codigos = obtenerData("codigo","con_t_invinicial","rowVarios","ok",0);//°C1145RB7D13S64%°C1145RB6D13S64%°C1145RB2D13S64%°C1145RB5D13S64%°C1145RB1D13S64%°C1145RB3D13S64%
    var codigosArray = codigos.split("%");
    var codigosids = obtenerDatajson('codigo,usuario','con_t_invinicial',"valoresconcondicion","ok",0);
    var jsoncodigosids = JSON.parse(codigosids);
    console.log(jsoncodigosids);
    var html = "";
    for(var i = 0; i<(jsoncodigosids.length);i++){
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerInicial'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'> A nombre de"+jsoncodigosids[i].usuario+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno' id='"+i+"prenda'>"+jsoncodigosids[i].codigo+"</p></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4'><label for='prenda"+i+"' class='control-label letra18pt-pc'> Referencia </label><select class='form-control referenciasCodigos' type='select' id='prenda"+i+"' name='prenda"+i+"' form='formularioCliente'></select><span class='pmd-textfield-focused'></span></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><button class='botonmodal botonenmodal letra18pt-pc insertCodigo' type='button' name='"+i+"'> Insertar Código </button></div></div>";
    }
    $('#codigosInicalesPc').append(html);
    var nombresReferencias = referenciasrodas();
    $('.referenciasCodigos').append(nombresReferencias);
    inventarioPrendas();
};

function inventarioPrendas() {
    $('.insertCodigo').on('click', function(){ 
        var ids = $(this).attr("name");
        var pren = ids+"prenda";
        var referenc = "prenda"+ids;
        var prenda = $("#"+pren).text();//C1145RB7D13S64
        var referencia = $("#"+referenc).val();//178°America°Azul Cielo°5XL
        var usuarioLevel = $('#usuarioCell').attr('name');
        if(referencia != "NA"){
            nuevocodigoinicial(prenda,referencia,usuarioLevel);//C1145RB6D13S64 192°Abbie°Camel°SM 10,Diego,1
            imrpimirinicialcodigos();
        }
    });
    
};

function imprimirMadrugones(madrugos){
    var html = "";
    var usuarioCell = $('#usuarioCell').attr("name");
    var usuarioCellArray = usuarioCell.split(",");
    var editarValorDinero = "";
    var editarValorCambios = "";
    if(usuarioCellArray[0]==10){
        editarValorDinero = "editarValorDinero";
        editarValorCambios = "editarValorCambios";
    }
    for(var i = 0; i<(madrugos.length);i++){
        var diferencia = parseInt(madrugos[i].valor_dinero)+parseInt(madrugos[i].valor_cambios)-parseInt(madrugos[i].valor_mercancia);
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerMadurgones'><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class=' letra18pt-pc'>"+madrugos[i].ID+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+madrugos[i].fecha+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+formatoPrecio(madrugos[i].valor_mercancia)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc "+editarValorDinero+"' name='"+madrugos[i].ID+"'>"+formatoPrecio(madrugos[i].valor_dinero)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class=' letra18pt-pc "+editarValorCambios+"' name='"+madrugos[i].ID+"'>"+formatoPrecio(madrugos[i].valor_cambios)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class=' letra18pt-pc'>"+formatoPrecio(diferencia)+"</p></div><div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'><p class=' letra18pt-pc'>"+madrugos[i].madrugon_ok+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><button class='botonmodal botonenmodal letra18pt-pc verMadrugon' type='button' name='"+madrugos[i].ID+"'> Ver madrugón </button></div></div>";
    }
    return html;
};

function imprimirPrendasMadrugones(pmadrugos){
    var html = "";//madrugos[i].ID
    var html2 = "";
    var descripcionConteo = {};
    for(var i = 0; i<(pmadrugos.length);i++){
        html += "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerPMadurgones'>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].codigoshow + "</p></div>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].descripcion + "</p></div>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].estado + "</p></div>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].cual + "</p></div>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].complemento_estado + "</p></div>";
        html += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc'>" + pmadrugos[i].fecha_cambio + "</p></div>";
        html += "</div>";
        var descripcion = pmadrugos[i].nombre + " " +pmadrugos[i].talla;
        if (descripcionConteo[descripcion]) {
            descripcionConteo[descripcion]++;
        } else {
            descripcionConteo[descripcion] = 1;
        }
    }
    html =  `${html} <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 removerPMadurgones'>
                        <p>Conteo total</p>
                    </div>
    `;
    var descripcionesOrdenadas = Object.keys(descripcionConteo).sort();

    for (var i = 0; i < descripcionesOrdenadas.length; i++) {
        var descripcion = descripcionesOrdenadas[i];
        html += "<p removerPMadurgones >Descripción: " + descripcion + ", Conteo: " + descripcionConteo[descripcion] + "</p>";
    }
    
    return html;
};

function imrpimirlotes(){
    $('.removerlotes').remove();
    var tlotes = obtenerData(0,"con_t_lotes","todas",0,0);
    var lotes = JSON.parse(tlotes);  
    console.log(lotes);
    var html = "";
    for(var i = (lotes.length-1); i>=0;i--){
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerlotes remover'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+lotes[i].ID+"</p></div><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class=' letra18pt-pc'>"+lotes[i].fecha_terminada+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed'><label class='control-label letra18pt-pc' for='regular1' >Fecha entrega</label><input type='text' id='fe"+lotes[i].ID+"' class='form-control datetimepicker-fechanuevalote'/></div></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><button class='botonmodal cambiarfechaentrega' type='button' id='"+lotes[i].ID+"'>Cambiar</button></div></div>";
    }
    $('#prmra').after(html);
    // Default date and time picker
	$('.datetimepicker-fechanuevalote').datetimepicker({
		format: 'L'
	});
    $('.cambiarfechaentrega').on('click', function() {   
        var id = this.id;
        var fen = $("#fe"+id+"").val();
        actualizar("fechalotes",fen,id,"-");//$tabla,$columna,$valor,$valor2
        imrpimirlotes();
    });
    //     var codigo = codigosArray[i].replace("°","");
    //     html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerlotes'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc negrillaUno' id='"+i+"prenda'>"+codigo+"</p></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4'><label for='prenda"+i+"' class='control-label letra18pt-pc'> Referencia </label><select class='form-control referenciasCodigos' type='select' id='prenda"+i+"' name='prenda"+i+"' form='formularioCliente'></select><span class='pmd-textfield-focused'></span></div><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><button class='botonmodal botonenmodal letra18pt-pc insertCodigo' type='button' name='"+i+"'> Insertar Código </button></div></div>";
    // }
    // $('#codigosInicalesPc').append(html);
    // var nombresReferencias = referenciasrodas();
    // $('.referenciasCodigos').append(nombresReferencias);
    // inventarioPrendas();
};

function verificarinforme(id,tipo){
    if(tipo=='venta'){
        var venta = obtenerDatajson("cliente_ok,estado","con_t_ventas","valoresconcondicion","venta_id",id);
        var tr_prendas = obtenerDatajson("referencia_id,descripcion,codigo,estado,cual,complemento_estado","con_t_trprendas","valoresconcondicion","cual","V"+id);
        var diferencia =0;
        var dineroreal =  parseInt(venta.cliente_ok);
        var dineroprendas = 0;
        for (let i = 0; i < array.length; i++) {
            var complemento = tr_prendas[i].complemento_estado.split('°');  
            var venta_item = obtenerDatajson("prenda_id,valor,estado_id","con_t_ventaitem","valoresconcondicion","ordenitem_id",complemento[1]);
            dineroprendas = dineroprendas + parseInt(venta_item.valor);
        }
        diferencia=dineroreal-dineroprendas;
        if(venta.estado == 'Sin empacar'){
            if(diferencia<0){
                
            }
        }
        if(venta.estado == 'No empacado'){}
        if(venta.estado == 'Cancelado'){}
        if(venta.estado == 'Empacado'){}
        if(venta.estado == 'Despachado'){}
        if(venta.estado == 'Con transportadora'){}
        if(venta.estado == 'Entregado'){}
        if(venta.estado == 'Entregado sin dinero'){}
        if(venta.estado == 'Pedido con excedente'){}
        if(venta.estado == 'Prendas por volver'){}
        if(venta.estado == 'Ya pago'){}
        if(venta.estado == 'Ya pago escoge'){}        
    }else{}
};