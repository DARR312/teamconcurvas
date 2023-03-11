<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
for(i=30;i<permisos.length;i++){
    console.log(permisos[i]);
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
}
//******************************************************************************++Insumo nuevo
$('#agregarInsumo').on('click', function() {
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'block');     
    $('#facturaNueva').css('display', 'none');   
    $('#resumenInvInsumos').css('display', 'none');     
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
    console.log(idinsumo);
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
    let listado = obtenerDatajson("ID,grupo,complemento,caracteristica,complemento_caracteristica,presentacion,cantidad","con_t_insumos","variasfilasunicas","0","0");
    let listadoInsumos =  JSON.parse(listado);    
    let html='';
    for (let i = 0; i < listadoInsumos.length; i++) {
        html = `${html} <div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
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