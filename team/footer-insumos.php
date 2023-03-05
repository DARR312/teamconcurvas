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
$('#verInsumos').on('click', function(){   
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'block');
    $('#nuevoInsumo').css('display', 'none');    
    $('#facturaNueva').css('display', 'none');          
    
    return false;     
}); 
//******************************************************************************++Insumo nuevo
$('#agregarInsumo').on('click', function() {
    $('.remover').remove();
    $('#resumenInsumos').css('display', 'none');
    $('#nuevoInsumo').css('display', 'block');     
    $('#facturaNueva').css('display', 'none');       
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
            let html = `<div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>
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
$('#pasoFinalFactura').on('click', function(){   
    let proveedor = $('#proveedor').val();
    if(proveedor == 'nuevo'){
        proveedor = $('#nuevoproveedor').val();
        if(!proveedor){alert('Por favor ingresa un proveedor');return false;}
    }
    
    let insumoselec = $('.insumosselec');
    if(insumoselec.length == 1){alert('Por favor ingresa un insumo');return false;}
    for (let i = 1; i < insumoselec.length; i++) {
        let insumo = $(`#insumo${i}`).val(); 
        let valor = $(`#valor${i}`).val();
        let cantidad = $(`#cantidad${i}`).val();
        
    }
    console.log(insumoselec.length);
    console.log(proveedor);
    $('#modalContable').modal("show");  
}); 
//******************************************************************************++Factura nueva
    
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