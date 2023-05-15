<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
var coloresCombinacion = [];
var referenciaParaProyecto = 0;

const funcionesProyectos = () => {
    const agregarTallasSelect = (idSelect) => {
        let listadoTallasj = obtenerDatajson("talla","con_t_medidasproducto","valoresconcondicion","ficha_tecnica ",`'${referenciaParaProyecto}'`);
        let listadoTallas =  JSON.parse(listadoTallasj);   
        const tallasUnicas = [...new Set(listadoTallas.map(objeto => objeto.talla))];
        html=`'<option class='remover'  value='selecciona'>Selecciona</option>'`;
        for (let i = 0; i < tallasUnicas.length; i++) {
            html = `${html} <option class='remover'  value='${tallasUnicas[i]}'>${tallasUnicas[i]}</option>`;
        }
        let select = $(`#${idSelect}`);
        select.append(html);
    }
    const agregarColorSelect = (idSelect) => {
        const grupos = {};
        coloresCombinacion.forEach((elemento) => {
        if (!grupos[elemento.indicativo_combinacion]) {
            grupos[elemento.indicativo_combinacion] = [];
        }
        grupos[elemento.indicativo_combinacion].push(elemento);
        });

        const arreglosSeparados = Object.values(grupos);
        html=`'<option class='removerColoresCombinaciones'  value='selecciona'>Selecciona</option>'`;
        for (let i = 0; i < arreglosSeparados.length; i++) {
            let textos = '';
            let codigoCombinacion = '';
            for (let j = 0; j < arreglosSeparados[i].length; j++) {            
         
                const resultado = arreglosSeparados.flat().filter(objeto => objeto.insumo === arreglosSeparados[i][j].insumo);
                if(resultado.length < arreglosSeparados.length){
                    textos = `${textos} ${arreglosSeparados[i][j].text_insumo}`;
                    let cantDigitos = arreglosSeparados[i][j].insumo.toString().length;
                    codigoCombinacion = codigoCombinacion.concat(cantDigitos);
                    codigoCombinacion = codigoCombinacion.concat(arreglosSeparados[i][j].insumo);
                    
                    
                }
            }
            let descripcion = textos.replace(/No aplica/g,"");
            html = `${html} <option class='removerColoresCombinaciones'  value='${codigoCombinacion}'>${descripcion}</option>`;
        }
        let select = $(`#${idSelect}`);
        select.append(html);
    }
    //******************************************************************************++Insumo nuevo
    const referenciaChange = () => {
        $('#referenciaParaProyecto').on('change', function() {
            referenciaParaProyecto = $('#referenciaParaProyecto').val();
            $('.divTallasCombinaciones').remove();
            let coloresCombinacionj = obtenerDatajson("ID,indicativo_combinacion,insumo,cantidad,text_insumo","con_t_combinacionesproducto","valoresconcondicion","ficha_tecnica ",`'${referenciaParaProyecto}'`);
            coloresCombinacion = JSON.parse(coloresCombinacionj);
            html = `<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divTallasCombinaciones' id='talla1'>
                        <div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                            <label for="nombreReferencia" class="control-label letra18pt-pc"> Talla </label>
                            <select class='form-control tallasProyecto' type='select' id='tallProyecto1' name='1' form='formNuevaFactura' required=''>
                                
                            </select><span class='pmd-textfield-focused'></span>
                        </div>                     
                    </div>`;
            let divFechaInicio = $(`#divFechaInicio`);
            divFechaInicio.after(html);       
            agregarTallasSelect('tallProyecto1'); 
            funcionesProyectos();
            tallasChange();
        }); 
    }
    const otraTalla = () => {
        $('#agregarOtraTalla').on('click', function() {
            if(coloresCombinacion.length ==0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor selecciona una referencia antes de agregar otra talla.`); 
                return false;
            }
            let numeroDivTallas = $('.divTallasCombinaciones').length;
            html = `<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divTallasCombinaciones' id='talla${numeroDivTallas+1}'>
                            <div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <label for="nombreReferencia" class="control-label letra18pt-pc"> Talla </label>
                                <select class='form-control tallasProyecto' type='select' id='tallProyecto${numeroDivTallas+1}' name='${numeroDivTallas+1}' form='formNuevaFactura' required=''>
                                    
                                </select><span class='pmd-textfield-focused'></span>
                            </div>                     
                        </div>`;
                let tallProyecto = $(`#talla${numeroDivTallas}`);
                tallProyecto.after(html);       
                agregarTallasSelect(`tallProyecto${numeroDivTallas+1}`); 
                funcionesProyectos();
                tallasChange();
        });   
    }

    const tallasChange = () => {
        $('.tallasProyecto').on('change', function() {
            if(coloresCombinacion.length ==0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor selecciona una referencia antes de elegir una talla.`); 
                $(`#${this.id}`).val('selecciona');
                return false;
            }
            console.log($(this).parent().parent().attr('id'));
            console.log(`.divColoresCombinaciones${$(this).parent().parent().attr('id')}).remove()`);
            $(`.divColoresCombinaciones${$(this).parent().parent().attr('id')}`).remove();
            html = `<div class='divColoresCombinaciones${$(this).parent().parent().attr('id')} col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class=' form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                            <label for="nombreReferencia" class="control-label letra18pt-pc"> Color </label>
                            <select class='form-control colorProyecto' type='select' id='colorProyecto${this.name}-1' name='${this.name}-1'  required=''>
                                
                            </select><span class='pmd-textfield-focused'></span>
                        </div>
                        <div class="  form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                            <input class="form-control" type="number" id="cantidadProyecto${this.name}-1" name="${this.name}" required=""><span class="pmd-textfield-focused"></span>
                        </div> </div>`;
            let divTalla = $(`#talla${this.name}`);
            divTalla.append(html);
            agregarColorSelect(`colorProyecto${this.name}-1`);
            funcionesProyectos();
        }); 
    }
    $('#agregarProyecto').on('click', function() {
        const nuevoProyecto = $('#nuevoProyecto');
        nuevoProyecto.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            nuevoProyecto.removeClass('oculto').addClass('mostrar');
        }, 5000);
        // Agrego las referencias a referenciaParaProyecto
        let html = `'<option class='remover'  value='selecciona'>Selecciona</option>'`;
        let referenciaj = obtenerDatajson("ID,referencia","con_t_fichatecnica","variasfilasunicas","0","0");
        let referencias = JSON.parse(referenciaj);
        for(i=0;i<referencias.length;i++){
            html=html+"<option class='remover' value='"+referencias[i].ID+"'>"+referencias[i].referencia+"</option>";
        }
        let referenciaParaProyecto = $('#referenciaParaProyecto');
        referenciaParaProyecto.append(html);
        referenciaChange();
        otraTalla();
        
    }); 
    
    
    $('.colorProyecto').on('change', function() {
        if($(this).val()=='selecciona'){return false;}        
        let indicativoNumeroSelect = this.name.split('-');
        let padre = $(`#talla${indicativoNumeroSelect[0]}`);
        let ultimoHijo = padre.children().length - 1;
        let valorUltimohijo = $(`#colorProyecto${indicativoNumeroSelect[0]}-${ultimoHijo}`).val();
        console.log(valorUltimohijo);
        if(valorUltimohijo == 'selecciona'){return false;}
        html = `<div class='divColoresCombinaciones${indicativoNumeroSelect[0]} col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                        <label for="nombreReferencia" class="control-label letra18pt-pc"> Color </label>
                        <select class='form-control colorProyecto' type='select' id='colorProyecto${indicativoNumeroSelect[0]}-${parseInt(indicativoNumeroSelect[1])+1}' name='${indicativoNumeroSelect[0]}-${parseInt(indicativoNumeroSelect[1])+1}'  required=''>
                            
                        </select><span class='pmd-textfield-focused'></span>
                    </div>
                    <div class=" form-group pmd-textfield pmd-textfield-floating-label col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <label for="cantidad" class="control-label letra18pt-pc"> Cantidad </label>
                        <input class="form-control" type="number" id="cantidadProyecto${indicativoNumeroSelect[0]}-${parseInt(indicativoNumeroSelect[1])+1}" name="${indicativoNumeroSelect[0]}" required=""><span class="pmd-textfield-focused"></span>
                    </div> </div>`;
        let divTalla = $(`#talla${indicativoNumeroSelect[0]}`);
        divTalla.append(html);
        agregarColorSelect(`colorProyecto${indicativoNumeroSelect[0]}-${parseInt(indicativoNumeroSelect[1])+1}`);
        funcionesProyectos();
    });  
    
}
for(i=30;i<permisos.length;i++){
    if(permisos[i].permiso_id==46){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion1'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='verProyectos'>Ver proyectos </button></div>");
    }
    if(permisos[i].permiso_id==47){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion2'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='agregarProyecto'>Agregar nuevo proyecto </button></div>");
    }   
    
    
}
funcionesProyectos();
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
	$('#datetimepicker-inicio-proyecto').datetimepicker({
        format: 'MM/DD/YYYY HH:mm'
	});
</script>
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>