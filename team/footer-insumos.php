<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
for(i=30;i<permisos.length;i++){
    if(permisos[i].permiso_id==39){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion1'><button class='botonmodal botonesInventario' type='button' id='verInsumos'>Ver insumos </button></div>");
    }
    if(permisos[i].permiso_id==40){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion2'><button class='botonmodal botonesInventario' type='button' id='agregarInsumo'>Agregar nuevo insumo </button></div>");
    }   
    if(permisos[i].permiso_id==40){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion3'><button class='botonmodal botonesInventario' type='button' id='agregarFactura'>Agregar factura </button></div>");
    }   
    if(permisos[i].permiso_id==42){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion4'><button class='botonmodal botonesInventario' type='button' id='verFichasTecnicas'>Ver fichas técnicas </button></div>");
    }      
}
//******************************************************************************++Insumo nuevo
$('#agregarInsumo').on('click', function() {
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'block');     
    $('#facturaNueva').css('display', 'none');   
    $('#resumenInvInsumos').css('display', 'none');     
    $('#bloqueFichas').css('display', 'none'); 
    let html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let gruposj = obtenerDatajson("grupo","con_t_insumos","filasunicas","0","0");
    let grupos = JSON.parse(gruposj);
    for(i=0;i<grupos.length;i++){
        html=html+"<option class='remover' value='"+grupos[i].grupo+"'>"+grupos[i].grupo+"</option>";
    }
    let grupo = $('#grupo');
    grupo.append(html);
        
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let complementoj = obtenerDatajson("complemento","con_t_insumos","filasunicas","0","0");
    let complemento = JSON.parse(complementoj);
    for(i=0;i<complemento.length;i++){
        html=html+"<option class='remover' value='"+complemento[i].complemento+"'>"+complemento[i].complemento+"</option>";
    }
    let complementod = $('#complemento');
    complementod.append(html);
        
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let caracteristicaj = obtenerDatajson("caracteristica","con_t_insumos","filasunicas","0","0");
    let caracteristica = JSON.parse(caracteristicaj);
    for(i=0;i<caracteristica.length;i++){
        html=html+"<option class='remover' value='"+caracteristica[i].caracteristica+"'>"+caracteristica[i].caracteristica+"</option>";
    }
    let caracteristicad = $('#caracteristica');
    caracteristicad.append(html);
    
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let compcaracteristicaj = obtenerDatajson("complemento_caracteristica","con_t_insumos","filasunicas","0","0");
    let compcaracteristica = JSON.parse(compcaracteristicaj);
    for(i=0;i<compcaracteristica.length;i++){
        html=html+"<option class='remover' value='"+compcaracteristica[i].complemento_caracteristica+"'>"+compcaracteristica[i].complemento_caracteristica+"</option>";
    }
    let Complementocaracteristicad = $('#Complementocaracteristica');
    Complementocaracteristicad.append(html);
            
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let presentacionj = obtenerDatajson("presentacion","con_t_insumos","filasunicas","0","0");
    let presentacion = JSON.parse(presentacionj);
    for(i=0;i<presentacion.length;i++){
        html=html+"<option class='remover' value='"+presentacion[i].presentacion+"'>"+presentacion[i].presentacion+"</option>";
    }
    let presentaciond = $('#presentacion');
    presentaciond.append(html);
    return false;     
}); 

$('#guardarInsumo').on('click', function(){   
    let presentacion = $('#presentacion').val();
    if(presentacion=='nuevo'){presentacion=$('#nuevapresentacion').val();}

    let caracteristica = $('#caracteristica').val();
    if(caracteristica=='nuevo'){caracteristica=$('#nuevacaracteristica').val();}

    let Complementocaracteristica = $('#Complementocaracteristica').val();
    if(Complementocaracteristica=='nuevo'){Complementocaracteristica=$('#Complementonuevacaracteristica').val();}

    let complemento = $('#complemento').val();
    if(complemento=='nuevo'){complemento=$('#nuevocomplemento').val();}

    let grupo = $('#grupo').val();
    if(grupo=='nuevo'){grupo=$('#nuevogrupo').val();}

    if(!grupo){alert('Por favor ingresa el grupo');return false;}
    if(!complemento){alert('Por favor ingresa el complemento');return false;}
    if(!caracteristica){alert('Por favor ingresa el caracteristica');return false;}
    if(!Complementocaracteristica){alert('Por favor ingresa el Complementocaracteristica');return false;}
    if(!presentacion){alert('Por favor ingresa el presentacion');return false;}
    
    var indicadorBuscante = 0;
    var insumoBuscado = obtenerDatajson("ID","con_t_insumos","variasCondiciones",`grupo = '${grupo}' 
    AND  grupo = '${grupo}' 
    AND  complemento = '${complemento}' 
    AND  caracteristica = '${caracteristica}' 
    AND  complemento_caracteristica = '${Complementocaracteristica}' 
    AND  presentacion = '${presentacion}'`,"0");
    var jsoninsumoBuscado = JSON.parse(insumoBuscado);

    console.log(jsoninsumoBuscado);
    if(jsoninsumoBuscado.length > 0){
        $('#modalAlertas').modal("show"); 
        $('#tituloAlertas').text(`El insumo que intentas agregar ya está en la base de datos`); 
        return false;
    }
    let objeto = {};
    objeto.tipo = "string";
    objeto.columna = "grupo";
    objeto.valor = grupo;
    let grupodb = prepararjson(objeto);
    objeto = {};
    objeto.tipo = "string";
    objeto.columna = "complemento";
    objeto.valor = complemento;
    let complementodb = prepararjson(objeto);
    objeto = {};
    objeto.tipo = "string";
    objeto.columna = "caracteristica";
    objeto.valor = caracteristica;
    let caracteristicadb = prepararjson(objeto);
    objeto.tipo = "string";
    objeto.columna = "complemento_caracteristica";
    objeto.valor = Complementocaracteristica;
    let Complementocaracteristicadb = prepararjson(objeto);
    objeto = {};
    objeto.tipo = "string";
    objeto.columna = "presentacion";
    objeto.valor = presentacion;
    let presentaciondb = prepararjson(objeto);
    let idinsumo = insertarfila("con_t_insumos",grupodb,complementodb,caracteristicadb,Complementocaracteristicadb,presentaciondb,"0","0","0","0","0","0");
    $('.remover').remove(); 
    $('#nuevogrupo').val("");
    $('#nuevocomplemento').val("");
    $('#nuevacaracteristica').val("");
    $('#Complementonuevacaracteristica').val("");
    $('#nuevapresentacion').val("");
    const nuevoInsumo = $('#nuevoInsumo');
    const insumoAgregadoOk = $('#insumoAgregadoOk');

    nuevoInsumo.addClass('oculto');
    insumoAgregadoOk.removeClass('oculto').addClass('mostrar');
    setTimeout(() => {
        insumoAgregadoOk.removeClass('mostrar').addClass('oculto');
        nuevoInsumo.removeClass('oculto').addClass('mostrar');
    }, 5000);



    let html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let gruposj = obtenerDatajson("grupo","con_t_insumos","filasunicas","0","0");
    let grupos = JSON.parse(gruposj);
    for(i=0;i<grupos.length;i++){
        html=html+"<option class='remover' value='"+grupos[i].grupo+"'>"+grupos[i].grupo+"</option>";
    }
    grupo = $('#grupo');
    grupo.append(html);
        
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let complementoj = obtenerDatajson("complemento","con_t_insumos","filasunicas","0","0");
    complemento = JSON.parse(complementoj);
    for(i=0;i<complemento.length;i++){
        html=html+"<option class='remover' value='"+complemento[i].complemento+"'>"+complemento[i].complemento+"</option>";
    }
    let complementod = $('#complemento');
    complementod.append(html);
        
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let caracteristicaj = obtenerDatajson("caracteristica","con_t_insumos","filasunicas","0","0");
    caracteristica = JSON.parse(caracteristicaj);
    for(i=0;i<caracteristica.length;i++){
        html=html+"<option class='remover' value='"+caracteristica[i].caracteristica+"'>"+caracteristica[i].caracteristica+"</option>";
    }
    let caracteristicad = $('#caracteristica');
    caracteristicad.append(html);
    
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let compcaracteristicaj = obtenerDatajson("complemento_caracteristica","con_t_insumos","filasunicas","0","0");
    let compcaracteristica = JSON.parse(compcaracteristicaj);
    for(i=0;i<compcaracteristica.length;i++){
        html=html+"<option class='remover' value='"+compcaracteristica[i].complemento_caracteristica+"'>"+compcaracteristica[i].complemento_caracteristica+"</option>";
    }
    let Complementocaracteristicad = $('#Complementocaracteristica');
    Complementocaracteristicad.append(html);
            
    html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let presentacionj = obtenerDatajson("presentacion","con_t_insumos","filasunicas","0","0");
    presentacion = JSON.parse(presentacionj);
    for(i=0;i<presentacion.length;i++){
        html=html+"<option class='remover' value='"+presentacion[i].presentacion+"'>"+presentacion[i].presentacion+"</option>";
    }
    let presentaciond = $('#presentacion');
    presentaciond.append(html);
    return false;     
}); 
//******************************************************************************++Insumo nuevo
//******************************************************************************++Factura nueva
const listadoInsumos = () => {
    $('.insumosselec').on('change', function(){   
        let insumoselec = $('.insumosselec');
        if(this.name == insumoselec[insumoselec.length - 1].attributes.name.value){
            let html = `<div class='remover col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6 pmd-textfield-floating-label-completed'>
                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Insumo </label>
                    <select class='form-control insumosselec' type='select' id='insumo${parseInt(this.name)+1}' name='${parseInt(this.name)+1}' form='formNuevaFactura' required=''>`;
                    html = `${html} <option class='remover' value='elige'>Selecciona una opción</option>`;
                    let insumo = listadoInsumos();
                    for(i=0;i<insumo.length;i++){
                        html = `${html} <option class='remover' value='${insumo[i].ID}'> ${insumo[i].grupo} ${insumo[i].complemento} ${insumo[i].caracteristica} ${insumo[i].complemento_caracteristica} ${insumo[i].presentacion} </option>`;
                    }            
                    html = `${html} </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="cantidad" class="control-label letra18pt-pc"> Valor </label>
                    <input class="form-control" type="number" id="valor${parseInt(this.name)+1}" name="${parseInt(this.name)+1}" required=""><span class="pmd-textfield-focused"></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                    <input class="form-control" type="number" id="cantidad${parseInt(this.name)+1}" name="${parseInt(this.name)+1}" required=""><span class="pmd-textfield-focused"></span>
                </div></div>`;
            $('#formNuevaFactura').append(html);
            listadoInsumos();
        }
    });
    let listado = obtenerDatajson("ID,grupo,complemento,caracteristica,complemento_caracteristica,presentacion","con_t_insumos","variasfilasunicas","0","0");
    return JSON.parse(listado);
}    
$('#agregarFactura').on('click', function(){   
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'none');       
    $('#facturaNueva').css('display', 'block');    
    $('#resumenInvInsumos').css('display', 'none');
    $('#bloqueFichas').css('display', 'none');     
    let html = "<option class='remover' value='nuevo'>Nuevo</option>";
    let proveedorj = obtenerDatajson("proveedor","con_t_facturas","filasunicas","0","0");
    let proveedor = JSON.parse(proveedorj);
    for(i=0;i<proveedor.length;i++){
        html=html+"<option class='remover' value='"+proveedor[i].proveedor+"'>"+proveedor[i].proveedor+"</option>";
    }
    let proveedordiv = $('#proveedor');
    proveedordiv.append(html);

    html = "<option class='remover' value='elige'>Selecciona una opción</option>";
    let insumo = listadoInsumos();
    for(i=0;i<insumo.length;i++){
        html = `${html} <option class='remover' value='${insumo[i].ID}'> ${insumo[i].grupo} ${insumo[i].complemento} ${insumo[i].caracteristica} ${insumo[i].complemento_caracteristica} ${insumo[i].presentacion} </option>`;
    }
    let insumo1 = $('#insumo1');
    insumo1.append(html);
    return false;     
}); 

let valortotal = 0;
let listaInsumos = [];
let proveedor;
let valoractual = 0;
let valor_porpagar = 0;
let valor_pagado = 0;
let valRetencio1 = 0;
let valRetencio2 = 0;
let valRetencio3 = 0;
let conceptoRetencio1 = "Retención 1";
let conceptoRetencio2 = "Retención 2";
let conceptoRetencio3 = "Retención 3";
let iva = 0;
let identificador = "0000";
let idFactura =0;
$('#pasoFinalFactura').on('click', function(){   
    proveedor = $('#proveedor').val();
    if(proveedor == 'nuevo'){
        proveedor = $('#nuevoproveedor').val();
        if(!proveedor){alert('Por favor ingresa un proveedor');return false;}
    }
    
    let insumoselec = $('.insumosselec');
    if(insumoselec.length == 1){alert('Por favor ingresa al menos un insumo');return false;}
    valortotal = 0;
    listaInsumos = [];
    for (let i = 1; i < insumoselec.length; i++) {
        let insumo = $(`#insumo${i} option:selected`).text(); 
        let insumoID = $(`#insumo${i}`).val(); 
        let valor = $(`#valor${i}`).val();
        if(!valor){alert(`Por favor agrega el valor para el insumo ${i}`);return false;}
        let cantidad = $(`#cantidad${i}`).val();
        if(!cantidad){alert(`Por favor agrega la cantidad para el insumo ${i}`);return false;}
        valortotal = valortotal +  parseInt(valor);
        var objetoinsumo = {InsumoID: insumoID, Insumo: insumo, Valor: valor, Cantidad: cantidad};
        listaInsumos.push(objetoinsumo);
    }
    valoractual = valortotal;
    valor_porpagar = valortotal;
    $('#modalContable').modal("show");  
    $('#valorCosto').text(`Costo: ${formatoPrecio(parseInt(valortotal))}`)
    $('#tituloFactura').text(`Factura del proveedor: ${proveedor}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valortotal))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valortotal))}`);

    let html = "<option class='remover' value='no'>No</option>";
    let retencionesj = obtenerDatajson("concepto,porcentaje","con_t_retenciones","filasunicas","0","0");
    let retenciones = JSON.parse(retencionesj);
    for(i=0;i<retenciones.length;i++){
        html=html+"<option class='remover' value='"+retenciones[i].porcentaje+"'>"+retenciones[i].concepto+"</option>";
    }
    let retencioneselect = $('.retenciones');
    retencioneselect.append(html);
}); 

$('#iva').on('change', function(){   
    if($(this).val() == "Si"){iva = (valortotal * 0.19);}
    else{iva = 0;}
    valoractual = valortotal + iva - valRetencio1 - valRetencio2 - valRetencio3; 
    valor_porpagar = valoractual - valor_pagado;
    $('#valorIva').text(`IVA:  ${formatoPrecio(parseInt(iva))}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valoractual))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valor_porpagar))}`);
}); 

$('#retencion1').on('change', function(){   
    if($(this).val() == "no"){valRetencio1 = 0; conceptoRetencio1 = "Retención 1";}
    else{valRetencio1 = (valortotal * parseFloat($(this).val())/100);conceptoRetencio1=$(`#retencion1 option:selected`).text();}
    valoractual = valortotal + iva - valRetencio1 - valRetencio2 - valRetencio3;
    valor_porpagar = valoractual - valor_pagado;
    $('#valRetencio1').text(`${formatoPrecio(parseInt(valRetencio1))}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valoractual))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valor_porpagar))}`);
}); 

$('#retencion2').on('change', function(){   
    if($(this).val() == "no"){valRetencio2 = 0; conceptoRetencio2 = "Retención 2";}
    else{valRetencio2 = (valortotal * parseFloat($(this).val())/100);conceptoRetencio2=$(`#retencion2 option:selected`).text();}
    valoractual = valortotal + iva - valRetencio1 - valRetencio2 - valRetencio3;
    valor_porpagar = valoractual - valor_pagado;
    $('#valRetencio2').text(`${formatoPrecio(parseInt(valRetencio2))}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valoractual))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valor_porpagar))}`);
}); 

$('#retencion3').on('change', function(){   
    if($(this).val() == "no"){valRetencio3 = 0; conceptoRetencio3 = "Retención 3";}
    else{valRetencio3 = (valortotal * parseFloat($(this).val())/100);conceptoRetencio3=$(`#retencion3 option:selected`).text();}
    valoractual = valortotal + iva - valRetencio1 - valRetencio2 - valRetencio3;
    valor_porpagar = valoractual - valor_pagado;
    $('#valRetencio3').text(`${formatoPrecio(parseInt(valRetencio3))}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valoractual))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valor_porpagar))}`);
}); 

$('#valor_pagado').on('change', function(){   
    valor_pagado = $(this).val();
    valoractual = valortotal + iva - valRetencio1 - valRetencio2 - valRetencio3;
    valor_porpagar = valoractual - valor_pagado;
    $('#valRetencio3').text(`${formatoPrecio(parseInt(valRetencio3))}`);
    $('#valor_total').text(`Valor total:  ${formatoPrecio(parseInt(valoractual))}`);
    $('#valor_porpagar').text(`Valor por pagar: ${formatoPrecio(parseInt(valor_porpagar))}`);
}); 

$('#identificador').on('change', function(){   
    identificador = $('#identificador').val();
}); 

$('#guardarFactura').on('click', function(){   
    $('#modalResumen').modal("show");  
    $('.removerinsumos').remove();
    let html='';
    for (let i = 0; i < listaInsumos.length; i++) {
        html = `${html} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerinsumos' >
                        <div class=' col-lg-5 col-md-5 col-sm-5 col-xs-5'>
                            <label class="control-label letra18pt-pc"> ${listaInsumos[i].Insumo} </label>
                        </div>
                        <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                            <label class="control-label letra18pt-pc"> ${listaInsumos[i].Cantidad} </label>
                        </div>                           
                        <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                            <label class="control-label letra18pt-pc"> ${formatoPrecio(parseInt(listaInsumos[i].Valor/listaInsumos[i].Cantidad))} </label>
                        </div>               
                        <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                            <label class="control-label letra18pt-pc"> ${formatoPrecio(parseInt(listaInsumos[i].Valor))} </label>
                        </div>   
                        </div>
        `;
        
    }
    let resumenInsumosFactura  = $('#resumenInsumosFactura');
    resumenInsumosFactura.append(html);
    $('#tituloResumenFactura').text(`Resumen factura ${identificador} de ${proveedor}`);
    $('#valCosto').text(formatoPrecio(parseInt(valortotal)));
    $('#valIva').text(formatoPrecio(parseInt(iva)));
    $('#retencionConcept1').text(conceptoRetencio1);
    $('#valRete1').text(formatoPrecio(parseInt(valRetencio1)));
    $('#retencionConcept2').text(conceptoRetencio2);
    $('#valRete2').text(formatoPrecio(parseInt(valRetencio2)));
    $('#retencionConcept3').text(conceptoRetencio3);
    $('#valRete3').text(formatoPrecio(parseInt(valRetencio3)));
    $('#valTotal').text(formatoPrecio(parseInt(valortotal)));
    $('#valPagado').text(formatoPrecio(parseInt(valor_pagado)));
    $('#valPagar').text(formatoPrecio(parseInt(valor_porpagar)));
}); 

$('#confirmarFactura').on('click', function(){     
    console.log(parseInt(valor_porpagar)); 
    if(parseInt(valor_porpagar)>0){
        $('#modalCrédito').modal("show");
        $('#tituloResumenFacturaCredito').text(`La factura tiene un valor por pagar de ${formatoPrecio(parseInt(valor_porpagar))}, por favor ingresa a cuántos días se espera pagar: `);
    }
    else{
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_total";
        objeto.valor = valoractual;
        var valor_tota = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "proveedor";
        objeto.valor = proveedor;
        var proveedo = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_porpagar";
        objeto.valor = valor_porpagar;
        var valor_porpaga = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_pagado";
        objeto.valor = valor_pagado;
        var valor_pagad = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion1";
        objeto.valor = valRetencio1;
        var retencion1 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion1";
        objeto.valor = conceptoRetencio1;
        var concepto_retenecion1 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion2";
        objeto.valor = valRetencio2;
        var retencion2 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion2";
        objeto.valor = conceptoRetencio2;
        var concepto_retenecion2 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion3";
        objeto.valor = valRetencio3;
        var retencion3 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion3";
        objeto.valor = conceptoRetencio3;
        var concepto_retenecion3 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "iva";
        objeto.valor = iva;
        var ivaFinal = prepararjson(objeto);
        idFactura = JSON.parse(insertarfila("con_t_facturas",valor_tota,proveedo,valor_porpaga,valor_pagad,retencion1,concepto_retenecion1,retencion2,concepto_retenecion2,retencion3,concepto_retenecion3,ivaFinal));
        
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = idFactura[0].id;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "concepto";
        objeto.valor = listaInsumos;
        concepto = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "costo";
        objeto.valor = valortotal;
        costofa = prepararjson(objeto);
        const date = new Date();
        let day = date.getDate();
        let month = date.getMonth()+1;
        let year = date.getFullYear();
        let currentDate = `${month}/${day}/${year}`;//2022-08-08 13:58:58 	
        var objeto = {};
        objeto.tipo = "date_sinhora";
        objeto.columna = "fecha_a_pagar";
        objeto.valor = currentDate;
        var fecha  = prepararjson(objeto);
        actualizarregistros("con_t_facturas",condicion,concepto,fecha,costofa,"0","0","0","0","0","0","0","0");
        actualizarInsumosprecios();
        actualizarInsumoscantidades("sumar");
        $('#modalCrédito').modal("hide");
        $('#modalResumen').modal("hide");
        $('#modalContable').modal("hide");

        const facturaNueva = $('#facturaNueva');
        const facturaAgregadaOk = $('#facturaAgregadaOk');

        facturaNueva.addClass('oculto');
        facturaAgregadaOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            facturaAgregadaOk.removeClass('mostrar').addClass('oculto');
            facturaNueva.removeClass('oculto').addClass('mostrar');
        }, 5000);
        $('.remover').remove();
        valortotal = 0;
        listaInsumos = [];
        proveedor='';
        valoractual = 0;
        valor_porpagar = 0;
        valor_pagado = 0;
        valRetencio1 = 0;
        valRetencio2 = 0;
        valRetencio3 = 0;
        conceptoRetencio1 = "Retención 1";
        conceptoRetencio2 = "Retención 2";
        conceptoRetencio3 = "Retención 3";
        iva = 0;
        identificador = "0000";
        idFactura =0;
        $('.fv').val("");
        let html = "<option class='remover' value='nuevo'>Nuevo</option>";
        let proveedorj = obtenerDatajson("proveedor","con_t_facturas","filasunicas","0","0");
        let proveedors = JSON.parse(proveedorj);
        for(i=0;i<proveedors.length;i++){
            html=html+"<option class='remover' value='"+proveedors[i].proveedor+"'>"+proveedors[i].proveedor+"</option>";
        }
        let proveedordiv = $('#proveedor');
        proveedordiv.append(html);

        html = "<option class='remover' value='elige'>Selecciona una opción</option>";
        let insumo = listadoInsumos();
        for(i=0;i<insumo.length;i++){
            html = `${html} <option class='remover' value='${insumo[i].ID}'> ${insumo[i].grupo} ${insumo[i].complemento} ${insumo[i].caracteristica} ${insumo[i].complemento_caracteristica} ${insumo[i].presentacion} </option>`;
        }
        let insumo1 = $('#insumo1');
        insumo1.append(html);
    }
}); 

$('#confirmarFacturaCredito').on('click', function(){
    let diasCredito = $('#dias_credito').val();
    var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_total";
        objeto.valor = valoractual;
        var valor_tota = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "proveedor";
        objeto.valor = proveedor;
        var proveedo = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_porpagar";
        objeto.valor = valor_porpagar;
        var valor_porpaga = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_pagado";
        objeto.valor = valor_pagado;
        var valor_pagad = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion1";
        objeto.valor = valRetencio1;
        var retencion1 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion1";
        objeto.valor = conceptoRetencio1;
        var concepto_retenecion1 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion2";
        objeto.valor = valRetencio2;
        var retencion2 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion2";
        objeto.valor = conceptoRetencio2;
        var concepto_retenecion2 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "retencion3";
        objeto.valor = valRetencio3;
        var retencion3 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "concepto_retenecion3";
        objeto.valor = conceptoRetencio3;
        var concepto_retenecion3 = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "iva";
        objeto.valor = iva;
        var ivaFinal = prepararjson(objeto);
        idFactura = JSON.parse(insertarfila("con_t_facturas",valor_tota,proveedo,valor_porpaga,valor_pagad,retencion1,concepto_retenecion1,retencion2,concepto_retenecion2,retencion3,concepto_retenecion3,ivaFinal));
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = idFactura[0].id;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "json";
        objeto.columna = "concepto";
        objeto.valor = listaInsumos;
        concepto = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "costo";
        objeto.valor = valortotal;
        costofa = prepararjson(objeto);
        const date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        let fechaNueva = new Date();
        let ultimoDiaMes = new Date(year, month, 0).getDate();
        let ok = 0;
        while (ok==0) {
            if((parseInt(day) + parseInt(diasCredito)) > ultimoDiaMes){       
                month++;
                diasCredito = parseInt(diasCredito) - ultimoDiaMes;
                continue;        
            }
            if(month>12){
                month=1;
                year++;
                continue;
            }
            fechaNueva = new Date(year, month, diasCredito);
            ultimoDiaMes = new Date(year, month, 0).getDate();
            ok=1;
        }

        let newDay = fechaNueva.getDate();
        let newMonth = fechaNueva.getMonth() + 1;
        let newYear = fechaNueva.getFullYear();

        let currentDate = `${month}/${day}/${year}`; // Fecha con los días sumados
        var objeto = {};
        objeto.tipo = "date_sinhora";
        objeto.columna = "fecha_a_pagar";
        objeto.valor = currentDate;
        var fecha  = prepararjson(objeto);
        actualizarregistros("con_t_facturas",condicion,concepto,fecha,costofa,"0","0","0","0","0","0","0","0");
        actualizarInsumosprecios();
        actualizarInsumoscantidades("sumar");
        $('#modalCrédito').modal("hide");
        $('#modalResumen').modal("hide");
        $('#modalContable').modal("hide");

        const facturaNueva = $('#facturaNueva');
        const facturaAgregadaOk = $('#facturaAgregadaOk');

        facturaNueva.addClass('oculto');
        facturaAgregadaOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            facturaAgregadaOk.removeClass('mostrar').addClass('oculto');
            facturaNueva.removeClass('oculto').addClass('mostrar');
        }, 5000);
        $('.remover').remove();
        valortotal = 0;
        listaInsumos = [];
        proveedor='';
        valoractual = 0;
        valor_porpagar = 0;
        valor_pagado = 0;
        valRetencio1 = 0;
        valRetencio2 = 0;
        valRetencio3 = 0;
        conceptoRetencio1 = "Retención 1";
        conceptoRetencio2 = "Retención 2";
        conceptoRetencio3 = "Retención 3";
        iva = 0;
        identificador = "0000";
        idFactura =0;
        $('.fv').val("");
        let html = "<option class='remover' value='nuevo'>Nuevo</option>";
        let proveedorj = obtenerDatajson("proveedor","con_t_facturas","filasunicas","0","0");
        let proveedors = JSON.parse(proveedorj);
        for(i=0;i<proveedors.length;i++){
            html=html+"<option class='remover' value='"+proveedors[i].proveedor+"'>"+proveedors[i].proveedor+"</option>";
        }
        let proveedordiv = $('#proveedor');
        proveedordiv.append(html);

        html = "<option class='remover' value='elige'>Selecciona una opción</option>";
        let insumo = listadoInsumos();
        for(i=0;i<insumo.length;i++){
            html = `${html} <option class='remover' value='${insumo[i].ID}'> ${insumo[i].grupo} ${insumo[i].complemento} ${insumo[i].caracteristica} ${insumo[i].complemento_caracteristica} ${insumo[i].presentacion} </option>`;
        }
        let insumo1 = $('#insumo1');
        insumo1.append(html);
}); 

const actualizarInsumosprecios = () =>{
    for (let i = 0; i < listaInsumos.length; i++) { 
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = listaInsumos[i].InsumoID;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "precio_unidad";
        objeto.valor = parseInt(listaInsumos[i].Valor/listaInsumos[i].Cantidad);
        var precio_unidad  = prepararjson(objeto);
        actualizarregistros("con_t_insumos",condicion,precio_unidad,"0","0","0","0","0","0","0","0","0","0");        
    }
}

const actualizarInsumoscantidades = (sumarrestar) =>{
    for (let i = 0; i < listaInsumos.length; i++) { 
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = listaInsumos[i].InsumoID;
        var condicion = prepararjson(objeto);
        let cantidadnueva = 0;
        let cantidadj = obtenerDatajson("cantidad","con_t_insumos","valoresconcondicion","ID",listaInsumos[i].InsumoID);
        let cantidad = JSON.parse(cantidadj);
        if(sumarrestar=='sumar'){
            cantidadnueva = parseInt(listaInsumos[i].Cantidad)+parseInt(cantidad[0].cantidad);
        }else if(sumarrestar=='restar'){
            cantidadnueva = parseInt(cantidad[0].cantidad)-parseInt(listaInsumos[i].Cantidad);
        }
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "cantidad";
        objeto.valor = cantidadnueva;
        var cant_nueva  = prepararjson(objeto);
        actualizarregistros("con_t_insumos",condicion,cant_nueva,"0","0","0","0","0","0","0","0","0","0");        
    }
}
//******************************************************************************++Factura nueva
//******************************************************************************++Ver insumos

$('#verInsumos').on('click', function(){
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'none');     
    $('#facturaNueva').css('display', 'none');       
    $('#resumenInvInsumos').css('display', 'block'); 
    $('#bloqueFichas').css('display', 'none');       
    let listado = obtenerDatajson("ID,grupo,complemento,caracteristica,complemento_caracteristica,presentacion,cantidad","con_t_insumos","variasfilasunicas","0","0");
    let listadoInsumos =  JSON.parse(listado);    
    let html='';
    for (let i = 0; i < listadoInsumos.length; i++) {
        html = `${html} <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 remover'>
                    <div class=' col-lg-8 col-md-8 col-sm-8 col-xs-8'>
                        <p  class="letra18pt-pc">${listadoInsumos[i].grupo} ${listadoInsumos[i].complemento} ${listadoInsumos[i].caracteristica} ${listadoInsumos[i].complemento_caracteristica} ${listadoInsumos[i].presentacion}</p>
                    </div>
                    <div class=' col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                        <p  class="letra18pt-pc">${listadoInsumos[i].cantidad}</p>
                    </div>
                </div>
        `;
        
    }
    let cabecerasResumen  = $('#cabecerasResumen');
    cabecerasResumen.after(html);
}); 

//******************************************************************************++Ver insumos

//******************************************************************************++Ficas técnicas
var idReferencia = "";
$('#verFichasTecnicas').on('click', function(){
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'none');     
    $('#facturaNueva').css('display', 'none');       
    $('#resumenInvInsumos').css('display', 'none'); 
    $('#bloqueFichas').css('display', 'block'); 

    const bloqueNuevaFicha = $('#bloqueNuevaFicha');
    const selecciondeficha = $('#selecciondeficha');
    const bloqueAntiguaFicha = $('#bloqueAntiguaFicha');

    bloqueNuevaFicha.removeClass('mostrar').addClass('oculto');
    bloqueAntiguaFicha.removeClass('mostrar').addClass('oculto');
    selecciondeficha.removeClass('oculto').addClass('mostrar');

    // Agrego las referencias que tienen ficha técnica al select de Ficha técnica
    $('.removerReferenciaConFicha').remove();
    let listadoReferenciasj = obtenerDatajson("referencia","con_t_fichatecnica","filasunicas","0","0");
    let listadoReferencias =  JSON.parse(listadoReferenciasj);    
    let html='';
    for (let i = 0; i < listadoReferencias.length; i++) {
        html = `${html} <option class='removerReferenciaConFicha'  value='${listadoReferencias[i].referencia}'>${listadoReferencias[i].referencia}</option>`;
        
    }
    let fichasTecnicasSelect  = $('#fichasTecnicasSelect');
    fichasTecnicasSelect.append(html);

}); 

$('#fichasTecnicasSelect').on('change', function(){
    if($('#fichasTecnicasSelect').val()=='nueva'){
        const bloqueNuevaFicha = $('#bloqueNuevaFicha');
        const selecciondeficha = $('#selecciondeficha');

        selecciondeficha.removeClass('mostrar').addClass('oculto');
        bloqueNuevaFicha.removeClass('oculto').addClass('mostrar');

        // Agrego las referencias al select de referencias
        let listadoReferenciasj = obtenerDatajson("nombre","con_t_resumen","filasunicas","0","0");
        let listadoReferencias =  JSON.parse(listadoReferenciasj);    
        let html='';
        for (let i = 0; i < listadoReferencias.length; i++) {
            html = `${html} <option class='remover'  value='${listadoReferencias[i].nombre}'>${listadoReferencias[i].nombre}</option>`;
            
        }
        let referenciasParaficha  = $('#referenciasParaficha');
        referenciasParaficha.append(html);

        // Agrego los insumos al select de insumos
        let listadoInsumosj = obtenerDatajson("grupo,presentacion","con_t_insumos","filasunicas","0","0");
        let listadoInsumos =  JSON.parse(listadoInsumosj);    
        html='';
        for (let i = 0; i < listadoInsumos.length; i++) {
            html = `${html} <option class='remover'  value='${listadoInsumos[i].grupo}'>${listadoInsumos[i].grupo} ${listadoInsumos[i].presentacion}</option>`;
        }
        let insumoFicha1  = $('#insumoFicha1');
        insumoFicha1.append(html);
        insumosdeFichas();
        
        // Agrego las tallas al select de tallas
        let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
        let listadoTallas =  JSON.parse(listadoTallasj);    
        html='';
        for (let i = 0; i < listadoTallas.length; i++) {
            html = `${html} <option class='remover'  value='${listadoTallas[i].talla}'>${listadoTallas[i].talla}</option>`;
        }
        let tallaMedida0  = $('#tallaMedida0');
        tallaMedida0.append(html);
        
        // Agrego las tallas al select de tallas
        let listadoTipoTallasj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
        let listadoTipoTallas =  JSON.parse(listadoTipoTallasj);    
        html='';
        for (let i = 0; i < listadoTipoTallas.length; i++) {
            html = `${html} <option class='remover'  value='${listadoTipoTallas[i].tipo_medida}'>${listadoTipoTallas[i].tipo_medida}</option>`;
        }
        let tipo_medida0  = $('#tipo_medida0');
        tipo_medida0.append(html);


    }else if($('#fichasTecnicasSelect').val()!=='selecciona'){
        $('.removerActualizacionFicha').remove();
        const bloqueAntiguaFicha = $('#bloqueAntiguaFicha');
        const selecciondeficha = $('#selecciondeficha');

        selecciondeficha.removeClass('mostrar').addClass('oculto');
        bloqueAntiguaFicha.removeClass('oculto').addClass('mostrar');
        
        // Agrego los detalles del modelo, de confección y nombre de la referencia
        let detallesj = obtenerDatajson("ID,detalles_modelo,detalles_confeccion","con_t_fichatecnica","valoresconcondicion","referencia",`'${$('#fichasTecnicasSelect').val()}'`);
        let detalles =  JSON.parse(detallesj);    
        let html='';

        $('#nombreReferencia').text($('#fichasTecnicasSelect').val());
        idReferencia = detalles[0].ID;
        $('#detallesModeloFicha').text(detalles[0].detalles_modelo);
        $('#detallesConfeccionFicha').text(detalles[0].detalles_confeccion);

        // Agrego la tabla de medidas
        let medidasj = obtenerDatajson("ID,talla,tipo_medida,medida","con_t_medidasproducto","valoresconcondicion","ficha_tecnica",detalles[0].ID);
        let medidas =  JSON.parse(medidasj);    
        html='';

        for (let i = 0; i < medidas.length; i++) {
            html = `${html} 
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 removerActualizacionFicha removerMedidasFicha' id='medidasproducto${i}' name='${medidas[i].ID}'>
                <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2' >
                    <p class="letra18pt-pc" id='tallaproducto${i}'>${medidas[i].talla}</p>
                </div>
                <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3' >
                    <p class="letra18pt-pc" id='tipomedidaproducto${i}'>${medidas[i].tipo_medida}</p>
                </div>
                <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2' >
                    <p class="letra18pt-pc" id='medidamedidaproducto${i}'>${medidas[i].medida}</p>
                </div>
                <div class=' col-lg-5 col-md-5 col-sm-5 col-xs-5' >
                    <button class='botonmodal actualizarMedida' type='button' name='${i}'>Editar medida</button>
                </div>
            </div>`;
            
        }

        $('#tablaMedidasFicha').append(html);

        

        // Agrego las tallas al select de tallas
        let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
        let listadoTallas =  JSON.parse(listadoTallasj);    
        html='';
        for (let i = 0; i < listadoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTallas[i].talla}'>${listadoTallas[i].talla}</option>`;
        }
        let tallaMedida0  = $('#tallaMedidaFicha0');
        tallaMedida0.append(html);

        // Agrego el tipo de medida al select de tallas
        let listadoTipoTallasj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
        let listadoTipoTallas =  JSON.parse(listadoTipoTallasj);    
        html='';
        for (let i = 0; i < listadoTipoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTipoTallas[i].tipo_medida}'>${listadoTipoTallas[i].tipo_medida}</option>`;
        }
        let tipo_medida0  = $('#tipo_medidaFicha0');
        tipo_medida0.append(html);


         // Agrego la tabla de combinaciones
         let combinacionesj = obtenerDatajson("ID,indicativo_combinacion,insumo,cantidad,text_insumo","con_t_combinacionesproducto","valoresconcondicion","ficha_tecnica",detalles[0].ID);
        let combinaciones =  JSON.parse(combinacionesj);    
        html='';
        console.log(combinaciones);

        const grupos = {};
        combinaciones.forEach((elemento) => {
        if (!grupos[elemento.indicativo_combinacion]) {
            grupos[elemento.indicativo_combinacion] = [];
        }
        grupos[elemento.indicativo_combinacion].push(elemento);
        });

        const arreglosSeparados = Object.values(grupos);
        console.log(arreglosSeparados);

        for (let i = 0; i < arreglosSeparados.length; i++) {
            html = `${html} <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 removerActualizacionFicha removerActualizacionCombinacionesFicha''>`;
            for (let j = 0; j < arreglosSeparados[i].length; j++) {
                html = `${html} <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3' >
                    <p class="letra18pt-pc" >${arreglosSeparados[i][j].text_insumo}</p>
                </div>`;                
            }
             html = `${html} </div>`;
            
        }

        $('#combinacionesFicha').append(html);


        // // Agrego los insumos al select de insumos
        // let listadoInsumosj = obtenerDatajson("grupo,presentacion","con_t_insumos","filasunicas","0","0");
        // let listadoInsumos =  JSON.parse(listadoInsumosj);    
        // html='';
        // for (let i = 0; i < listadoInsumos.length; i++) {
        //     html = `${html} <option class='removerActualizacionFicha'  value='${listadoInsumos[i].grupo}'>${listadoInsumos[i].grupo} ${listadoInsumos[i].presentacion}</option>`;
        // }
        // let insumoFicha1  = $('#insumoFichaNuevo1');
        // insumoFicha1.append(html);

        comboActualizarFT();
    }
});   
var referenciaParaficha;
var detalles_modelo;
var detalles_confeccion;
var talla;	
var insumos;
var combinaciones;	
$('#referenciasParaficha').on('change', function(){
    referenciaParaficha = $('#referenciasParaficha').val();
    let referenciaFichaj = obtenerDatajson("referencia","con_t_fichatecnica","valoresconcondicion","referencia",`'${$('#referenciasParaficha').val()}'`);
    let referenciaFicha =  JSON.parse(referenciaFichaj);   
    if(referenciaFicha.length > 0){
        $('.remover').remove();
        $('#resumenInsumos').css('display', 'none');
        $('#nuevoInsumo').css('display', 'none');     
        $('#facturaNueva').css('display', 'none');       
        $('#resumenInvInsumos').css('display', 'none'); 
        $('#bloqueFichas').css('display', 'block'); 

        const bloqueNuevaFicha = $('#bloqueNuevaFicha');
        const selecciondeficha = $('#selecciondeficha');

        bloqueNuevaFicha.removeClass('mostrar').addClass('oculto');
        selecciondeficha.removeClass('oculto').addClass('mostrar');

        $('#modalAlertas').modal("show"); 
        $('#tituloAlertas').text(`La referencia ${referenciaParaficha} ya tiene una ficha técnica creada, por favor seleccionala si la quieres editar.`);
        return false;
    }
    
}); 
$('#otraMedida').on('click', function(){
    let listadotallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
    let listadotallas =  JSON.parse(listadotallasj);
    let listadotallashtml='';
    for (let i = 0; i < listadotallas.length; i++) {
        listadotallashtml = `${listadotallashtml} <option class='remover'  value='${listadotallas[i].talla}'>${listadotallas[i].talla}</option>`;        
    }    
    let listadotipo_medidaj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
    let listadotipo_medida =  JSON.parse(listadotipo_medidaj);
    let listadotipo_medidahtml='';
    for (let i = 0; i < listadotipo_medida.length; i++) {
        listadotipo_medidahtml = `${listadotipo_medidahtml} <option class='remover'  value='${listadotipo_medida[i].tipo_medida}'>${listadotipo_medida[i].tipo_medida}</option>`;
        
    }
    let html = `
    <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12' >
        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed'>
            <label  class="control-label letra18pt-pc"> Talla </label>
            <select class='form-control tallaMedida' type='select' id='tallaMedida${$('.tallaMedida').length}' name='${$('.tallaMedida').length}'>
                <option  value='nueva'>Nueva</option>
                ${listadotallashtml}
            </select><span class='pmd-textfield-focused'></span>
        </div>
        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="cantidad" class="control-label letra18pt-pc"> Nueva talla </label>
            <input class="form-control" type="text" id="nueva_talla${$('.tallaMedida').length}" name="${$('.tallaMedida').length}" required=""><span class="pmd-textfield-focused"></span>
        </div>
        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3 pmd-textfield-floating-label-completed'>
            <label  class="control-label letra18pt-pc"> Tipo de medida </label>
            <select class='form-control tipo_medida' type='select' id='tipo_medida${$('.tallaMedida').length}' name='${$('.tallaMedida').length}'>
                <option  value='nueva'>Nueva</option>
                ${listadotipo_medidahtml}
            </select><span class='pmd-textfield-focused'></span>
        </div>
        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <label for="cantidad" class="control-label letra18pt-pc"> Nuevo tipo de medida </label>
            <input class="form-control" type="text" id="nuevo_tipo_medida${$('.tallaMedida').length}" name="${$('.tallaMedida').length}" required=""><span class="pmd-textfield-focused"></span>
        </div>
        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="cantidad" class="control-label letra18pt-pc"> Medida </label>
            <input class="form-control" type="number" id="medida${$('.tallaMedida').length}" name="${$('.tallaMedida').length}" required=""><span class="pmd-textfield-focused"></span>
        </div>   
    </div>   
    `;
    $('#otraMedidaDiv').before(html);
}); 
const insumosdeFichas = () =>{
    $('.insumoFicha').on('change', function(){
        var numeroInsumo = this.name;
        var cantidadInsumos = $('.insumoFicha').length;
        if(numeroInsumo == cantidadInsumos){    
            let listadoInsumosj = obtenerDatajson("grupo,presentacion","con_t_insumos","filasunicas","0","0");
            let listadoInsumos =  JSON.parse(listadoInsumosj);    
            let html='';
            for (let i = 0; i < listadoInsumos.length; i++) {
                html = `${html} <option class='remover'  value='${listadoInsumos[i].grupo}'>${listadoInsumos[i].grupo} ${listadoInsumos[i].presentacion}</option>`;
            }
            let htmll = `
                    <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12' id='material${parseInt(numeroInsumo)+1}'>
                        <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6 pmd-textfield-floating-label-completed'>
                            <label  class="control-label letra18pt-pc"> Insumo </label>
                            <select class='form-control insumoFicha' type='select' id='insumoFicha${parseInt(numeroInsumo)+1}' name='${parseInt(numeroInsumo)+1}'>
                                <option  value='selecciona'>Selecciona</option>
                                ${html}
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                            <input class="form-control" type="number" id="cantidadInsumo${parseInt(numeroInsumo)+1}" name="${parseInt(numeroInsumo)+1}" required=""><span class="pmd-textfield-focused"></span>
                        </div>      
                        <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="observasiones" class="control-label letra18pt-pc"> Observasiones </label>
                            <input class="form-control" type="text" id="observasion${parseInt(numeroInsumo)+1}" name="${parseInt(numeroInsumo)+1}" required=""><span class="pmd-textfield-focused"></span>
                        </div>               
                    </div>
            `;
            $(`#material${numeroInsumo}`).after(htmll);  
            insumosdeFichas();
        }
    }); 
}
$('#guardarFicha').on('click', function(){
    detalles_modelo = $("#detales_modelo").val();
    detalles_confeccion = $("#detalles_confeccion").val();

    if(!referenciaParaficha){
        $('#modalAlertas').modal("show"); 
        $('#tituloAlertas').text("Por favor ingresa el nombre de la referencia para la ficha técnica que estás creando");
        return false;
    }
    // Acomodo el array de objetos de tallas
    var tallas = $('.tallaMedida');	
    talla = [];
    for (let i = 0; i < tallas.length; i++) {
        var tallaactual = $(`#tallaMedida${i}`).val();
        
        if(tallaactual == "nueva"){
            tallaactual = $(`#nueva_talla${i}`).val();
        }
        if(!tallaactual && i==0){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text("Por favor revisa las tallas ya que en la primera talla dices que vas a agregar una nueva pero el valor es vacío");
            return false;
        }
        if(!tallaactual){continue;}

        var medidaactual = $(`#tipo_medida${i}`).val();        
        if(medidaactual == "nueva"){
            medidaactual = $(`#nuevo_tipo_medida${i}`).val();
        }
        if(!medidaactual){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor revisa las tallas:
             En la talla ${i} dices que vas a agregar un nuevo tipo de talla pero el campo está vacío`);
            return false;
        }

        var dimensionactual = $(`#medida${i}`).val();
        if(!dimensionactual){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor revisa las tallas:
             En la talla ${i} la medida está vacío`);
            return false;
        }
        var objetomedidas = {};
        objetomedidas.talla = tallaactual;
        objetomedidas.tipo_medida = medidaactual;
        objetomedidas.medida = dimensionactual;
        talla.push(objetomedidas);
    }

    // acomodo el array de objeto de insumos
    var insumoClase = $('.insumoFicha');	
    insumos = [];
    for (let i = 1; i <= insumoClase.length; i++) {
        var insumoactual = $(`#insumoFicha${i}`).val();
        if(insumoactual == "selecciona"  && i==1){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text("Por favor revisa los insumos ya que en el primero no has seleccionado ninguno");
            return false;
        }
        if(insumoactual == "selecciona"){continue;}

        var cantidadactual = $(`#cantidadInsumo${i}`).val();      
        if(!cantidadactual){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor revisa los insumos:
             En el insumo ${i} no has especificado la cantidad que se va a utilizar para el producto.`);
            return false;
        }

        var observasionActual = $(`#observasion${i}`).val();

        var objetoinsumos = {};
        objetoinsumos.insumo = insumoactual;
        objetoinsumos.cantidad = cantidadactual;
        objetoinsumos.observacion = observasionActual;
        insumos.push(objetoinsumos);
    }

    if(!detalles_modelo || !detalles_confeccion){
        $('#modalAlertas').modal("show"); 
        $('#tituloAlertas').text("Por favor revisa los detalles de confección o detalles del modelo, no pueden estar vacíos"); 
        return false;
    }else{
        $('#modalCombinaciones').modal("show"); 
        $('.removerCominaciones').remove();        
        insertarCombinacion();   
    }     
});
const insertarCombinacion = () =>{
    var cantidadFilasInsumos = $('.removerCominaciones').length;
    var html = ` <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerCominaciones' id='filaCombinaciones${cantidadFilasInsumos}' name='${cantidadFilasInsumos}'>
            <p class='letra18pt-pc negrillaTres'> Combinación ${cantidadFilasInsumos + 1}</p>
    `;
    for (let i = 0; i < insumos.length; i++) {
        var insumoPorConsultar = insumos[i].insumo;
        var colores = obtenerDatajson("ID,complemento,caracteristica,complemento_caracteristica","con_t_insumos","valoresconcondicion","grupo",`'${insumoPorConsultar}'`);
        var jsoncolores = JSON.parse(colores); 
        var htmll='';
        for (let i = 0; i < jsoncolores.length; i++) {
            htmll = `${htmll} <option  value='${jsoncolores[i].ID}'>${jsoncolores[i].complemento} ${jsoncolores[i].caracteristica} ${jsoncolores[i].complemento_caracteristica}</option>`;            
        }
        html = `${html} 
        <div  class='col-lg-3 col-md-3 col-sm-3 col-xs-3 elementoCombinado'>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p  class=" letra18pt-pc insumoComnbinado"> ${insumos[i].insumo} </p>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p  class=" letra18pt-pc cantidadComnbinado"> ${insumos[i].cantidad} </p>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-12 col-md-12 col-sm-12 col-xs-12 pmd-textfield-floating-label-completed">
                    <label class=" letra18pt-pc"> Color </label>
                    <select class='form-control colorCombinaciones' type='select' required=''>
                        <option class=''  value='selecciona'>Selecciona</option>
                        ${htmll} 
                    </select><span class='pmd-textfield-focused'></span>
                </div>
        </div>
        `;            
    }
    html = `${html} </div>`;
    $('#lasCombinaciones').append(html);
} 
    
$('#otraCombinacion').on('click', function(){ insertarCombinacion();  }); 


//confirmarCombinaciones

$('#confirmarCombinaciones').on('click', function(){
    $('.removerResumenFicha').remove();
    combinaciones = [];
    var elementoCombinado = $('.elementoCombinado');
    for (let i = 0; i < elementoCombinado.length; i++) {
        
        var insumoCombinacion = $(elementoCombinado[i]).find('.insumoComnbinado').text();
        var cantidadComnbinado = $(elementoCombinado[i]).find('.cantidadComnbinado').text();
        var colorCombinacion = $(elementoCombinado[i]).find('.colorCombinaciones').val();
        var indicativo_combinacion = parseInt($(elementoCombinado[i]).parent().attr('name'))+1;
        var colorCombinacionTexto =  $(elementoCombinado[i]).find('.colorCombinaciones').find('option:selected').text();
        if(colorCombinacion == 'selecciona'){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor revisa los colores de la combinación ${indicativo_combinacion}, 
            recuerda que todos los insumos deben tener sus colores asignados`); 
            return false;
        }
        var objetoCombinaciones = {};
        objetoCombinaciones.indicativo_combinacion = indicativo_combinacion;
        objetoCombinaciones.insumoCombinacion = insumoCombinacion;
        objetoCombinaciones.idInsumoCombinacion = colorCombinacion;
        objetoCombinaciones.colorCombinacionTexto =colorCombinacionTexto;
        objetoCombinaciones.cantidadComnbinado =cantidadComnbinado;
        combinaciones.push(objetoCombinaciones);
    }    
    
    var resumenHtml = ` <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc negrillaUno">Referencia: ${referenciaParaficha}</p>
                    </div>`;

    var indicativoAnterior = 0;
    $('#modalResumenFicha').modal("show"); 
    for (let i = 0; i < combinaciones.length; i++) {
        if(indicativoAnterior !== combinaciones[i].indicativo_combinacion){
            resumenHtml = `${resumenHtml} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc">Combinacion ${combinaciones[i].indicativo_combinacion}</p>
                    </div>`;
            indicativoAnterior = combinaciones[i].indicativo_combinacion;
        }
        resumenHtml = `${resumenHtml} <div  class='col-lg-3 col-md-3 col-sm-3 col-xs-3 removerResumenFicha' >
                        <p class="letra18pt-pc">${combinaciones[i].insumoCombinacion} ${combinaciones[i].colorCombinacionTexto}</p>
                    </div>`;
    }
    resumenHtml = `${resumenHtml} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc negrillaUno">Insumos</p>
                    </div>`;
    for (let i = 0; i < insumos.length; i++) {
        resumenHtml = `${resumenHtml} <div  class='col-lg-3 col-md-3 col-sm-3 col-xs-3 removerResumenFicha' >
                        <p class="letra18pt-pc">${insumos[i].insumo} ${insumos[i].cantidad}  ${insumos[i].observacion}</p>
                    </div>`;        
    }
    resumenHtml = `${resumenHtml} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc negrillaUno">Tallas</p>
                    </div>`;
    for (let i = 0; i < talla.length; i++) {
        resumenHtml = `${resumenHtml} <div  class='col-lg-3 col-md-3 col-sm-3 col-xs-3 removerResumenFicha' >
                        <p class="letra18pt-pc">${talla[i].talla} ${talla[i].tipo_medida}  ${talla[i].medida}</p>
                    </div>`;        
    }
    resumenHtml = `${resumenHtml} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc negrillaUno">Detalles del modelo</p>
                        <p class="letra18pt-pc">${detalles_modelo}</p>
                    </div>`;
                    
    resumenHtml = `${resumenHtml} <div  class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerResumenFicha' >
                        <p class="letra18pt-pc negrillaUno">Detalles de confección</p>
                        <p class="letra18pt-pc">${detalles_confeccion}</p>
                    </div>`;
    $('#cuerpoResumen').append(resumenHtml); 
}); 
$('#confirmarFichaTecnica').on('click', function(){
    //  	referencia 	fecha_creacion 	detalles_modelo 	detalles_confeccion
    //      con_t_fichatecnica
    var objeto = {};
    objeto.tipo = "string";
    objeto.columna = "referencia";
    objeto.valor = referenciaParaficha;
    var referencia = prepararjson(objeto);
    var objeto = {};
    objeto.tipo = "string";
    objeto.columna = "detalles_modelo";
    objeto.valor = detalles_modelo;
    var detalles_modeloInsert = prepararjson(objeto);
    var objeto = {};
    objeto.tipo = "string";
    objeto.columna = "detalles_confeccion";
    objeto.valor = detalles_confeccion;
    var detalles_confeccionInsert = prepararjson(objeto);
    let idFichaTecnica = JSON.parse(insertarfila("con_t_fichatecnica",referencia,detalles_modeloInsert,detalles_confeccionInsert,"0","0","0","0","0","0","0","0"));
    

    var objeto = {};
    objeto.tipo = "int";
    objeto.columna = "ficha_tecnica";
    objeto.valor = idFichaTecnica[0].id;
    var idFichaTecnicaObjeto = prepararjson(objeto);
    for (let i = 0; i < combinaciones.length; i++) {
        // ficha_tecnica 	indicativo_combinacion 	insumo 	cantidad 	text_insumo 
        //  con_t_combinacionesproducto
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "indicativo_combinacion";
        objeto.valor = combinaciones[i].indicativo_combinacion;
        var indicativo_combinacion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "insumo";
        objeto.valor = combinaciones[i].idInsumoCombinacion;
        var insumo = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "cantidad";
        objeto.valor = combinaciones[i].cantidadComnbinado;
        var cantidad = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "text_insumo";
        objeto.valor = `${combinaciones[i].insumoCombinacion} ${combinaciones[i].colorCombinacionTexto}`;
        var text_insumo = prepararjson(objeto);
        insertarfila(
            "con_t_combinacionesproducto",idFichaTecnicaObjeto,indicativo_combinacion,insumo,cantidad,text_insumo,"0","0","0","0","0","0");        
    }

    for (let i = 0; i < insumos.length; i++) {
        // ficha_tecnica 	insumo 	cantidad 	observacion
        // con_t_insumosproducto
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "insumo";
        objeto.valor = insumos[i].insumo;
        var insumo = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "float";
        objeto.columna = "cantidad";
        objeto.valor = insumos[i].cantidad;
        var cantidad = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "observacion";
        objeto.valor = insumos[i].observacion;
        var observacion = prepararjson(objeto);
        insertarfila("con_t_insumosproducto",idFichaTecnicaObjeto,insumo,cantidad,observacion,"0","0","0","0","0","0","0");     
    }
    for (let i = 0; i < talla.length; i++) {
        // ficha_tecnica 	talla 	tipo_medida 	medida 	
        // con_t_medidasproducto
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "talla";
        objeto.valor = talla[i].talla;
        var tallaInsert = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "tipo_medida";
        objeto.valor = talla[i].tipo_medida;
        var tipo_medida = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "float";
        objeto.columna = "medida";
        objeto.valor = talla[i].medida;
        var medida = prepararjson(objeto);
        insertarfila("con_t_medidasproducto",idFichaTecnicaObjeto,tallaInsert,tipo_medida,medida,"0","0","0","0","0","0","0");    
    }
    $('#modalResumenFicha').modal("hide"); 
    $('#modalCombinaciones').modal("hide"); 
    const bloqueNuevaFicha = $('#bloqueNuevaFicha');
    const selecciondeficha = $('#selecciondeficha');

    bloqueNuevaFicha.removeClass('mostrar').addClass('oculto');
    selecciondeficha.removeClass('oculto').addClass('mostrar');

    // Agrego las referencias que tienen ficha técnica al select de Ficha técnica
    $('.removerReferenciaConFicha').remove();
    let listadoReferenciasj = obtenerDatajson("referencia","con_t_fichatecnica","filasunicas","0","0");
    let listadoReferencias =  JSON.parse(listadoReferenciasj);    
    let html='';
    for (let i = 0; i < listadoReferencias.length; i++) {
        html = `${html} <option class='removerReferenciaConFicha'  value='${listadoReferencias[i].referencia}'>${listadoReferencias[i].referencia}</option>`;
        
    }
    let fichasTecnicasSelect  = $('#fichasTecnicasSelect');
    fichasTecnicasSelect.append(html);
}); 
//******************************************************************************++Ficas técnicas
//****++Ficas técnicas actualizar
$('#guardarDetalles').on('click', function(){
    var detales_modeloFiccion = $('#detales_modeloFiccion').val();
    var detalles_confeccionFiccion = $('#detalles_confeccionFiccion').val();
    if(!detales_modeloFiccion){
        detales_modeloFiccion =  $('#detallesModeloFicha').text();
    }
    if(!detalles_confeccionFiccion){
        detalles_confeccionFiccion =  $('#detallesConfeccionFicha').text();
    }
    var objeto = {};
    objeto.columna = "ID";
    objeto.valor = idReferencia;
    var condicion = prepararjson(objeto);
    var objeto = {};
    objeto.tipo = "string";
    objeto.columna = "detalles_modelo";
    objeto.valor = detales_modeloFiccion;
    var  detalles_modelo = prepararjson(objeto);
    var objeto = {};
    objeto.tipo = "string";
    objeto.columna = "detalles_confeccion";
    objeto.valor = detalles_confeccionFiccion;
    var  detalles_confeccion = prepararjson(objeto);
    actualizarregistros("con_t_fichatecnica",condicion,detalles_modelo,detalles_confeccion,"0","0","0","0","0","0","0","0","0");
    console.log(`con_t_fichatecnica,${condicion},${detalles_modelo},${detalles_confeccion}`);
    // Agrego los detalles del modelo, de confección y nombre de la referencia
    let detallesj = obtenerDatajson("ID,detalles_modelo,detalles_confeccion","con_t_fichatecnica","valoresconcondicion","referencia",`'${$('#fichasTecnicasSelect').val()}'`);
    let detalles =  JSON.parse(detallesj);    
    let html='';
    
    $('#nombreReferencia').text($('#fichasTecnicasSelect').val());
    $('#nombreReferencia').attr('name',detalles[0].ID);
    $('#detallesModeloFicha').text(detalles[0].detalles_modelo);
    $('#detallesConfeccionFicha').text(detalles[0].detalles_confeccion);

}); 

var iDAFT = '';
var tallaAFT = '';
var tipo_medidaAFT = '';
var medidaAFT = '';
var iMedidaAFT = '';

var materialDivAFT= '';
var insumoDivAFT='';
var cantidadDivAFT='';
var observasionDivAFT='';

const comboActualizarFT = () => {

    $('.actualizarMedida').on('click', function(){
        iMedidaAFT = this.name;
        iDAFT = $(`#medidasproducto${this.name}`).attr('name');
        tallaAFT = $(`#tallaproducto${this.name}`).text();
        tipo_medidaAFT = $(`#tipomedidaproducto${this.name}`).text();
        medidaAFT = $(`#medidamedidaproducto${this.name}`).text();
       
        $('#tituloActualizarMedidaAFT').text(`Actualizar la talla ${tallaAFT} ${tipo_medidaAFT} ${medidaAFT}`);

         // Agrego las tallas al select de tallas
         let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
        let listadoTallas =  JSON.parse(listadoTallasj);    
        html='';
        for (let i = 0; i < listadoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTallas[i].talla}'>${listadoTallas[i].talla}</option>`;
        }
        let tallaMedidaAFT0  = $('#tallaMedidaAFT0');
        tallaMedidaAFT0.append(html);

        // Agrego el tipo de medida al select de tallas
        let listadoTipoTallasj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
        let listadoTipoTallas =  JSON.parse(listadoTipoTallasj);    
        html='';
        for (let i = 0; i < listadoTipoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTipoTallas[i].tipo_medida}'>${listadoTipoTallas[i].tipo_medida}</option>`;
        }
        let tipo_medidaAFT0  = $('#tipo_medidaAFT0');
        tipo_medidaAFT0.append(html);

        $('#actMedidaFt').modal("show"); 
    }); 

    $('#confirmarCambiodelaMedida').on('click', function(){
        // tallaMedidaAFT0 nueva
        // nueva_tallaAFT0
        // tipo_medidaAFT0 nueva
        // nuevo_tipo_medidaAFT0
        // medidaAFT0
        var tallaMedida = $('#tallaMedidaAFT0').val();
        var tipoMedida = $('#tipo_medidaAFT0').val();
        if(tallaMedida == 'nueva'){
            tallaMedida=$('#nueva_tallaAFT0').val();
            if(!tallaMedida){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Estás indicando que vas a agregar una talla nueva, por favor llena el campo de Nueva talla`); 
                return false;
            }
            // Verifico que esta talla no esté agregada anteriormente
            let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","valoresconcondicion","talla",`'${tallaMedida}'`);
            let listadoTallas =  JSON.parse(listadoTallasj);  
            if(listadoTallas.length>0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Estás indicando que vas a agregar una talla nueva, por favor verifica que no está talla no haya estado agregada antes`); 
                return false;
            }
        }
        if(tipoMedida == 'nueva'){
            tipoMedida=$('#nuevo_tipo_medidaAFT0').val();
            if(!tipoMedida){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Estás indicando que vas a agregar un nuevo tipo de medida, por favor llena el campo de Nuevo tipo de medida`); 
                return false;
            }
            // Verifico que esta talla no esté agregada anteriormente
            let listadoTipoTallasj = obtenerDatajson("tipo_medida","con_t_medidasproducto","valoresconcondicion","tipo_medida",`'${tipoMedida}'`);
            let listadoTipoTallas =  JSON.parse(listadoTipoTallasj);  
            if(listadoTipoTallas.length>0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Estás indicando que vas a agregar una nuevo tipo de medida, por favor verifica que no este tipo de medida no haya estado agregada antes`); 
                return false;
            }
        }
        var medidaNum = $('#medidaAFT0').val();
        if(!medidaNum){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor pon un valor para la medida, llena el campo "Medida"`); 
            return false;
        }
        
        objeto = {};
        objeto.columna = "ID";
        objeto.valor = iDAFT;
        var condicion = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "talla";
        objeto.valor = tallaMedida;
        var  talla = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "tipo_medida";
        objeto.valor = tipoMedida;
        var  tipo_medida = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "medida";
        objeto.valor = medidaNum;
        var  medida = prepararjson(objeto);
        
        actualizarregistros("con_t_medidasproducto",condicion,talla,tipo_medida,medida,"0","0","0","0","0","0","0","0");

        $(`#tallaproducto${iMedidaAFT}`).text(tallaMedida);
        $(`#tipomedidaproducto${iMedidaAFT}`).text(tipoMedida);
        $(`#medidamedidaproducto${iMedidaAFT}`).text(medidaNum);

        // Agrego las tallas al select de tallas
        $('.removerSelectActualizacion').remove();
        let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
        let listadoTallas =  JSON.parse(listadoTallasj);    
        html='';
        for (let i = 0; i < listadoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTallas[i].talla}'>${listadoTallas[i].talla}</option>`;
        }
        let tallaMedida0  = $('.tallaMedidaFicha');
        tallaMedida0.append(html);

        // Agrego el tipo de medida al select de tallas
        let listadoTipoTallasj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
        let listadoTipoTallas =  JSON.parse(listadoTipoTallasj);    
        html='';
        for (let i = 0; i < listadoTipoTallas.length; i++) {
            html = `${html} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadoTipoTallas[i].tipo_medida}'>${listadoTipoTallas[i].tipo_medida}</option>`;
        }
        let tipo_medida0  = $('.tipo_medidaFicha');
        tipo_medida0.append(html);


        $('#actMedidaFt').modal("hide"); 
        
        
    }); 

    
    $('#otraMedidaFicha').on('click', function(){
        let listadotallasj = obtenerDatajson("talla","con_t_medidasproducto","filasunicas","0","0");
        let listadotallas =  JSON.parse(listadotallasj);
        let listadotallashtml='';
        for (let i = 0; i < listadotallas.length; i++) {
            listadotallashtml = `${listadotallashtml} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadotallas[i].talla}'>${listadotallas[i].talla}</option>`;        
        }    
        let listadotipo_medidaj = obtenerDatajson("tipo_medida","con_t_medidasproducto","filasunicas","0","0");
        let listadotipo_medida =  JSON.parse(listadotipo_medidaj);
        let listadotipo_medidahtml='';
        for (let i = 0; i < listadotipo_medida.length; i++) {
            listadotipo_medidahtml = `${listadotipo_medidahtml} <option class='removerActualizacionFicha removerSelectActualizacion'  value='${listadotipo_medida[i].tipo_medida}'>${listadotipo_medida[i].tipo_medida}</option>`;
            
        }
        let html = `
        <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 removerOtrasMedidas' >
            <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2 pmd-textfield-floating-label-completed'>
                <label  class="control-label letra18pt-pc"> Talla </label>
                <select class='form-control tallaMedidaFicha' type='select' id='tallaMedidaFicha${$('.tallaMedidaFicha').length}' name='${$('.tallaMedidaFicha').length}'>
                    <option  value='nueva'>Nueva</option>
                    ${listadotallashtml}
                </select><span class='pmd-textfield-focused'></span>
            </div>
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="cantidad" class="control-label letra18pt-pc"> Nueva talla </label>
                <input class="form-control" type="text" id="nueva_tallaFicha${$('.tallaMedidaFicha').length}" name="${$('.tallaMedidaFicha').length}" required=""><span class="pmd-textfield-focused"></span>
            </div>
            <div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3 pmd-textfield-floating-label-completed'>
                <label  class="control-label letra18pt-pc"> Tipo de medida </label>
                <select class='form-control tipo_medidaFicha' type='select' id='tipo_medidaFicha${$('.tallaMedidaFicha').length}' name='${$('.tallaMedida').length}'>
                    <option  value='nueva'>Nueva</option>
                    ${listadotipo_medidahtml}
                </select><span class='pmd-textfield-focused'></span>
            </div>
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="cantidad" class="control-label letra18pt-pc"> Nuevo tipo de medida </label>
                <input class="form-control" type="text" id="nuevo_tipo_medidaFicha${$('.tallaMedidaFicha').length}" name="${$('.tallaMedidaFicha').length}" required=""><span class="pmd-textfield-focused"></span>
            </div>
            <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="cantidad" class="control-label letra18pt-pc"> Medida </label>
                <input class="form-control" type="number" id="medidaFicha${$('.tallaMedidaFicha').length}" name="${$('.tallaMedidaFicha').length}" required=""><span class="pmd-textfield-focused"></span>
            </div>   
        </div>   
        `;
        $('#otraMedidaFichaDiv').before(html);
    }); 
    

    $('#guardarNuevasMedidas').on('click', function(){
        // Acomodo el array de objetos de tallas
        var tallas = $('.tallaMedidaFicha');	
        tallaFicha = [];
        for (let i = 0; i < tallas.length; i++) {
            var tallaactual = $(`#tallaMedidaFicha${i}`).val();
            
            if(tallaactual == "nueva"){
                tallaactual = $(`#nueva_tallaFicha${i}`).val();
            }
            if(!tallaactual && i==0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text("Por favor revisa las tallas ya que en la primera talla dices que vas a agregar una nueva pero el valor es vacío");
                return false;
            }
            if(!tallaactual){continue;}

            var medidaactual = $(`#tipo_medidaFicha${i}`).val();        
            if(medidaactual == "nueva"){
                medidaactual = $(`#nuevo_tipo_medidaFicha${i}`).val();
            }
            if(!medidaactual){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor revisa las tallas:
                En la talla ${i} dices que vas a agregar un nuevo tipo de talla pero el campo está vacío`);
                return false;
            }

            var dimensionactual = $(`#medidaFicha${i}`).val();
            if(!dimensionactual){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor revisa las tallas:
                En la talla ${i} la medida está vacío`);
                return false;
            }
            var objetomedidas = {};
            objetomedidas.talla = tallaactual;
            objetomedidas.tipo_medida = medidaactual;
            objetomedidas.medida = dimensionactual;
            tallaFicha.push(objetomedidas);
        }

        for (let i = 0; i < tallaFicha.length; i++) {
            // ficha_tecnica 	talla 	tipo_medida 	medida 	
            // con_t_medidasproducto
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "talla";
            objeto.valor = tallaFicha[i].talla;
            var tallaInsert = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "tipo_medida";
            objeto.valor = tallaFicha[i].tipo_medida;
            var tipo_medida = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "float";
            objeto.columna = "medida";
            objeto.valor = tallaFicha[i].medida;
            var medida = prepararjson(objeto);

            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "ficha_tecnica";
            objeto.valor = idReferencia;
            var idFichaTecnicaObjeto = prepararjson(objeto);
            
            insertarfila("con_t_medidasproducto",idFichaTecnicaObjeto,tallaInsert,tipo_medida,medida,"0","0","0","0","0","0","0");    
        }

        $('.removerMedidasFicha').remove();
        $('.removerOtrasMedidas').remove();

        // Agrego la tabla de medidas
        let medidasj = obtenerDatajson("ID,talla,tipo_medida,medida","con_t_medidasproducto","valoresconcondicion","ficha_tecnica",idReferencia);
        let medidas =  JSON.parse(medidasj);    
        html='';

        for (let i = 0; i < medidas.length; i++) {
            html = `${html} 
            <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12 removerActualizacionFicha removerMedidasFicha' id='medidasproducto${i}' name='${medidas[i].ID}'>
                <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2' >
                    <p class="letra18pt-pc" id='tallaproducto${i}'>${medidas[i].talla}</p>
                </div>
                <div class=' col-lg-3 col-md-3 col-sm-3 col-xs-3' >
                    <p class="letra18pt-pc" id='tipomedidaproducto${i}'>${medidas[i].tipo_medida}</p>
                </div>
                <div class=' col-lg-2 col-md-2 col-sm-2 col-xs-2' >
                    <p class="letra18pt-pc" id='medidamedidaproducto${i}'>${medidas[i].medida}</p>
                </div>
                <div class=' col-lg-5 col-md-5 col-sm-5 col-xs-5' >
                    <button class='botonmodal actualizarMedida' type='button' name='${i}'>Editar medida</button>
                </div>
            </div>`;
            
        }

        $('#tablaMedidasFicha').append(html);
        comboActualizarFT();
    }); 

    
}



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
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>