
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
    for(var i = 0; i<(madrugos.length);i++){
        html = html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerMadurgones'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+madrugos[i].ID+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+madrugos[i].fecha+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+formatoPrecio(madrugos[i].valor_mercancia)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+formatoPrecio(madrugos[i].valor_dinero)+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class=' letra18pt-pc'>"+madrugos[i].madrugon_ok+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><button class='botonmodal botonenmodal letra18pt-pc verMadrugon' type='button' name='"+madrugos[i].ID+"'> Ver madrugón </button></div></div>";
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
