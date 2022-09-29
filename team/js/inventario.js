
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
        actualizar("dinero_madrugon",valor,id,0);//
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
        actualizar("dinero_madrugonCambio",valor,id,0);//
        var madrugones = madru();//principal.js      
        var madrugos = JSON.parse(madrugones);     
        var primeraFila = $('#primeraMadrugones');
        var html = imprimirMadrugones(madrugos);
    	primeraFila.after(html);
        inventario();
        return false;     
    });  
};

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
    var html = "";
    for(var i = 0; i<(codigosArray.length-1);i++){
        var codigo = codigosArray[i].replace("°","");
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerInicial'><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><p class='letra18pt-pc negrillaUno' id='"+i+"prenda'>"+codigo+"</p></div><div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4'><label for='prenda"+i+"' class='control-label letra18pt-pc'> Referencia </label><select class='form-control referenciasCodigos' type='select' id='prenda"+i+"' name='prenda"+i+"' form='formularioCliente'></select><span class='pmd-textfield-focused'></span></div><div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'><button class='botonmodal botonenmodal letra18pt-pc insertCodigo' type='button' name='"+i+"'> Insertar Código </button></div></div>";
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
    console.log(pmadrugos);
    var html = "";//madrugos[i].ID
    for(var i = 0; i<(pmadrugos.length);i++){
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerPMadurgones'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].codigo+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].descripcion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].cual+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].complemento_estado+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+pmadrugos[i].fecha_cambio+"</p></div></div>";
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
        actualizar("fechalotes",fen,id);//$tabla,$columna,$valor,$valor2
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