<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
var coloresCombinacion = [];
var insumosRepetidos = [];
var referenciaParaProyecto = 0;
var arrayInsumosUtilizados;
var arregloInsumosSimplificado = [];//arregloInsumosSimplificado tiene como resultado las cantidades totales de prendas, los insumos y la cantidad por unidad que se va a gastar en el proyecto. 
var nombreNuevoProyecto = '';
var espaciosProyectos = [];
var trabajadoresProyectos = [];
var fechaInicioProyecto;
var fechaFinProyecto;
const mostrarDiv = (idaMostrar) => {
    $('.divHorariosPordias').remove();
    const nuevoEspacio = $('#nuevoEspacio');
    const nuevoProyecto = $('#nuevoProyecto');
    const verEspaciosDiv = $('#verEspaciosDiv');
    const aidaMostrar = $(`#${idaMostrar}`);
    nuevoEspacio.removeClass('mostrar').addClass('oculto');
    nuevoProyecto.removeClass('mostrar').addClass('oculto');
    verEspaciosDiv.removeClass('mostrar').addClass('oculto');
    
    setTimeout(() => {
        nuevoEspacio.css('display', 'none');
        nuevoProyecto.css('display', 'none');
        verEspaciosDiv.css('display', 'none');
        aidaMostrar.css('display', 'block');
    }, 1000);
    setTimeout(() => {
        aidaMostrar.removeClass('oculto').addClass('mostrar');
    }, 1500);
}

const mostrarOcultarDiv = (idaMostrar,idOcultar) => {
    const aidaMostrar = $(`#${idaMostrar}`);
    const aidaOcultar = $(`#${idOcultar}`);
    aidaOcultar.removeClass('mostrar').addClass('oculto');
    
    setTimeout(() => {
        aidaOcultar.css('display', 'none');
        aidaMostrar.css('display', 'block');
    }, 1000);
    setTimeout(() => {
        aidaMostrar.removeClass('oculto').addClass('mostrar');
    }, 1500);
}

const calcularFechaHoraFinal = (fechaHoraInicial,minutos) => {
    const aidaMostrar = $(`#${idaMostrar}`);
    const aidaOcultar = $(`#${idOcultar}`);
    aidaOcultar.removeClass('mostrar').addClass('oculto');
    
    setTimeout(() => {
        aidaOcultar.css('display', 'none');
        aidaMostrar.css('display', 'block');
    }, 1000);
    setTimeout(() => {
        aidaMostrar.removeClass('oculto').addClass('mostrar');
    }, 1500);
}

const diferenciaMinutosSegundos = (horaInicio,horaFin) => {
    // Dividir las horas, minutos y segundos de la hora de inicio
    var partesInicio = horaInicio.split(':');
    var horasInicio = parseInt(partesInicio[0]);
    var minutosInicio = parseInt(partesInicio[1]);
    var segundosInicio = parseInt(partesInicio[2]);

    // Dividir las horas, minutos y segundos de la hora de fin
    var partesFin = horaFin.split(':');
    var horasFin = parseInt(partesFin[0]);
    var minutosFin = parseInt(partesFin[1]);
    var segundosFin = parseInt(partesFin[2]);

    // Convertir las horas, minutos y segundos a minutos
    var minutosTotalesInicio = horasInicio * 60 + minutosInicio + segundosInicio / 60;
    var minutosTotalesFin = horasFin * 60 + minutosFin + segundosFin / 60;

    // Calcular la diferencia total en minutos
    var diferenciaMinutos = minutosTotalesFin - minutosTotalesInicio;

    // Obtener la parte entera de los minutos
    var minutos = Math.floor(diferenciaMinutos);

    // Calcular los segundos restantes
    var segundos = Math.round((diferenciaMinutos - minutos) * 60);
    var objeto = {
        minutos: minutos,
        segundos: segundos
    }
    return objeto;
    
}


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
        insumosRepetidos = [];
        const grupos = {};
        coloresCombinacion.forEach((elemento) => {// coloresCombinacion es el array que traigo de con_t_combinacionesproducto según la referencia escogida
        if (!grupos[elemento.indicativo_combinacion]) {
            grupos[elemento.indicativo_combinacion] = [];
        }
        grupos[elemento.indicativo_combinacion].push(elemento);
        });

        const arreglosSeparados = Object.values(grupos);//arreglosSeparados son las combinaciones agrupadas según el indicativo de combinación
        
        html=`'<option class='removerColoresCombinaciones'  value='selecciona'>Selecciona</option>'`;
        for (let i = 0; i < arreglosSeparados.length; i++) {
            let textos = '';
            let codigoCombinacion = '';
            for (let j = 0; j < arreglosSeparados[i].length; j++) {            
                // Acá verifico que el insumo no se repita en todos los indicativos de combinación, de esta forma solo voy a mostrar lo que en realidad diferencia a las combinaciones, por ejemplo si todas las combinaciones tienen el isumo broches, pues este no lo voy a mostrar
                const resultado = arreglosSeparados.flat().filter(objeto => objeto.insumo === arreglosSeparados[i][j].insumo);
                
                if(resultado.length < arreglosSeparados.length){
                    textos = `${textos} ${arreglosSeparados[i][j].text_insumo}`;//Ejemplo de  text_insumo: Algodón perchado  Rosa Cobre No aplica No aplica / si hay otra iteración por ejemplo Super Nylon  Verde Militar No aplica No aplica
                    let cantDigitos = arreglosSeparados[i][j].insumo.toString().length;//Ejemplo de .insumo: 1, por lo tanto cantDigitos en ese caso será 1 / entonces e .insumo: 9, por lo tanto cantDigitos en ese caso será 1
                    codigoCombinacion = codigoCombinacion.concat(cantDigitos);// Para el ejemplo codigoCombinacion: 1                                       / Para codigo de combinación será 1
                    codigoCombinacion = codigoCombinacion.concat(arreglosSeparados[i][j].insumo);// Para el ejemplo codigoCombinacion: 11                   / En la segunda iteración sería 19, por lo tanto el codigoCombinacion: 1119, haciendo referencia al insumo 1 y al 9.
                }else{
                    const verificoSiEsta = insumosRepetidos.filter(insumo => insumo === arreglosSeparados[i][j].insumo);
                    if(verificoSiEsta.length == 0){
                        insumosRepetidos.push(arreglosSeparados[i][j].insumo);
                    }
                    
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
            $('#agregarOtraTalla').removeClass('oculto').addClass('mostrar');
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
            let divReferencia = $(`#divReferencia`);
            divReferencia.after(html);       
            agregarTallasSelect('tallProyecto1'); 
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
                tallasChange();
        });   
    }

    $('#agregarProyecto').on('click', function() {
        mostrarDiv('nuevoProyecto');
        $('.tallasProyecto').remove();
        $('.colorProyecto').remove();
        $('#agregarOtraTalla').remove();
        $('.removerAgregarProyecto').remove();
        // Agrego las referencias a referenciaParaProyecto
        let html = `'<option class='removerAgregarProyecto'  value='selecciona'>Selecciona</option>'`;
        let referenciaj = obtenerDatajson("ID,referencia","con_t_fichatecnica","variasfilasunicas","0","0");
        let referencias = JSON.parse(referenciaj);
        for(i=0;i<referencias.length;i++){
            html=html+"<option class='removerAgregarProyecto' value='"+referencias[i].ID+"'>"+referencias[i].referencia+"</option>";
        }
        let referenciaParaProyecto = $('#referenciaParaProyecto');
        referenciaParaProyecto.append(html);
        referenciaChange();
        let htmlOtra = `<button class='botonmodal oculto col-lg-12 col-md-12 col-sm-12 col-xs-12 ' type='button' id='agregarOtraTalla'>Otra talla</button>`;
        let divReferencia = $('#divReferencia');
        divReferencia.after(htmlOtra);
        otraTalla();
        // Agrego los espcios a espacio
        html = `'<option class='removerAgregarProyecto'  value='selecciona'>Selecciona</option>'`;
        let espacioj = obtenerDatajson("ID,nombre_espacio","con_t_espacios","variasfilasunicas","0","0");
        let espacios = JSON.parse(espacioj);
        for(i=0;i<espacios.length;i++){
            html=html+"<option class='removerAgregarProyecto' value='"+espacios[i].ID+"'>"+espacios[i].nombre_espacio+"</option>";
        }
        let espacio = $('#espacio1');
        espacio.append(html);
        espacioChange();
        // Agrego los trabajadores a trabajador
        html = `'<option class='removerAgregarProyecto'  value='selecciona'>Selecciona</option>'`;
        let trabajadorj = obtenerDatajson("id_empleado,nombre_empleado","con_t_empleados","variasfilasunicas","0","0");
        let trabajadors = JSON.parse(trabajadorj);
        for(i=0;i<trabajadors.length;i++){
            html=html+"<option class='removerAgregarProyecto' value='"+trabajadors[i].id_empleado+"'>"+trabajadors[i].nombre_empleado+"</option>";
        }
        let trabajador = $('#trabajador1');
        trabajador.append(html);
        trabajadoresProyectoChange();
    }); 

    $('#confirmaTallasCombinaciones').on('click', function() {
        var cantidadPrendasPorCortar = 0;
        var referenciaParaProyecto = $('#referenciaParaProyecto').val();
        if(referenciaParaProyecto=="selecciona"){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona la referencia del proyecto`); 
            return false;
        }
        var divTallasCombinaciones = $('.divTallasCombinaciones');
        var  arrayTallas = [];
        for (let i = 0; i < divTallasCombinaciones.length; i++) {
            if($(divTallasCombinaciones[i]).children().eq(0).children().eq(1).val() == 'selecciona'){continue;}
            var objeto = {
                talla: $(divTallasCombinaciones[i]).children().eq(0).children().eq(1).val(), // Aquí va el valor de talla, 3XL por ejemplo
                coloresCombinaciones: [], // Array vacío para almacenar colores combinaciones
                codigosCombinaciones: [],
            };
            for (let j = 1; j < $(divTallasCombinaciones[i]).children().length; j++) {
                if($(divTallasCombinaciones[i]).children().eq(j).children().eq(0).children().eq(1).val() == 'selecciona'){
                    continue;
                }
                if(!$(divTallasCombinaciones[i]).children().eq(j).children().eq(1).children().eq(1).val() || $(divTallasCombinaciones[i]).children().eq(j).children().eq(1).children().eq(1).val() == 0){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`Por favor pon la cantidad de prendas que se van a cortar en la combinaciór ${j} 
                    de la talla ${$(divTallasCombinaciones[i]).children().eq(0).children().eq(1).val()}`); 
                    return false;
                }
                var codigoCombinacion = $(divTallasCombinaciones[i]).children().eq(j).children().eq(0).children().eq(1).val();//Es el código de los insumos utilizado para esta combinación, mirar explicación en la línea 71 de este documento. 
                
                // decodifico codigoCombinacion para tener los insumos por separado de una vez
                var insumoActual='';
                for (let l = 0; l < codigoCombinacion.length; l=l+1+parseInt(codigoCombinacion[l])) {
                    for (let k = 0; k < codigoCombinacion[l]; k++) {     
                        insumoActual = `${insumoActual}${codigoCombinacion[l+1+k]}`;
                    }
                    var objetoColoresCombinaciones = {
                        insumo: insumoActual, 
                        cantidad: $(divTallasCombinaciones[i]).children().eq(j).children().eq(1).children().eq(1).val()// Es la cantidad de prendas que se van a cortar para esta combinación
                    };                    
                    insumoActual='';
                    objeto.coloresCombinaciones.push(objetoColoresCombinaciones);
                }
                cantidadPrendasPorCortar = cantidadPrendasPorCortar + parseInt(objetoColoresCombinaciones.cantidad);
                var objetoCombi={
                    codigo: codigoCombinacion,
                    cantidad:$(divTallasCombinaciones[i]).children().eq(j).children().eq(1).children().eq(1).val()
                }
                objeto.codigosCombinaciones.push(objetoCombi);
            }
            if(objeto.coloresCombinaciones.length == 0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor selecciona al menos 1 combinación de color para 
                la talla ${$(divTallasCombinaciones[i]).children().eq(0).children().eq(1).val()}`); 
                return false;
            }
            arrayTallas.push(objeto);
        }
        if(arrayTallas.length==0){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona al menos 1 talla valida que no tenga como valor selecciona`); 
            return false;
        }
        //Como resultado arrayTallas va a ser un arreglo con objetos, cada objeto tiene una propiedad llamada talla y otra coloresCombinaciones que es un array de objetos que tiene dentro de si objetos cada uno con una propiedad llamada insumo con el codigo del insumo utilizado y la cantidad de prendas que se van a cortar de ese insumo
        //insumosRepetidos son los insumos que van a ir en cada una de las prendas que se van a crear, es decir el total de prendas
        
        const arrayAplanado = arrayTallas
        .map(talla => talla.coloresCombinaciones) // Obtiene solo la propiedad "coloresCombinaciones" de cada objeto "talla"
        .flat() // Aplana el arreglo resultante

        const nuevosObjetos = insumosRepetidos.map(insumo => ({ insumo, cantidad: cantidadPrendasPorCortar }));

        const arrayTodosInsumoCantidades = arrayAplanado.concat(nuevosObjetos);// Es un array que contiene todos los insumos y unidades a cortar que se van a usar para cada proyecto
        // A continuación voy a simplificar el arreglo para hacer menos consultas al servidor de que cantidad del insumo se va a gastar.
        let textoConfirmado='';
        arregloInsumosSimplificado = arrayTodosInsumoCantidades.reduce((acumulador, elemento) => {
            const index = acumulador.findIndex(objeto => objeto.insumo === elemento.insumo);
            if (index !== -1) {
                acumulador[index].cantidad += +elemento.cantidad;
            } else {
                acumulador.push({ insumo: elemento.insumo, cantidad: +elemento.cantidad });
            }
            return acumulador;
        }, []);

        
        let insumoFichaTecnicaj = obtenerDatajson("insumo,cantidad","con_t_insumosproducto","valoresconcondicion","ficha_tecnica ",referenciaParaProyecto);
        let insumoFichaTecnica =  JSON.parse(insumoFichaTecnicaj);   

        for (let i = 0; i < arregloInsumosSimplificado.length; i++) {
            let insumoActualj = obtenerDatajson("caracteristica,complemento_caracteristica,complemento,presentacion,grupo,cantidad,faltantes,precio_unidad","con_t_insumos","valoresconcondicion","ID ",arregloInsumosSimplificado[i].insumo);
            let insumoActual =  JSON.parse(insumoActualj);   
            const isumoCantidadUsada = insumoFichaTecnica.find(function(objeto) {
                return objeto.insumo === insumoActual[0].grupo;
            });
            var cantidadInsumo = isumoCantidadUsada ? isumoCantidadUsada.cantidad * parseInt(arregloInsumosSimplificado[i].cantidad) : null;//Multiplico la cantidad que se usa en una prenda por la cantidad de prendas en total que se van a hacer.
            arregloInsumosSimplificado[i].cantidadInsumo = cantidadInsumo;
            arregloInsumosSimplificado[i].costo = cantidadInsumo * parseInt(insumoActual[0].precio_unidad);
            if(parseInt(insumoActual[0].faltantes) > 0){
                arregloInsumosSimplificado[i].faltantesCon_t_Insumos = parseInt(insumoActual[0].faltantes) + cparseInt(antidadInsumo);
                arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes = parseInt(cantidadInsumo);
            }else if((parseInt(insumoActual[0].cantidad)-parseInt(cantidadInsumo))<0){
                arregloInsumosSimplificado[i].faltantesCon_t_Insumos = -1*(parseInt(insumoActual[0].cantidad) - parseInt(cantidadInsumo));
                arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes =  -1*(parseInt(insumoActual[0].cantidad) - parseInt(cantidadInsumo));        
            }else{
                arregloInsumosSimplificado[i].faltantesCon_t_Insumos =0;
                arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes = 0;
            }
            textoConfirmado = `${textoConfirmado}
            <p class='col-lg-8 col-md-8 col-sm-8 col-xs-8 letra18pt-pc confirmaTextoInsumosFaltantes'>
                ${insumoActual[0].grupo} ${insumoActual[0].complemento} ${insumoActual[0].caracteristica} ${insumoActual[0].complemento_caracteristica} :
            </p>
            <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc confirmaTextoInsumosFaltantes'>
                ${arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes} ${insumoActual[0].presentacion}
            </p>`;
        }
        console.log('arregloInsumosSimplificado');
        console.log(arregloInsumosSimplificado);//arregloInsumosSimplificado tiene como resultado las cantidades totales de prendas, los insumos, la cantidad por unidad que se va a gastar en el proyecto y los faltantes para el proyecto y en general de todo el inventario 
        console.log('arrayTallas');
        console.log(arrayTallas);// tiene las tallas que se van a hacer, con sus respectivas combinaciones y cantidades, una con los codigos separados por insumos y otra con los codigosColores listos para decodificar e ingresar en con_t_combinacionesproyectos

        mostrarOcultarDiv('confirmacionesInsumosCantidadesDiv','referenciaTallaDiv');

        
        var contenidoAconfirmarTallasCombinaciones = $('#contenidoAconfirmarTallasCombinaciones');
        $('.confirmaTextoInsumosFaltantes').remove();
        var textoInsert = textoConfirmado.replace(/No aplica/g,"");
        contenidoAconfirmarTallasCombinaciones.append(textoInsert);

    }); 
    // arregloInsumosSimplificado   *** son los dos arreglos importantes ya que estos nos van a dar las combinaciones y cantidades para crear las marquillas 
    // arrayTallas                  *** y nos van a dar la cantidad de insumos que se van a usar en el proyecto.
    $('#confirmaNotificacionesTallasCombinaciones').on('click', function() {
        mostrarOcultarDiv('espaciosTrabajadoresDiv','confirmacionesInsumosCantidadesDiv');       
    }); 
    $('#volverAreferenciaTallaDiv').on('click', function() {
        mostrarOcultarDiv('referenciaTallaDiv','confirmacionesInsumosCantidadesDiv');  
    }); 
    
    $('#volverAconfirmacionesInsumosFaltantes').on('click', function() {
        mostrarOcultarDiv('confirmacionesInsumosCantidadesDiv','espaciosTrabajadoresDiv');  
    }); 
     
    $('#volverAespaciosTrabajadoresDiv').on('click', function() {
        mostrarOcultarDiv('espaciosTrabajadoresDiv','fechaFinalaldelProyectoDiv');  
    }); 
    
    $('#confirmaEspaciosTrabajadores').on('click', function() {
        // espaciosProyectos son todos los espacios con los minutos que se van a utilizar cada uno
        // trabajadoresProyectos son todos los trabajadores que van a estar en el proyecto con los minutos implementados en el
        //Acá empiezo a calcular la fecha y hora en la que empezaría el proyecto en cuestión
        //Empezamos calculando el tiempo en espacios utilizados. 
        let fechaActual = new Date();
        let diaSemana = fechaActual.getDay();
        // Ajustar el valor del domingo y lunes
        if (diaSemana === 0) {
        diaSemana = 6;
        } else {
        diaSemana--;
        }

        var fechaMenorEspacios = '2023-05-25 10:06:16'; 
        var fechaMenorTrabajadores= '2023-05-25 10:06:16'; 
        espaciosProyectos = [];
        let espaciosProyectosClass = $('.espaciosProyecto');
        
        for (let i = 0; i < espaciosProyectosClass.length; i++) {
            if($(espaciosProyectosClass[i]).val() == 'selecciona'){continue;}
            const index = espaciosProyectos.findIndex(objeto => objeto.espacio === $(espaciosProyectosClass[i]).val());

            if (index !== -1) {
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor revisa el espacio ${$(espaciosProyectosClass[i]).attr('name')} 
                ya que no puede estar repetido`); 
                return false;
            }

            if(!$(`#minutosEspacio${$(espaciosProyectosClass[i]).attr('name')}`).val()){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor asigna el tiempo en el que el espacio 
                ${$(espaciosProyectosClass[i]).attr('name')} va a estar ocupado por este proyecto`); 
                return false;
            }

            let fecha_hora_disponibleEspacioj = obtenerDatajson("fecha_hora_disponible","con_t_espacios","valoresconcondicion","ID",$(espaciosProyectosClass[i]).val());
            let fecha_hora_disponibleEspacio =  JSON.parse(fecha_hora_disponibleEspacioj);   
            let horarios_espaciosj = obtenerDatajson("dia_semana,hora_inicio,hora_fin","con_t_horarios_espacios","valoresconcondicion","id_espacio",$(espaciosProyectosClass[i]).val());
            let horarios_espacios =  JSON.parse(horarios_espaciosj);    
            var fechaDisponEspacio = fecha_hora_disponibleEspacio[0].fecha_hora_disponible;
            if(fecha_hora_disponibleEspacio[0].fecha_hora_disponible > fechaMenorEspacios){
                fechaMenorEspacios = fecha_hora_disponibleEspacio[0].fecha_hora_disponible;
            }
            let elementoSeleccionado = $(espaciosProyectosClass[i]).find('option:selected');
            let textoSeleccionado = elementoSeleccionado.text();

            
            var fechaMenorEspaciosObjeto = new Date(fechaMenorEspacios);
            var año = fechaActual.getFullYear();
            var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
            var dia = ('0' + fechaActual.getDate()).slice(-2);
            var horas = ('0' + fechaActual.getHours()).slice(-2);
            var minutos = ('0' + fechaActual.getMinutes()).slice(-2);
            var segundos = ('0' + fechaActual.getSeconds()).slice(-2);

            if(fechaActual>fechaMenorEspaciosObjeto){
                
                var fechaFormateada = `${año}-${mes}-${dia} ${horas}:${minutos}:${segundos}`;
                fechaMenorEspacios = fechaFormateada;
                fechaDisponEspacio = fechaFormateada;
            }
            //Calculo la fecha y hora final en la que el espacio va a dejar el proyecto
            // horarios_espacios[diaSemana]
            var horaInicio = `${horas}:${minutos}:${segundos}`;//horaInicio es la hora actual
            // console.log(horarios_espacios[diaSemana].hora_fin);//es la hora en la que los espacios dejan de estar disponibles en el día actual.
            
           

            var objeto = {
                espacio:$(espaciosProyectosClass[i]).val(), 
                minutos: $(`#minutosEspacio${$(espaciosProyectosClass[i]).attr('name')}`).val(),
                horarios: horarios_espacios,
                fecha_hora_disponible: fechaDisponEspacio,
                texto: textoSeleccionado
            };
            espaciosProyectos.push(objeto);

        }
        if(espaciosProyectos.length == 0 ){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor seleccion al menos un espacio para este proyecto`); 
            return false;
        }
        //Empezamos calculando el tiempo en trabajadores utilizados. 
        trabajadoresProyectos = [];
        let trabajadoresProyectosClass = $('.trabajadoresProyecto');
        
        for (let i = 0; i < trabajadoresProyectosClass.length; i++) {
            if($(trabajadoresProyectosClass[i]).val() == 'selecciona'){continue;}
            const index = trabajadoresProyectos.findIndex(objeto => objeto.trabajador === $(trabajadoresProyectosClass[i]).val());

            if (index !== -1) {
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor revisa el trabajador ${$(trabajadoresProyectosClass[i]).attr('name')} 
                ya que no puede estar repetido`); 
                return false;
            }

            if(!$(`#minutosTrabajador${$(trabajadoresProyectosClass[i]).attr('name')}`).val()){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor asigna el tiempo en el que el trabajador 
                ${$(trabajadoresProyectosClass[i]).attr('name')} va a estar ocupado por este proyecto`); 
                return false;
            }

            let fecha_hora_disponibleTrabajadorj = obtenerDatajson("fecha_hora_disponible","con_t_empleados","valoresconcondicion","id_empleado",$(trabajadoresProyectosClass[i]).val());
            let fecha_hora_disponibleTrabajador =  JSON.parse(fecha_hora_disponibleTrabajadorj);   
            let horarios_trabajadorj = obtenerDatajson("dia_semana,hora_inicio,hora_fin","con_t_horarios_empleados","valoresconcondicion","id_empleado",$(trabajadoresProyectosClass[i]).val());
            let horarios_trabajador =  JSON.parse(horarios_trabajadorj);  

            if(fecha_hora_disponibleTrabajador[0].fecha_hora_disponible > fechaMenorTrabajadores){
                fechaMenorTrabajadores = fecha_hora_disponibleTrabajador[0].fecha_hora_disponible;
            }
            let elementoSeleccionado = $(trabajadoresProyectosClass[i]).find('option:selected');
            let textoSeleccionado = elementoSeleccionado.text();

            var fechaDisponTrabajador = fecha_hora_disponibleTrabajador[0].fecha_hora_disponible;
            var fechaMenorTrabajadoresObjeto = new Date(fechaMenorTrabajadores);
            if(fechaActual>fechaMenorTrabajadoresObjeto){
                var año = fechaActual.getFullYear();
                var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
                var dia = ('0' + fechaActual.getDate()).slice(-2);
                var horas = ('0' + fechaActual.getHours()).slice(-2);
                var minutos = ('0' + fechaActual.getMinutes()).slice(-2);
                var segundos = ('0' + fechaActual.getSeconds()).slice(-2);

                var fechaFormateada = `${año}-${mes}-${dia} ${horas}:${minutos}:${segundos}`;
                fechaMenorTrabajadores = fechaFormateada;
                fechaDisponTrabajador = fechaFormateada;
            }

            var objeto = {
                trabajador:$(trabajadoresProyectosClass[i]).val(), 
                minutos: $(`#minutosTrabajador${$(trabajadoresProyectosClass[i]).attr('name')}`).val(),
                horarios: horarios_trabajador,
                fecha_hora_disponible: fechaDisponTrabajador,
                texto: textoSeleccionado
            };
            trabajadoresProyectos.push(objeto);

        }
        if(trabajadoresProyectos.length == 0 ){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor seleccion al menos un trabajador para este proyecto`); 
            return false;
        }
        console.log("espaciosProyectos");
        console.log(espaciosProyectos);
        console.log("trabajadoresProyectos"); 
        console.log(trabajadoresProyectos); 
        console.log('fechaMenorEspacios'); 
        console.log(fechaMenorEspacios); 
        console.log('fechaMenorTrabajadores'); 
        console.log(fechaMenorTrabajadores); 
        if(fechaMenorTrabajadores >= fechaMenorEspacios){
            fechaInicioProyecto = fechaMenorTrabajadores;
        }else{
            fechaInicioProyecto=fechaMenorEspacios;
        }
        console.log(fechaInicioProyecto);
        var fechaInicioProyectoObjeto = new Date(fechaInicioProyecto);
        mostrarOcultarDiv('fechaFinalaldelProyectoDiv','espaciosTrabajadoresDiv');  
        // Inicializar el datetimepicker en el elemento
        $('#datetimepickerInicioProyecto').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            minDate: fechaInicioProyectoObjeto
        });
        // let elementosFechaFinal = ``;
        // for (let i = 0; i < espaciosProyectos.length; i++) {
        //     elementosFechaFinal = `${elementosFechaFinal}
        // <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        //     <input class="form-check-input selectEspacios" type="checkbox" value="${espaciosProyectos[i].minutos}">
        // </div>
        // <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
        //     <p class='letra18pt-pc'> 
        //         ${espaciosProyectos[i].texto}
        //     </p>
        // </div>
        // `;            
        // }
        // for (let i = 0; i < trabajadoresProyectos.length; i++) {
        //     elementosFechaFinal = `${elementosFechaFinal}
        // <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        //     <input class="form-check-input selectTrabajadores" type="checkbox" value="${trabajadoresProyectos[i].minutos}">
        // </div>
        // <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
        //     <p class='letra18pt-pc'> 
        //         ${trabajadoresProyectos[i].texto}
            
        // </div>
        // `;            
        // }
        
        // $('#trabajadoresYespacios').append(elementosFechaFinal);

        // elementosFechaFinal = `<p class='letra18pt-pc'>
        // El proyecto va a iniciar en la siguiente fecha ${fechaInicioProyecto}
        // </p>
        // <p class='letra18pt-pc'>
        // El proyecto va a finalizar en la siguiente fecha ${fechaFinProyecto}
        // </p>
        // `;

        // $('#fechaFinalTiempoReal').append(elementosFechaFinal);
    }); 
//     var horaFin = horarios_espacios[diaSemana].hora_fin;

// var objetoDiferencia = diferenciaMinutosSegundos(horaInicio,horarios_espacios[diaSemana].hora_fin);

// console.log(objetoDiferencia);
    const tallasChange = () => {
        $('.tallasProyecto').on('change', function() {
            if(coloresCombinacion.length ==0){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`Por favor selecciona una referencia antes de elegir una talla.`); 
                $(`#${this.id}`).val('selecciona');
                return false;
            }
            // Agrego las combinaciones de colores
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
            
            colorChange();
        }); 
    }
    
    const espacioChange = () => {
        $('.espaciosProyecto').on('change', function() {
            var espaciosSelect = $('.espaciosProyecto');

            if($(espaciosSelect[espaciosSelect.length-1]).val() == 'selecciona'){return false;}
             // Agrego los espcios a espacio
            let espacioshtml = `'<option class='removerAgregarProyecto'  value='selecciona'>Selecciona</option>'`;
            let espacioj = obtenerDatajson("ID,nombre_espacio","con_t_espacios","variasfilasunicas","0","0");
            let espacios = JSON.parse(espacioj);
            for(i=0;i<espacios.length;i++){
                espacioshtml=espacioshtml+"<option class='removerAgregarProyecto' value='"+espacios[i].ID+"'>"+espacios[i].nombre_espacio+"</option>";
            }
            let htmlTotal = `<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="espacio" class="control-label letra18pt-pc">
                        Espacio
                    </label>
                    <select class='form-control espaciosProyecto' type='select' id='espacio${parseInt($(espaciosSelect[espaciosSelect.length-1]).attr('name'))+1}' name='${parseInt($(espaciosSelect[espaciosSelect.length-1]).attr('name'))+1}' form='formNuevaFactura' required=''>
                    ${espacioshtml}
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label class="control-label letra18pt-pc" for="minutosEspacio${parseInt($(espaciosSelect[espaciosSelect.length-1]).attr('name'))+1}">Duración en minutos del uso del espacio.</label>
                    <input type="number" id="minutosEspacio${parseInt($(espaciosSelect[espaciosSelect.length-1]).attr('name'))+1}" class="form-control" />
                </div>`;
            let espacio = $('#espaciosDiv');
            espacio.append(htmlTotal);
            espacioChange();
        }); 
    }

    //  
    const trabajadoresProyectoChange = () => {
        $('.trabajadoresProyecto').on('change', function() {
            var trabajadorSelect = $('.trabajadoresProyecto');

            if($(trabajadorSelect[trabajadorSelect.length-1]).val() == 'selecciona'){return false;}
            // Agrego los trabajadores a trabajador
            let trabajadorhtml = `'<option class='removerAgregarProyecto'  value='selecciona'>Selecciona</option>'`;
            let trabajadorj = obtenerDatajson("id_empleado,nombre_empleado","con_t_empleados","variasfilasunicas","0","0");
            let trabajadors = JSON.parse(trabajadorj);
            for(i=0;i<trabajadors.length;i++){
                trabajadorhtml=trabajadorhtml+"<option class='removerAgregarProyecto' value='"+trabajadors[i].id_empleado+"'>"+trabajadors[i].nombre_empleado+"</option>";
            }
            let htmlTotal = `<div class='form-group pmd-textfield pmd-textfield-floating-label col-lg-8 col-md-8 col-sm-8 col-xs-8 pmd-textfield-floating-label-completed'>
                    <label for="trabajador${parseInt($(trabajadorSelect[trabajadorSelect.length-1]).attr('name'))+1}" class="control-label letra18pt-pc">
                        Trabajador
                    </label>
                    <select class='form-control trabajadoresProyecto' type='select' id='trabajador${parseInt($(trabajadorSelect[trabajadorSelect.length-1]).attr('name'))+1}' name='${parseInt($(trabajadorSelect[trabajadorSelect.length-1]).attr('name'))+1}' form='formNuevaFactura' required=''>
                        ${trabajadorhtml}
                    </select><span class='pmd-textfield-focused'></span>
                </div>
                <div class="form-group pmd-textfield pmd-textfield-floating-label col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label class="control-label letra18pt-pc" for="minutosTrabajador${parseInt($(trabajadorSelect[trabajadorSelect.length-1]).attr('name'))+1}">Duración en minutos de trabajo del trabajador.</label>
                    <input type="number" id="minutosTrabajador${parseInt($(trabajadorSelect[trabajadorSelect.length-1]).attr('name'))+1}" class="form-control" />
                </div> `;
            let trabajadoresDiv = $('#trabajadoresDiv');
            trabajadoresDiv.append(htmlTotal);
            trabajadoresProyectoChange();
        }); 
    }
    /////************************************************************** ESPACIOS  */
    var espacioActual = 0;
    const agregarVistaHorarios = () => { 
        
        $('.horaUpdate').on('click', function() {
            $('#modalHorarios').modal("show"); 
            let diaText = '';
            horarioDiaActual = $(this).attr('name');
            switch (parseInt(horarioDiaActual)) {
            case 1:
                diaText='Lunes';
                break;
            case 2:
                diaText='Martes';
                break;
            case 3:
                diaText='Miercoles';
                break;
            case 4:
                diaText='Jueves';
                break;
            case 5:
                diaText='Viernes';
                break;
            case 6:
                diaText='Sábado';
                break;
            default:
                diaText='Domingo';
                break;
            }
            $('#tituloHorarios').text(`Selecciona hora de inicio y fin para el día ${diaText}`);
            
        }); 
        var horariosSemanaj = obtenerDatajson("dia_semana,hora_inicio,hora_fin","con_t_horarios_espacios","valoresconcondicion","id_espacio",espacioActual);
        var horariosSemana = JSON.parse(horariosSemanaj);   
        if(horariosSemana.length == 0 ){return false;}
        for (let i = 0; i < horariosSemana.length; i++) {
            $(`#hEntrada${horariosSemana[i].dia_semana}`).text(`${horariosSemana[i].hora_inicio}`);
            $(`#hSalida${horariosSemana[i].dia_semana}`).text(`${horariosSemana[i].hora_fin}`);
        }
    }

    const changeEspacio = () => {
        $('#espaciosDeTrabajo').on('change', function() {
            espacioActual = $('#espaciosDeTrabajo').val();
            if(espacioActual == 'selecciona'){return false;}
            $('.divHorariosPordias').remove();
            html = `<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias' id='titulosdivHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Día </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Hora de inicio </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Hora de fin </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Lunes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada1' name='1'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida1' name='1'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Martes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada2' name='2'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida2' name='2'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Miercoles </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada3' name='3'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida3' name='3'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Jueves </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada4' name='4'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida4' name='4'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Viernes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada5' name='5'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida5' name='5'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Sábado </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada6' name='6'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida6' name='6'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias' id='diaDomingoDiv'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Domingo </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada7' name='7'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida7' name='7'> 00:00:00 </p>                    
                    </div>
                    `;
            let verEspaciosDiv = $(`#verEspaciosDiv`);
            verEspaciosDiv.after(html);       
            agregarVistaHorarios(); 
            // agregarVistaPermisos();
        }); 
    }

    $('#cambiarHorario').on('click', function() {
        var horariosSemanaj = obtenerDatajson("ID,dia_semana,hora_inicio,hora_fin","con_t_horarios_espacios","valoresconcondicion","id_espacio ",espacioActual);
        var horariosSemana = JSON.parse(horariosSemanaj);   
        var objetosConValor = horariosSemana.filter(function(objeto) {
            return objeto.dia_semana === horarioDiaActual;
        });

        if(!$('#datetimepicker-horariode-salida').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora de inicio.`); 
            return false;
        }
        if(!$('#datetimepicker-horariode-entrada').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora de fin.`); 
            return false;
        }

        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "id_espacio";
        objeto.valor = espacioActual;
        var id_espacio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "dia_semana";
        objeto.valor = horarioDiaActual;
        var dia_semana = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "hora_inicio";
        objeto.valor = `${$('#datetimepicker-horariode-entrada').val()}:00`;
        var hora_inicio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "hora_fin";
        objeto.valor = `${$('#datetimepicker-horariode-salida').val()}:00`;
        var hora_fin = prepararjson(objeto);

        if (objetosConValor.length > 0) {
            console.log(objetosConValor);
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = objetosConValor[0].ID;
            var condicion = prepararjson(objeto);
            actualizarregistros("con_t_horarios_espacios",condicion,id_espacio,dia_semana,hora_inicio,hora_fin,"0","0","0","0","0","0","0");
        } else {
            idHorarioAgregado = insertarfila("con_t_horarios_espacios",id_espacio,dia_semana,hora_inicio,hora_fin,"0","0","0","0","0","0","0");
        }
        
        agregarVistaHorarios();
        $('#modalHorarios').modal("hide");        
    }); 

    $('#agregarEspacios').on('click', function() {
        mostrarDiv('nuevoEspacio');
        $('.removeragregarEspacios').remove();
        // // Agrego los estados a estadoRelacionado
        let html = `'<option class='removeragregarEspacios'  value='selecciona'>Selecciona</option>'`;
        let estadoj = obtenerDatajson("ID,descripcion","con_t_estadoproyectos","variasfilasunicas","0","0");
        let estados = JSON.parse(estadoj);
        for(i=0;i<estados.length;i++){
            html=html+"<option class='removeragregarEspacios' value='"+estados[i].ID+"'>"+estados[i].descripcion+"</option>";
        }
        let estadoRelacionado = $('#estadoRelacionado');
        estadoRelacionado.append(html);
        changeEspacio();
    }); 

    $('#agregarNuevoEspacio').on('click', function() {
        var estadoRelacionado = $('#estadoRelacionado').val();
        var nombreEspacio = $('#nombreEspacio').val();
        var datetimepickeriniciolunes = $('#datetimepicker-inicio-lunes').val();
        var datetimepickerfinlunes = $('#datetimepicker-fin-lunes').val();
        var datetimepickeriniciomartes = $('#datetimepicker-inicio-martes').val();
        var datetimepickerfinmartes = $('#datetimepicker-fin-martes').val();
        var datetimepickeriniciomiercoles = $('#datetimepicker-inicio-miercoles').val();
        var datetimepickerfinmiercoles = $('#datetimepicker-fin-miercoles').val();
        var datetimepickeriniciojueves = $('#datetimepicker-inicio-jueves').val();
        var datetimepickerfinjueves = $('#datetimepicker-fin-jueves').val();
        var datetimepickerinicioviernes = $('#datetimepicker-inicio-viernes').val();
        var datetimepickerfinviernes = $('#datetimepicker-fin-viernes').val();
        var datetimepickeriniciosabado = $('#datetimepicker-inicio-sabado').val();
        var datetimepickerfinsabado = $('#datetimepicker-fin-sabado').val();
        var datetimepickeriniciodomingo = $('#datetimepicker-inicio-domingo').val();
        var datetimepickerfindomingo = $('#datetimepicker-fin-domingo').val();
        
        if((estadoRelacionado=='selecciona') || (!estadoRelacionado)){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona un estado para relacionarlo con el espacio que estás creando.`); 
            return false;
        }
        if(!nombreEspacio){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor pon un nombre para identificar el espacio.`); 
            return false;
        }

        if(!datetimepickeriniciolunes){
            datetimepickeriniciolunes = '00:00';
        }
        if(!datetimepickerfinlunes){
            datetimepickerfinlunes = '00:00';
        }
        if(!datetimepickeriniciomartes){
            datetimepickeriniciomartes = '00:00';
        }
        if(!datetimepickerfinmartes){
            datetimepickerfinmartes = '00:00';
        }
        if(!datetimepickeriniciomiercoles){
            datetimepickeriniciomiercoles = '00:00';
        }
        if(!datetimepickerfinmiercoles){
            datetimepickerfinmiercoles = '00:00';
        }
        if(!datetimepickeriniciojueves){
            datetimepickeriniciojueves = '00:00';
        }
        if(!datetimepickerfinjueves){
            datetimepickerfinjueves = '00:00';
        }
        if(!datetimepickerinicioviernes){
            datetimepickerinicioviernes = '00:00';
        }
        if(!datetimepickerfinviernes){
            datetimepickerfinviernes = '00:00';
        }
        if(!datetimepickeriniciosabado){
            datetimepickeriniciosabado = '00:00';
        }
        if(!datetimepickerfinsabado){
            datetimepickerfinsabado = '00:00';
        }
        if(!datetimepickeriniciodomingo){
            datetimepickeriniciodomingo = '00:00';
        }
        if(!datetimepickerfindomingo){
            datetimepickerfindomingo = '00:00';
        }
        
        const nuevoEspacio = $('#nuevoEspacio');
        const espacioCreadoOk = $('#espacioCreadoOk');

        nuevoEspacio.removeClass('mostrar').addClass('oculto');
        espacioCreadoOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            espacioCreadoOk.removeClass('mostrar').addClass('oculto');
            nuevoEspacio.removeClass('oculto').addClass('mostrar');
        }, 5000);

        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'estado_proyecto_relacionado';
        objeto.valor = estadoRelacionado;
        let estadoRelacionadoInsert = prepararjson(objeto);
                
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'nombre_espacio';
        objeto.valor = nombreEspacio;
        let nombreEspacioInsert = prepararjson(objeto);
        
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'fecha_hora_disponible';
        objeto.valor = '2023-05-25 10:06:16';
        let fechaDisponible = prepararjson(objeto);

        let espacio = insertarfila("con_t_espacios",nombreEspacioInsert,estadoRelacionadoInsert,fechaDisponible,"0","0","0","0","0","0","0","0");
        var idEspacio = JSON.parse(espacio);
            
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'id_espacio';
        objeto.valor = idEspacio[0].id;
        let idEspacioInsert = prepararjson(objeto);

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciolunes}:00`;
        var datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinlunes}:00`;
        var datetimepickerfin = prepararjson(objeto);        
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 1;
        var dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciomartes}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinmartes}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 2;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciomiercoles}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinmiercoles}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 3;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciojueves}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinjueves}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 4;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickerinicioviernes}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinviernes}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 5;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciosabado}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfinsabado}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 6;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_inicio';
        objeto.valor = `${datetimepickeriniciodomingo}:00`;
        datetimepickerinicio = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'hora_fin';
        objeto.valor = `${datetimepickerfindomingo}:00`;
        datetimepickerfin = prepararjson(objeto);
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'dia_semana';
        objeto.valor = 7;
        dia_semana = prepararjson(objeto);
        insertarfila("con_t_horarios_espacios",idEspacioInsert,datetimepickerinicio,datetimepickerfin,dia_semana,"0","0","0","0","0","0","0");

        

    }); 

    $('#verEspacios').on('click', function() {
        mostrarDiv('verEspaciosDiv');
        $('.remoververEspacios').remove();
        // Agrego los espacios a espaciosDeTrabajo
        let html = `'<option class='remoververEspacios'  value='selecciona'>Selecciona</option>'`;
        let espacioj = obtenerDatajson("ID,nombre_espacio,estado_proyecto_relacionado","con_t_espacios","variasfilasunicas","0","0");
        let espacios = JSON.parse(espacioj);
        for(i=0;i<espacios.length;i++){
            html=html+"<option class='remoververEspacios' value='"+espacios[i].ID+"'>"+espacios[i].nombre_espacio+"</option>";
        }
        let espaciosDeTrabajo = $('#espaciosDeTrabajo');
        espaciosDeTrabajo.append(html);
        changeEspacio();
    });
    const colorChange = () => {
        $('.colorProyecto').on('change', function() {
            if($(this).val()=='selecciona'){return false;}        
            let indicativoNumeroSelect = this.name.split('-');
            let padre = $(`#talla${indicativoNumeroSelect[0]}`);
            let ultimoHijo = padre.children().length - 1;
            let valorUltimohijo = $(`#colorProyecto${indicativoNumeroSelect[0]}-${ultimoHijo}`).val();

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
            colorChange();
        });  
    }
    
    
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
    if(permisos[i].permiso_id==50){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion3'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='verEspacios'>Ver espacios </button></div>");
    }   
    if(permisos[i].permiso_id==51){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion3'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='agregarEspacios'>Agregar espacios </button></div>");
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
    // date and time picker
	$('.datetimepickerHoras').datetimepicker({
        format: 'HH:mm'
	});

    
</script>
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>