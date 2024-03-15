<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
var coloresCombinacion = [];
var insumosRepetidos = [];
var proyectosArray = [];
var referenciaParaProyecto = 0;
var arrayInsumosUtilizados;
var arregloInsumosSimplificado = [];//arregloInsumosSimplificado tiene como resultado las cantidades totales de prendas, los insumos y la cantidad por unidad que se va a gastar en el proyecto. 
var arrayTallas = [];
var arregloColoresTexto = [];
var nombreReferencia = '';
var nombreNuevoProyecto = '';
var espaciosProyectos = [];
var trabajadoresProyectos = [];
var fechaInicioProyecto;
var fechaFinProyecto = new Date('2053-07-01 10:06:16');
var notificacionFaltantes = '';
var costoTotalProyectoNuevo = 0;
var eliminarProyecto = 0;
var proyectoIdTotal = 0;
const mostrarDiv = (idaMostrar) => {
    $('.divHorariosPordias').remove();
    const nuevoEspacio = $('#nuevoEspacio');
    const nuevoProyecto = $('#nuevoProyecto');
    const verEspaciosDiv = $('#verEspaciosDiv');
    const verProyectosDiv = $('#verProyectosDiv');
    const nuevoSatelite = $('#nuevoSatelite');
    const verSatelitesDiv = $('#verSatelitesDiv');
    const aidaMostrar = $(`#${idaMostrar}`);
    nuevoEspacio.removeClass('mostrar').addClass('oculto');
    nuevoProyecto.removeClass('mostrar').addClass('oculto');
    verEspaciosDiv.removeClass('mostrar').addClass('oculto');
    verProyectosDiv.removeClass('mostrar').addClass('oculto');
    verSatelitesDiv.removeClass('mostrar').addClass('oculto');
    nuevoSatelite.removeClass('mostrar').addClass('oculto');
    
    setTimeout(() => {
        nuevoEspacio.css('display', 'none');
        nuevoProyecto.css('display', 'none');
        verEspaciosDiv.css('display', 'none');
        verProyectosDiv.css('display', 'none');
        nuevoSatelite.css('display', 'none');
        verSatelitesDiv.css('display', 'none');
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
const tablaTallas = (claseDiv) => {
    var detalles = '';
    for (let i = 0; i < arrayTallas.length; i++) {
                
                for (let j = 0; j < arrayTallas[i].codigosCombinaciones.length; j++) {
                    var codigoCombinacion = arrayTallas[i].codigosCombinaciones[j].codigo;
                    var insumoActual='';
                    for (let j = 0; j < codigoCombinacion.length; j=j+1+parseInt(codigoCombinacion[j])) {
                        for (let k = 0; k < codigoCombinacion[j]; k++) {       
                            insumoActual = `${insumoActual}${codigoCombinacion[j+1+k]}`;
                        }   
                    }
                    
                    let combinacion = arrayTallas[i].codigosCombinaciones[j].nombreCombinacion;
                    detalles = `${detalles}
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc ${claseDiv}' > 
                                
                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${arrayTallas[i].talla}</p>

                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${combinacion}</p>

                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${arrayTallas[i].codigosCombinaciones[j].cantidad}</p>

                            </div>
                    `;
                }
            }
    return detalles;
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

const calcularFechaHoraFinal = (fechaHoraInicial,minutos,horario) => {
    var tiempo = {
        "minutos":minutos,
        "segundos": 0
    }

    var fecha = new Date(fechaHoraInicial);
    var dia = fecha.getDay();
    var hora = fecha.getHours();
    var minuts = fecha.getMinutes();
    var segundos = fecha.getSeconds();
    var horaInicioProyecto = `${hora}:${minuts}:${segundos}`;
    for (let i = 0; i < 999; i++) {
        
        var diaEncontrado = horario.find(function(objeto) {
            return objeto.dia_semana === dia.toString();
        });
        if(!diaEncontrado){
            dia++;
            fecha.setDate(fecha.getDate() + 1);
            if(dia==8){dia=1;}
            continue;
        }
        if(i>0){
            horaInicioProyecto=diaEncontrado.hora_inicio;
        }
        
        var objetoDiferencia = diferenciaMinutosSegundos(diaEncontrado.hora_inicio,horaInicioProyecto);//calculo si la hora de unicio del día es menor a la hora de inicio del proyecto
        
        if(objetoDiferencia.minutos <0){
            horaInicioProyecto = diaEncontrado.hora_inicio;
        }
    
        var objetoDiferencia = diferenciaMinutosSegundos(horaInicioProyecto,diaEncontrado.hora_fin);//calculo la diferencia entre la hora de inicio y la hora de fin del día.
        

        if(tiempo.minutos > objetoDiferencia.minutos){
            tiempo.minutos = tiempo.minutos - objetoDiferencia.minutos;
            if(tiempo.segundos<objetoDiferencia.segundos){
                tiempo.minutos = tiempo.minutos-1;
                tiempo.segundos = 60-(objetoDiferencia.segundos-tiempo.segundos);
            }else{
                tiempo.segundos = tiempo.segundos-objetoDiferencia.segundos;
            }
            
        }else{

            var minutosRestar = objetoDiferencia.minutos - tiempo.minutos;
            
            var segundosRestar = 0; 

            if((objetoDiferencia.segundos-tiempo.segundos)<0){
                segundosRestar = 60+(objetoDiferencia.segundos-tiempo.segundos);
            }
            if((objetoDiferencia.segundos-tiempo.segundos)>0){
                segundosRestar = objetoDiferencia.segundos-tiempo.segundos;
            }

            
           // Dividir la cadena en horas, minutos y segundos
            var partes = diaEncontrado.hora_fin.split(":");
            var horas = parseInt(partes[0]);
            var minutos = parseInt(partes[1]);
            var segundos = parseInt(partes[2]);

            // Calcular la cantidad total de minutos y segundos del valor original
            var minutosTotales = horas * 60 + minutos;
            var segundosTotales = minutosTotales * 60 + segundos;

            // Restar la cantidad deseada de minutos y segundos
            var segundosResultantes = segundosTotales - (minutosRestar * 60 + segundosRestar);

            // Manejar casos en los que los segundos resultantes sean negativos o superen el valor de 60
            if (segundosResultantes < 0) {
            // Ajustar los minutos si los segundos resultantes son negativos
            segundosResultantes += 86400; // 86400 segundos = 24 horas
            }

            // Calcular las nuevas horas, minutos y segundos
            horas = Math.floor(segundosResultantes / 3600);
            minutos = Math.floor((segundosResultantes % 3600) / 60);
            segundos = segundosResultantes % 60;

            // Formatear nuevamente la cadena de tiempo resultante
            var horaFinRestada = `${horas.toString().padStart(2, "0")}:${minutos.toString().padStart(2, "0")}:${segundos.toString().padStart(2, "0")}`;

            // Obtener los componentes de la fecha
            var anio = fecha.getFullYear();
            var mes = (fecha.getMonth() + 1).toString().padStart(2, "0"); // Se suma 1 al mes ya que los meses van de 0 a 11
            var dia = fecha.getDate().toString().padStart(2, "0");

            // Formatear la fecha en el formato deseado
            var fechaFormateada = `${anio}-${mes}-${dia}`;

            var fechaHoraFinal = {
                "hora":horaFinRestada,
                "fecha":fechaFormateada
            }
            return fechaHoraFinal;
        }

        dia++;
        fecha.setDate(fecha.getDate() + 1);
        
        if(dia==8){dia=1;}        
    }

}

const fechaActual = () => {
   
         // Obtener la fecha actual
         const fechaActual = new Date();

// Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
const anio = fechaActual.getFullYear();
const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
const dia = String(fechaActual.getDate()).padStart(2, '0');
const hora = String(fechaActual.getHours()).padStart(2, '0');
const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

// Construir la cadena de fecha y hora en el formato deseado
const fechaHoraActual = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;

return(fechaHoraActual);
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
        coloresCombinacion.forEach((elemento) => {//aqui coloresCombinacion es el array que traigo de con_t_combinacionesproducto según la referencia escogida
        if (!grupos[elemento.indicativo_combinacion]) {
            grupos[elemento.indicativo_combinacion] = [];
        }
        grupos[elemento.indicativo_combinacion].push(elemento);
        });

        const arreglosSeparados = Object.values(grupos);//arreglosSeparados son las combinaciones agrupadas según el indicativo de combinación
        // console.log('arreglosSeparados');
        // console.log(arreglosSeparados);
        html=`'<option class='removerColoresCombinaciones'  value='selecciona'>Selecciona</option>'`;
        for (let i = 0; i < arreglosSeparados.length; i++) {
            let textos = `${arreglosSeparados[i][0].nombre_combinacion} > ${arreglosSeparados[i][0].codigo_combinacion}`;   
            let codigoCombinacion = '';
            console.log(arreglosSeparados);
            for (let j = 0; j < arreglosSeparados[i].length; j++) {            
                // Acá verifico que el insumo no se repita en todos los indicativos de combinación, de esta forma solo voy a mostrar lo que en realidad diferencia a las combinaciones, por ejemplo si todas las combinaciones tienen el isumo broches, pues este no lo voy a mostrar
                const resultado = arreglosSeparados.flat().filter(objeto => objeto.insumo === arreglosSeparados[i][j].insumo);
                
                if(resultado.length < arreglosSeparados.length){
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
            html = `${html} <option class='removerColoresCombinaciones' name='${arreglosSeparados[i][0].ID}' value='${codigoCombinacion}'>${descripcion}</option>`;
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
            let coloresCombinacionj = obtenerDatajson("ID,indicativo_combinacion,insumo,cantidad,text_insumo,nombre_combinacion,codigo_combinacion","con_t_combinacionesproducto","valoresconcondicion","ficha_tecnica ",`'${referenciaParaProyecto}'`);
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
        referenciaParaProyecto = $('#referenciaParaProyecto').val();

        var elementoSeleccionado = $("#referenciaParaProyecto option:selected");
        nombreReferencia = elementoSeleccionado.text();
        if(referenciaParaProyecto=="selecciona"){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona la referencia del proyecto`); 
            return false;
        }
        var divTallasCombinaciones = $('.divTallasCombinaciones');
        arrayTallas = [];
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
                
                const selectElement = $(divTallasCombinaciones[i]).children().eq(j).children().eq(0).children().eq(1);
                const codigoCombinacionesproducto = selectElement.find('option:selected').attr("name");
                var arrColorCombinacion = selectElement.find('option:selected').text().split('>');
                var nombreColorCombinacion = arrColorCombinacion[0];
                var codigoColorCombinacion = arrColorCombinacion[1];
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
                console.log(objetoColoresCombinaciones);
                cantidadPrendasPorCortar = cantidadPrendasPorCortar + parseInt(objetoColoresCombinaciones.cantidad);
                var objetoCombi={
                    codigo: codigoCombinacion,
                    cantidad:$(divTallasCombinaciones[i]).children().eq(j).children().eq(1).children().eq(1).val(),
                    codigoCombinacionesproducto: codigoCombinacionesproducto,
                    nombreCombinacion: nombreColorCombinacion,
                    codigoColorCombinacion: codigoColorCombinacion
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
        // console.log(arrayTallas);
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
                arregloInsumosSimplificado[i].faltantesCon_t_Insumos = parseInt(insumoActual[0].faltantes) + parseInt(cantidadInsumo);
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
        // console.log('arregloInsumosSimplificado'); 
        // console.log(arregloInsumosSimplificado);//arregloInsumosSimplificado tiene como resultado las cantidades totales de prendas, los insumos, la cantidad por unidad que se va a gastar en el proyecto y los faltantes para el proyecto y en general de todo el inventario 
        // console.log('arrayTallas');
        // console.log(arrayTallas);// tiene las tallas que se van a hacer, con sus respectivas combinaciones y cantidades, una con los codigos separados por insumos y otra con los codigosColores listos para decodificar e ingresar en con_t_combinacionesproyectos

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
        $('.removerEspaciosTrabajosFechasInicio').remove();
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
                minutosMenor = $(`#minutosEspacio${$(espaciosProyectosClass[i]).attr('name')}`).val(); 
            }

            var minutosEsp = $(`#minutosEspacio${$(espaciosProyectosClass[i]).attr('name')}`).val();
            
           

            var objeto = {
                espacio:$(espaciosProyectosClass[i]).val(), 
                minutos: minutosEsp,
                horarios: horarios_espacios,
                fecha_hora_disponible: fechaDisponEspacio,
                fecha_hora_fin: "",
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
                minutosMenor = $(`#minutosTrabajador${$(trabajadoresProyectosClass[i]).attr('name')}`).val();
            }

            var objeto = {
                trabajador:$(trabajadoresProyectosClass[i]).val(), 
                minutos: $(`#minutosTrabajador${$(trabajadoresProyectosClass[i]).attr('name')}`).val(),
                horarios: horarios_trabajador,
                fecha_hora_disponible: fechaDisponTrabajador,
                fecha_hora_fin:"",
                texto: textoSeleccionado
            };
            trabajadoresProyectos.push(objeto);

        }
        if(trabajadoresProyectos.length == 0 ){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor seleccion al menos un trabajador para este proyecto`); 
            return false;
        }
       
        if(fechaMenorTrabajadores >= fechaMenorEspacios){
            fechaInicioProyecto = fechaMenorTrabajadores;
        }else{
            fechaInicioProyecto = fechaMenorEspacios;
        }
        
        var fechaInicioProyectoObjeto = new Date(fechaInicioProyecto);

        var htmlHorarios = '';
        //agrego el campo de fecha final a cada elemento del arreglo espacios
        for (let i = 0; i < espaciosProyectos.length; i++) {
            var fechaFin = calcularFechaHoraFinal(espaciosProyectos[i].fecha_hora_disponible,espaciosProyectos[i].minutos,espaciosProyectos[i].horarios);
            espaciosProyectos[i].fecha_hora_fin = `${fechaFin.fecha} ${fechaFin.hora}`;
            htmlHorarios = `
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerEspaciosTrabajosFechasInicio'> 
                <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio del proyecto para ${espaciosProyectos[i].texto}</label>
                    <input type="text" id="datetimepickerInicioProyecto-Espacio-${espaciosProyectos[i].espacio}" class="form-control fechaInicioSelect" />
                </div>  
                <div id='fechaFinalTiempoReal' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Hora y fecha final
                    </p>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='e${espaciosProyectos[i].espacio}'> 
                        ${fechaFin.fecha} ${fechaFin.hora} 
                    </p>
                </div> 
            </div> 
            `;

            $('#volverAespaciosTrabajadoresDiv').before(htmlHorarios);

            // Inicializar el datetimepicker en el elemento
            $(`#datetimepickerInicioProyecto-Espacio-${espaciosProyectos[i].espacio}`).datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                minDate: espaciosProyectos[i].fecha_hora_disponible
            });

        }

       
        //agrego el campo de fecha final a cada elemento del arreglo trabajadores
        for (let i = 0; i < trabajadoresProyectos.length; i++) {
            var fechaFin = calcularFechaHoraFinal(trabajadoresProyectos[i].fecha_hora_disponible,trabajadoresProyectos[i].minutos,trabajadoresProyectos[i].horarios);
            trabajadoresProyectos[i].fecha_hora_fin = `${fechaFin.fecha} ${fechaFin.hora}`;

            htmlHorarios = `
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removerEspaciosTrabajosFechasInicio'>  
                <div class="form-group pmd-textfield pmd-textfield-floating-label pmd-textfield-floating-label-completed col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <label class="control-label letra18pt-pc" for="regular1">Fecha y hora de inicio del proyecto para ${trabajadoresProyectos[i].texto}</label>
                    <input type="text" id="datetimepickerInicioProyecto-Trabajador-${trabajadoresProyectos[i].trabajador}" class="form-control fechaInicioSelect" />
                </div>  
                <div id='fechaFinalTiempoReal' class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc'> 
                        Hora y fecha final
                    </p>
                    <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc' id='t${trabajadoresProyectos[i].trabajador}'> 
                        ${fechaFin.fecha} ${fechaFin.hora} 
                    </p>
                </div> 
            </div> 

            
            `;

            $('#volverAespaciosTrabajadoresDiv').before(htmlHorarios);

            // Inicializar el datetimepicker en el elemento
            $(`#datetimepickerInicioProyecto-Trabajador-${trabajadoresProyectos[i].trabajador}`).datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                minDate: trabajadoresProyectos[i].fecha_hora_disponible
            });

        }

        mostrarOcultarDiv('fechaFinalaldelProyectoDiv','espaciosTrabajadoresDiv'); 
        
        fechaInicioSelect();
        
    }); 

    $('#irAresumen').on('click', function() {
        var ultimoProyecto = obtenerDatajson("ID","con_t_proyectos","ultimo","0","0");
        var jsonUltimoProyecto = JSON.parse(ultimoProyecto); 
        
        var numeroProyecto = 0;
        if(!jsonUltimoProyecto[0].id){
            numeroProyecto = 1;
        }else{
            numeroProyecto = parseInt(jsonUltimoProyecto[0].id) +1;
        }

        nombreNuevoProyecto = `${nombreReferencia} ${numeroProyecto}`;

        fechaInicioProyecto = '2120-07-15 13:00:00';
        fechaFinProyecto = '2020-07-15 13:00:00';
        

        var espacioTexto = '';

        for (let i = 0; i < espaciosProyectos.length; i++) {
            if(fechaInicioProyecto > espaciosProyectos[i].fecha_hora_inicio){
                fechaInicioProyecto = espaciosProyectos[i].fecha_hora_inicio;
            }
            if(fechaFinProyecto < espaciosProyectos[i].fecha_hora_fin){
                fechaFinProyecto =  espaciosProyectos[i].fecha_hora_fin;
            }
            
            espacioTexto = `${espacioTexto}
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerResumenFinal'> 
                        
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${espaciosProyectos[i].texto}</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${espaciosProyectos[i].fecha_hora_inicio}</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${espaciosProyectos[i].fecha_hora_fin}</p>

                </div>
            `;
        }
        
        var trabajadorTexto = '';
        for (let i = 0; i < trabajadoresProyectos.length; i++) {
            if(fechaInicioProyecto > trabajadoresProyectos[i].fecha_hora_inicio){
                fechaInicioProyecto = trabajadoresProyectos[i].fecha_hora_inicio;
            }
            if(fechaFinProyecto < trabajadoresProyectos[i].fecha_hora_fin){
                fechaFinProyecto =  trabajadoresProyectos[i].fecha_hora_fin;
            }
            

            trabajadorTexto = `${trabajadorTexto}
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerResumenFinal'> 
                        
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${trabajadoresProyectos[i].texto}</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${trabajadoresProyectos[i].fecha_hora_inicio}</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc '>${trabajadoresProyectos[i].fecha_hora_fin}</p>

                </div>
            `;
        }      

        notificacionFaltantes = `Para el proyecto ${nombreNuevoProyecto} que tiene como fecha de inicio ${fechaInicioProyecto}
        faltan los siguientes insumos: `;

        var detalles =  tablaTallas('removerResumenFinal');

        costoTotalProyectoNuevo = 0;
        var resumenPresupuesto = '';
        var resumenFaltantes = '';
        console.log('arregloInsumosSimplificado');
        console.log(arregloInsumosSimplificado);
        for (let i = 0; i < arregloInsumosSimplificado.length; i++) {
            let insumoActualj = obtenerDatajson("caracteristica,complemento_caracteristica,complemento,grupo,presentacion","con_t_insumos","valoresconcondicion","ID ",arregloInsumosSimplificado[i].insumo);
            let insumoActualTexto =  JSON.parse(insumoActualj); 
            resumenPresupuesto=`${resumenPresupuesto}
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerResumenFinal'> 
                        
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${insumoActualTexto[0].grupo} ${insumoActualTexto[0].caracteristica} ${insumoActualTexto[0].complemento} ${insumoActualTexto[0].complemento_caracteristica}  </p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${arregloInsumosSimplificado[i].cantidadInsumo}</p>

                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${formatoPrecio(parseInt(arregloInsumosSimplificado[i].costo))}</p>

                    </div>
            `;
            if(arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes>0){
                resumenFaltantes=`${resumenFaltantes}
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerResumenFinal'> 

                        <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'>${insumoActualTexto[0].grupo} ${insumoActualTexto[0].caracteristica} ${insumoActualTexto[0].complemento} ${insumoActualTexto[0].complemento_caracteristica}</p>

                        <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc'>${arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes} ${insumoActualTexto[0].presentacion}  </p>

                    </div>
                `;
                notificacionFaltantes = `${notificacionFaltantes}
                ${insumoActualTexto[0].grupo} ${insumoActualTexto[0].caracteristica} ${insumoActualTexto[0].complemento} ${insumoActualTexto[0].complemento_caracteristica} ${arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes} ${insumoActualTexto[0].presentacion}
                `;
            }
            costoTotalProyectoNuevo = costoTotalProyectoNuevo + parseInt(arregloInsumosSimplificado[i].costo);
        }
        var costoTotalProyectoNuevoFormato = formatoPrecio(costoTotalProyectoNuevo);

       
        $(`#nombreProyecto`).text(nombreNuevoProyecto.replace(/No aplica/g,""));

        $(`#fechaInicioProyectoNuevo`).text(`Fecha inicio del proyecto: ${fechaInicioProyecto}`);

        $(`#fechaFinProyectoNuevo`).text(`Fecha fin del proyecto: ${fechaFinProyecto}`);
        
        $(`#detallesProyectoDiv`).after(detalles);

        $(`#costoTotalProyectoNuevo`).text(costoTotalProyectoNuevoFormato);
        
        $(`#resumenPresupuesto`).after(resumenPresupuesto.replace(/No aplica/g,""));

        $(`#resumenFaltantes`).after(resumenFaltantes.replace(/No aplica/g,"")); 

        $(`#espaciosUtilizadosProyectoDiv`).after(espacioTexto); 

        $(`#trabajadoresUtilizadosProyectoDiv`).after(trabajadorTexto); 
        

         // arregloInsumosSimplificado   *** son los dos arreglos importantes ya que estos nos van a dar las combinaciones y cantidades para crear las marquillas  faltantesCon_t_InsumosFaltantes Son los insumos faltantes totales para actualizar la tabla de insumos faltantes
        // arrayTallas                  *** y nos van a dar la cantidad de insumos que se van a usar en el proyecto.
       
        mostrarOcultarDiv('resumenFinalNuevoProyecto','fechaFinalaldelProyectoDiv'); 
    });

    $('#volverAfechaFinalaldelProyectoDiv').on('click', function() {
        $('.removerResumenFinal').remove();
        mostrarOcultarDiv('fechaFinalaldelProyectoDiv','resumenFinalNuevoProyecto');  
    }); 
    
    
    $('#confirmarNuevoProyecto').on('click', function() {

        // con_t_proyectos  	ID 	nombre_proyecto 	fecha_inicio_proyecto 	fecha_fin_proyecto 	presupuesto 	estado 	

        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "nombre_proyecto";
        objeto.valor = nombreNuevoProyecto.replace(/No aplica/g,"");
        var nombre_proyecto = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "date";
        objeto.columna = "fecha_inicio_proyecto";
        objeto.valor = fechaInicioProyecto;
        var fecha_inicio_proyecto = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "date";
        objeto.columna = "fecha_fin_proyecto";
        objeto.valor = fechaFinProyecto;
        var fecha_fin_proyecto = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "presupuesto";
        objeto.valor = costoTotalProyectoNuevo;
        var presupuesto = prepararjson(objeto);
        
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "estado";
        objeto.valor = 'Por cortar';
        var estado = prepararjson(objeto);

        var proyecto = insertarfila("con_t_proyectos",nombre_proyecto,fecha_inicio_proyecto,fecha_fin_proyecto,presupuesto,estado,"0","0","0","0","0","0"); 
        var idProyecto = JSON.parse(proyecto);
            
        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'id_proyecto';
        objeto.valor = idProyecto[0].id;
        let id_proyecto = prepararjson(objeto);

        // con_t_presupuestosproyectos ID 	id_proyecto 	id_insumo 	cantidad 	cantidadInsumo 	costo 	
        // **La diferencia entre cantidad y cantidadInsumo es que cantidad es la cantidad de prendas que van a utilizar ese insumo en el proyectos
        // ** y cantidadInsumo es la cantidad en total del isumo que se van a utilizar
        for (let i = 0; i < arregloInsumosSimplificado.length; i++) {
               
            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'id_insumo';
            objeto.valor = arregloInsumosSimplificado[i].insumo;
            let id_insumo = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'cantidad';
            objeto.valor = arregloInsumosSimplificado[i].cantidad;
            let cantidad = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'cantidadInsumo';
            objeto.valor = arregloInsumosSimplificado[i].cantidadInsumo;
            let cantidadInsumo = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'costo';
            objeto.valor = arregloInsumosSimplificado[i].costo;
            let costo = prepararjson(objeto);

            var presupuestosProyectos = insertarfila("con_t_presupuestosproyectos",id_proyecto,id_insumo,cantidad,cantidadInsumo,costo,"0","0","0","0","0","0"); 
           
           
            // con_t_insumos faltantes 	int(200)
            // con_t_insumosfaltantes ID 	id_insumo 	cantidad 	id_proyecto 	completado 

            if(arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes>0){

                var objeto = {};
                objeto.columna = "ID";
                objeto.valor = arregloInsumosSimplificado[i].insumo;
                var condicion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'faltantes';
                objeto.valor = arregloInsumosSimplificado[i].faltantesCon_t_Insumos;
                let faltantes = prepararjson(objeto);

                actualizarregistros("con_t_insumos",condicion,faltantes,"0","0","0","0","0","0","0","0","0","0");
                
                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'cantidad';
                objeto.valor = arregloInsumosSimplificado[i].faltantesCon_t_InsumosFaltantes;
                let cantidadFaltante = prepararjson(objeto);

                var objeto = {};
                objeto.tipo = "int";
                objeto.columna = "completado";
                objeto.valor = 0;
                var completado = prepararjson(objeto);

                var iDinsumosfaltantes = insertarfila("con_t_insumosfaltantes",id_insumo,cantidadFaltante,id_proyecto,completado,"0","0","0","0","0","0","0"); 
                
                
            }
            
        }

        
        // con_t_espacios fecha_hora_disponible 	datetime 
        // `con_t_espaciosproyecto` `id_proyecto` int(11) NOT NULL,`id_espacio` int(11) NOT NULL,
       
        for (let i = 0; i < espaciosProyectos.length; i++) {
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = espaciosProyectos[i].espacio;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'date';
            objeto.columna = 'fecha_hora_disponible';
            objeto.valor = espaciosProyectos[i].fecha_hora_fin;
            let fecha_hora_disponibleEspacio = prepararjson(objeto);

            actualizarregistros("con_t_espacios",condicion,fecha_hora_disponibleEspacio,"0","0","0","0","0","0","0","0","0","0");

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'id_espacio';
            objeto.valor = espaciosProyectos[i].espacio;
            let id_espacio = prepararjson(objeto);

            var iDespaciosproyecto = insertarfila("con_t_espaciosproyecto",id_proyecto,id_espacio,"0","0","0","0","0","0","0","0","0"); 
        }

        // con_t_empleados fecha_hora_disponible 	datetime 
        // `con_t_trabajadoresproyecto` `id_proyecto` int(11) NOT NULL,`id_trabajador` int(11) NOT NULL, 
        
        for (let i = 0; i < trabajadoresProyectos.length; i++) {
            var objeto = {};
            objeto.columna = "id_empleado ";
            objeto.valor = trabajadoresProyectos[i].trabajador;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'date';
            objeto.columna = 'fecha_hora_disponible';
            objeto.valor = trabajadoresProyectos[i].fecha_hora_fin;
            let fecha_hora_disponibleEmpleado = prepararjson(objeto);

            actualizarregistros("con_t_empleados",condicion,fecha_hora_disponibleEmpleado,"0","0","0","0","0","0","0","0","0","0");

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'id_trabajador';
            objeto.valor = trabajadoresProyectos[i].trabajador;
            let id_trabajador = prepararjson(objeto);

            var iDespaciosproyecto = insertarfila("con_t_trabajadoresproyecto",id_proyecto,id_trabajador,"0","0","0","0","0","0","0","0","0"); 
        }   

        
         // `con_t_proyectostr` 
        // `id_proyecto` int(11) NOT NULL,
        // `id_usuario` bigint(20) unsigned NOT NULL,
        // `fecha_hora` datetime DEFAULT NULL,
        // `tipocambio` varchar(50) DEFAULT NULL,
        // `anterior` varchar(50) DEFAULT NULL,
        // `actual` varchar(50) DEFAULT NULL,

        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'id_usuario';
        objeto.valor = parseInt($('#usuario').attr("name"));
        let id_usuario = prepararjson(objeto);
       
        const fechaActual = new Date();

        // Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        const hora = String(fechaActual.getHours()).padStart(2, '0');
        const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
        const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

        // Construir la cadena de fecha y hora en el formato deseado
        var fechaActuall  = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;


        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_hora";
        objeto.valor = fechaActuall;
        var fecha_hora = prepararjson(objeto);
        
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "tipocambio";
        objeto.valor = 'Creación del proyecto';
        var tipocambio = prepararjson(objeto);

        var iDespaciosproyecto = insertarfila("con_t_proyectostr",id_proyecto,id_usuario,fecha_hora,tipocambio,"0","0","0","0","0","0","0"); 
                

        //con_t_combinacionesproyecto  	ID 	id_proyecto 	id_combinacion 	cantidad 	

        // con_t_detalleproyecto id_detalleproyecto 	id_proyecto 	talla 	color 	id_combinacion 	cantidad 	
        for (let i = 0; i < arrayTallas.length; i++) {            
            for (let j = 0; j < arrayTallas[i].codigosCombinaciones.length; j++) {

                var objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'id_combinacion';
                objeto.valor = arrayTallas[i].codigosCombinaciones[j].codigo;
                var id_combinacion = prepararjson(objeto);

                var objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'cantidad';
                objeto.valor = arrayTallas[i].codigosCombinaciones[j].cantidad;
                let cantidadCombinaciones = prepararjson(objeto);
                

                var combinacionesProyecto = insertarfila("con_t_combinacionesproyecto",id_proyecto,id_combinacion,cantidadCombinaciones,"0","0","0","0","0","0","0","0"); 
                
               
                let combinacion = arrayTallas[i].codigosCombinaciones[j].nombreCombinacion;
                let codigoColorcombinacion = arrayTallas[i].codigosCombinaciones[j].codigoColorCombinacion;
                

                var objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'talla';
                objeto.valor = arrayTallas[i].talla;
                let talla = prepararjson(objeto);
                
                var objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'color';
                objeto.valor = combinacion;
                let color = prepararjson(objeto);

                var objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'codigo_combinacion';
                objeto.valor = codigoColorcombinacion;
                let codigo_combinacion = prepararjson(objeto);
            
                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'id_combinacion';
                objeto.valor = arrayTallas[i].codigosCombinaciones[j].codigoCombinacionesproducto;
                var id_combinacion = prepararjson(objeto);
                
                var resumenBuscado = obtenerDatajson("referencia_id","con_t_resumen","variasCondiciones",`nombre = '${nombreReferencia}' 
                AND  color = '${combinacion}' 
                AND  talla = '${arrayTallas[i].talla}'`,"0");
                var jsonresumenBuscado = JSON.parse(resumenBuscado);
                var referendiaIdinsert = jsonresumenBuscado[0].referencia_id;

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'id_ref';
                objeto.valor = referendiaIdinsert;
                var id_ref = prepararjson(objeto);

                var iDdetalleproyecto = insertarfila("con_t_detalleproyecto",id_proyecto,talla,color,codigo_combinacion,id_combinacion,cantidadCombinaciones,id_ref,"0","0","0","0","0"); 

            }
        }        

        const resumenFinalNuevoProyecto = $('#resumenFinalNuevoProyecto');
        const proyectoCreadoOk = $('#proyectoCreadoOk');

        resumenFinalNuevoProyecto.removeClass('mostrar').addClass('oculto');
        proyectoCreadoOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            proyectoCreadoOk.removeClass('mostrar').addClass('oculto');
            resumenFinalNuevoProyecto.removeClass('oculto').addClass('mostrar');
        }, 5000);
        
        const textoCodificado = encodeURIComponent(notificacionFaltantes.replace(/No aplica/g,""));
        var url = `https://wa.me/573017209186?text=${textoCodificado}`;
        
        window.open(url, '_blank');

        let proyectosJson = obtenerDatajson("ID,nombre_proyecto,fecha_inicio_proyecto,fecha_fin_proyecto,presupuesto,estado","con_t_proyectos","variasfilasunicas","0","0");
        proyectosArray = JSON.parse(proyectosJson);

        var html = '';
        for (let i =  (proyectosArray.length-1); i >= 0; i--) {
            if (proyectosArray[i].estado == 'Eliminado') {continue;}
            html = `${html}
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerVerProyectos' id='proyectoMostrar${proyectosArray[i].ID}'> 
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].nombre_proyecto}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].estado}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_inicio_proyecto}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_fin_proyecto}</p>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                    <button class='botonmodal verProyectoIndividual' type='button' id='proyectoN${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                    Ver proyecto
                    </button>
                </div>`;
            if((eliminarProyecto==1) && (proyectosArray[i].estado == 'Por cortar')){
                html=`${html}
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                    <button class='botonmodal borrarProyectoIndividual' type='button' id='proyectoB${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                    Borrar proyecto
                    </button>
                </div>`;
            }
                
            html = `${html}</div>`; 
        
        }
        $('.removerEspaciosTrabajosFechasInicio').remove();
        $('.removerResumenFinal').remove();
        $('.removerVerProyectos').remove();
        $('.removerDetallesVistProyecto').remove();
        mostrarOcultarDiv('verProyectosDiv','verProyectoDiv'); 
        mostrarDiv('verProyectosDiv'); 
        $('#titulosProyectosVer').after(html);
        proyectoIndividual(); 
    }); 

    
    $('#verProyectos').on('click', function() {
        let proyectosJson = obtenerDatajson("ID,nombre_proyecto,fecha_inicio_proyecto,fecha_fin_proyecto,presupuesto,estado","con_t_proyectos","variasfilasunicas","0","0");
        proyectosArray = JSON.parse(proyectosJson);

        var html = '';
        for (let i =  (proyectosArray.length-1); i >= 0; i--) {
            if (proyectosArray[i].estado == 'Eliminado') {continue;}
            html = `${html}
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerVerProyectos' id='proyectoMostrar${proyectosArray[i].ID}'> 
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].nombre_proyecto}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].estado}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_inicio_proyecto}</p>
                <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_fin_proyecto}</p>
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                    <button class='botonmodal verProyectoIndividual' type='button' id='proyectoN${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                    Ver proyecto
                    </button>
                </div>`;
            if((eliminarProyecto==1) && (proyectosArray[i].estado == 'Por cortar')){
                html=`${html}
                <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                    <button class='botonmodal borrarProyectoIndividual' type='button' id='proyectoB${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                    Borrar proyecto
                    </button>
                </div>`;
            }
                
            html = `${html}</div>`; 
        
        }
        $('.removerEspaciosTrabajosFechasInicio').remove();
        $('.removerResumenFinal').remove();
        $('.removerVerProyectos').remove();
        $('.removerDetallesVistProyecto').remove();
        mostrarOcultarDiv('verProyectosDiv','verProyectoDiv'); 
        mostrarDiv('verProyectosDiv'); 
        $('#titulosProyectosVer').after(html);
        proyectoIndividual();
    }); 

    var terminadoProyecto = 0;
    const proyectoIndividual = () => {
        $('#eliminarProyectoConfirmado').on('click', function() {
            // `con_t_insumosfaltantes` (
            //   `ID` int(11) NOT NULL AUTO_INCREMENT,
            //   `id_insumo` int(11) NOT NULL,
            //   `cantidad` int(200) NOT NULL,
            //   `id_proyecto` int(11) NOT NULL,
            //   `completado` int(11) NOT NULL,
            var objeto = {};
            objeto.columna = "id_proyecto";
            objeto.valor = proyectoIdTotal;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'completado';
            objeto.valor = 2;
            let completado = prepararjson(objeto);

            actualizarregistros("con_t_insumosfaltantes",condicion,completado,"0","0","0","0","0","0","0","0","0","0");

            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = proyectoIdTotal;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'string';
            objeto.columna = 'estado';
            objeto.valor = 'Eliminado';
            let estado = prepararjson(objeto);

            actualizarregistros("con_t_proyectos",condicion,estado,"0","0","0","0","0","0","0","0","0","0");

            let faltantesJson = obtenerDatajson("id_insumo,cantidad","con_t_insumosfaltantes","valoresconcondicion","id_proyecto",`'${proyectoIdTotal}'`);
            let faltantes = JSON.parse(faltantesJson);

            for (let i = 0; i < faltantes.length; i++) {
                let faltantesTablaInsumosJson = obtenerDatajson("faltantes","con_t_insumos","valoresconcondicion","ID",faltantes[i].id_insumo);
                let faltantesTablaInsumos = JSON.parse(faltantesTablaInsumosJson);
                let totalActualizar = parseInt(faltantesTablaInsumos[0].faltantes) - parseInt(faltantes[i].cantidad);

                var objeto = {};
                objeto.columna = "ID";
                objeto.valor = faltantes[i].id_insumo;
                var condicion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'faltantes';
                objeto.valor = totalActualizar;
                let faltantesActualizar = prepararjson(objeto);

                actualizarregistros("con_t_insumos",condicion,faltantesActualizar,"0","0","0","0","0","0","0","0","0","0");
                
                
            }

            proyectotr('Eliminado');    
        
            $('#modalEliminarProyecto').modal("hide");  

            $(`#proyectoMostrar${proyectoIdTotal}`).remove();
        }); 

        $('.borrarProyectoIndividual').on('click', function() {
            proyectoIdTotal = $(`#${this.id}`).attr('name');
            let proyectoJson = obtenerDatajson("nombre_proyecto","con_t_proyectos","valoresconcondicion","ID",`'${proyectoIdTotal}'`);
            let proyect = JSON.parse(proyectoJson);
            $('#modalEliminarProyecto').modal("show"); 
            $('#tituloEliminarProyecto').text(`¿Seguro que desea borrar el proyecto ${proyect[0].nombre_proyecto}?
            Se actualizarán los insumos faltantes`); 
        }); 
        
        $('.verProyectoIndividual').on('click', function() {
            proyectoIdTotal = $(`#${this.id}`).attr('name'); 
            let proyectoJson = obtenerDatajson("satelite,terminados,presupuesto,estado","con_t_proyectos","valoresconcondicion","ID",`'${proyectoIdTotal}'`);
            let proyect = JSON.parse(proyectoJson);
            let terminado = '';
            if (proyect[0].terminados == 0) {
                terminado = 'No requiere terminados';
            }else{
                terminado = 'Requiere terminados';
            }
            let sateliteJson = obtenerDatajson("nombre","con_t_satelites","valoresconcondicion","ID",`'${proyect[0].satelite}'`);
            let satelite = JSON.parse(sateliteJson);

            var idSatelite = 'asignarSatelite';
            if(satelite[0].nombre != 'Sin asignar'){idSatelite='yaAsignado';}

            var asignarTerminados = 'yaAsignado';
            if(proyect[0].estado == 'Cortado' || proyect[0].estado == 'Por cortar'){asignarTerminados='asignarTerminados';}

            var html = `
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerDetallesVistProyecto'> 
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${formatoPrecio(parseInt(proyect[0].presupuesto))}</p>
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc' id='${idSatelite}'>${satelite[0].nombre}</p>
                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc' id='${asignarTerminados}'>${terminado}</p>
                </div>
            `;
            
            $('#detallesProyectoSeleccionado').append(html);

            let tallasproyectoJson = obtenerDatajson("id_detalleproyecto,talla,color,cantidad,id_combinacion,cantidad_cortada","con_t_detalleproyecto","valoresconcondicion","id_proyecto",`${proyectoIdTotal}`);
            let tallasproyecto = JSON.parse(tallasproyectoJson);
            
            var tallasProyectoSeleccionado = '';
            if(proyect[0].estado =='Por cortar'){
                tallasProyectoSeleccionado=`
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerDetallesVistProyecto'> 

                    <p class='col-lg-1 col-md-1 col-sm-1 col-xs-1 letra18pt-pc negrillaTres'>Talla</p>

                    <p class='col-lg-7 col-md-7 col-sm-7 col-xs-7 letra18pt-pc negrillaTres'>Combinación</p>

                    <p class='col-lg-1 col-md-1 col-sm-1 col-xs-1 letra18pt-pc negrillaTres'>Cantidad</p>

                    <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc negrillaTres'>Cantidad real cortada</p>

                </div>`;
            }else{
                tallasProyectoSeleccionado=`
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerDetallesVistProyecto'> 

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Talla</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Combinación</p>

                    <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc negrillaTres'>Cantidad cortada</p>

                </div>`;
            }
            
            for (let i = 0; i < tallasproyecto.length; i++) {
                if(proyect[0].estado =='Por cortar'){
                tallasProyectoSeleccionado = `${tallasProyectoSeleccionado}
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerDetallesVistProyecto' > 
                                
                                <p class='col-lg-1 col-md-1 col-sm-1 col-xs-1 letra18pt-pc' id='tallaCortada${tallasproyecto[i].id_detalleproyecto}'>${tallasproyecto[i].talla}</p>

                                <p class='col-lg-7 col-md-7 col-sm-7 col-xs-7 letra18pt-pc' id='colorCortado${tallasproyecto[i].id_detalleproyecto}' name='${tallasproyecto[i].id_combinacion}'>${tallasproyecto[i].color}</p>

                                <p class='col-lg-1 col-md-1 col-sm-1 col-xs-1 letra18pt-pc'>${tallasproyecto[i].cantidad}</p>

                                <div class=' form-group pmd-textfield pmd-textfield-floating-label  col-lg-3 col-md-3 col-sm-3 col-xs-3'>
                                    <label for="nombreReferencia" class="control-label letra18pt-pc"> Cantidad real </label>
                                    <input class="form-control cantidadesRealesCortadas" type="number" id='cantidadCortada${tallasproyecto[i].id_detalleproyecto}' name='${tallasproyecto[i].id_detalleproyecto}' >
                                    <span class="pmd-textfield-focused"></span>
                                </div>
                            </div>
                    `;    
                }else{
                    tallasProyectoSeleccionado = `${tallasProyectoSeleccionado}
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerDetallesVistProyecto' > 
                                
                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc' id='tallaCortada${tallasproyecto[i].id_detalleproyecto}'>${tallasproyecto[i].talla}</p>

                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc' id='colorCortado${tallasproyecto[i].id_detalleproyecto}'>${tallasproyecto[i].color}</p>

                                <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'>${tallasproyecto[i].cantidad_cortada}</p>

                               
                            </div>
                    `;    
                }            
            }
            tallasProyectoSeleccionado = `${tallasProyectoSeleccionado}
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc removerDetallesVistProyecto' > 
                <button class='botonmodal boton100  removerDetallesVistProyecto' type='button' id='volverProyectosTodos'>Volver a ver los proyectos    </button>
            </div>
            `;
            if(proyect[0].estado =='Por cortar'){
                tallasProyectoSeleccionado = `${tallasProyectoSeleccionado}
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc removerDetallesVistProyecto'>
                    <button class='botonmodal  boton100 removerDetallesVistProyecto' type='button' id='confirmarPrendasCortadas'>Confirmar prendas reales cortadas    </button>
                </div>
                `;}
            $('#tallasProyectoSeleccionado').append(tallasProyectoSeleccionado);
            
            funcionesPrendasCortadas();

            mostrarOcultarDiv('verProyectoDiv','verProyectosDiv'); 
        }); 

        
        
    }

    $('#confirmarSatelite').on('click', function() { 
        var sateliteSelect = $('#sateliteSelect').val(); 
        if(sateliteSelect == 1){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona un satélite`); 
            $(`#${this.id}`).val('');
            return false;
        }
        var marquillas = `<table border="1"><tbody><tr><th>Codigo</th><th>CodigoShow</th><th>Descripción</th></tr>`;
        
        let proyectJson = obtenerDatajson("cantidad_cortada,talla,color,codigo_combinacion,id_ref","con_t_detalleproyecto","valoresconcondicion","id_proyecto",`'${proyectoIdTotal}'`);
        let proyect = JSON.parse(proyectJson);
        // 

        
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = proyectoIdTotal;
        var condicion = prepararjson(objeto);

        objeto = {};
        objeto.tipo = 'string';
        objeto.columna = 'estado';
        objeto.valor = 'En satélite';
        let estadoP = prepararjson(objeto);

        objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'satelite ';
        objeto.valor = parseInt(sateliteSelect);
        let sateliteAsign = prepararjson(objeto);


        actualizarregistros("con_t_proyectos",condicion,estadoP,sateliteAsign,"0","0","0","0","0","0","0","0","0");

        proyectotr('En satélite');

        for (let i = 0; i < proyect.length; i++) {

            let resumJson = obtenerDatajson("nombre,cantidad","con_t_resumen","valoresconcondicion","referencia_id ",`'${proyect[i].id_ref}'`);
            let resum = JSON.parse(resumJson);

            var objeto = {};
            objeto.columna = "referencia_id";
            objeto.valor = proyect[i].id_ref;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'cantidad';
            objeto.valor = parseInt(resum[0].cantidad) + parseInt(proyect[i].cantidad_cortada);
            let cantidad = prepararjson(objeto);

            actualizarregistros("con_t_resumen",condicion,cantidad,"0","0","0","0","0","0","0","0","0","0");

            let nombreProyec = resum[0].nombre;

            for (let j = 0; j < proyect[i].cantidad_cortada; j++) {

                var codigoPrendaD = `P${proyectoIdTotal}${proyect[i].codigo_combinacion}${j+1}D${proyect[i].cantidad_cortada}T${proyect[i].talla}S${sateliteSelect}`;
                var codigoPrenda = codigoPrendaD.replace(" ","")
                var descr = `${nombreProyec} ${proyect[i].color} ${proyect[i].talla}`;
                marquillas = `${marquillas} 
                <tr>
                    <td>${codigoPrenda}914</td>    
                    <td>${codigoPrenda}</td>                
                    <td>${descr}</td>
                </tr>`;

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'referencia_id';
                objeto.valor = proyect[i].id_ref;
                var referencia_id = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'descripcion';
                objeto.valor = descr;
                var descripcion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'codigo';
                objeto.valor = `${codigoPrenda}914`;
                var codigo = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'codigoshow';
                objeto.valor = `${codigoPrenda}`;
                var codigoshow = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'estado';
                objeto.valor = `En satélite`;
                var estado = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'cual';
                objeto.valor = `${sateliteSelect}`;
                var cual = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'string';
                objeto.columna = 'complemento_estado';
                objeto.valor = ``;
                var complemento_estado = prepararjson(objeto);

                const date = new Date();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
                let currentDate = `${year}/${month}/${day}`;//2022-08-08 13:58:58 	
                var objeto = {};
                objeto.tipo = "date";
                objeto.columna = "fecha_cambio";
                objeto.valor = currentDate;
                var fecha  = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'proyecto';
                objeto.valor = proyectoIdTotal;
                var proyecto = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'satelite';
                objeto.valor = sateliteSelect;
                var satelite = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'terminado';
                objeto.valor = terminadoProyecto;
                var terminado = prepararjson(objeto);

                // console.log(`"con_t_trprendas",${referencia_id},${descripcion},${codigo},${codigoshow},${estado},${cual},${complemento_estado},${fecha},${proyecto},${satelite},${terminado},"0"`); 
                insertarfila("con_t_trprendas",referencia_id,descripcion,codigo,codigoshow,estado,cual,complemento_estado,fecha,proyecto,satelite,terminado,"0"); 
               
            }
           
            
        }
        
        marquillas = `${marquillas}     </tbody></table>`;
        $('#marquillas').append(marquillas);
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#marquillas').html()));
        
    }); 
    
    
    var arregloInsumosCortados = [];
    var arregloPrendasCortadas = [];
    const funcionesPrendasCortadas = () => {

        $('#asignarSatelite').on('click', function() { 
            let proyectoJson = obtenerDatajson("satelite,terminados,presupuesto,estado","con_t_proyectos","valoresconcondicion","ID",`'${proyectoIdTotal}'`);
            let proyect = JSON.parse(proyectoJson);
            terminadoProyecto = proyect[0].terminados;
            if(proyect[0].estado == 'Por cortar'){
                $('#modalAlertas').modal("show"); 
                $('#tituloAlertas').text(`El proyecto ${proyectoIdTotal} esta sin cortar, no puedes asignar satélite aún`); 
                $(`#${this.id}`).val('');
                return false;
            }
            if(terminadoProyecto == 0){
                $('#modalSinterminados').modal("show"); 
                $('#tituloSinTerminados').text(`El proyecto ${proyectoIdTotal} indica que no requiere terminados (breches, punteras, etc) ¿Deseas continuar?`); 
                $(`#${this.id}`).val('');
                return false;
            }
            let satelitesJson = obtenerDatajson("ID ,nombre,direccion,telefono","con_t_satelites","variasfilasunicas","0","0");
            satelitesArray = JSON.parse(satelitesJson);
            let htmll = '';
            for (let i = 0; i < satelitesArray.length; i++) {
                htmll=htmll+"<option class='removerSatelites' value='"+satelitesArray[i].ID+"'>"+satelitesArray[i].nombre+"</option>";
                
            }
            $('.removerSatelites').remove();
            let sateliteSelect = $('#sateliteSelect');
            sateliteSelect.append(htmll);
            mostrarOcultarDiv('asignarSateliteDiv','verProyectoDiv'); 
            
        }); 

        $('#confirmarSinTerminados').on('click', function() { 
            $('#modalSinterminados').modal("hide"); 
            let satelitesJson = obtenerDatajson("ID ,nombre,direccion,telefono","con_t_satelites","variasfilasunicas","0","0");
            satelitesArray = JSON.parse(satelitesJson);
            let htmll = '';
            for (let i = 0; i < satelitesArray.length; i++) {
                htmll=htmll+"<option class='removerSatelites' value='"+satelitesArray[i].ID+"'>"+satelitesArray[i].nombre+"</option>";
                
            }
            $('.removerSatelites').remove();
            let sateliteSelect = $('#sateliteSelect');
            sateliteSelect.append(htmll);
            mostrarOcultarDiv('asignarSateliteDiv','verProyectoDiv');
        }); 

        $('#asignarTerminados').on('click', function() { 
            let detallJson = obtenerDatajson("id_ref","con_t_detalleproyecto","valoresconcondicion","id_proyecto",`'${proyectoIdTotal}'`);
            let detall = JSON.parse(detallJson);
            let resumJson = obtenerDatajson("nombre","con_t_resumen","valoresconcondicion","referencia_id ",`'${detall[0].id_ref}'`);
            let resum = JSON.parse(resumJson);
            let fichaJson = obtenerDatajson("ID","con_t_fichatecnica","valoresconcondicion","referencia",`'${resum[0].nombre}'`);
            let ficha = JSON.parse(fichaJson);
            let insumosTJson = obtenerDatajson("ID,insumo,cantidad","con_t_insumosproducto","valoresconcondicion","ficha_tecnica",`'${ficha[0].ID}'`);
            let insumosT = JSON.parse(insumosTJson);
            $('.removerInsumosParaterminados').remove();
            html = ``;
            for (let i = 0; i < insumosT.length; i++) {
                html = `${html}
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 removerInsumosParaterminados">
                    <input type="checkbox" class="letra18pt-pc insumosParaterminados" name='${insumosT[i].ID} '> ${insumosT[i].insumo} se deben terminar ${insumosT[i].cantidad}  </input>
                </div>
                `;
                
            }
            $('#insumosParaTerminados').append(html);
            $('#asignarTerminadosModal').modal("show"); 
        }); 

        $('#asignarTerminadosBoton').on('click', function() { 

            let term = $('#terminadosProyecto').val();
            
            if(parseInt(term)==0){                
                $('#asignarTerminados').text('No requiere terminados');

                var objeto = {};
                objeto.columna = "proyecto_id";
                objeto.valor = proyectoIdTotal;
                var condicion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'activo';
                objeto.valor = 0;
                let activo = prepararjson(objeto);

                actualizarregistros("con_t_terminadoinsumo",condicion,activo,"0","0","0","0","0","0","0","0","0","0");
            }else{
                const checkedInputs = $('.insumosParaterminados:checked');
                if(checkedInputs.length == 0){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`Por favor selecciona al menos un insumo para los terminados.`); 
                    return false;
                }
                checkedInputs.each(function() {
                    const name = $(this).attr('name');

                    var objeto = {};
                    objeto.tipo = 'int';
                    objeto.columna = 'proyecto_id';
                    objeto.valor = proyectoIdTotal;
                    let proyecto_id = prepararjson(objeto);

                    var objeto = {};
                    objeto.tipo = 'int';
                    objeto.columna = 'insumo_id';
                    objeto.valor = name;
                    let insumo_id = prepararjson(objeto);

                    insertarfila("con_t_terminadoinsumo",proyecto_id,insumo_id,"0","0","0","0","0","0","0","0","0"); 

                });
                proyectotr('Terminado asignado');
                $('#asignarTerminados').text('Requiere terminados');
                
            }
            
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = proyectoIdTotal;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'terminados';
            objeto.valor = parseInt(term);
            let terminados = prepararjson(objeto);

            actualizarregistros("con_t_proyectos",condicion,terminados,"0","0","0","0","0","0","0","0","0","0");
           
            

            $('#asignarTerminadosModal').modal("hide"); 

            
        }); 
        

        


        $('#volverProyectosTodos').on('click', function() {  
            $('.removerDetallesVistProyecto').remove();
            mostrarOcultarDiv('verProyectosDiv','verProyectoDiv'); 
        }); 
        $('#confirmarPrendasCortadas').on('click', function() {    
            arregloInsumosCortados=[];
            var cantidadesRealesCortadas = $('.cantidadesRealesCortadas');
            
            for (let i = 0; i < cantidadesRealesCortadas.length; i++) {
                let cantidadCortada = cantidadesRealesCortadas[i].value;
                let combinacion = $(`#colorCortado${cantidadesRealesCortadas[i].name}`).attr('name');
                let idDetalle = $(`#cantidadCortada${cantidadesRealesCortadas[i].name}`).attr('name');
                let colorCortado = $(`#colorCortado${cantidadesRealesCortadas[i].name}`).text();
                let tallaCortada = $(`#tallaCortada${cantidadesRealesCortadas[i].name}`).text();
                
                var objeto = {};
                objeto.detalleID = idDetalle;
                objeto.cantidad = cantidadCortada;
                arregloPrendasCortadas.push(objeto);

                if(!cantidadCortada){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`Por favor ingresa la cantidad de prendas que se cortaron para
                    la talla ${tallaCortada} en el color ${colorCortado}`); 
                    $(`#${this.id}`).val('');
                    return false;
                }
                //   `con_t_combinacionesproyecto` (
                //   `ID` int(11) NOT NULL AUTO_INCREMENT,
                //   `id_proyecto` int(11) NOT NULL,
                //   `id_combinacion` int(5) NOT NULL,
                //   `cantidad` int(200) NOT NULL,
                // let combinacionesJson = obtenerDatajson("nombre","con_t_satelites","valoresconcondicion","ID",`'${proyect[0].satelite}'`);
                // let combinaciones = JSON.parse(combinacionesJson);
                let fichaTecnicaj = obtenerDatajson("indicativo_combinacion,ficha_tecnica","con_t_combinacionesproducto","valoresconcondicion","ID ",combinacion);
                let fichaTecnica = JSON.parse(fichaTecnicaj);
                let insumosproductoj = obtenerDatajson("indicativo_combinacion,insumo,cantidad,text_insumo,ficha_tecnica","con_t_combinacionesproducto","valoresconcondicion","indicativo_combinacion",fichaTecnica[0].indicativo_combinacion);
                let insumosproductos = JSON.parse(insumosproductoj);  
                const insumosproducto = insumosproductos.filter(objeto => objeto.ficha_tecnica === fichaTecnica[0].ficha_tecnica);
                
                const cantidadesAcumuladas = {};
                for (let i = 0; i < insumosproducto.length; i++) {
                    var cantidadUsada = insumosproducto[i].cantidad * cantidadCortada;
                    let insumoCantidadj = obtenerDatajson("cantidad,grupo,complemento,caracteristica,complemento_caracteristica,presentacion,precio_unidad","con_t_insumos","valoresconcondicion","ID ",insumosproducto[i].insumo);
                    let insumoCantidad = JSON.parse(insumoCantidadj);
                    // Verificar si ya existe un objeto con el insumoID en el arreglo
                    const indiceExistente = arregloInsumosCortados.findIndex(objeto => objeto.insumoID === insumosproducto[i].insumo);

                    if (indiceExistente !== -1) {
                        // Si el objeto ya existe, actualizar su cantidad
                        arregloInsumosCortados[indiceExistente].cantidad += cantidadUsada;                        
                        cantidadUsada = arregloInsumosCortados[indiceExistente].cantidad;
                        arregloInsumosCortados[indiceExistente].cantidadNueva =insumoCantidad[0].cantidad- cantidadUsada;
                    } 
                    var textoIsunmo = `${insumoCantidad[0].grupo} ${insumoCantidad[0].complemento} ${insumoCantidad[0].caracteristica} ${insumoCantidad[0].complemento_caracteristica}`;
                    console.log(` ${textoIsunmo.replace(/No aplica/g,"")} insumoCantidad[0].cantidad ${insumoCantidad[0].cantidad}  cantidadUsada ${cantidadUsada}`);
                    if(insumoCantidad[0].cantidad < cantidadUsada){
                        
                        $('#modalAlertas').modal("show"); 
                        $('#tituloAlertas').text(`Por favor las cantidades que se cortaron en 
                         ${colorCortado} de la talla ${tallaCortada}, ya que la cantidad de material que se utilizarían de 
                         ${textoIsunmo.replace(/No aplica/g,"")} es más de los que están registrados en el inventario:
                         Cantidad en inventario: ${insumoCantidad[0].cantidad} ${insumoCantidad[0].presentacion}
                         Cantidad a utilizar para ${cantidadCortada} prendas: ${cantidadUsada} ${insumoCantidad[0].presentacion}`); 
                        $(`#${this.id}`).val('');
                        return false;
                    }
                    if (indiceExistente !== -1) {continue;}
                    var objeto = {};
                    objeto.cantidad = cantidadUsada;
                    objeto.insumoID = insumosproducto[i].insumo;
                    objeto.insumoTexto = textoIsunmo.replace(/No aplica/g,"");
                    objeto.cantidadNueva =insumoCantidad[0].cantidad- cantidadUsada;
                    objeto.precio_unidad =insumoCantidad[0].precio_unidad;
                    arregloInsumosCortados.push(objeto);
                }
                
                
            }

            var htmll = '';
            for (let i = 0; i < arregloInsumosCortados.length; i++) {
                htmll = `${htmll}
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerConfirmacionProyecto'> 
                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc negrillaTres'>${arregloInsumosCortados[i].insumoTexto}</p>
                    <p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 letra18pt-pc negrillaTres'>${arregloInsumosCortados[i].cantidad}</p>
                </div>
                `;
                
            }
            
            $('#isumosCortadosProyectoSeleccionado').append(htmll);
            mostrarOcultarDiv('confirmarCortadoDiv','verProyectoDiv'); 
            console.log('arregloInsumosCortados');
            console.log(arregloInsumosCortados);
        });  
        $('#volverVerproyecto').on('click', function() {  
            $('.removerConfirmacionProyecto').remove();
            mostrarOcultarDiv('verProyectoDiv','confirmarCortadoDiv'); 
        }); 
        $('#confirmaInsumosCortados').on('click', function() {  
            
            var presupuestoNuevo = 0;

            for (let i = 0; i < arregloInsumosCortados.length; i++) {
                
                var objeto = {};
                objeto.columna = "ID";
                objeto.valor = arregloInsumosCortados[i].insumoID;
                var condicion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'cantidad';
                objeto.valor = arregloInsumosCortados[i].cantidadNueva;
                let cantidad = prepararjson(objeto);

                presupuestoNuevo =presupuestoNuevo+( parseInt(arregloInsumosCortados[i].precio_unidad) * parseInt(arregloInsumosCortados[i].cantidad));

                actualizarregistros("con_t_insumos",condicion,cantidad,"0","0","0","0","0","0","0","0","0","0");

            }


            for (let i = 0; i < arregloPrendasCortadas.length; i++) {

                var objeto = {};
                objeto.columna = "id_detalleproyecto ";
                objeto.valor = arregloPrendasCortadas[i].detalleID;
                var condicion = prepararjson(objeto);

                objeto = {};
                objeto.tipo = 'int';
                objeto.columna = 'cantidad_cortada';
                objeto.valor = arregloPrendasCortadas[i].cantidad;
                let cantidad_cortada = prepararjson(objeto);

                actualizarregistros("con_t_detalleproyecto",condicion,cantidad_cortada,"0","0","0","0","0","0","0","0","0","0");
                
            }
            
            objeto = {};
            objeto.tipo = 'int';
            objeto.columna = 'presupuesto';
            objeto.valor = presupuestoNuevo;
            var presupuestoN = prepararjson(objeto);

            
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = proyectoIdTotal;
            var condicion = prepararjson(objeto);

            objeto = {};
            objeto.tipo = 'string';
            objeto.columna = 'estado';
            objeto.valor = 'Cortado';
            let estado = prepararjson(objeto);

            actualizarregistros("con_t_proyectos",condicion,estado,presupuestoN,"0","0","0","0","0","0","0","0","0");

            proyectotr('Cortado');

            const confirmarCortadoDiv = $('#confirmarCortadoDiv');
            const proyectoActualizadoOk = $('#proyectoActualizadoOk');

            confirmarCortadoDiv.removeClass('mostrar').addClass('oculto');
            proyectoActualizadoOk.removeClass('oculto').addClass('mostrar');
            setTimeout(() => {
                proyectoActualizadoOk.removeClass('mostrar').addClass('oculto');
            }, 5000);

            let proyectosJson = obtenerDatajson("ID,nombre_proyecto,fecha_inicio_proyecto,fecha_fin_proyecto,presupuesto,estado","con_t_proyectos","variasfilasunicas","0","0");
            proyectosArray = JSON.parse(proyectosJson);

            var html = '';
            for (let i =  (proyectosArray.length-1); i >= 0; i--) {
                if (proyectosArray[i].estado == 'Eliminado') {continue;}
                html = `${html}
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerVerProyectos' id='proyectoMostrar${proyectosArray[i].ID}'> 
                    <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].nombre_proyecto}</p>
                    <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].estado}</p>
                    <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_inicio_proyecto}</p>
                    <p class='col-lg-2 col-md-2 col-sm-2 col-xs-2 letra18pt-pc '>${proyectosArray[i].fecha_fin_proyecto}</p>
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                        <button class='botonmodal verProyectoIndividual' type='button' id='proyectoN${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                        Ver proyecto
                        </button>
                    </div>`;
                if((eliminarProyecto==1) && (proyectosArray[i].estado == 'Por cortar')){
                    html=`${html}
                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 '> 
                        <button class='botonmodal borrarProyectoIndividual' type='button' id='proyectoB${proyectosArray[i].ID}' name='${proyectosArray[i].ID}'>
                        Borrar proyecto
                        </button>
                    </div>`;
                }
                    
                html = `${html}</div>`; 
            
            }
            $('.removerEspaciosTrabajosFechasInicio').remove();
            $('.removerResumenFinal').remove();
            $('.removerVerProyectos').remove();
            $('.removerDetallesVistProyecto').remove();
            mostrarOcultarDiv('verProyectosDiv','verProyectoDiv'); 
            mostrarDiv('verProyectosDiv'); 
            $('#titulosProyectosVer').after(html);
            proyectoIndividual();

        });  
    }

    const proyectotr = (tipocambioInsert) =>{
        const fechaActual = new Date();

        // Obtener los componentes de la fecha (año, mes, día, hora, minutos y segundos)
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0, por lo que se le suma 1
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        const hora = String(fechaActual.getHours()).padStart(2, '0');
        const minutos = String(fechaActual.getMinutes()).padStart(2, '0');
        const segundos = String(fechaActual.getSeconds()).padStart(2, '0');

        // Construir la cadena de fecha y hora en el formato deseado
        var fechaActuall  = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;


        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_hora";
        objeto.valor = fechaActuall;
        var fecha_hora = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "tipocambio";
        objeto.valor = tipocambioInsert;
        var tipocambio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'id_usuario';
        objeto.valor = parseInt($('#usuario').attr("name"));
        let id_usuario = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = 'int';
        objeto.columna = 'id_proyecto';
        objeto.valor = proyectoIdTotal;
        let id_proyecto = prepararjson(objeto);

        var iDproyectoTR = insertarfila("con_t_proyectostr",id_proyecto,id_usuario,fecha_hora,tipocambio,"0","0","0","0","0","0","0"); 

    }
    $('#agregarSatelites').on('click', function() {    

        mostrarDiv('nuevoSatelite');

    });  
    $('#agregarNuevoSatelite').on('click', function() {    

        var telefonoSatelite = $('#telefonoSatelite').val(); 
        var direcSatelite = $('#direcSatelite').val(); 
        var nombreSatelite = $('#nombreSatelite').val(); 


        // con_t_satelites ID 	nombre 	direccion 	telefono 	
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "nombre";
        objeto.valor = nombreSatelite;
        var nombre = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "direccion";
        objeto.valor = direcSatelite;
        var direccion = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "telefono";
        objeto.valor = telefonoSatelite;
        var telefono = prepararjson(objeto);

        var idSatelite = insertarfila("con_t_satelites",nombre,direccion,telefono,"0","0","0","0","0","0","0","0");

        const nuevoSatelite = $('#nuevoSatelite');
        const sateliteCreadoOk = $('#sateliteCreadoOk');

        nuevoSatelite.removeClass('mostrar').addClass('oculto');
        sateliteCreadoOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            sateliteCreadoOk.removeClass('mostrar').addClass('oculto');
            nuevoSatelite.removeClass('oculto').addClass('mostrar');
        }, 5000);


    }); 
    
    $('#verSatelites').on('click', function() {  

        // con_t_satelites ID 	nombre 	direccion 	telefono 	
        let satelitesJson = obtenerDatajson("ID,nombre,direccion,telefono","con_t_satelites","variasfilasunicas","0","0");
        let satelitesArray = JSON.parse(satelitesJson);

        var html = '';
        for (let i = 1; i < satelitesArray.length; i++) {
            html = `${html}
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 letra18pt-pc removerSatelites'> 
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc '>${satelitesArray[i].ID}</p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc '>${satelitesArray[i].nombre}</p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc '>${satelitesArray[i].direccion}</p>
                <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc '>${satelitesArray[i].telefono}</p>
            </div>
        `; 
        
        }
        $('.removerSatelites').remove();
        mostrarDiv('verSatelitesDiv'); 
        $('#tituloSatelites').after(html);

    });     
   

    const fechaInicioSelect = () => {
        $('.fechaInicioSelect').on('dp.change', function() {

            var fechaSeleccionada = $(`#${this.id}`).val();

            var idFechaInicio = this.id;
            var arregloId = idFechaInicio.split("-");
            
            var fecha = new Date(fechaSeleccionada);
            var dia = fecha.getDay();
            var hora = fecha.getHours();
            var minuts = fecha.getMinutes();
            var segundos = fecha.getSeconds();
            var horaInicioProyecto = `${hora}:${minuts}:${segundos}`;
            

            if(arregloId[1] == 'Espacio'){
                
                var espacioEncontrado = espaciosProyectos.find(function(objeto) {
                    return objeto.espacio === arregloId[2];
                });
                
                var diaEncontrado = espacioEncontrado.horarios.find(function(objeto) {
                    return objeto.dia_semana === dia.toString();
                });

                if(!diaEncontrado){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`La hora y fecha seleccionada no están disponibles en los horarios de ${espacioEncontrado.texto}`); 
                    $(`#${this.id}`).val('');
                    return false;
                }
                var objetoDiferencia = diferenciaMinutosSegundos(diaEncontrado.hora_inicio,horaInicioProyecto);//calculo si la hora de unicio del día es menor a la hora de inicio del proyecto
                var objetoDiferenciaMayor = diferenciaMinutosSegundos(horaInicioProyecto,diaEncontrado.hora_fin);//calculo si la hora de unicio del día es menor a la hora de inicio del proyecto

                
                if(objetoDiferencia.minutos <0 || objetoDiferenciaMayor.minutos < 0){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`La hora y fecha seleccionada no están disponibles en los horarios de ${espacioEncontrado.texto}`); 
                    $(`#${this.id}`).val('');
                    return false;
                }

                var fechaFin = calcularFechaHoraFinal(fechaSeleccionada,espacioEncontrado.minutos,espacioEncontrado.horarios);
               
                // Modificar la propiedad fecha_hora_fin del objeto encontrado
                espacioEncontrado.fecha_hora_fin = `${fechaFin.fecha} ${fechaFin.hora}`;
                espacioEncontrado.fecha_hora_inicio = fechaSeleccionada;

                $(`#e${arregloId[2]}`).text(`${fechaFin.fecha} ${fechaFin.hora}`);
            }
            if(arregloId[1] == 'Trabajador'){

                
                var trabajadorEncontrado = trabajadoresProyectos.find(function(objeto) {
                    return objeto.trabajador === arregloId[2];
                });

                var diaEncontrado = trabajadorEncontrado.horarios.find(function(objeto) {
                    return objeto.dia_semana === dia.toString();
                });

                if(!diaEncontrado){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`La hora y fecha seleccionada no están disponibles en los horarios de ${trabajadorEncontrado.texto}`); 
                    $(`#${this.id}`).val('');
                    return false;
                }

                var objetoDiferencia = diferenciaMinutosSegundos(diaEncontrado.hora_inicio,horaInicioProyecto);//calculo si la hora de unicio del día es menor a la hora de inicio del proyecto
                var objetoDiferenciaMayor = diferenciaMinutosSegundos(horaInicioProyecto,diaEncontrado.hora_fin);//calculo si la hora de unicio del día es menor a la hora de inicio del proyecto
                

                if(objetoDiferencia.minutos <0 || objetoDiferenciaMayor.minutos < 0){
                    $('#modalAlertas').modal("show"); 
                    $('#tituloAlertas').text(`La hora y fecha seleccionada no están disponibles en los horarios de ${trabajadorEncontrado.texto}`); 
                    $(`#${this.id}`).val('');
                    return false;
                }
                
                var fechaFin = calcularFechaHoraFinal(fechaSeleccionada,trabajadorEncontrado.minutos,trabajadorEncontrado.horarios);
                
                // Modificar la propiedad fecha_hora_fin del objeto encontrado
                trabajadorEncontrado.fecha_hora_fin = `${fechaFin.fecha} ${fechaFin.hora}`;
                trabajadorEncontrado.fecha_hora_inicio = fechaSeleccionada;
                $(`#t${arregloId[2]}`).text(`${fechaFin.fecha} ${fechaFin.hora}`);
            }
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
for(i=0;i<permisos.length;i++){
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
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion4'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='agregarEspacios'>Agregar espacios </button></div>");
    }   
    if(permisos[i].permiso_id==52){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion5'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='agregarSatelites'>Agregar satélites </button></div>");
    }   
    if(permisos[i].permiso_id==53){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion6'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='verSatelites'>Ver satélites</button></div>");
    }   
    if(permisos[i].permiso_id==54){
        eliminarProyecto = 1;
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